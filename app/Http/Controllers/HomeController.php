<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PostController;
use DB;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        $posts = Post::with(['category','subcategory'])->paginate(5);
         return view('web.home',compact('posts'));
    }

    public function postshow_By_category($id){
        $data['posts']  = Post::with(['category','subcategory'])->where(['category_id'=> $id, 'deleted_at'=> NULL ])->paginate(5);

      

        $data['category_name'] =  Post::with(['category','subcategory'])->where(['category_id'=> $id, 'deleted_at'=> NULL ])->first();

        $data['totalpost'] = $data['posts']->total();
     
        return view('web.categories',$data);
       

        
    }
}
