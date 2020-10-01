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
            </div>
            <div class="col-sm-4 col-8 text-right m-b-30">
                <a class="btn btn-primary btn-rounded float-right" href="{{ route('adverts.create') }}"><i class="fa fa-plus"></i> Add advert</a>
            </div>
        </div>
        <div class="row">
            @foreach ($adverts as $advert)
            <div class="col-lg-4">
                <div class="advert grid-advert">
                    <div class="advert-image" style="height: 300px">
                    <a href="{{ url('admin/advert/'.$advert->id.'/edit') }}"><img style="width:350xp; height: 250px" class="img-fluid" src="{{$advert->advert}}" alt=""></a>
                    </div>
                    <div class="advert-info clearfix">
                        <div class="advert-left">
                            <form class="dropdown-item" id="delete-form" action="{{ url('admin/adverts/'.$advert->id) }}" method="POST" style="color: red; cursor: pointer">
                                @csrf
                                @method('DELETE')
                                <i class="fa fa-trash-o m-r-5"></i>
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
                        <br>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div>{{ $adverts->links() }}</div>
    </div>
</div>

@endsection