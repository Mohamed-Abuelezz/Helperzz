<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoreServices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (DB::table('moreservices')->count() > 0) {
            return;
        }
        $specializations = array(
            array('id' => 1,'name_ar' => 'بواسير' ,'name_en' => "Bwaser",'specialization_id' => 1,'isActive' => 1),
            array('id' => 2,'name_ar' => 'بواسير 1' ,'name_en' => "Bwaser1",'specialization_id' => 1,'isActive' => 1),
            array('id' => 3,'name_ar' => 'بواسير2 ' ,'name_en' => "Bwaser2",'specialization_id' => 1,'isActive' => 1),
            array('id' => 4,'name_ar' => 'بواسير3 ' ,'name_en' => "Bwaser3",'specialization_id' => 1,'isActive' => 1),
            array('id' => 5,'name_ar' => 'بواسير4' ,'name_en' => "Bwaser4",'specialization_id' => 1,'isActive' => 1),
            array('id' => 6,'name_ar' => 'بواسير5' ,'name_en' => "Bwaser5",'specialization_id' => 1,'isActive' => 1),
        );
        
        DB::table('moreservices')->insert($specializations);

    }
}
