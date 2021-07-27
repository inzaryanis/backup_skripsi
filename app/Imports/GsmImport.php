<?php

namespace App\Imports;

use App\Gsm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;  // membaca heading row di excel

class GsmImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Gsm([
            'gsm_number' => $row['gsm_number'],
            'serial_number' => $row['serial_number'], 
        ]);
    }
}
