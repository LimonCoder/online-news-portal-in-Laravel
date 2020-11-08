@extends('layouts.web')

@if($posts->total() > 0)
@section('tittle',$category_name->category->name)
@else
@section('tittle',"কোন কিছু পাওয়া যায় নাই")
@endif

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

        @if($posts->total() > 0)
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
                      <p  ><b>ক্যাটেগরি : </b> 
                      <a href="javascript:void(0)">{{$post->category->name}}</a> </p>
                      @php
                        $description = strlen(strip_tags($post->post_description)) > 100 ? substr( strip_tags($post->post_description),0,100)."....." : strip_tags($post->post_description);
                        
                      @endphp
                      <p id="description" style="margin: 5px;" >{{ $description }}</p>
                    <a href="news-details.php?nid=43" class="btn btn-primary"> আরও পড়ুন &rarr;</a>
                  </div>
                  <div class="card-footer text-muted">
                    @php
                      $time = date("d-m-Y", strtotime($post->created_at));
                    @endphp
                    Posted on {{$time}}
                
                  </div>
            </div>
         @endforeach
        @else
            <h2 ‍style="color: red;">কোন খবর পাওয়া যায় নাই </h2>
        @endif 
            
                <ul class="pagination justify-content-center mb-4">
                    {{ $posts->links() }}
                </ul>

    </div>

 @endsection   