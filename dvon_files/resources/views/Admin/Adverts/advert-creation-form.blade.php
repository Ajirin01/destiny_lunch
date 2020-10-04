@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Advert</h4>
                <h4 class="page-title text-center text-success">
                    @if(session('msg'))
                    {{session('msg')}}
                    @endif
                </h4>
                <h4 class="page-title text-center text-danger">
                    @if(session('error'))
                    {{session('error')->first('advert_image')}}
                    @endif
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('adverts.store') }}" runat="server" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <br>
                        <span>Please select the number of adverts to create</span>
                        <select id="num">
                            @for ($i = 0; $i < 7; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div id="form" class="form-group">
                        
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Create Advert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var num = document.getElementById('num')
    var form = document.getElementById('form')
    var pages = document.getElementById('pages')

    function readURL(input, index){
        console.log('hello from readURL')
        if(input.files && input.files[0]){
            var reader = new FileReader()

            reader.onload = function(e){
                var id = '#preview'+index
                console.log(id)
                $(id).attr('src', e.target.result)
            }

            reader.readAsDataURL(input.files[0])
        }
    }
    num.onchange = () => {
        console.log(num.value)
        var i = 0
        form.innerHTML = ""
        for(i; i < num.value; i++){

            form.innerHTML += '<div id="form'+i+'" class="form-group" style="border-bottom: 2px purple dotted">' 
                            + '</div>'
                            + '<div class="form-group">'
                            + '<span>Please select web pages number</span>'
                            + '<select class="form-control" name="pages[]" id="pages">'
                            + '<option value="">Please select pages</option>'
                            + '<option value="5 pages">5 pages</option>'
                            + '<option value="all pages">all pages</option>'
                            + '</select>'
                            + '</div>'
                            + '<div class="form-group">'
                            + '<label>Advert Image</label>'
                            + '<input class="form-control" id="advert_image'+i+'" type="file" name="advert_image[]">'
                            + '<div align="center"><img style="width: 350px; height: 250px" id="preview'+i+'" src="#" alt="preview" /></div>'
                            + '</div>'

        }

        var state = 0

        if(state == 0){
            $('#advert_image0').change(function(){
                readURL(this, 0)
            });
            state = 1
        }if(state == 1){
            $('#advert_image1').change(function(){
                readURL(this, 1)
            });
            state = 2
        }if(state == 2){
            $('#advert_image2').change(function(){
                readURL(this, 2)
            });
            state = 3
        }if(state == 3){
            $('#advert_image3').change(function(){
                readURL(this, 3)
            });
            state = 4
        }if(state == 4){
            $('#advert_image4').change(function(){
                readURL(this, 4)
            });
            state = 5
        }if(state == 5){
            $('#advert_image5').change(function(){
                readURL(this, 5)
            });
            state = 0
        }
    }

    
</script>
@endsection