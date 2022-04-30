<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (DB::table('users')->count() > 0) {
            return;
        }
        $this->faker = Faker::create();

        $country_id = Country::all()->random()->first()->id;
        $state_id = State::where('country_id', $country_id)->get()->random()->first()->id;
        $city_id = City::where('state_id', $state_id)->get()->random()->first()->id;

      //  dd(Str::random(10));
        for ($x = 0; $x <= 10; $x++) {
            DB::table('users')->insert([
                'image' => Str::random(10),
                'name' => $this->faker->name(),
                'email' => Str::random(10).'@gmail.com',
                'phone' => Str::random(10),
                'country_id' => $country_id,
                'state_id' => $state_id ,
                'city_id' => $city_id,
                'gender' =>  1,
                'isActive' => true,
                'password' => Hash::make('password'),
                'created_at' => now(),
            ]);
              }
          
        //



    }
}
