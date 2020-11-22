<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


function permission_check($role_id, $module = null){

   $widgets = DB::table('users')
    ->join('acls','users.role_id',"=",'acls.id')
    ->select('acls.widgets')
    ->where('acls.id',$role_id)
    ->first();

    $widget_array = explode("##",$widgets->widgets);
    if($module != null){
        if(in_array($module, $widget_array)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}


?>