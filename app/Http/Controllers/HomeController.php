<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PostController;
use Illuminate\Support\Facades\DB;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Comments;

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

    public function single_post($id){
        $post =Post::with(['category','subcategory'])->where(['id'=> $id, 'deleted_at'=> NULL ])->first();
        return view('web.single_post',compact('post'));
    }

    public function store(Request $request){
        
        $data = new Comments();

        $data->post_id  = $request->post_id;

        $operation = '';

        if(isset($request->comment_id) && !empty($request->comment_id)){
            $operation = "reply";
            $data->comment_id = $request->comment_id;
            $data->type = 2;
        }else{
            $operation = "comment";
            $data->email = $request->user_email;
            $data->type = 1;

        }

        $data->name =  $request->user_name;
        $data->comment =  $request->comment_descript;
        $data->created_by_ip =  $request->ip();
        

        $result = $data->save();

        return response()->json([ 
            "status" => $result ? "success" : "error",
            "message" => $result ? "সফলভাবে $operation  যোগ হয়েছে" : "সফলভাবে $operation  যোগ হয় নি"
        ]);

    }


    public function comments_list(Request $request){
        $data =  DB::table('comment_reply_mapping')
                ->whereNull('comment_id')
                ->where('post_id',$request->post_id)
                ->where('type',1)
                ->whereNull('deleted_at')
                ->get();

        return response()->json([ 
            "status" =>  "success",
            "data" => $data
         ]);

    }

    public function fetch_reply(){
        

        $reply_data = DB::table('comment_reply_mapping')
                    ->whereNotNull('comment_id')
                    ->where('type',2)
                    ->whereNull('deleted_at')
                    ->get()->toArray();
    

        $comment_id = [];

        foreach ($reply_data as $item) {
            array_push($comment_id,$item->comment_id);
        }

        $info = [];

        foreach ($reply_data as $value) {
           $info[$value->comment_id] = DB::table('comment_reply_mapping')
                    ->where('comment_id',$value->comment_id)
                    ->where('type',2)
                    ->whereNull('deleted_at')
                    ->get()->toArray();
        }
    
              
        return response()->json(["status"=> "success", "comment_id"=>$comment_id, "data"=> $info]);            
    }
}
