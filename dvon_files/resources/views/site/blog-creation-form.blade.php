@extends('layouts.site.main_layout')
@section('upper-content')
    <h1 class="text-center">Create Your Own Blog</h1>
    <div class="row">
        <div class="col-lg-9  offset-lg-1">
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
        </div>
        <div class="col-lg-9 offset-lg-1">
            <h4 class="page-title">Add Article</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 offset-lg-1">
        <form action="{{URL::to('blog/create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Blog Name</label>
                @if(session('errors'))
                <div class="text text-danger">{{session('errors')->first('article_title')}}*</div>
                @endif
                <input class="form-control" type="text" name="blog_name" required>
            </div>
            <div class="form-group">
                <label>Blog Logo</label>
                @if(session('errors'))
                <div class="text text-danger">{{session('errors')->first('blog_logo')}}*</div>
                @endif
                <div>
                    <input class="form-control" type="file" name="blog_logo" required>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Create Blog</button>
            </div>
        </form>
        </div>
    </div>
@endsection
