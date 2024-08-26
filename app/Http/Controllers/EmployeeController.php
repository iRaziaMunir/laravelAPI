<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //6.Fetch employees working in a specific office:

        public function getOfficeEmployees($officeCode){

            try{
                $employees = Employee::where('officeCode', $officeCode)->get();
                if($employees->isEmpty()){

                    return response()->json(['message' => 'No employee found for this office code'], 200);
                }
                return response()->json($employees);
            }
            catch(Exception $e){

                return response()->json(['error' => $e->getMessage()], 500);
            }
            
        }

}
