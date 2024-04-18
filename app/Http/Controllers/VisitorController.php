<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function GetVisitorDetails()
    {
        date_default_timezone_set("Asia/Tehran");
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $visitorDate = date('Y:m:d');
        $visitorTime = date('h:i:sa');
        Visitor::create([
            'ip_address' => $ipAddress,
            'visit_time' => $visitorTime,
            'visit_date' => $visitorDate,
        ]);
    }
}
