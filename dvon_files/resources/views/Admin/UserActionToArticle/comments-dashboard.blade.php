@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h4 class="page-title">Comments</h4>
                <h4 class="page-title text-center text-success">
                    @if(session('success'))
                    {{session('success')}}
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
                                <th>User</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                function getUser($id){
                                    $user = App\User::find($id);
                                    return $user;
                                }
                            @endphp
                            @foreach ($comments as $comment)
                                <tr>
                                <td>{{$comment->id}}</td>
                                <td>
                                    @php
                                        echo getUser($comment->user_id)->fullname;
                                    @endphp
                                </td>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->status}}</td>
                            <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            {{-- <a class="dropdown-item" href="{{ url('admin/comments/'.$comment->id.'/edit ')}}"><i class="fa fa-pencil m-r-5"></i> Edit</a> --}}
                                            <form class="dropdown-item" id="delete-form" action="{{ url('admin/update_comment_status/'.$comment->id) }}" method="POST" style="color: green; cursor: pointer">
                                                @csrf
                                                <i class="fa fa-check"></i>
                                                <input style="background: transparent; border: none; color: green; cursor: pointer" type="submit" value="Activate" onclick="
                                                    event.stopPropagation()
                                                    var next = confirm('are you sure you want to make this comment active?')
                                                    if(next){
                                                        //
                                                    }else{
                                                       event.preventDefault()
                                                    }
                                                ">
                                                <input type="hidden" name="status" value="active">
                                            </form>
                                            <form class="dropdown-item" id="delete-form" action="{{ url('admin/update_comment_status/'.$comment->id) }}" method="POST" style="color: orange; cursor: pointer">
                                                @csrf
                                                <i class="fa fa-close"></i>
                                                <input style="background: transparent; border: none; color: rgb(233, 154, 6); cursor: pointer" type="submit" value="Inactivate" onclick="
                                                    event.stopPropagation()
                                                    var next = confirm('are you sure you want to make this comment Inactive?')
                                                    if(next){
                                                        //
                                                    }else{
                                                       event.preventDefault()
                                                    }
                                                ">
                                                <input type="hidden" name="status" value="inactive">
                                            </form>
                                            <form class="dropdown-item" id="delete-form" action="{{ url('admin/delete_comment/'.$comment->id) }}" method="POST" style="color: red; cursor: pointer">
                                                @csrf
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
                {{$comments->links()}}
            </div>
        </div>
    </div>
</div>
@endsection