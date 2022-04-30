<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Moreservicesofserviceproviders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (DB::table('moreservicesofserviceproviders')->count() > 0) {
            return;
        }
        
        DB::table('moreservicesofserviceproviders')->insert($countries);

    }
}
