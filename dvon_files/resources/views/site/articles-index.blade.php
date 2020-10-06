@extends('layouts.site.main_layout')
@section('upper-content')
    <h3 class="text-center">{{$title}}</h3>
    <div class="col-12">
        @if (count($articles) > 0)
            <div class="single-blog-post featured-post col-12">
                <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img style="width: 100%; height: 500px" src="/dvon_files/public/uploads/{{$articles[0]->article_intro_image}}" alt=""></a>
                <div class="post-data">
                    <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                        <h6>{{$articles[0]->article_title}}</h6> 
                    </a>
                    <div class="align-items-center">
                        @php
                            function getLikesH($article_id){
                                $likes = App\Like::where('article_id',$article_id)->get();
                                return count($likes);
                            }

                            function getCommentsH($article_id){
                                $comments = App\ArticleComment::where('article_id',$article_id)->get();
                                return count($comments);
                            }

                            function getLikeUserH($article_id, $user_id){
                                $likes = App\Like::where('user_id',$user_id)->where('article_id',$article_id)->get();
                                return count($likes);
                            }

                            function getCommentUserH($article_id, $user_id){
                                $likes = App\ArticleComment::where('user_id',$user_id)->where('article_id',$article_id)->get();
                                return count($likes);
                            }

                        @endphp
                        <a href="/api/like/{{$articles[0]->id}}" class="{{$articles[0]->id}}" id="like-btn">
                            @if (Auth::user())
                                @if (getLikeUserH($articles[0]->id, Auth::user()->id)>0)
                                    <i style="color: red" id="like-icon" class="fa fa-thumbs-up"></i>
                                @else
                                    <i style="color: gray" id="like-icon" class="fa fa-thumbs-up"></i>
                                @endif
                            @else
                                <i style="color: gray" id="like-icon" class="fa fa-thumbs-up"></i>
                            @endif
                            <span id="likes">
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
                            <span id="likes">
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
                                    <div class="single-blog-post featured-post mb-30">
                                        <div >
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$article->id)}}"><img style=" width: 100%; height: 500px" src="/dvon_files/public/uploads/{{$article->article_intro_image}}" alt=""></a>
                                        </div>
                                        <div class="post-data">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$article->id)}}" class="post-title">
                                                <h6>{{$article->article_title}}……</h6>
                                            </a>
                                            <div class="align-items-center">
                                                <a href="/api/like/{{$article->id}}" class="{{$article->id}}" id="like-btn2">
                                                    @if (Auth::user())
                                                        @if (getLikeUserH($article->id, Auth::user()->id)>0)
                                                            <i style="color: red" id="like-icon2" class="fa fa-thumbs-up"></i>
                                                        @else
                                                            <i style="color: gray" id="like-icon2" class="fa fa-thumbs-up"></i>
                                                        @endif
                                                    @else
                                                        <i style="color: gray" id="like-icon2" class="fa fa-thumbs-up"></i>
                                                    @endif
                                                    <span id="likes2">
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
                                @endif
                            @endforeach
                        </div>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination mt-50">
                                <li class="page-item active"><a class="page-link" href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">1</a></li>
                                <li class="page-item"><a class="page-link" href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">2</a></li>
                                <li class="page-item"><a class="page-link" href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">3</a></li>
                                <li class="page-item"><a class="page-link" href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">4</a></li>
                                <li class="page-item"><a class="page-link" href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">5</a></li>
                                <li class="page-item"><a class="page-link" href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">...</a></li>
                                <li class="page-item"><a class="page-link" href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">10</a></li>
                            </ul>
                        </nav>
                    </div>
                    @php
                        include_once('includes/get_random_latest.php');
                    @endphp
                    <div class="col-12 col-lg-4">
                        <div class="blog-sidebar-area">

                            <!-- Latest Posts Widget -->
                            {{-- <div class="latest-posts-widget mb-50">

                                <!-- Single Featured Post -->
                                <div class="single-blog-post small-featured-post d-flex">
                                    <div class="post-thumb">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img src="{{asset('site/img/bg-img/19.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-catagory">Finance</a>
                                        <div class="post-meta">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                                                <h6>Pellentesque mattis arcu massa, nec fringilla turpis eleifend id.</h6>
                                            </a>
                                            <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Featured Post -->
                                <div class="single-blog-post small-featured-post d-flex">
                                    <div class="post-thumb">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img src="{{asset('site/img/bg-img/20.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-catagory">Politics</a>
                                        <div class="post-meta">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                                                <h6>Sed a elit euismod augue semper congue sit amet ac sapien.</h6>
                                            </a>
                                            <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Featured Post -->
                                <div class="single-blog-post small-featured-post d-flex">
                                    <div class="post-thumb">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img src="{{asset('site/img/bg-img/21.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-catagory">Health</a>
                                        <div class="post-meta">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                                                <h6>Pellentesque mattis arcu massa, nec fringilla turpis eleifend id.</h6>
                                            </a>
                                            <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Featured Post -->
                                <div class="single-blog-post small-featured-post d-flex">
                                    <div class="post-thumb">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img src="{{asset('site/img/bg-img/22.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-catagory">Finance</a>
                                        <div class="post-meta">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                                                <h6>Augue semper congue sit amet ac sapien. Fusce consequat.</h6>
                                            </a>
                                            <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Featured Post -->
                                <div class="single-blog-post small-featured-post d-flex">
                                    <div class="post-thumb">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img src="{{asset('site/img/bg-img/23.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-catagory">Travel</a>
                                        <div class="post-meta">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                                                <h6>Pellentesque mattis arcu massa, nec fringilla turpis eleifend id.</h6>
                                            </a>
                                            <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Featured Post -->
                                <div class="single-blog-post small-featured-post d-flex">
                                    <div class="post-thumb">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}"><img src="{{asset('site/img/bg-img/24.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-catagory">Politics</a>
                                        <div class="post-meta">
                                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}" class="post-title">
                                                <h6>Augue semper congue sit amet ac sapien. Fusce consequat.</h6>
                                            </a>
                                            <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Popular News Widget -->
                            @if (count($latest_articles)>1)
                        <div class="section-heading">
                            <h6 class="rect-box-headline">Info</h6>
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
                                    {{-- <p>{{$latest['created_at']->diffforHumans()}}</p> --}}
                                </div>
                            @endforeach
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
                    </div>
                @endif

                <!-- Latest Comments Widget -->
                <div class="latest-comments-widget">
                    <h3>Latest Comments</h3>

                    <!-- Single Comments -->
                    <div class="single-comments d-flex">
                        <div class="comments-thumbnail mr-15">
                            <img src="{{asset('site/img/bg-img/29.jpg')}}" alt="">
                        </div>
                        <div class="comments-text">
                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">Jamie Smith <span>on</span> Facebook is offering facial recognition...</a>
                            <p>06:34 am, April 14, 2018</p>
                        </div>
                    </div>

                    <!-- Single Comments -->
                    <div class="single-comments d-flex">
                        <div class="comments-thumbnail mr-15">
                            <img src="{{asset('site/img/bg-img/30.jpg')}}" alt="">
                        </div>
                        <div class="comments-text">
                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">Jamie Smith <span>on</span> Facebook is offering facial recognition...</a>
                            <p>06:34 am, April 14, 2018</p>
                        </div>
                    </div>

                    <!-- Single Comments -->
                    <div class="single-comments d-flex">
                        <div class="comments-thumbnail mr-15">
                            <img src="{{asset('site/img/bg-img/31.jpg')}}" alt="">
                        </div>
                        <div class="comments-text">
                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">Jamie Smith <span>on</span> Facebook is offering facial recognition...</a>
                            <p>06:34 am, April 14, 2018</p>
                        </div>
                    </div>

                    <!-- Single Comments -->
                    <div class="single-comments d-flex">
                        <div class="comments-thumbnail mr-15">
                            <img src="{{asset('site/img/bg-img/32.jpg')}}" alt="">
                        </div>
                        <div class="comments-text">
                            <a href="{{URL::to('articles/'.$article_type.'/'.$articles[0]->id)}}">Jamie Smith <span>on</span> Facebook is offering facial recognition...</a>
                            <p>06:34 am, April 14, 2018</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##### Blog Area End ##### -->
    @endif

    @if (Auth::user())
    <script>
        var like_btn = document.getElementById('like-btn');
        var like_btn2 = document.getElementById('like-btn2');
        var like_icon = document.getElementById('like-icon');
        var like_icon2 = document.getElementById('like-icon2');
        var likes_container = document.getElementById('likes');
        var likes_container2 = document.getElementById('likes2');

        like_btn.onclick = (e) => {
            e.preventDefault()
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

        like_btn2.onclick = (e) => {
            e.preventDefault()
            var user_id = "{{Auth::user()->id}}"
            var url = like_btn2.href

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
                        like_icon2.style.color = "red";
                        console.log(likes);
                        likes_container2.innerText = likes;
                    }else if(msg === "unliked"){
                        like_icon2.style.color = "gray";
                        console.log(likes);
                        likes_container2.innerText = likes;
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

        like_btn.onclick = (e) => {
            e.preventDefault()
            alert('Ops!, You can not like article because you are not logged in. Please Login or Register to like article.')
        }
    </script>
    @endif
@endsection