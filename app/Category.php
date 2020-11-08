<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
     protected $table = 'categories';
     public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public static function categories_list(){

        $data = DB::table('categories AS cat')
        ->select(
            DB::raw('IF(cat.type = 1, cat.name, IF(cat.type = 2,subcat.name,null)) category_name'),
            DB::raw('IF(cat.type = 2, cat.name, null) sub_catgory_name'), "cat.id","cat.type","cat.serial",
            "cat.is_show","cat.parent_id")
        ->leftJoin('categories AS subcat', 'subcat.id', '=', 'cat.parent_id')
        ->where('cat.deleted_at', NULL)
        ->orderBy('cat.serial', 'asc')
        ->get();
        return $data;
    }
    
}
