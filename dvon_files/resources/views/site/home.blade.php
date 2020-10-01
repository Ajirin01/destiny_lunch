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
            @if (count($random_articles)>0)
                <div class="single-blog-post featured-post">
                    <div class="post-thumb">
                        <a href="{{URL::to('articles/'.$random_articles[0]['article_type'].'/'.$random_articles[0]['id'])}}"><img style="width: 100%; height: 500px" src="/dvon_files/public/uploads/{{$random_articles[0]['article_intro_image']}}" alt=""></a>
                    </div>
                    <div class="post-data">
                        <h4>{{$random_articles[0]['article_title']}}</h4>
                        <div class="post-meta">
                            <p class="post-author">
                                <a class="text-danger" href="#">
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
                    @foreach ($random_articles as $key => $article)
                    <div class="row">
                        <!-- Single Post -->
                        
                            @if ($key > 0)
                                <div class="col-12 col-md-6">
                                    <div class="single-blog-post style-3">
                                        {{-- <h5 class="text-center">
                                            LOVE FROM DIASPORA …
                                        </h5> --}}
                                        {{-- <br> --}}
                                        <div class="post-thumb">
                                            <div class="single-blog-post featured-post mb-30">
                                                <div>
                                                    <a href="{{URL::to('articles/'.$article['article_type'].'/'.$article['id'])}}"><img style="width: 400px; height: 500px" src="/dvon_files/public/uploads/{{$article['article_intro_image']}}" alt=""></a>
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
                                            <div class="text-left row" style="word-break: break-word;">
                                                <?php echo substr($article['article_intro'],0,500)?>...
                                            </div>
                                            
                                            {{-- {{$article['article_intro']}} --}}
                                            <p class="post-author">
                                                <a class="text-danger" href="{{URL::to('articles/'.$article['article_type'].'/'.$article['id'])}}">
                                                    … Read Story here…
                                                </a>
                                            </p>
                                            <div class="align-items-center">
                                                <a href="#" class="post-like"><img src="{{asset('site/img/core-img/like.png')}}" alt=""> <span>392</span></a>
                                                <a href="#" class="post-comment"><img src="{{asset('site/img/core-img/chat.png')}}" alt=""> <span>10</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                @endforeach

                </div>
            </div>
            @if (count($random_articles)>1)
                <div class="col-12 col-lg-4">
                    <div class="section-heading">
                        <h6 class="rect-box-headline">Info</h6>
                    </div>
                    <!-- Popular News Widget -->
                    <div class="popular-news-widget mb-30">
                        <h3>4 Most Recent Updates</h3>
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
            
        </div>
    </div>
</div>

<!-- ##### Video Post Area Start ##### -->
{{-- <div class="video-post-area bg-img bg-overlay" style="background-image: url(img/bg-img/bg1.jpg); transform: scaleY(.5)"> --}}
<div class="video-post-area bg-img bg-overlay" style="background-image: url(img/bg-img/bg1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Single Video Post -->
            <div class="col-12 col-sm-6 col-md-4">
                {{-- <div class="single-video-post" style="transform: scaleX(.7); transform: scaleY()"> --}}
                <div class="single-video-post">
                    <img src="{{asset('site/img/bg-img/aunty shade advert.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Video Post Area End ##### -->
@endsection