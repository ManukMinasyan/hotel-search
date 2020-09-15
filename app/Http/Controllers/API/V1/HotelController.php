<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Get All Hotels With Resource
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() {
        return HotelResource::collection(Hotel::all());
    }

    /**
     * @param  FilterRequest  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function filter(FilterRequest $request)
    {
        $hotels = Hotel::query();

        $filteredFields = [
            'name' =>  'LIKE',
            'bathrooms' => '=',
            'bedrooms' => '=',
            'garages' => '=',
            'storeys' => '='
        ];

        foreach ($filteredFields as $key=>$operator) {
            if ($request->has($key)) {
                $query = $request[$key];
                if ($operator === 'LIKE') {
                    $query = '%'.trim($query).'%';
                } else {
                    $query = (int)$query;
                }

                $hotels = $hotels->where($key, $operator, $query);
            }
        }

        $price = json_decode($request->price);

        if ($request->has('price')) {
            $hotels = $hotels->where('price', '>=', $price->start);

            $hotels = $hotels->where('price', '<=', $price->end);
        }

        return HotelResource::collection($hotels->get());
    }
}