@extends('layouts.site.main_layout')
@section('upper-content')
    <div class="col-12 col-lg-12">
        <h1 style="font-family: OCR A Std; color: #24293c; text-align: center">Place your adverts</h1>
    </div>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
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
                @php
                    $user_country = Auth::user()->country;
                    $country_detail =  App\Country::where('name',$user_country)->first();
                @endphp
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
                        <div class="m-t-20 text-right">
                            <p>Subtotal</p>
                            <table align="right" class="table table-collapse" id="subtotal">
                                
                            </table>
                        <p><span class="text-left">Total:  </span><span id="currency">{{$country_detail->currencies}} </span><span id="total">0</span></p>
                        </div>
                        {{-- <input type="hidden" name="total_advert_price" id="total_advert_price"> --}}
                        <input type="hidden" name="name" placeholder="Plan Name" value="Advert Subscription"/>
                        <input type="hidden" name="amount" placeholder="Amount" id="total_advert_price"/>
                        <input type="hidden" name="interval" placeholder="Interval" value="monthly"/>
                        <input type="hidden" name="duration" placeholder="Duration" value="1"/> <!-- Uncomment if you want to add a duration -->
                        <div class="m-t-20 text-center">
                            {{-- <button class="site-btn">Create Advert</button> --}}
                            <button class="site-btn">Checkout</button>

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
        var subtotal = document.getElementById('subtotal')
        var total = document.getElementById('total')
        var total_advert_price = document.getElementById('total_advert_price')

        var five_pages = 200
        var all_pages = 1000
        var total_cost_array = []
        var cart = []
        var size


        function readURL(input, index){
            if(input.files && input.files[0]){
                var reader = new FileReader()
                
                reader.onload = function(e){
                    var id = '#preview'+index
                    var advert_image = '#advert_image'+index
                    
                    var img = new Image();      
                    img.src = e.target.result;

                    img.onload = function () {
                        var w = this.width;
                        var h = this.height;
                        console.log('width: '+w+' height: '+h)
                        if(size == 'center'){
                            // if(w % h < 100){
                            if(Math.ceil(w / h)  == 5 || Math.ceil(w / h)  == 6){
                                console.log(size)
                                $(id).attr('src', e.target.result)
                            }else{
                                console.log(size)
                                $(advert_image).val('')
                                alert('Size of the chosen image is not close to 5:1 type')
                                $(id).attr('src', '')
                            }
                        }else if(size == 'side'){
                            // if(w <= 500 && h <= 600){
                            if(Math.ceil(w / h)  == 1 || Math.ceil(w / h)  == 2){
                                console.log(size)
                                $(id).attr('src', e.target.result)
                            }else{
                                console.log(size)
                                $(advert_image).val('')
                                alert('Size of the chosen image is not close to 5:5 type')
                                $(id).attr('src', '')
                            }
                        }
                    }

                }
    
                reader.readAsDataURL(input.files[0])
            }
        }

        function sum(array_of_numbers){
            total_sum = array_of_numbers.reduce((a, b) => a+b, 0)
            return total_sum
        }

        function print_cart(cart, price){
            var tab = ''
            for(var x = 0; x< cart.length; x++){
                tab += '<tr>'
                    +  '<td>'+cart[x]+'</td>'
                    +  '<td>'+price[x]+'</td>'
                    +  '</tr>'
            }
            return tab
        }

        function handleSelectPages(index){
            var total_cost = 0
            var selected = document.getElementById('pages'+index)
            var selected_value = selected.value

            if(selected_value === '5 pages'){
                total_cost_array[index] = 200
                cart[index] = selected_value
                total.innerText = sum(total_cost_array)
                subtotal.innerHTML = print_cart(cart, total_cost_array)
                total_advert_price.value = sum(total_cost_array)
            }else if(selected_value === 'all pages'){
                total_cost_array[index] = 1000
                cart[index] = selected_value
                total.innerText = sum(total_cost_array)
                subtotal.innerHTML = print_cart(cart, total_cost_array)
                total_advert_price.value = sum(total_cost_array)
                 
            }
        }
        function handleSelectSize(index){
            var selected = document.getElementById('size'+index)
            var advert_image = document.getElementById('advert_image'+index)
            var selected_value = selected.value

            if(selected_value === 'side'){
               size = selected_value
               advert_image.style.display = 'block'
            }else if(selected_value === 'center'){
                size = selected_value
                advert_image.style.display = 'block'
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
                                + '<span>Please select advert size type</span>'
                                + '<select class="form-control" name="size[]" id="size'+i+'" onchange="handleSelectSize('+i+')" required>'
                                + '<option value="">Please select size</option>'
                                + '<option value="side">5:5</option>'
                                + '<option value="center">5:1</option>'
                                + '</select>'
                                + '</div>'
                                
                                + '<div class="form-group">'
                                + '<span>Please select web pages number</span>'
                                + '<select class="form-control" name="pages[]" id="pages'+i+'" onchange="handleSelectPages('+i+')" required>'
                                + '<option value="">Please select pages</option>'
                                + '<option value="5 pages">5 pages</option>'
                                + '<option value="all pages">all pages</option>'
                                + '</select>'
                                + '</div>'

                                + '<div class="form-group">'
                                + '<label>Advert Image</label>'
                                + '<input class="form-control" id="advert_image'+i+'" type="file" name="advert_image[]" required accept=".jpg, .png, .jpeg, .gif" style="display:none">'
                                + '<div align="center"><img style="width: 350px; height: 250px" id="preview'+i+'" src="#" alt="preview" /></div>'
                                + '</div>'
    
            }
    
            var state = 0
            var total_cost = 0

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
