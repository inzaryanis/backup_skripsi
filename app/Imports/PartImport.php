<?php

namespace App\Imports;

use App\Masterpart;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;  // membaca heading row di excel


class PartImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Masterpart([
                'part' => $row['part'],
                'series' => $row['series'], 
                'type' => $row['type'], 
                'merk' => $row['merk'], 
                'uom' => $row['uom'],
                'serialized_code' => $row['serialized_code']
        ]);
    }
}
