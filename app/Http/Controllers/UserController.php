<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    public function create(){
        $roles_data = DB::table('acls')
                        ->whereNull('deleted_at')
                        ->select(['id','name'])
                        ->get();
        return view('admin.users',compact('roles_data'));
    }

    public function store(Request $request){
        $user = new User();


        if($request->ajax()){
            $operation = "";
            if(!empty($request->row_id)){
                $operation = "update";


            }else{
               $operation = "save";

               $user->user_name =  $request->user_name;
               $user->role_id  = $request->role;
               $user->email = $request->user_email;
               $user->mobile_number = $request->user_number;
               $user->password  = Hash::make($request->password);
               $user->type =  $request->user_type;
               $user->created_by_ip = $request->ip();






            }

            $result = $user->save();

            return response()->json(
                [
                    "status" => $result ? "success" :"error",
                    "message" =>  $result ? "successfully $operation": "$operation faild" 
                ]
            );
        }
    }
}
