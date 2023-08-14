<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// model
use App\Models\Package;

class PricingController extends Controller
{
    //
    public function index() {
        $packagesStandart = Package::where('name','standart')->get();
        $packagesGold = Package::where('name','gold')->get();
       
        return view('member.pricing.index', 
        [
            'standart' => $packagesStandart, 
            'gold' => $packagesGold
        ]);
    }
}
