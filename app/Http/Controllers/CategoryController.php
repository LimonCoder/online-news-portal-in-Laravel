<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use \App\Category;
use Illuminate\Support\Facades\Auth;
use \DataTables;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use custom_helper;

class CategoryController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

    public function index(){
        return view('admin.categories');
    }

    public function store(Request $request){

        if($request->ajax()){
            $operation_type = '';

            if(!empty($request->row_id)){

                $category =  Category::find($request->row_id);
                $operation_type = 'আপডেট';

                if($request->hasFile('icon')){
                    $old_image = public_path('upload/categories/'.$category->icon);
                    if(file_exists($old_image)){
                        @unlink($old_image);
                    }
                    $file_name = time().".".$request->icon->extenstion();
                    $category->icon =  $file_name;
                    $request->icon->move('upload/categories/',$file_name);
                }

                $validate = Validator::make($request->all(),
                    ['name' => ['required'] ],
                    ['name.required'=> 'নাম প্রদান করুন' ]
                );
                $category->updated_at  = date('Y-m-d H:i:s');
                $category->updated_by_ip = $request->ip();


            }else{
                 $category = new Category();
                  $operation_type =' জমা';

                    $validate =  Validator::make($request->all(),
                    [ 'name' => ['required' ,Rule::unique('categories', 'name')->whereNull('deleted_at')]
                     ],
                     [ 'name.required' => 'নাম প্রদান করুন', 'name.unique'=> 'এই নাম আগে ব্যবহার হয়েছে' ]
                );

                if($request->hasFile('icon')){
                    $filename = time().'.'.$request->icon->extension();
                    $category->icon  =  $filename;
                    $request->icon->move(public_path('upload/categories/'),$filename);
                }
                $category->created_by  = Auth::user()->user_name; 
                $category->created_by_ip =  request()->ip();


            }

            
            
            

            if(!$validate->fails()){
                if($request->category != null){
                     $category->parent_id =  $request->category;
                     $category->type = 2;
                     $store = "সাব-ক্যাটেগরি";

                }else{
                     $category->parent_id =  null;
                     $category->type = 1;
                     $store = "ক্যাটেগরি";
                }
                $category->name = $request->name;
                $category->serial = $request->sorting;
                $category->is_show = $request->is_show != null ? 1 : 0;
                $status = $category->save();

                return response()->json(
                    [
                        "status" => $status ? "success": "error",
                        "massege" => $status ? " $store সফলভাবে $operation_type  হয়েছে " : " $store সফলভাবে সম্পন্ন হয়েনি"
                    ]);

                
            }else {
                return response()->json(["errors"=> $validate->errors() ]);
            }

            


        }

        
    }

    public function categories(){
        $data =  Category::where(['type'=>1, 'deleted_at'=> null])->get();
        return response()->json( $data);
    }

    public function categories_list(Request $request)
    {
        if($request->ajax()){
            $response = Category::categories_list();
            return DataTables::of( $response)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.categories');   

    }
    
    public function category_delete(Request $request){

        $result = Category::where('id',$request->id)->delete();

        return response()->json([
            "status" =>  $result ? "success":"error",
            "massage" =>  $result ? "সফলভাবে ডিলিট সম্পন্ন হয়েছে" : "ডিলিট সম্পন্ন হয়নি"
        ]);
    }
}
