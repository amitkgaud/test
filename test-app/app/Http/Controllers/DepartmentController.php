<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        echo storage_path();exit;
//        Log::useDailyFiles(storage_path().'/department_'.date('Y-m-d_H-i-s').'index');

        try {
            $requestdata = $request->all();
            
            Log::info($requestdata);
            
            $department = Department::selectRaw("id,name")->where("status",'1')->get();

            if(!empty($department)){
                return [
                    "success" => true,
                    "data" => $department
                ];
            } else {
                return [
                    "success" => true,
                    "data" => '',
                    "msg" => "No Deapertment Found"
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $rules = [
                'name' => 'required|string',
                'status' => 'required|'.Rule::in([1,0]),
                ];
            $messages = [
                'name.required' => 'The role name field is required.',
                'status.in' => 'The status is invalid.',
            ];
            $request->validate($rules, $messages);
            $data = $request->all();
            $insert['name'] = $data['name'];
            $insert['status'] = $data['status'];
            $insert['created_time'] = date('Y-m-d H:i:s');
            $departement = Department::selectRaw("id")->where("name", $data['name'])->get();
            if(empty($departement)){
                $result = Department::create($insert);
                if(!empty($result)){
                    $resp = [
                            "success" => true,
                            "msg" => "Departement Created Successfully"
                        ];
                } else {
                    $resp = [
                            "success" => true,
                            "msg" => "Departement Creation Failed"
                        ];
                }
            }else {
                $resp = [
                            "success" => true,
                            "msg" => "Departement Name Alreday Exist"
                        ];
            }
            return $resp;
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return [
                    "success" => false,
                    "data" => $e->getMessage(),
                    "msg" => "Something Went Wrong"
                ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $rules = [
                'id' => 'required|int',
                'name' => 'string',
                'status' => 'required|'.Rule::in([1,0]),
                ];
            $messages = [
                'id.required' => 'The id field is required.',
                'status.in' => 'The status is invalid.',
            ];
            $request->validate($rules, $messages);
            $data = $request->all();
            $id =  $data['id'];
            $update['name'] = $data['name'];
            $update['status'] = $data['status'];
            $update['modified_time'] = date('Y-m-d H:i:s');
            $result = Department::where('id', $id)->update($update);
            if(!empty($result)){
                $resp = [
                        "success" => true,
                        "msg" => "Departement updated Successfully"
                    ];
            } else {
                $resp = [
                        "success" => true,
                        "msg" => "Departement updation Failed"
                    ];
            }
            
            return $resp;
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return [
                    "success" => false,
                    "data" => $e->getMessage(),
                    "msg" => "Something Went Wrong"
                ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        try {
            $rules = [
                'id' => 'required|int',
                ];
            $messages = [
                'id.required' => 'The id field is required.',
            ];
            $request->validate($rules, $messages);
            $data = $request->all();
            $id =  $data['id'];
            $update['status'] = 2;
            $update['deleted_by_user'] = 11;
            $update['modified_time'] = date('Y-m-d H:i:s');
            $result = Department::where('id', $id)->update($update);
            if(!empty($result)){
                $resp = [
                        "success" => true,
                        "msg" => "Departement Deleted Successfully"
                    ];
            } else {
                $resp = [
                        "success" => true,
                        "msg" => "Departement Deletion Failed"
                    ];
            }
            
            return $resp;
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return [
                    "success" => false,
                    "data" => $e->getMessage(),
                    "msg" => "Something Went Wrong"
                ];
        }
    }
}
