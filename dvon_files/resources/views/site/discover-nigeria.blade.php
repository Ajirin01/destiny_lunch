@extends('layouts.site.main_layout')

@section('upper-content')
<div class="col-12 col-md-12">
    <div class="row">
        <div class="col-12 col-lg-12">
            <!-- Single Featured Post -->
            <h1 class="text-center">
                DISCOVER NIGERIA
            </h1>
            <div>
                <h5 style="line-height: 1.5">
                    Nigeria is a great country, 
                    rich in vast natural and human resources, 
                    blessed with adequate rain and mild summer, 
                    rich vegetation belt, 
                    most suitable for diverse food and cash crops, etc.
                </h5>
                <h5 style="line-height: 1.5">
                    A greater percentage of Nigeria’s vast resources are still untapped,
                    as her focus has been majorly on Crude oil and Natural gas,
                    which presently provides for greater chunk of her GDP and National Income. 

                </h5>
                {{-- <a href="/about"><h4 class="text-center" style="font-size:0.8rem">… Read more About Us …</h4></a> --}}
            </div>

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
                    @foreach ($latest_articles_discover_nigeria as $key => $article)
                        <div class="row">
                            <!-- Single Post -->
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
                                        <h4>{{$article['article_title']}}:</h4>
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
                        </div>
                        <!-- ##### Advert Add Area Start ##### -->
                        @if ($key % 2)
                            <div class="row">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="footer-add">
                                                <a href="#"><img src="{{asset('site/img/bg-img/footer-add.gif')}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <br>
                        <!-- ##### Advert Add Area End ##### -->
                    @endforeach
                </div>
            </div>
            @if (count($latest_articles_discover_nigeria)>0)
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
                                include_once('includes/get_user_by_id.php');
                                
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
                          <div class="swiper-container">
                            <div class="swiper-wrapper" >
                                <?php
                                    for($i=0;$i<10;$i++){
                                        echo'<div class="swiper-slide">';
                                        echo '<img class="slide-img" src="/site/img/core-img/destiny-logo.png">';
                                        echo'</div>';
                                    }
                               ?>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    </div>
                    <!-- Newsletter Widget -->
                    <div class="newsletter-widget">
                        <h4>Newsletter</h4>
                        <p>Get our latest update by simply Subscribing to our Newsletter</p>
                        <form action="#" method="post">
                            <input type="text" name="text" placeholder="Name">
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
                                <?php
                                    for($i=0;$i<10;$i++){
                                        echo'<div class="swiper-slide">';
                                        echo '<img class="slide-img" src="/site/img/core-img/destiny-logo.png">';
                                        echo'</div>';
                                    }
                               ?>
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