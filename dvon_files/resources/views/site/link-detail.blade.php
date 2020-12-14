<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Destiny &amp; Voice of Nigeria</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('site/img/core-img/destiny-logo.png')}}">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('site/style.css')}}">

    <!-- swipper Stylesheet -->
    <link rel="stylesheet" href="{{asset('site/css/swiper.min.css')}}">

</head>

<body  style="height: 100vh; background: url({{$link->link_intro_background}}) rgba(100,100,100,1); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div style="width: 100%; height: 100%; background-color: rgba(2, 10, 19, 0.918);">
        <div class="container" >
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-12 col-lg-12 text-center" style="word-break: break-word; margin-top: 10%;">
                            <!-- Single Featured Post -->
                            @php
                                echo $link->link_intro_description;
                            @endphp
                                
                            <div style=" width: 150px; background-color: white; padding: 10px 20px 5px 20px; border-radius: 50px; margin: 0 auto; margin-top: 5%">
                                <a href="//{{$link->link_url}}"><h4 class="text-center" style="font-size:0.9rem">Visit Site</h4></a>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>