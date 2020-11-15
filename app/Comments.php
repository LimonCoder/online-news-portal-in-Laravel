<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
     protected $table = 'comment_reply_mapping';
    //  public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    


}
