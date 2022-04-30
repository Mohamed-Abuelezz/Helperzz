<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesCatogries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        if (DB::table('servicescatogries')->count() > 0) {
            return;
        }
        $servicescatogries = array(
            array('id' => 1,'name_ar' => 'الطب' ,'name_en' => "Medicine",'isActive' => 1),
            array('id' => 2,'name_ar' => 'التعليم' ,'name_en' => "Education",'isActive' => 1),
        );
        
        DB::table('servicescatogries')->insert($servicescatogries);

    }
}
