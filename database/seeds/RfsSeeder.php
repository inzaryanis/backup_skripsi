<?php

use Illuminate\Database\Seeder;

class RfsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rfs')->insert([
            'rfs_number'=> '00001',
            'request_type'=>'request',
            'request_from'=>'internal',
            'request_media'=>'email',
            'requestor'=>'Novi',
            'requestor_group'=>'IU',
            'requestor_pic'=>'Reza',
            'phone_number'=>'089765754676',
            'task'=>'GPS Delay',
            'task_description'=>'Delay merah',
            'location'=>'Bandung',
            'response_by'=>'ambar',
            'response_input_by'=>'ambar',
            'response_media'=>'WA',
            'status'=>'Done',
            ]);
    }
}

