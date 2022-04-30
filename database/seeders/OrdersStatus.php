<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (DB::table('ordersStatus')->count() > 0) {
            return;
        }
        $specializations = array(
            array('id' => 1,'name' => 'review' ,'descUser_ar' => "جاري مراجعة الحجز في الادارة",'descUser_en' => "Review by the administration",'descProvider_ar' => "",'descProvider_en' => ""),
            array('id' => 2,'name' => 'review_refused' ,'descUser_ar' => "تم رفض الحجز من الادارة يرجي مراجعة الشروط والاحكام جيدا قبل انشاء حجز",'descUser_en' => "The Reservation was rejected by the administration. Please review the terms and conditions carefully before creating a reservation",'descProvider_ar' => "",'descProvider_en' => ""),
            array('id' => 3,'name' => 'review_accept' ,'descUser_ar' => "تم ارسال الحجز لمقدم الخدمة وبانتظار الرد",'descUser_en' => "The reservation has been sent to the service provider and is awaiting a response.",'descProvider_ar' => "",'descProvider_en' => ""),
            array('id' => 4,'name' => 'provider_accept' ,'descUser_ar' => "مقدم الخدمة قد وافق علي الحجز",'descUser_en' => "The service provider has agreed to the reservation",'descProvider_ar' => "تمت الموافقة",'descProvider_en' => "Approved"),
            array('id' => 5,'name' => 'provider_refused' ,'descUser_ar' => "مقدم الخدمة قد رفض الحجز",'descUser_en' => "The service provider has refused the reservation",'descProvider_ar' => "تمت الرفض",'descProvider_en' => "Rejected"),

        );
        
        DB::table('ordersStatus')->insert($specializations);
    }
}
