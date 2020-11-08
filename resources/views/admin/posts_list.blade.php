@extends('layouts.admin')
@section('tittle','Post list')

@section('css')

<link rel="stylesheet" href="{{ asset('admin/vendor/data-table/media/css/dataTables.bootstrap.min.css')}}">

<style>
.modal-content {
    margin-top: -213px;
}
</style>

@endsection

@section('content')
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
                <h4 class="section-subtitle" style="margin-left: 10px;">
                    <a href="{{route('post.create')}}" class="btn btn-warning pull-right" style="margin-right: 19px;"
                      >পোস্ট যোগ করুন</a>
                </h4>

                

            </div>
            <div class="row"  >
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">ক্যাটাগরি</label>
                            <select class="form-control" id="filter_category" name="filter_category" onchange="getsubcategory(this.value)">
                                <option value=""> নির্বাচন করুণ</option>
                                @foreach (App\Category::where(['type'=> 1, 'deleted_at'=> NULL ])->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach         
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">সাব ক্যাটাগরি</label>
                            <select class="form-control" id="sub_category" name="sub_category">
                                <option value="">সাব ক্যাটাগরি নির্বাচন করুন</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-block FilterResult" style="margin-top: 30px;"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>

            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="postTable" class="data-table table table-striped nowrap table-hover"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>নং</th>
                                    <th>ছবি</th>
                                    <th>ক্যাটেগরি</th>
                                    <th>সাব-ক্যাটেগরি</th>
                                    <th>পোস্টের নাম</th>
                                    <th>date</th>
                                     <th>আ্যকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<!--dataTable-->
<script src="{{ asset('admin/vendor/data-table/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/data-table/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/pages/js/posts.js') }}"></script>


<script>
    $("#postTable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:"/post/postslist",
            data:function(e){
                (e.category_id = $("#filter_category").val() || 0);
                (e.sub_category_id = $("#sub_category").val() || 0);
            }
        },
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
             { 
                name: 'images',
                render:function(data,type,row,meta){
                   
                    var html = ''
                    if(row.images != null && row.images != ''){

                        var imges = row.images.split("##")[0];
                        
                        html = '<img src="upload/posts/'+imges+'" style="height:50px; width:50px;" alt="'+imges+'">';
                    }else{
                        html = '<img src="upload/posts/deafult.webp" style="height:50px; width:50px;" alt="deafult.webp">';
                    }
                    return html;
                    
             }
            },
            {data: 'category_name', name: 'categoryname'},
            {data: 'Subcategroy_name', name: 'subcategoryname'},
            {data: 'post_tille', name: 'post_tille'},
            {data: 'date', name: 'date'},
            {data: 'action', name: 'action', orderable: false, searchable: false,},
        ]
    });


$(document).on("click", ".FilterResult", function () {
  
    var errors = false;

    if($("#filter_category").val() == ''){
        errors = true;
    }else{
        errors = false;
    }

    if(errors == false ){

        $("#postTable").DataTable().draw(true);

    }else{

        return false;

    }




    
});    




</script>

@endsection