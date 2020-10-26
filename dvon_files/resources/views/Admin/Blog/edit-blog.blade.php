@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
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
                <h4 class="page-title">Edit Post</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form action="{{ url('admin/blog-post/'.$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Post Title</label>
                        <input class="form-control" type="text" name="blog_title" value="{{$post->blog_title}}">
                    </div>
                    <div class="form-group">
                        <label>Blog Name</label>
                        @if(session('errors'))
                        <div class="text text-danger">{{session('errors')->first('article_title')}}*</div>
                        @endif
                        <select name="blog_slug" class="form-control" id="">
                        <option value="{{strtoupper(preg_replace("/ /","/-/",$post->blog_slug))}}">{{$post->blog_slug}}</option>
                            @php
                                $Slug = new App\BlogName();
                                $all_blogs = $Slug::where('blog_owner_id', Auth::user()->id)->get(['blog_name']);
                                
                                function getBlogNameIndice($article_index, $index){
                                    $article_at_index = $article_index[$index]['blog_name'];
                                    $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
                                    $data = array('type'=>$article_at_index, 'title'=>$article_title);
                                    return $data;
                                }
                                for($i = 0; $i< count($all_blogs); $i++){
                                    echo "
                                    <option id='$i' value='".getBlogNameIndice($all_blogs, $i)['type']."'>".getBlogNameIndice($all_blogs, $i)['title']."</option>
                                    ";
                                }
                            @endphp
                        </select>
                    </div>
                    <input type="hidden" name="blog_owner_id" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <label>Post Image</label>
                        <div>
                            <input class="form-control" type="file" name="post_image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Post Description</label>
                        <textarea cols="30" rows="15" class="form-control tinymce" name="blog_description" >{{$post->blog_description}}</textarea>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection