<?php

namespace App\Http\Controllers\User;

use App\Models\Visitor;

class VisitorController extends Controller
{
    public function GetVisitorDetails()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $result = Visitor::create([
            'ip_address' => $ipAddress
        ]);
        return $result;
    }
}
