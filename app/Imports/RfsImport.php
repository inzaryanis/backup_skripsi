<?php

namespace App\Imports;

use App\Rfs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;  // membaca heading row di excel


class RfsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rfs([

                'rfs_number' => $row['rfs_number'],
                'company_requestor' => $row['company_requestor'],
                'request_from' => $row['request_from'],
                'task' => $row['task'],
                'request_date' => $row['request_date'],
                'request_media' => $row['request_media'],
                'task_description' => $row['task_description'],
                'response_date' => $row['response_date'],
                'response_by' => $row['response_by'],
                'response_media' => $row['response_media'],
                'status' => $row['status'],
                'company' => $row['company'],
                'location' => $row['location'],
                'phone_number' => $row['phone_number'],
                'status_description' => $row['status_description'],
                'request_type' => $row['request_type'],
                'response_input_by' => $row['response_input_by'],

        ]);
    }
}
