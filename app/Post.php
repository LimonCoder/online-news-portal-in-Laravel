<?php

namespace App;

use App\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $table = "posts";
    const CREATED_AT = 'created_at';
    public $timestamps = true;
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];
    use SoftDeletes;


    public function category(){
       return $this->hasOne('App\Category','id','category_id');
    }

    public function subcategory(){
        return $this->hasOne('App\Category','id','subcategory_id');
    }

    

    
}
