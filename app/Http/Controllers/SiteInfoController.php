<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    public function GetAllSiteInfo()
    {
        $siteInfo = SiteInfo::all();
        return $siteInfo;
    }
}
