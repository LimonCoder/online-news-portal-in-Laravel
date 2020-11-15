@extends('layouts.admin')

@section('tittle','comments')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendor/data-table/media/css/dataTables.bootstrap.min.css')}}">

<style>

.modal-content {
	-webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
	box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
	margin-top: -134px;
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

        <div class="modal fade" id="replymodal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ক্যাটেগরি যোগ করুন</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-validation" enctype="multipart/form-data" id="reply_form"
                                action="javascript:void(0)">
                                <div class="modal-body">
                                    

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 form-control-label">Reply :<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="name" parsley-type="name" class="form-control"
                                                name="replysms" id="replysms" placeholder="লিখুন">
                                            <span class="text-danger" id="reply_error"></span>
                                            <input type="hidden" id="post_id" name="post_id" >
                                            <input type="hidden" id="comment_id" name="comment_id" >
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                
                                    <button type="submit" id="reply_save_button" 
                                        class="btn btn-primary waves-effect waves-light">সাবমিট</button>
                                    <button type="button" class="btn btn-danger waves-effect"
                                        data-dismiss="modal">বাতিল</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="commentsTable" class="data-table table table-striped nowrap table-hover"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>নং</th>
                                    <th>tittle</th>
                                    <th>নাম</th>
                                    <th>ইমেল</th>
                                    <th>বার্তা</th>
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
    $("#commentsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/comments_list') }}",
        columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'tittle', name: 'tittle'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'comment', name: 'comment'},
            {data: 'action', name: 'action', orderable: false, searchable: false,},
        ]
    });

    function add_reply(id,comment_id){
       
        $("#reply_error").html("");
        $("#post_id").val(id);
        $("#comment_id").val(comment_id);
        $("#replymodal").modal('show');
        
    }

    $("#reply_form").on("submit",function(event){


        event.preventDefault();

        var post_id = $("#post_id").val();
        var comment_id = $("#comment_id").val();
        var message = $("#replysms").val();

        if(message == ""){
            $("#reply_error").html("বার্তা লিখুন");
            return false;
        }else{
            $("#reply_error").html("");

             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
      
            $.ajax({

                url:'/reply_store',
                type:'POST',
                data:{post_id:post_id,comment_id:comment_id,message:message },
                dataType:'json',
                success:function(response){
                    if(response.status = "success"){
                        $("#replysms").val("");
                        $("#replymodal").modal('hide');
                        swal("সফলভাবে", response.message, response.status,{
                            buttons:false,
                            timer:1600
                        });
                    }
                }
                
                
            })
            
        }

    })

    

       

</script>


@endsection




