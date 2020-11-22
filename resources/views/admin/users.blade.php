@extends('layouts.admin')
@section('tittle','User')

@section('css')

<link rel="stylesheet" href="{{ asset('admin/vendor/data-table/media/css/dataTables.bootstrap.min.css')}}">

<style>
.modal-content {
    margin-top: -213px;
}

.parsley-custom-error-message, .parsley-validphonenumber, .parsley-required {
	color: red;
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
                     onclick="add_user();" data-toggle="modal">যোগ করুন</button>
                </h4>

                <div class="modal fade" id="usermodal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ইউজার যোগ করুন</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-validation" enctype="multipart/form-data" id="user_from"
                                action="javascript:void(0)">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="role" class="col-md-4 form-control-label">Role Name :</label>
                                        <div class="col-md-7">
                                            <select class="form-control" name="role" id="role" data-parsley-required="true" data-parsley-error-message="সিলেক্ট করুন" > 
                                                 <option value="">select</option>
                                                @foreach($roles_data as $role )
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 form-control-label">User name<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="name" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-error-message="সঠিক নাম দেন "  class="form-control"
                                                name="user_name" id="user_name" placeholder="user name"  autocomplete="off" >

                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 form-control-label">User Email</label>
                                                
                                        <div class="col-md-7">
                                            <input type="text" data-parsley-type="email" data-parsley-trigger="keyup"  data-parsley-error-message="সঠিক ইমেল দেন"  class="form-control"
                                                name="user_email" id="user_email" placeholder="email">

                                            <span class="text-danger" id="email_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 form-control-label">User Number</label>
                                                
                                        <div class="col-md-7">
                                            <input type="text" parsley-type="number"          data-parsley-required="true" class="form-control" data-parsley-error-message="সঠিক নম্বর দেন"
                                                data-parsley-validphonenumber="" data-parsley-trigger="keyup"   name="user_number" id="user_number" placeholder="user number"   autocomplete="off" >

                                            <span class="text-danger" id="email_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 form-control-label">Create Password :<span
                                         class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="password" parsley-type="name" 
                                            data-parsley-required="true" 
                                            data-parsley-minlength="6" data-parsley-error-message="ছয় সংখ্যার  পাসওয়ার্ড দেন " data-parsley-trigger="keyup" class="form-control"
                                                name="password" id="password" placeholder="password"  autocomplete="new-password" >

                                            <span class="text-danger" id="password_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="role" class="col-md-4 form-control-label">User Type :</label>
                                        <div class="col-md-7">
                                            <select class="form-control"  data-parsley-required="true"
                                            data-parsley-error-message="সিলেক্ট করুন"   name="user_type" id="user_type">
                                                 <option value="">select</option>
                                                 <option value="1">Admin</option>
                                                 <option value="2">User</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="row_id" id="row_id" value="">

                                    <button type="submit" id="user_save_button"
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
<script src="http://parsleyjs.org/dist/parsley.js"></script>


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
                {
                    name: 'action',
                    render:function(data,type,row,meta){
    
                        return "<a href='javascript:void(0)' class='edit btn btn-primary btn-sm' onclick='category_edit("+meta.row+")' >আপডেট</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' onclick='category_delete("+meta.row+")' >মুছুন</a>";

                    }
                }
         ]
              
    });

    function add_user() {
        $("#user_name").val('');
        $("#user_email").val('');
        $("#user_number").val('');
        $("#password").val('');

        $('#role').prop('selectedIndex', 0);
         $('#user_type').prop('selectedIndex', 0);

       $("#usermodal").modal('show');
    }

    // custom validation //
    window.Parsley.addValidator('validphonenumber', {
    validateString: function(number) {
        var bd_rgx = /\+?(88)?0?1[56789][0-9]{8}\b/;

        if (number.match(bd_rgx)) {
            return true;
        } else {
            return false;
        }
    },
    messages: {
        en: 'সঠিক নম্বর দেন',
        fr: "সঠিক নম্বর দেন"
    }
    });


    
    $(document).ready(function(){
        $('#user_from').parsley();

    $(document).on('submit','#user_from',function(event) {
        event.preventDefault();
        

         if($('#user_from').parsley().isValid()){

             $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
             });

           $.ajax({
               url:'{{route("users.create")}}',
               type:'post',
               data: new FormData(this),
               processData:false,
               contentType:false,
               dataType:'json',
               beforeSend: function() {
                    // setting a timeout
                    $("#user_save_button").prop("disabled",true);
                    $("#user_save_button").text("লোডিং...")
                },
               success:function(response){
                 console.log(response);
                    $("#user_save_button").prop("disabled",false);
                    $("#user_save_button").text("সাবমিট")
               } 
           })

        }

            
        

    })
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