<?php

namespace App\Http\Controllers;



use App\Post;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;

class PostController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.posts_list');
    }


    public function posts_list(Request $request){

        $data = $this->fetech_posts($request);

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->addColumn('date',function($row){
                    return date("d-m-Y", strtotime($row->created_at));
                })
                ->rawColumns(['action','date'])
                ->make(true);
    }

    public function fetech_posts(Request $request){

        $data = DB::table('posts')
        ->join("categories AS CAT",function($join){
            $join->on('CAT.id','=','posts.category_id');
        })
        ->join("categories AS SUBCAT",function($join){
            $join->on('SUBCAT.id','=','posts.subcategory_id');
        })
        
        ->select("posts.*","CAT.name AS category_name","SUBCAT.name AS Subcategroy_name");
        if($request->category_id > 0 ){
            $data->where('posts.category_id','=',$request->category_id);   
        }
        if($request->sub_category_id > 0){
            $data->where('posts.subcategory_id','=',$request->sub_category_id);   
        }

        $data = $data->whereNull('posts.deleted_at')->get();
        return $data;
    }


    public function getsubcategoryBycategory(Request $request){

        if($request->ajax()){
            $data = DB::table('categories')
                    ->select('id','name')
                    ->where(['type'=> 2, "parent_id"=> $request->id, "deleted_at" => NULL ])
                    ->get();
            return response()->json($data);
        }
    }

    
    public function create()
    {
        $data['categories'] = Category::where(['type'=> 1, 'deleted_at'=> NULL ])->get();
        
        return view('admin.add_post',$data);
    }

   
    public function store(Request $request)
    {       
            
            $request->validate(
            [
            'category' => 'required',
            'sub_category' => 'required',
            'postname' => 'required',
            'postdescription' => 'required'
            ],
            [
                'category.required' => 'ক্যাটাগরি সিলেক্ট করুন',
                'sub_category.required' => 'সাব-ক্যাটাগরি সিলেক্ট করুন',
                'postname.required' => 'পোষ্টের নাম লিখুন',
                'postdescription.required' => 'পোষ্টের বর্ণনা লিখুন',
                'postimage.required' =>'image has been empty',
            ]
        );

        

       

            if(!empty($request->row_id)){
                $post = Post::find($request->row_id);
                $operation_type = "আপডেট";
                $post->updated_at =  date('Y-m-d H:i:s');
                $post->updated_by_ip  =  $request->ip();
            }else{
                $post = new Post();
                $operation_type = "জমা";
                $post->created_by = Auth::user()->user_name;
                $post->created_by_ip = $request->ip();
                
                if ($files = $request->file('postimage')) {
                $iamges = '';
                foreach ($files as $key => $file) {
                    $extension = ['jpeg','png','jpg'];
                        if(in_array($file->getClientOriginalExtension(),$extension)){
                            $file_Name = date('YmdHis') .$key."." . $file->getClientOriginalExtension();
                            $file->move(public_path('upload/posts/'), $file_Name);
                            $iamges .= $file_Name."##";
                        }
                        

                    }

                    $post->images = $iamges;

                 }
            }

            $post->category_id  = $request->category;
            $post->subcategory_id  = $request->sub_category;
            $post->post_tille   = $request->postname;
            $post->post_description   = strip_tags($request->postdescription) ;
            

            $results = $post->save();

            if($results){

                return redirect()->route('post.create')->with('status', $operation_type);

            }
           



        




        
    }


    

    
    public function show(Post $post)
    {
        //
    }

    
    public function edit(Post $post)
    {
        //
    }

    
    public function update(Request $request, Post $post)
    {
        //
    }

    

    public function destroy(Post $post)
    {
        //
    }
}
