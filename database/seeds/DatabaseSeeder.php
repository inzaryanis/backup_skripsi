<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){

        // DB::table('rfs')->insert([
        //     'rfs_number'=> '00001',
        //     'request_type'=>'request',
        //     'request_from'=>'internal',
        //     'request_media'=>'1',
        //     'company_requestor'=>'Novi',
        //     'company'=>'IU',
        //     'requestor_pic'=>'Reza',
        //     'phone_number'=>'089765754676',
        //     'task'=>'GPS Delay',
        //     'task_description'=>'Delay merah',
        //     'location'=>'Bandung',
        //     'response_by'=>'ambar',
        //     'response_input_by'=>'ambar',
        //     'response_media'=>'WA',
        //     'response_duration'=>'120',
        //     'status'=>'open',
        //     'created_by'=>'jamal',



            DB::table('rfs')->insert([
                'rfs_number'=> $faker->numberBetween(0, 99999) ,
                'request_type'=>$faker->title,
                'request_from'=>$faker->title,
                'request_media'=>'1' ,
                'company_requestor'=>$faker->title,
                'company'=>$faker->title,
                'requestor_pic'=>$faker->title,
                'phone_number'=>$faker->title,
                'task'=>$faker->title,
                'task_description'=>$faker->sentence,
                'location'=>$faker->sentence,
                'response_by'=>$faker->title,
                'response_input_by'=>$faker->title,
                'response_media'=>$faker->title,
                'response_duration'=>$faker->numberBetween(0, 99999) ,
                'status'=>$faker->title,
                'created_by'=>$faker->title,



        ]);
        

    }
    }}