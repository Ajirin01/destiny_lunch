@extends('layouts.site.main_layout')

@section('upper-content')
<div class="col-12 col-md-12">
    <div class="row">
        <div class="col-12 col-lg-5">
            <!-- Single Featured Post -->
            <h1 class="text-center">
                WELCOME
            </h1>
            <div>
                <h5 style="line-height: 1.5">
                    Welcome to Destiny Nigeria’s
                    Voice Magazine, “the
                    authentic global voice for
                    Nigeria”.
                </h5>
                <h5 style="line-height: 1.5">
                    We provide the foremost
                    platform you can rely on to
                    obtain valuable information
                    about Nigeria as a nation, her
                    people and her vast natural
                    resources.
                </h5>
                <a href="/about"><h4 class="text-center" style="font-size:0.8rem">… Read more About Us …</h4></a>
            </div>

        </div>
        <div class="col-12 col-lg-7">
            <!-- Single Featured Post -->
            @if (count($latest_articles)>0)
                <div class="single-blog-post featured-post">
                    <div class="post-thumb">
                        {{-- <a href="{{URL::to('articles/'.$random_articles[0]['article_type'].'/'.$random_articles[0]['id'])}}"><img style="width: 100%; height: 500px" src="{{$random_articles[0]['article_intro_image']}}" alt=""></a> --}}
                        <a href="{{URL::to('articles/'.$latest_articles[0]['article_type'].'/'.$latest_articles[0]['id'])}}">
                            <div style="background-image: url({{$latest_articles[0]['article_intro_image']}});
                            background-size: cover; background-repeat: no-repeat; background-position: center; width: inherit; height: 500px
                            "></div>
                        </a>
                    </div>
                    <div class="post-data">
                        <h4>{{$latest_articles[0]['article_title']}}</h4>
                        <div class="post-meta">
                            <p class="post-author">
                                <a class="text-danger" href="{{URL::to('articles/'.$latest_articles[0]['article_type'].'/'.$latest_articles[0]['id'])}}">
                                    … Read Interview …
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('lower-content')
<div class="popular-news-area section-padding-80-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="section-heading">
                    <h6 class="rect-box-headline">Popular Updates</h6>
                </div>
                <div class="row">
                    <!-- Single Post -->
                    @foreach ($latest_articles as $key => $article)
                        <div class="row">
                            <!-- Single Post comment-->
                            @if ($key > 0)
                                <div class="col-12 col-md-6">
                                    <div class="single-blog-post style-3">
                                        <h5 class="text-center">
                                            @php
                                                echo strtoupper(preg_replace("/-/"," ",$article['article_type']));
                                            @endphp
                                        </h5>
                                        <div class="post-thumb">
                                            <div class="single-blog-post featured-post mb-40">
                                                <div>
                                                    {{-- <a href="{{URL::to('articles/'.$article['article_type'].'/'.$article['id'])}}"><img style="width: 360px; height: 500px" src="{{$article['article_intro_image']}}" alt=""></a> --}}
                                                    <a href="{{URL::to('articles/'.$article['article_type'].'/'.$article['id'])}}">
                                                        <div style="background-image: url({{$article['article_intro_image']}});
                                                        background-size: cover; background-repeat: no-repeat; background-position: center; width: inherit; height: 500px
                                                        "></div>
                                                    </a>
                                                    
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Post -->
                                <div class="col-12 col-md-6">
                                    <div class="single-blog-post style-3">
                                        <div class="post-data">
                                            {{-- <br><br> --}}
                                            <h4 class="text-center" style="word-break: break-word">{{$article['article_title']}}:</h4>
                                            <div class="text-left" style="word-break: break-word; margin: 0 10px">
                                                <?php echo substr($article['article_intro'],0,500)?>...
                                            </div>
                                            
                                            {{-- {{$article['article_intro']}} --}}
                                            <p class="post-author">
                                                <a class="text-danger" href="{{URL::to('articles/'.$article['article_type'].'/'.$article['id'])}}">
                                                    … Read Story here…
                                                </a>
                                            </p>
                                            <div class="align-items-center">
                                                @php
                                                    include_once('includes/likes_comments_handler.php');
                                                @endphp

                                                <a href="/api/like/{{$article['id']}}" class="{{$article['id']}}" id="like-btn{{$article['id']}}" onclick="handleLikeButtonClicked({{$article['id']}})">
                                                    @if (Auth::user())
                                                        @if (getLikeUserH($article['id'], Auth::user()->id)>0)
                                                            <i style="color: red" id="like-icon{{$article['id']}}" class="fa fa-thumbs-up"></i>
                                                        @else
                                                            <i style="color: gray" id="like-icon{{$article['id']}}" class="fa fa-thumbs-up"></i>
                                                        @endif
                                                    @else
                                                        <i style="color: gray" id="like-icon{{$article['id']}}" class="fa fa-thumbs-up"></i>
                                                    @endif
                                                    <span id="likes{{$article['id']}}">
                                                        {{getLikesH($article['id'])}}
                                                    </span>
                                                </a>
                                                <a href="{{URL::to('articles/'.$article['article_type'].'/'.$article['id'])}}" class="post-comment">
                                                    @if (Auth::user())
                                                        @if (getCommentUserH($article['id'], Auth::user()->id)>0)
                                                            <i style="color: red" id="comment-icon" class="fa fa-comments"></i>
                                                        @else
                                                            <i style="color: gray" id="comment-icon" class="fa fa-comments"></i>
                                                        @endif
                                                    @else
                                                        <i style="color: gray" id="comment-icon" class="fa fa-comments"></i>
                                                    @endif
                                                    <span id="likes">
                                                        {{getCommentsH($article['id'])}}
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- ##### advert Add Area Start ##### -->
                        @if ($key % 2)
                            <div class="row" style="margin-bottom: 20px">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 justify-content-center">
                                            <div class="footer-add">
                                                <a href="#"><img src="<?php $advert = (App\Advert::where('position', 'center')->where('status','active')
                                                                            ->where('expired','no')->inRandomOrder()->first());
                                                                            if($advert != null){
                                                                                echo $advert->advert;
                                                                            }
                                                                        ?>" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <br>
                        <!-- ##### advert Add Area End ##### -->
                    @endforeach
                </div>
            </div>
            @if (count($latest_articles)>1)
                <div class="col-12 col-lg-4">
                    <div class="section-heading">
                        <h6 class="rect-box-headline">Info</h6>
                    </div>
                    {{--Blog links --}}
                    <div class="popular-news-widget newsletter-widget mb-30">
                        <h4 style="color: white">Blog Links</h4>
                        <div class="nav">
                            @php
                                include_once('includes/get_blog_links.php');
                                include_once('includes/get_user_by_ID.php');
                                
                            @endphp
                            @foreach (get_blog_links() as $key => $link)
                                <!-- Single Popular Blog -->
                                <div class="blog-links">
                                    <a href="{{URL::to('blog/'.get_user_by_id($link->blog_owner_id)->name.'/'.$link->blog_name)}}">
                                        {{$link->blog_name}}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Popular News Widget -->
                    <div class="popular-news-widget mb-30">
                        <h4 style="color: red">4 Most Recent Updates</h4>
                        @foreach ($latest_articles as $key => $latest)
                            <!-- Single Popular Blog -->
                            <div class="single-popular-post">
                                <a href="{{URL::to('articles/'.$latest['article_type'].'/'.$latest['id'])}}">
                                <h6><span>{{$key + 1}}.</span> {{$latest['article_title']}}</h6>
                                </a>
                                <p>{{\Carbon\Carbon::parse($latest['created_at'])->diffforHumans()}}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="popular-news-widget mb-30">
                        <div class="main-container">
                          <!-- Swiper -->
                          @php
                                $side_adverts = App\Advert::where('position', 'side')->where('status','active')
                                                ->where('expired','no')->get();
                                
                          @endphp
                          <div class="swiper-container">
                            <div class="swiper-wrapper" >
                                @foreach ($side_adverts as $advert)
                                    <div class="swiper-slide">
                                        <img class="slide-img" src="{{$advert->advert}}">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    </div>
                    <!-- Newsletter Widget -->
                    <div class="newsletter-widget">
                        <h4>Newsletter</h4>
                        <p>Get our latest updates by just Subscribing to our Newsletter</p>
                        <form action="/subscribe-newsletter" method="post">
                            @csrf
                            <input type="text" name="name" placeholder="Name">
                            <input type="email" name="email" placeholder="Email">
                            <button type="submit" class="btn w-100">Subscribe</button>
                        </form>
                    </div>
                    <br>
                    <div class="newsletter-widget mb-30">
                        <div class="main-container">
                          <!-- Swiper -->
                          <div class="swiper-container">
                            <div class="swiper-wrapper" >
                                @foreach ($side_adverts as $advert)
                                    <div class="swiper-slide">
                                        <img class="slide-img" src="{{$advert->advert}}">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
    </div>
</div>

<!-- ##### Video Post Area Start ##### -->
{{-- <div class="video-post-area bg-img bg-overlay" style="background-image: url(img/bg-img/bg1.jpg); transform: scaleY(.5)"> --}}

<!-- ##### Video Post Area End ##### -->
@if (Auth::user())
    <script>
        function handleLikeButtonClicked(id){
            event.preventDefault()
            var like_btn = document.getElementById('like-btn'+id)
            var like_icon = document.getElementById('like-icon'+id)
            var likes_container = document.getElementById('likes'+id)
            console.log('like button clicked on ID:'+ id)
            var user_id = "{{Auth::user()->id}}"
            var url = like_btn.href

            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', url);

            xhr.onload = function(){
                var json;

                if(xhr.status != 200){
                    console.log('HTTP Error:' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                var res = xhr.responseText;
                var msg = JSON.parse(res).msg;
                var likes = JSON.parse(res).likes;

                if(msg === "liked"){
                    like_icon.style.color = "red";
                    console.log(likes);
                    likes_container.innerText = likes;
                }else if(msg === "unliked"){
                    like_icon.style.color = "gray";
                    console.log(likes);
                    likes_container.innerText = likes;
                }else if(msg === "failure"){
                    alert("Internal error has occurred!");
                }else{
                    alert('connection error')
                }
            
            };

            formData = new FormData();
            formData.append('id', user_id);

            xhr.send(formData);
        }
    </script>
@else
    <script>
        var like_btn = document.getElementById('like-btn')

        function handleLikeButtonClicked(id){
            event.preventDefault()
            alert('Ops!, You can not like article because you are not logged in. Please Login or Register to like article.')
        }
    </script>
@endif

@endsection