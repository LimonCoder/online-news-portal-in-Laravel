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
        // $data = DB::table('posts')
        // ->join("categories AS CAT",function($join){
        //     $join->on('CAT.id','=','posts.category_id');
        // })
        // ->join("categories AS SUBCAT",function($join){
        //     $join->on('SUBCAT.id','=','posts.subcategory_id');
        // })
        // ->select("posts.*","CAT.name AS category_name","SUBCAT.name AS Subcategroy_name")
        // ->whereNull('posts.deleted_at')->get();
        
         return view('web.home',compact('posts'));
    }
}
