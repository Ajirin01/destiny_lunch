@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-8 col-4">
                <h4 class="page-title text-center text-success">
                    @if(session('msg'))
                    {{session('msg')}}
                    @endif
                </h4>
                <h4 class="page-title text-center text-danger">
                    @if(session('error'))
                    {{session('error')}}
                    @endif
                </h4>
                <h4 class="page-title">Posts</h4>
            </div>
            <div class="col-sm-4 col-8 text-right m-b-30">
                <a class="btn btn-primary btn-rounded float-right" href="{{ route('blog-post.create') }}"><i class="fa fa-plus"></i> Add Post</a>
            </div>
        </div>
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="blog grid-blog">
                    <div class="blog-image" style="height: 300px">
                    <a href="{{ url('admin/blog-post/'.$post->id.'/edit') }}"><img class="img-fluid" src="{{$post->blog_image}}" alt=""></a>
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title"><a href="{{ url('admin/blog-post/'.$post->id.'/edit') }}">{{$post->blog_title}}</a></h3>
                    <p style="word-break: break-word"><?php echo substr($post->blog_description,0,50) ?>...</p>
                        {{-- <a href="{{ url('admin/blog-post/1/edit') }}" class="read-more"><i class="fa fa-long-arrow-right"></i> Read More</a> --}}
                        <div class="blog-info clearfix">
                            <div class="post-left">
                                <a class="dropdown-item" href="{{ url('admin/blog-post/'.$post->id.'/edit') }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <form class="dropdown-item" id="delete-form" action="{{ url('admin/blog-post/'.$post->id.'/') }}" method="POST" style="color: red; cursor: pointer">
                                    @csrf
                                    @method('DELETE')
                                    <i class="fa fa-trash-o m-r-5 text-danger"></i>
                                    <input style="background: transparent; border: none; color: red; cursor: pointer" type="submit" value="Delete" onclick="
                                        event.stopPropagation()
                                        var next = confirm('are you sure you want to delete this record?')
                                        if(next){
                                            //
                                        }else{
                                           event.preventDefault()
                                        }
                                    ">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div>{{ $posts->links() }}</div>
    </div>
</div>

@endsection