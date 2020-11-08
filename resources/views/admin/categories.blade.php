@extends('layouts.admin')
@section('tittle','Category')

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
                    <button type="button" class="btn btn-warning pull-right" style="margin-right: 19px;"
                     onclick="add_category();" data-toggle="modal">যোগ করুন</button>
                </h4>

                <div class="modal fade" id="categorymodal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ক্যাটেগরি যোগ করুন</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-validation" enctype="multipart/form-data" id="category_form"
                                action="javascript:void(0)">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="category" class="col-md-4 form-control-label">ক্যাটেগরি</label>
                                        <div class="col-md-7">
                                            <select class="form-control" name="category" id="category">
                                                <option value="">সিলেক্ট</option>
                                                <option value="2">খাবার সামগ্রী</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 form-control-label">নাম<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="name" parsley-type="name" class="form-control"
                                                name="name" id="name" placeholder="নাম">

                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="icon" class="col-md-4 form-control-label">আইকন নির্বাচন করুন</label>
                                        <div class="col-md-7">
                                            <input id="icon" class="form-control" type="file" name="icon" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sorting" class="col-md-4 form-control-label">সিরিয়াল</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="sorting" id="sorting"
                                                placeholder="সিরিয়াল">

                                            <span class="text-danger" id="is_show_error"></span>
                                        </div>
                                        <label for="is_show" class="col-md-3 form-control-label">প্রদর্শিত হবে ?</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" parsley-type="is_show" class="form-control"
                                                name="is_show" id="is_show" value="1">

                                            <span class="text-danger" id="is_show_error"></span>
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="is_feature" class="col-md-4 form-control-label">ফিচারড</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" class="form-control" name="is_feature"
                                                id="is_feature" value="1">

                                            <span class="text-danger" id="is_feature_error"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="row_id" id="row_id" value="">

                                    <button type="submit" id="category_save_button"
                                        class="btn btn-primary waves-effect waves-light">সাবমিট</button>
                                    <button type="button" class="btn btn-danger waves-effect"
                                        data-dismiss="modal">বাতিল</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="categoryTable" class="data-table table table-striped nowrap table-hover"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>নং</th>
                                    <th>ক্যাটেগরি</th>
                                    <th>সাব-ক্যাটেগরি</th>
                                    <th>সিরিয়াল</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>ফিচারড</th>
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


<script>

    // calling datatable //
    $('#categoryTable').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: { url: "/categorieslist" },
        columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category_name', name: 'category_name'},
                {data: 'sub_catgory_name', name: 'sub_catgory_name' },
                { data: 'serial', name: 'serial'},
                {
                    data: 'is_show',name: 'is_show',render:function(data, type, row, meta){
                        if(row.is_show ==1 ){
                           return '<span class="badge badge-teal">Show</span>';
                        }else{
                            return '<span class="badge badge-danger badge-pill">Hide</span>';
                        }
                    }
                },
                { data: 'is_feature', name: 'is_feature',render:function(data, type, row, meta){
                    if(row.is_feature == 1){
                        return '<span class="badge badge-teal">ফিচারড</span>';
                    }else{
                        return '<span class="badge badge-danger badge-pill">নন-ফিচারড</span>';
                    }
                }
                },
                {
                    name: 'action',
                    render:function(data,type,row,meta){
    
                        return "<a href='javascript:void(0)' class='edit btn btn-primary btn-sm' onclick='category_edit("+meta.row+")' >আপডেট</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' onclick='category_delete("+meta.row+")' >মুছুন</a>";

                    }
                }
         ]
              
    });

    function add_category() {
        $("#name").val('');
        $("#sorting").val('');
        $("#is_show").prop("checked",false);
        $("#is_feature").prop("checked",false);

        $('#category').prop('selectedIndex', 0);
        get_all_category()
       $("#categorymodal").modal('show');
    }



    $(document).on('submit','#category_form',function(event) {
        event.preventDefault();
        var name = $("#name").val();
        var error_status = false;

        if(name == ''){
            $("#name_error").html('নাম প্রদান করুন')
            error_status = true;
        }else{
            $("#name_error").html('');
            error_status = false;
        }

        if(error_status == true){
             return false;
        }else{

            $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
             });

           $.ajax({
               url:'/store',
               type:'post',
               data: new FormData(this),
               processData:false,
               contentType:false,
               success:function(response){
                  
                   //if laravel validation error
                    if (response.errors) {

                        if (response.errors.name) {
                            $('#name_error').html(response.errors.name[0]);
                        }

                    }
                    if(response.status == "success" || response.status == "error" ){
                        
                       var text = (response.status == 'success') ? "ধন্যবাদ" : "দুঃখিত";
                        $("#categorymodal").modal('hide');
                        swal(text, response.massege, response.status,{
                            buttons:false,
                            timer:1600
                        });

                        $('#categoryTable').DataTable().draw(true);
                        

                    }

               } 
           })
        }

    })

    function get_all_category(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
             $.ajax({
                 url:'/categories',
                 type:'get',
                 success:function(response){
                     let mapping = '<option value="">সিলেক্ট</option>';
                    response.forEach(function(item){
                        mapping += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    $("#category").html(mapping);
                 }
             })


    }

    function category_edit(id){
        var row_data = $('#categoryTable').DataTable().row(id).data();
         get_all_category();
         $("#row_id").val(row_data.id);

         setTimeout(() => {

             if(row_data.type == 1 ){
            $('#category').prop('selectedIndex', 0);
            $("#name").val(row_data.category_name);
            }else{
                $('#category').val(row_data.parent_id);
                $("#name").val(row_data.sub_catgory_name);
                
            }
            $("#sorting").val(row_data.serial);

            (row_data.is_show == 1) ? $("#is_show").prop("checked", true) : $("#is_show").prop("checked", false);

            (row_data.is_feature == 1) ? $("#is_feature").prop("checked", true) : $("#is_feature").prop("checked", false);
             
         }, 500);
        

         $("#categorymodal").modal('show');





    }

    function category_delete(id){

        var data = $('#categoryTable').DataTable().row(id).data();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {

                    $.ajaxSetup({

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url:"/categories_delete",
                        type:"POST",
                        data:{id:data.id},
                        dataType:'json',
                        success:function(response){
                        $('#categoryTable').DataTable().draw(true);
                            swal(response.massage , {
                                    icon: response.status,
                                 });
                            
                        }
                    })




                
            } else {
                swal("Your imaginary file is safe!");
            }
            });

        

    }

</script>

@endsection