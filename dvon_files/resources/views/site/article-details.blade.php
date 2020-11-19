@extends('layouts.site.main_layout')
@section('upper-content')
@if (count($article)>0)
    <h3 class="text-center">{{$article[0]->article_title}}</h3>
    <div class="article-items" style="word-break: break-word;">
        <?php echo $article[0]->article_intro;?>
    </div>
@else
    <h3 class="text-center">Ops! Article content is unavailable at the moment</h3>
    <h3 class="text-center">Please check again later</h3>
    <img src="{{asset('site/img/bg-img/ops.gif')}}" alt="">
@endif

@endsection

@section('lower-content')
@php
    use Carbon\Carbon;
    include_once('includes/get_random_latest.php');
@endphp
@if (count($article)>0)
    <!-- ##### Blog Area Start ##### -->
    @php
        // $adverts = App\Advert::where('status','active')->inRandomOrder()->get();
    @endphp
    <div class="blog-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <br>
                    <div class="blog-posts-area">
                        <div class="section-heading">
                            <h6>Interview</h6>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                @if ($article[0]->paid)
                                    @if (!Auth::user()->subscribed)
                                        <div>
                                            <div class="article-items" style="word-break: break-word" id="article-details">
                                                <?php echo substr($article[0]->article_description,0,500)?>...
                                            </div>
                                            <div class="article-items">
                                                <h6 class="text-center text-danger">
                                                    "Ops! you do not have active subscription, please subscribe to read full content and enjoy unlimited access at <span class="text-primary">*** NGN</span><span class="text-primary"> 600 *** </span> only" 
                                                </h6>
                                            </div>
                                            <form method="POST" action="{{ route('createpaymentplan') }}" id="paymentForm">
                                                @csrf
                                                <input type="hidden" name="name" placeholder="Plan Name" value="Subscription to read articles"/>
                                                <input type="hidden" name="amount" placeholder="Amount" value="600"/>
                                                <input type="hidden" name="interval" placeholder="Interval" value="monthly"/>
                                                <input type="hidden" name="duration" placeholder="Duration" value="1"/> <!-- Uncomment if you want to add a duration -->
                                                {{-- <input type="submit" value="Create"  /> --}}
                                                <div class="m-t-20 text-center">
                                                    <input type="submit" value="Subscribe"  class="site-btn"/>
                                                </div>
                                            </form>

                                            
                                        </div>
                                    @else
                                        <div class="article-items" style="word-break: break-word" id="article-details">
                                            <?php echo $article[0]->article_description;?>
                                        </div>
                                    @endif
                                @else
                                    <div class="article-items" style="word-break: break-word" id="article-details">
                                        <?php echo $article[0]->article_description;?>
                                    </div>
                                @endif
                                
                                
                                <br><br>
                                <a href="{{URL::to('articles/'.$article_type)}}" class="btn btn-primary">
                                … Read Other Related Interviews….
                                </a>
                                <br><br>
                            </div>
                        </div>

                        <!-- Comment Area Start -->
                        <div class="comment_area clearfix">
                            @if ($number_of_comments == 0)
                            <h3 class="small-title">No comments yet, be the first to comment</h3>
                            @else
                                @if ($number_of_comments == 1)
                                <h3 class="small-title">{{$number_of_comments}} Comment</h3>
                                @else
                                <h3 class="small-title">{{$number_of_comments}} Comments</h3>
                                @endif
                            @endif
                            <br>

                            @php
                                include_once('includes/get_user_by_ID.php');
                            @endphp

                            @foreach ($comments as $comment)
                            <ol>
                                <!-- Single Comment Area -->
                                <li class="single_comment_area">
                                    <!-- Comment Content -->
                                    <div class="comment-content d-flex" style="word-wrap: break-word">
                                        <!-- Comment Author -->
                                        <div class="comment-author">
                                            <i class="fa fa-user" style="transform: scale(3) translateY(10px)"></i>
                                        </div>
                                        <!-- Comment Meta -->
                                        <div class="comment-meta">
                                            <a href="#" class="post-author">{{get_user_by_id($comment->user_id)->fullname}}</a>
                                            <a href="#" class="post-date">{{$comment->created_at->diffforHumans()}}</a>
                                            <p>{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                            @endforeach

                            
                        </div>

                        <div class="post-a-comment-area section-padding-80-0">
                            <h4>Leave a comment</h4>
                            
                            <!-- Reply Form -->
                            <div class="contact-form-area">
                                <div class="col-12 text-center">
                                    <h4 class="page-title text-center text-success">
                                        @if(session('msg'))
                                            {{session('msg')}}
                                        @endif
                                    </h4>
                                </div>
                                @if (Auth::user())
                                    <form action="{{URL::to('articles/'.$article_type.'/'.$article[0]->id.'/comment')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea name="comment" class="form-control" id="message" cols="30" rows="10" placeholder="Comment" required></textarea>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button class="btn newspaper-btn mt-30 w-100" type="submit">Submit Comment</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{URL::to('articles/'.$article_type.'/'.$article[0]->id.'/comment')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <button class="btn newspaper-btn mt-30 w-100" type="submit">Please Login to post comments</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- @if (count($latest_articles)>1) --}}
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
            {{-- @endif --}}
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->
    @endif

    <script>
        var y, article_details = document.getElementById('article-details')
        var article_adverts = document.getElementsByTagName('code')
        var advert
        var config = {
            routes:{
                url: "{{URL::to('/api/get-adverts')}}"
            }
        }

        async function getAdvert(){
           let response = await fetch(config.routes.url)
           let data = await response.text()
           return data
        }

        async function makeAdvert(){
            for(var i = 0; i< article_adverts.length; i++){
                advert = await getAdvert()
                advert = JSON.parse(advert).advert
                console.log(advert)
                article_adverts[i].innerHTML = "<img src='"+advert+"' alt='' style='margin: 20px 0'>"
            }
        }
        makeAdvert()
        
    </script>
@endsection