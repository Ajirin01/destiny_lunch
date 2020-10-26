@extends('layouts.site.main_layout')
@section('upper-content')
    <div class="col-12 col-lg-12" style="margin-top: 150px">
        @php
            $array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
                            array('metaname' => 'size', 'metavalue' => 'big'));
            $user_fullname = Auth::user()->fullname;
            $user_fullname = preg_replace("/ /",",", $user_fullname);
            $user_fullname_array = explode(',',$user_fullname);
        @endphp
        <form method="POST" action="{{ route('blogpay') }}" id="paymentForm" class="align-content-center text-align-center">
            @csrf
            <input type="hidden" name="amount" value="{{$sub_data->amount}}" /> <!-- Replace the value with your transaction amount -->
            <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
            <input type="hidden" name="description" value="Blog Ownership Subscription Payment" /> <!-- Replace the value with your transaction description -->
            <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
            <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
            <input type="hidden" name="email" value="{{Auth::user()->email}}" /> <!-- Replace the value with your customer email -->
            <input type="hidden" name="firstname" value="{{$user_fullname_array[0]}}" /> <!-- Replace the value with your customer firstname -->
            <input type="hidden" name="lastname" value="{{$user_fullname_array[1]}}" /> <!-- Replace the value with your customer lastname -->
            <input type="hidden" name="metadata" value="{{ json_encode($array) }}" > <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
            <input type="hidden" name="phonenumber" value="{{Auth::user()->phone}}" /> <!-- Replace the value with your customer phonenumber -->
            <input type="hidden" name="paymentplan" value="{{$sub_data->id}}" /> <!-- Ucomment and Replace the value with the payment plan id -->
            {{-- <input type="hidden" name="ref" value="MY_NAME_5uwh2a2a7f270ac98" /> <!-- Ucomment and  Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. --> --}}
            {{-- <input type="hidden" name="logo" value="https://pbs.twimg.com/profile_images/915859962554929153/jnVxGxVj.jpg" /> <!-- Replace the value with your logo url (Optional, present in .env)--> --}}
            {{-- <input type="hidden" name="title" value="Flamez Co" /> <!-- Replace the value with your transaction title (Optional, present in .env) --> --}}
            <div class="m-t-20 text-center">
                <input type="submit" value="Continue"  class="site-btn"/>
            </div>
        </form>
    </div>
@endsection
