@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add links</h4>
                <h4 class="page-title text-center text-success">
                    @if(session('msg'))
                    {{session('msg')}}
                    @endif
                </h4>
                <h4 class="page-title text-center text-danger">
                    @if(session('errors'))
                    {{session('errors')}} <br>
                    {{-- {{session('errors')->first('links_code[]')}} --}}
                    @endif
                </h4>
                <br>
                <span>Please select the number of links to create</span>
                <select id="num">
                    @for ($i = 0; $i < 7; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('external-links.store') }}" method="POST">
                @csrf
                    <div id="form">
                        
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Create links</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var num = document.getElementById('num')
    var form = document.getElementById('form')

    num.onchange = () => {
        console.log(num.value)
        var i = 0
        
            var chd = '<div id="form" class="form-group" style="border-bottom: 2px purple dotted">'
                chd +=    '</div>'
                chd +=  '<div class="form-group">'
                chd +=      '<label>Link Name</label>'
                chd +=      '<input class="form-control" type="text" name="links_name[]">'
                chd +=  '</div>'
                chd +=  '<div class="form-group">'
                chd +=      '<label>Link URL</label>'
                chd +=      '<input class="form-control" type="text" name="links_url[]">'
                chd +=  '</div>'
                var form_inner = ""
                for(i; i< num.value; i++){
                    form_inner += chd;
                }
                form.innerHTML=form_inner
    }
</script>
@endsection