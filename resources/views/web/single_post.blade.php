@extends('layouts.web')


@section('tittle',"কোন কিছু পাওয়া যায় নাই")

@section('css')

<style>
.card-img-top {
	width: 26%;
	/* border-top-left-radius: calc(.25rem - 1px); */
	/* border-top-right-radius: calc(.25rem - 1px); */
	height: 3%;
	margin: 3px 6px;
}

#single_comment {
	background-color: #a6a0a0;
	padding: 8px;
	margin-bottom: 15px;
	border-radius: 17px;
}
#comment_details {
	text-align: justify;
	margin-top: 4px;
}

#single_replay {
	background: #cecece;
	padding: 1px 31px;
	margin-left: 31px;
	border-radius: 30px;
	margin: 22px 40px;
}

</style>

@endsection

@section('content')
<div class="container">


     
      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <!-- Blog Post -->

       
            <div class="card mb-4">
              @if(!empty($post->images))
                  @php
                    $images = explode("##",$post->images);
                    $iamge =  $images[0];
                  @endphp
                <img class="card-img-top" src="{{ asset('upload/posts') }}/{{$iamge}}" alt="{{$iamge}}" >
              
              @endif
                  <div class="card-body">
                    <h2 class="card-title">{{ $post->post_tille  }}</h2>
                      <p  ><b>ক্যাটেগরি : </b> 
                      <a href="javascript:void(0)">{{$post->category->name}}</a> </p>
                      <p id="description" style="margin: 5px;" >{{ $post->post_description }}</p>
                  </div>
                  <div class="card-footer text-muted">
                    @php
                      $time = date("d-m-Y", strtotime($post->created_at));
                    @endphp
                    Posted on {{$time}}
                
                  </div>
                  
        </div>
        <div class="row" >
             <div class="col-md-12">
               <div id="comment">
                  
               </div>
             </div>
        </div>
        <div class="row" style="margin: 14px;">
            <div class="col-md-12">
              <h2>Leave a Comment </h2>
              <form action="" id="comment_form" method="POST" >
                  <div class="form-row">
                  </div>
                  <div class="form-group">
                    <label for="comment">Message</label>
                    <textarea style="resize:none;" class="form-control" name="comment" id="comments" placeholder="write message here ......" >
                    </textarea>
                    <span id="comment_error" style="color:red" ></span>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="name">Name :</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name :" >
                      <span id="name_error" style="color:red" ></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">Email :</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email : ">
                      <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}" >
                    </div>
    
                  </div>
                  <button type="submit" style="text-align: center;" class="btn btn-primary">Post Comment</button>
              </form> 
            </div>
        </div>
</div>

 @endsection 

 
 @section('js')

 <script>

     comments_data();
    
    

   $(document).on("submit","",function(event){
      event.preventDefault();

      var errors = false;

     

      var comments =   $.trim($("#comments").val()); 
      var name = $("#name").val();
      var email = $("#email").val();
      var row_id = $("#post_id").val();

       console.log(name == "");

      if(name == ""){
        $("#name_error").html("খালিঘর পূরণ করুন");
        errors = true;
      }else{
        $("#name_error").html("");
        errors = false;
      }
      
      if(comments == ""){
        $("#comment_error").html("খালিঘর পূরণ করুন");
        errors = true;
      }else{
         $("#comment_error").html("");
         errors = false;
      }

      

      if(errors == false){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
             });

        $.ajax({
            url:'/comment_store',
            type:'post',
            data:{
              user_name:name,
              user_email:email,
              comment_descript:comments,
              post_id:row_id

            },
            dataType:'JSON',
            success:function(response){
              $("#name").val("");
              $.trim($("#comments").val("")); 
              $("#email").val("");

              comments_data();

            }

        })
      }else{
        return false;
      }




       



   })


   function comments_data() {
      var row_id = $("#post_id").val();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      
      $.ajax({
        url:'/comment_data',
        type:'POST',
        data:{post_id:row_id },
        dataType:'json',
        success:function(response){
          var map = '';

          response.data.forEach(function(item){
                 map += `<div id="single_comment" data-comment-id="${item.id}" >
                      <h3>${item.name}</h3>
                      <p id="comment_details">${item.comment}</p>
                      <h6 style="color: royalblue;">Date : <span>${item.created_at}</span></h6>
                      <div id="replygroup${item.id}" >
                          
                      </div>
                      
                      <a href="javascript:void(0)" onclick="replyform_show(${item.id})" >Reply</a>
                      
                      <div class="reply" id="reply_section${item.id}" style="display:none" >
                      
                        <form action="" id="reply_form" method="POST" style="margin-top:5px">
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" name="replyer_name" id="replyer_name${item.id}" onkeyup="reply_button_action(${item.id})" placeholder="name" >
                             
                            </div>
                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" name="replyer_msg" id="replyer_msg${item.id}" onkeyup="reply_button_action(${item.id})" placeholder="message">
                            </div>
                            <div class="form-group col-md-4">
                              <button type="button" id="replybutton${item.id}"   onclick="reply_store(${item.id})" class="btn btn-primary" disabled>reply</button>
                            </div>
            
                          </div>
                          </div>
                          
                        </form>
                       </div>`;
            });

            $("#comment").html(map);
             
        }
      })
   }

   reply_data();

   function reply_data(){
      $.ajax({
          url:'/reply_data',
          type:'get',
          dataType:'json',
          success:function(response){
              if(response.status == "success"){

                response.comment_id.forEach(function(item){
                    var map = ``;
                    response.data[item].forEach(function(subitem){
                        map += `<div id="single_replay" >
                              <h3>${subitem.name}</h3>
                              <p >${subitem.comment}</p>
                             <h6 style="color: royalblue;">Date : <span>${subitem.created_at}</span></h6>
                          </div>`;
                    })
                    $("#replygroup"+item).html(map);
                })

                  
              }
          }
      })

   }


   function replyform_show(id) {
     $("#reply_section"+id).toggle();
   }

   function reply_button_action(comment_id){
     var name = $("#replyer_name"+comment_id).val();
     var message = $("#replyer_msg"+comment_id).val();

     if(name != "" && message != "" ){
        $("#replybutton"+comment_id).prop('disabled',false);
     }else{
       $("#replybutton"+comment_id).prop('disabled',true);
     }
   }

   function reply_store(comment_id){
     
      var name = $("#replyer_name"+comment_id).val();
      var message = $("#replyer_msg"+comment_id).val();
      var comment_id = comment_id;
      var post_id = $("#post_id").val();

      $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      })

      $.ajax({
            url:'/comment_store',
            type:'post',
            data:{
              user_name:name,
              comment_descript:message,
              post_id:post_id,
              comment_id:comment_id

            },
            dataType:'JSON',
            success:function(response){
                $("#replyer_name"+comment_id).val('');
                $("#replyer_msg"+comment_id).val('');
                reply_data();
               

            }

        })

   }

 </script>

 @endsection