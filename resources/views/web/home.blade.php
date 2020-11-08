@extends('layouts.web')

@section('tittle','Home Page')

@section('css')

<style>
.card-img-top {
	width: 26%;
	/* border-top-left-radius: calc(.25rem - 1px); */
	/* border-top-right-radius: calc(.25rem - 1px); */
	height: 3%;
	margin: 3px 6px;
}
</style>

@endsection

@section('content')
<div class="container">


     
      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <!-- Blog Post -->


         @foreach ($posts as $post)
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
                      <p><b>Category : </b> 
                      <a href="category.php?catid=4">{{$post->category->name}}</a> </p>
                      @php
                        $description = strlen(strip_tags($post->post_description)) > 100 ? substr( strip_tags($post->post_description),0,100)."....." : strip_tags($post->post_description);
                        
                      @endphp
                      <p id="description" style="margin: 5px;" >{{ $description }}</p>
                    <a href="news-details.php?nid=43" class="btn btn-primary">Read More &rarr;</a>
                  </div>
                  <div class="card-footer text-muted">
                    @php
                      $time = date("d-m-Y", strtotime($post->created_at));
                    @endphp
                    Posted on {{$time}}
                
                  </div>
            </div>
         @endforeach

         
            
                <ul class="pagination justify-content-center mb-4">
                    {{ $posts->links() }}
                </ul>

    </div>

 @endsection   