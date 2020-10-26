@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-5 col-5">
                <h4 class="page-title">Links</h4>
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
            <div class="col-sm-7 col-7 text-right m-b-30">
                <a href="{{ route('external-links.create')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Link(s)</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Link Name</th>
                                <th>Link URL</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                <td>{{$link->id}}</td>
                                <td>{{$link->link_name}}</td>
                                <td>{{$link->link_url}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ url('admin/external-links/'.$link->id.'/edit ')}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <form class="dropdown-item" id="delete-form" action="{{ url('admin/external-links/'.$link->id) }}" method="POST" style="color: red; cursor: pointer">
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
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$links->links()}}
            </div>
        </div>
    </div>
</div>
@endsection