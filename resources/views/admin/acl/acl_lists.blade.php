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
                    <a href="{{route('acl.create')}}"  class="btn btn-warning pull-right" style="margin-right: 19px;"
                         data-toggle="modal">যোগ করুন</a>
                </h4>


            </div>

            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="aclTable" class="data-table table table-striped nowrap table-hover"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role Name</th>
                                    <th>Created</th>
                                     <th>action</th>
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
    $('#aclTable').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: { url: "{{route('acl.data')}}" },
        columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                { data: 'date', name: 'date'},
                {
                    data:'action',
                    name: 'action'
                    
                }
         ]
              
    });

    // function add_category() {
    //     $("#name").val('');
    //     $("#sorting").val('');
    //     $("#is_show").prop("checked",false);
    //     $("#is_feature").prop("checked",false);

    //     $('#category').prop('selectedIndex', 0);
    //     get_all_category()
    //    $("#categorymodal").modal('show');
    // }



    // $(document).on('submit','#category_form',function(event) {
    //     event.preventDefault();
    //     var name = $("#name").val();
    //     var error_status = false;

    //     if(name == ''){
    //         $("#name_error").html('নাম প্রদান করুন')
    //         error_status = true;
    //     }else{
    //         $("#name_error").html('');
    //         error_status = false;
    //     }

    //     if(error_status == true){
    //          return false;
    //     }else{

    //         $.ajaxSetup({

    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //          });

    //        $.ajax({
    //            url:'/store',
    //            type:'post',
    //            data: new FormData(this),
    //            processData:false,
    //            contentType:false,
    //            success:function(response){
                  
    //                //if laravel validation error
    //                 if (response.errors) {

    //                     if (response.errors.name) {
    //                         $('#name_error').html(response.errors.name[0]);
    //                     }

    //                 }
    //                 if(response.status == "success" || response.status == "error" ){
                        
    //                    var text = (response.status == 'success') ? "ধন্যবাদ" : "দুঃখিত";
    //                     $("#categorymodal").modal('hide');
    //                     swal(text, response.massege, response.status,{
    //                         buttons:false,
    //                         timer:1600
    //                     });

    //                     $('#categoryTable').DataTable().draw(true);
                        

    //                 }

    //            } 
    //        })
    //     }

    // })

    // function get_all_category(){
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //          });
    //          $.ajax({
    //              url:'/categories',
    //              type:'get',
    //              success:function(response){
    //                  let mapping = '<option value="">সিলেক্ট</option>';
    //                 response.forEach(function(item){
    //                     mapping += '<option value="'+item.id+'">'+item.name+'</option>';
    //                 });
    //                 $("#category").html(mapping);
    //              }
    //          })


    // }

    // function category_edit(id){
    //     var row_data = $('#categoryTable').DataTable().row(id).data();
    //      get_all_category();
    //      $("#row_id").val(row_data.id);

    //      setTimeout(() => {

    //          if(row_data.type == 1 ){
    //         $('#category').prop('selectedIndex', 0);
    //         $("#name").val(row_data.category_name);
    //         }else{
    //             $('#category').val(row_data.parent_id);
    //             $("#name").val(row_data.sub_catgory_name);
                
    //         }
    //         $("#sorting").val(row_data.serial);

    //         (row_data.is_show == 1) ? $("#is_show").prop("checked", true) : $("#is_show").prop("checked", false);

    //         (row_data.is_feature == 1) ? $("#is_feature").prop("checked", true) : $("#is_feature").prop("checked", false);
             
    //      }, 500);
        

    //      $("#categorymodal").modal('show');





    // }

    // function category_delete(id){

    //     var data = $('#categoryTable').DataTable().row(id).data();

    //     swal({
    //         title: "Are you sure?",
    //         text: "Once deleted, you will not be able to recover this imaginary file!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //         })
    //         .then((willDelete) => {
    //         if (willDelete) {

    //                 $.ajaxSetup({

    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     }
    //                 });

    //                 $.ajax({
    //                     url:"/categories_delete",
    //                     type:"POST",
    //                     data:{id:data.id},
    //                     dataType:'json',
    //                     success:function(response){
    //                     $('#categoryTable').DataTable().draw(true);
    //                         swal(response.massage , {
    //                                 icon: response.status,
    //                              });
                            
    //                     }
    //                 })




                
    //         } else {
    //             swal("Your imaginary file is safe!");
    //         }
    //         });

        

    // }

</script>

@if (session('success'))
    <script>
        toastr.success('{{session("success")}}', 'New ACL save successfully');
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error('{{session("error")}}', 'New ACL save faild');
    </script>
@endif



@endsection