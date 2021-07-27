<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;  // membaca heading row di excel


class CustomerImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            if($row["name"] != NULL)
        return new Customer([
            'name' => $row['name'],
            'short_name' => $row['short_name'],
            'business_type' => $row['business_type'],
            'business_conduct' => $row['business_conduct'],
            'npwp' => $row['npwp'],
            'remarks' => $row['remarks'],
            'active_ind' => $row['active_ind'],
            'code_name' => $row['code_name'],
            'control_by' => $row['control_by'],
            
        ]);
    }
}
