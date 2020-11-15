<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use App\Comments;
use App\Post;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class CommentController extends Controller
{
    
    public function comments(){
        return view('admin.comments');
    }

    public function comments_list(Request $request){

        if($request->ajax()){
            
            $data = DB::table('comment_reply_mapping AS  crm')
                ->join('posts AS ps',function($join){
                    $join->on('ps.id', '=', 'crm.post_id');
                })
                ->whereNull('crm.comment_id')
                ->where('crm.type',1)
                ->whereNull('crm.deleted_at')
                ->select("crm.id", "crm.post_id", "ps.post_tille","crm.name", "crm.email", "crm.comment")
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tittle',function($row){
                    $post_tittle = $row->post_tille;
                    return $post_tittle;
                    
                })
                ->addColumn('action', function($row){
                    $comment_id = $row->id;
                    $row_id = $row->post_id; 
                    $btn = '<a href="javascript:void(0)" onclick="add_reply('. $row_id .', '.$comment_id.' )" class="edit btn btn-success btn-sm">Reply</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action','tittle'])
                ->make(true);
        }

        


        
    
        

        
        

    }


    public function reply_store(Request $request){

        // 
        if($request->ajax()){
            $reply = new Comments();

            $reply->post_id  = $request->post_id;
            $reply->comment_id   = $request->comment_id ;
            $reply->name    = Auth::user()->user_name; 
            $reply->email     = Auth::user()->email;
            $reply->comment     = $request->message ;
            $reply->type      = 2 ;
            $reply->created_by_ip = $request->ip();

            $result = $reply->save();

           return response()->json([ 
            "status" => $result ? "success" : "error",
            "message" => $result ? "রিপ্লাই  যোগ হয়েছে" : "সফলভাবে রিপ্লাই  যোগ হয় নি"
         ]);


        }
    }
}
