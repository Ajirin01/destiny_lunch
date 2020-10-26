@extends('layouts.site.main_layout')

@section('upper-content')
<section class="section gb nopadtop">
    <div class="container">
        <div class="boxed boxedp4">

            {{-- <div id="map" class="wow slideInUp"></div> --}}
            <div class="row">
                <div class="col-md-12 col-md-offset-3">
                    <div class="section-title text-center">
                        <h3>Contact Form</h3>
                    </div><!-- end title -->
                    <div class="col-12 text-center">
                        <h4 class="page-title text-center text-success">
                            @if(session('msg'))
                                {{session('msg')}}
                            @endif
                        </h4>
                    </div>
                    <div class="contact-form-area">
                        <form action="{{ route('contactUs') }}" method="POST" class="big-contact-form" role="search">
                            @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" name='name' class="form-control" placeholder="Enter your name..">
                                    </div>
                                    <div class="col-12">
                                        <input type="email" name='email' class="form-control" placeholder="Enter email..">
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Comment" required></textarea>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn newspaper-btn mt-30 w-100" type="submit">Submit Message</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div>
</section>
@endsection