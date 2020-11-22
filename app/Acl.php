<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Acl extends Model
{
    protected $table = "acls";
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function users(){
        return $this->hasMany('App\User','role_id','id');
    }
    
}
