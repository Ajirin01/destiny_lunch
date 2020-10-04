@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Advert</h4>
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
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form action="{{ url('admin/adverts/'.$advert->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div id="form" class="form-group"> 
                    <div class="form-group">
                        <span>Please select web pages number</span>
                        <select class="form-control" name="pages" id="pages">
                            <option value="{{$advert->pages}}">{{$advert->pages}}</option>
                            <option value="5 pages">5 pages</option>
                            <option value="all pages">all pages</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Active Status</span>
                        <select class="form-control" name="status" id="pages">
                            <option value="{{$advert->status}}">{{$advert->status}}</option>
                            <option value="active">Activate</option>
                            <option value="inactive">Inactivate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Advert Image</label>
                        <span>Select new advert if you to change or leave current one</span>
                        <input class="form-control" id="advert_image" type="file" name="advert_image">
                    <div align="center"><img style="width: 350px; height: 250px" id="preview" src="{{$advert->advert}}" alt="preview" /></div>
                    <input type="hidden" name="expired" value="{{$advert->expired}}">
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection