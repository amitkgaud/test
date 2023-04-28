<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeAddress;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    //
    public function employee_search(Request $request){

        try {
            $requestdata = $request->all();
            
            Log::info($requestdata);
            $rules = [
                'search' => 'required|string',
                ];
            $messages = [
                'search.required' => 'The serch field is required.',
            ];
            $request->validate($rules, $messages);
            $searchTerm = $requestdata['search'];
            
            $employee = Employee::selectRaw("id,name")->where("status",'1')->
                    where('name', 'LIKE', "%{$searchTerm}%") ->get();

            if(!empty($employee)){
                return [
                    "success" => true,
                    "data" => $employee
                ];
            } else {
                return [
                    "success" => true,
                    "data" => '',
                    "msg" => "No Employee Found"
                ];
            }

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return [
                    "success" => false,
                    "msg" => "Something Went Wrong"
                ];
        }
      
    }
}
