<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function Visitation()
    {
        return view('report.visitation_report');
    }
    public function amountFree()
    {
        return view('report.amount_of_free_visit');
    }
    public function amountPaid()
    {
        return view('report.amount_of_paid_visit');
    }
    public function equipmentUsed()
    {
        return view('report.equipment_used');
    }
    public function gpsMaintenance()
    {
        return view('report.gps_maintenance');
    }

    public function technicianWorkTimes()
    {
        return view('report.technician_work_times');
    }

    public function terminateActivation()
    {
        return view('report.terminate_activation_gsm');
    }

    public function terminateExtension()
    {
        return view('report.terminate_and_extension');
    }

    public function TerminateError()
    {
        return view('report.terminate_of_gsm_erorr');
    }
}
