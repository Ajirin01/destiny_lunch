<?php 
    define("filename", "CountryCodes.json");
	define("mode", "r");
	$ph = fopen(filename, mode);
	$json = file_get_contents(filename);
	$countries = json_decode($json, true);
?>
@extends('layouts.auth.auth_layout')

@section('auth_content')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('auth/images/img-01.png')}}" alt="IMG">
            </div>

            <form class="login100-form validate-form" method="POST" action="{{ route('next') }}">
                @csrf
                <span class="login100-form-title">
                    {{ __('Register') }}
                </span>
                @error('email')
                    <span class="text-danger"  role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
                @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="wrap-input100 validate-input" data-validate = "Valid first name is required: A-Za-z">
                    
                    <input class="input100 " name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus type="text" placeholder="fullname">

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Valid country is required: ex@abc.xyz">
                    <select class="input100" id="country" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus placeholder="country">
                        <option value="">Please select country</option>
                        @foreach ($countries as $country)
                        <option value="{{$country['dial_code']}}">{{$country['name']}}</option>
                        @endforeach
                        <input type="hidden" id="country_name" name="country_name" value="">
                    </select>
                    
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    
                    <input class="input100 @error('phone') is-invalid @enderror" id="phone" name="phone" required type="phone"  placeholder="phone">

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        {{ __('Continue') }}
                    </button>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="/register">
                        {{-- Create your Account --}}
                        {{-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> --}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var country = document.getElementById('country')
    var phone = document.getElementById('phone')
    var country_name_to_send = document.getElementById('country_name')
    var country_name = country.innerText
    country.onchange = ()=> {
        phone.value = country.value+" "
        country_name_to_send.value = country.options[country.selectedIndex].text
        // console.log(country_name_to_send.value)
    }
</script>
@endsection

