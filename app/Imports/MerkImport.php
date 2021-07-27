<?php

namespace App\Imports;

use App\Merk;
use Maatwebsite\Excel\Concerns\ToModel;

class MerkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Merk([
            'merk' => $row[0],
        ]);
    }
}
