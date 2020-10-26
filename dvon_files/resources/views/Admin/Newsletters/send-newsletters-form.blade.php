@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
        {{-- <div class="text text-center text-success">
            @if(session('msg'))
            {{session('msg')}}
            @endif
        </div> --}}
        <div class="col-lg-8  offset-lg-2">
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
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Send Newsletter</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form action="{{ url('admin/newsletters/send-newsletters') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Newsletter</label>
                    @if(session('errors'))
                    <div class="text text-danger">{{session('errors')->first('newsletter')}}*</div>
                    @endif
                    <textarea cols="30" rows="12" id="newsletter" class="form-control tinymce" name="newsletter"></textarea>
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Send</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection