<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Specializations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (DB::table('specializations')->count() > 0) {
            return;
        }
        $specializations = array(
            array('id' => 1,'name_ar' => 'مسالك' ,'name_en' => "Medicine",'serviceCatogrey_id' => 1,'isActive' => 1),
            array('id' => 2,'name_ar' => 'اسنان' ,'name_en' => "tuooth",'serviceCatogrey_id' => 1,'isActive' => 1),
        );
        
        DB::table('specializations')->insert($specializations);

    }
}
