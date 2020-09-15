<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
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

    public function filter() {

    }
}