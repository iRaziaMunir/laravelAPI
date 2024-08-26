<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    //13.Fetch all offices located in a specific country:

        
    public function getCountryOffice($country){

        $countryOffice = Office::where('country', $country)->get();

        return response()->json(['offices' => $countryOffice]);
    }
}
