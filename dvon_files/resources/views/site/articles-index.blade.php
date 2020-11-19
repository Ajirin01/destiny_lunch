@extends('layouts.site.main_layout')
@section('upper-content')
    <h3 class="text-center">{{$title}}</h3>
    <div class="col-12">
        @if (count($articles) > 0)
            <div class="single-blog-post featured-post col-12" style="word-wrap: break-word">
                {{-- <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img style="width: 100%; height: 500px" src="{{$articles[0]->article_intro_image}}" alt=""></a> --}}
                <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">
                    <div style="background-image: url({{$articles[0]->article_intro_image}});
                    background-size: cover; background-repeat: no-repeat; background-position: center; width: inherit; height: 500px
                    "></div>
                </a>
                <div class="post-data">
                    <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                        <h6>{{$articles[0]->article_title}}</h6> 
                    </a>
                    <div class="text-left"><?php echo substr($articles[0]->article_intro,0,500)?>...</div>
                    <div class="align-items-center">
                        @php
                            include_once('includes/likes_comments_handler.php');
                        @endphp
                        <a href="/api/like/{{$articles[0]->id}}" class="{{$articles[0]->id}}" id="like-btn{{$articles[0]->id}}" onclick="handleLikeButtonClicked({{$articles[0]->id}})">
                            @if (Auth::user())
                                @if (getLikeUserH($articles[0]->id, Auth::user()->id)>0)
                                    <i style="color: red" id="like-icon{{$articles[0]->id}}" class="fa fa-thumbs-up"></i>
                                @else
                                    <i style="color: gray" id="like-icon{{$articles[0]->id}}" class="fa fa-thumbs-up"></i>
                                @endif
                            @else
                                <i style="color: gray" id="like-icon{{$articles[0]->id}}" class="fa fa-thumbs-up"></i>
                            @endif
                        <span id="likes{{$articles[0]->id}}">
                                @php
                                    echo getLikesH($articles[0]->id);
                                @endphp
                            </span>
                        </a>
                        <a href="{{URL::to('articles/'.$articles[0]->article_type.'/'.$articles[0]->id)}}" class="post-comment">
                            @if (Auth::user())
                                @if (getCommentUserH($articles[0]->id, Auth::user()->id)>0)
                                    <i style="color: red" id="comment-icon" class="fa fa-comments"></i>
                                @else
                                    <i style="color: gray" id="comment-icon" class="fa fa-comments"></i>
                                @endif
                            @else
                                <i style="color: gray" id="comment-icon" class="fa fa-comments"></i>
                            @endif
                            <span id="comment">
                                @php
                                    echo getCommentsH($articles[0]->id);
                                @endphp
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <h3 class="text-center">Ops! Article content is unavailable at the moment</h3>
            <h3 class="text-center">Please check again later</h3>
            <img src="{{asset('site/img/bg-img/ops.gif')}}" alt="">
        @endif
        
    </div>
</div>
@endsection

@section('lower-content')
    @if (count($articles) >= 2)
        <!-- ##### Blog Area Start ##### -->
        <div style="margin-top: 30px" class="blog-area section-padding-0-80">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="section-heading">
                            <h6 class="rect-box-headline">Popular Updates</h6>
                        </div>
                        <div class="blog-posts-area">

                            <!-- Single Featured Post -->
                            @foreach ($articles as $key => $article)
                                @if ($key > 0)
                                    <div class="single-blog-post featured-post mb-30" style="word-wrap: break-word">
                                        <div>
                                            {{-- <a href="{{URL::to('articles/'.$article_type.'/'.$article->id)}}"><img style=" width: 100%; height: 500px" src="{{$article->article_intro_image}}" alt=""></a> --}}
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$article->id)}}">
                                                <div style="background-image: url({{$article->article_intro_image}});
                                                background-size: cover; background-repeat: no-repeat; background-position: center; width: inherit; height: 500px
                                                "></div>
                                            </a>
                                        </div>
                                        <div class="post-data">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$article->id)}}" class="post-title">
                                                <h6>{{$article->article_title}}</h6>
                                            </a>
                                            <div class="text-left"><?php echo substr($article->article_intro,0,500)?>...</div>
                                            <div class="align-items-center">
                                                <a href="/api/like/{{$article->id}}" class="{{$article->id}}" id="like-btn{{$article->id}}" onclick="handleLikeButtonClicked({{$article->id}})">
                                                    @if (Auth::user())
                                                        @if (getLikeUserH($article->id, Auth::user()->id)>0)
                                                            <i style="color: red" id="like-icon{{$article->id}}" class="fa fa-thumbs-up"></i>
                                                        @else
                                                            <i style="color: gray" id="like-icon{{$article->id}}" class="fa fa-thumbs-up"></i>
                                                        @endif
                                                    @else
                                                        <i style="color: gray" id="like-icon{{$article->id}}" class="fa fa-thumbs-up"></i>
                                                    @endif
                                                    <span id="likes{{$article->id}}">
                                                        @php
                                                            echo getLikesH($article->id);
                                                        @endphp
                                                    </span>
                                                </a>
                                                <a href="{{URL::to('articles/'.$article->article_type.'/'.$article->id)}}" class="post-comment">
                                                    @if (Auth::user())
                                                        @if (getCommentUserH($article->id, Auth::user()->id)>0)
                                                            <i style="color: red" id="comment-icon" class="fa fa-comments"></i>
                                                        @else
                                                            <i style="color: gray" id="comment-icon" class="fa fa-comments"></i>
                                                        @endif
                                                    @else
                                                        <i style="color: gray" id="comment-icon" class="fa fa-comments"></i>
                                                    @endif
                                                    <span id="comments">
                                                        @php
                                                            echo getCommentsH($article->id);
                                                        @endphp
                                                    </span>
                                                </a>
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
                                @endif
                            @endforeach
                        </div>

                        <nav aria-label="Page navigation example">
                            {{$articles->links()}}
                        </nav>
                    </div>
                    @php
                        include_once('includes/get_random_latest.php');
                    @endphp
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
                            <h4 style="color: red">Most Recent Updates</h4>
                            @foreach ($latest_articles as $key => $latest)
                                <!-- Single Popular Blog -->
                                @if ($key < 6)
                                    <div class="single-popular-post">
                                        <a href="{{URL::to('articles/'.$latest['article_type'].'/'.$latest['id'])}}">
                                        <h6><span>{{$key + 1}}.</span> {{$latest['article_title']}}</h6>
                                        </a>
                                        <p>{{\Carbon\Carbon::parse($latest['created_at'])->diffforHumans()}}</p>
                                    </div>
                                @endif
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
            </div>
        </div>
        <!-- ##### Blog Area End ##### -->
    @endif

    @if (Auth::user())
    <script>
        function handleLikeButtonClicked(id){
            event.preventDefault()
            var like_btn = document.getElementById('like-btn'+id);
            var like_icon = document.getElementById('like-icon'+id);
            var likes_container = document.getElementById('likes'+id);
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
        function handleLikeButtonClicked(id){
            event.preventDefault()
            alert('Ops!, You can not like article because you are not logged in. Please Login or Register to like article.')
        }
    </script>
    @endif
@endsection