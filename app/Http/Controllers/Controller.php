<?php

namespace App\Http\Controllers;

use App\Models\Visitor;

abstract class Controller
{
    public function GetVisitorDetails()
    {
        date_default_timezone_set("Asia/Tehran");
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $visitTime = date("h:i:sa");
        $visitDate = date("Y:m:d");
        $result = Visitor::create([
            'ip_address' => $ipAddress,
            'visit_time' => $visitTime,
            'visit_date' => $visitDate,
        ]);
        return $result;
    }
}
