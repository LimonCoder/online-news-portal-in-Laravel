<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acl;
use Illuminate\Support\Facades\Auth;
use DataTables;
use custom_helper;


class AclController extends Controller
{

    public function index(){
        return view('admin.acl.acl_lists');

    }

    public function create(){
       return view('admin.acl.create');
    }

    public function acl_list(){
        $acl_data = Acl::all();

        return DataTables::of($acl_data)
        ->addIndexColumn()
        ->addColumn('date', function($row) {
            $date = $row->created_at->diffForHumans() ;
            return $date;
        })
        ->addColumn('action',function($row){
            $is_active = (Auth::user()->role_id == $row->id || $row->id === 1 )? 'disabled' : '';

            $map = "<a href='javascript:void(0)' class='edit btn btn-primary btn-sm' onclick=''  $is_active >আপডেট</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' $is_active >মুছুন</a>";
            return $map;
        })
        ->rawColumns(['date','action'])
        ->make(true);
    }

    public function store(Request $request){

        $acl = new Acl();

        $widgets = (array) $request->widget;
        $widgets_item = implode("##",$widgets);




        $acl->name = $request->role_name;
        $acl->widgets  = $widgets_item;
        $acl->created_by  = Auth::user()->user_name;
        $acl->created_by_ip = $request->ip();

        $result = $acl->save();

        if($result){

            return redirect()->route('acl.index')->with('success', 'role create successfully');

        }else{

            return redirect()->route('acl.index')->with('error', 'role create faild');
        }




    }



}
