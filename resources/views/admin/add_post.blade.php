@extends('layouts.admin')
@section('tittle','Add Post')

@section('css')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>

</style>

@endsection

@section('content')
<ul>
@foreach ($errors->all() as $message) 
    <li>{{$message}}</li>
@endforeach
</ul>
<div class="content">
    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Tables</a></li>
                <li><a>Data-table</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                
                <form action="{{url('/post/store')}}" id="AddPostFrom" method="POST" enctype="multipart/form-data" >    
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">ক্যাটাগরি:</label>
                        <div class="col-md-9">
                            <select class="form-control" id="category" name="category" onchange="getsubcategory(this.value)"  >
                                <option value=""> নির্বাচন করুণ</option>
                                @foreach (App\Category::where(['type'=> 1, 'deleted_at'=> NULL ])->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach                           
                            </select>
                            @error('category')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">সাব-ক্যাটাগরি:</label>
                        <div class="col-md-9">
                            <select class="form-control" id="sub_category"  name="sub_category">
                                <option value="">নির্বাচন করুণ</option></select>
                            @error('sub_category')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">পোষ্টের নাম:</label>
                        <div class="col-md-9">
                            <input class="form-control is-invalid" type="text" name="postname" id="postname" placeholder="পন্যের নাম লিখুন">
                            @error('postname')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">পোষ্টের বিবরণ:</label>
                        <div class="col-md-9">
                            <textarea id="postdescription" name="postdescription"></textarea>
                            @error('postdescription')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">পোষ্টের ছবি:</label>
                        <div class="col-md-9">

                            <div class="row" id="picture_input1">
                                <div class="col-sm-6">
                                    <input class="form-control-file" type="file" id="postimage" name="postimage[]"  accept="image/*" multiple>
                                    @error('postimage')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product_pictures"></div>
                    <div class="row justify-content-center">
                         <div class="col-sm-2 col-sm-offset-6">
                              <input type="hidden" name="row_id" id="row_id" value="">
                            <button type="submit" class="btn btn-primary text-center" >সাবমিট</button> <button class="btn btn-warning text-center" >বাতিল</button>
                           
                         </div>
                         
                     </div>
                </form>     
                </div>
            </div>

            
        </div>
    </div>
</div>

<!-- when post has been saved then this if excuted  -->
@if (session('status'))
     <script>
        swal(" সফলভাবে {{ session('status') }} হয়েছে  " , {
            icon: "success",
            buttons:false,
            timer:1600
         });
        window.open("{{ route('post.index') }}","_self"); 
    </script>

<!-- when post has been saved then this if excuted  -->
@endif


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('admin/pages/js/posts.js') }}"></script>


<script>
    $(document).ready(function() {
       $('#postdescription').summernote({
        placeholder: 'পোষ্টের বিবরণ লিখুন :',
        tabsize: 2,
        height: 200
      });

      

    
    });

    

   

    

</script>

@endsection