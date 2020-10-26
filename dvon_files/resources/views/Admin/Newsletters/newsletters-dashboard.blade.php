@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-5 col-5">
                <h4 class="page-title">Newsletter Subscribers</h4>
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
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emails</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newsletters as $newsletter)
                                <tr>
                                <td>{{$newsletter->id}}</td>
                                <td>{{$newsletter->email}}</td>
                                <td>{{$newsletter->status}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form class="dropdown-item" id="delete-form" action="{{ url('admin/newsletters/delete-newsletter/'.$newsletter->id) }}" method="POST" style="color: red; cursor: pointer">
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
                {{$newsletters->links()}}
            </div>
        </div>
    </div>
</div>
@endsection