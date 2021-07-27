<?php

namespace App\Imports;

use App\Customer_address;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;  // membaca heading row di excel


class AddressImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer_address([
            'id_customer' => $row['id_customer'],
            'office_type' => $row['office_type'],
            'address_text' => $row['address_text'],
            'first_address_line' => $row['first_address_line'],
            'second_address_line' => $row['second_address_line'],
            'third_address_line' => $row['third_address_line'],
            'city_area' => $row['city_area'],
            'postal_zip_code' => $row['postal_zip_code'],
            'country_area' => $row['country_area'],
        ]);
    }
}
