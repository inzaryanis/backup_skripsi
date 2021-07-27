<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gps_installation extends Model
{
    protected $table = 'gps_installation';

    protected $fillable = [
        'id_customer',
        'no_polisi',
        'po_customer_number' ,
        'po_customer_date' ,
        'imei' ,
        'gsm_number' ,
        'merk',
        'type',
        'gsm_provider',
        'gps_owned_by' ,
        'gps_status' ,
        'gps_install_date' ,
        'gps_uninstall_date' ,
        'remarks' ,
        'fuel_sensor' ,
        'door_sensor',
        'door_sensor_remarks' ,
        'immobilizer_sensor' ,
        'rfid_sensor' ,
        'temperature_sensor',
        'temperature_sensor_remarks' ,
        'button_sensor' ,
        'button_sensor_remarks' ,
        'dump_sensor' ,
        'tail_sensor' ,
        'camera_sensor' ,
        'pust_to_talk' ,
        'gps_port' ,
        'installation_location',
        'oslog_status' ,
        'oslog_inactive_date',
        'oslog_active_date' ,
        'gsm_terminated_date' ,
        'ex_no_polisi' ,
        'ex_imei',
        'ex_gsm_number',
        'note' 
    ];

   //relasi sama tabel customer
   public function customer(){
    return $this->belongsTo('\App\Customer','id_customer','id');
}

public function union_nomor_polisi(){
    return $this->hasMany('\App\Union_nomor_polisi');
}
}
