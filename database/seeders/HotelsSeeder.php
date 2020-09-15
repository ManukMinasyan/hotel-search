<?php

namespace Database\Seeders;

use App\Services\CsvSeeder;
use Illuminate\Support\Facades\DB;

class HotelsSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'hotels';
        $this->filename = base_path().'/database/files/property-data.csv';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table($this->table)->truncate();

        parent::run();
    }
}