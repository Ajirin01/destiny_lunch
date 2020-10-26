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
            <span class="text-danger text-center">Total of NGN200 would be charged</span>
            <input type="hidden" name="name" placeholder="Plan Name" value="Blog Ownership Subscription"/>
            <input type="hidden" name="amount" placeholder="Amount" id="total_advert_price" value="200"/>
            <input type="hidden" name="interval" placeholder="Interval" value="monthly"/>
            <input type="hidden" name="duration" placeholder="Duration" value="1"/>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Checkout</button>
            </div>
        </form>
        </div>
    </div>
@endsection
