<?php

namespace App\Imports;

use App\Gps_installation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;  // membaca heading row di excel




class GpsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Gps_installation([
            'id_customer' => $row['id_customer'],
            'no_polisi' => $row['no_polisi'],
            'po_customer_number' => $row['po_customer_number'],
            'po_customer_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['po_customer_date'])->format('y-m-d'),
            'imei' => $row['imei'],
            'gsm_number' => $row['gsm_number'],
            'merk' => $row['merk'],
            'type' => $row['type'],
            'gsm_provider' => $row['gsm_provider'],
            'gps_owned_by' => $row['gps_owned_by'],
            'gps_status' => $row['gps_status'],
            'gps_install_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['gps_install_date'])->format('y-m-d'),
            'gps_uninstall_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['gps_uninstall_date'])->format('y-m-d'),
            'remarks' => $row['remarks'],
            'fuel_sensor' => $row['fuel_sensor'],
            'door_sensor' => $row['door_sensor'],
            'door_sensor_remarks' => $row['door_sensor_remarks'],
            'immobilizer_sensor' => $row['immobilizer_sensor'],
            'rfid_sensor' => $row['rfid_sensor'],
            'temperature_sensor' => $row['temperature_sensor'],
            'temperature_sensor_remarks' => $row['temperature_sensor_remarks'],
            'button_sensor' => $row['button_sensor'],
            'button_sensor_remarks' => $row['button_sensor_remarks'],
            'dump_sensor' => $row['dump_sensor'],
            'tail_sensor' => $row['tail_sensor'],
            'camera_sensor' => $row['camera_sensor'],
            'pust_to_talk' => $row['pust_to_talk'],
            'gps_port' => $row['gps_port'],
            'installation_location' => $row['installation_location'],
            'oslog_status' => $row['oslog_status'],
            'oslog_inactive_date' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['oslog_inactive_date'])->format('y-m-d'),
            'oslog_active_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['oslog_active_date'])->format('y-m-d'),
            'gsm_terminated_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['gsm_terminated_date'])->format('y-m-d'),
            'ex_no_polisi' => $row['ex_no_polisi'],
            'ex_imei' => $row['ex_imei'],
            'ex_gsm_number' => $row['ex_gsm_number'],
            'note' => $row['note'],

        ]);
    }
}
