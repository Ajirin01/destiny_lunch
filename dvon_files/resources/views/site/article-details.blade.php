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
@if (count($article)>0)
    <!-- ##### Blog Area Start ##### -->
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
                                <div class="article-items" style="word-break: break-word">
                                    <?php echo $article[0]->article_description;?>
                                </div>
                                <a href="{{URL::to('articles/'.$article_type)}}" class="btn btn-primary">
                                … Read Other Related Interviews….
                                </a>
                                <br><br>
                            </div>
                        </div>

                        <!-- Comment Area Start -->
                        {{-- <div class="comment_area clearfix">
                            <h5 class="title">3 Comments</h5>

                            <ol>
                                <!-- Single Comment Area -->
                                <li class="single_comment_area">
                                    <!-- Comment Content -->
                                    <div class="comment-content d-flex">
                                        <!-- Comment Author -->
                                        <div class="comment-author">
                                            <img src="{{asset('site/img/bg-img/30.jpg')}}" alt="author">
                                        </div>
                                        <!-- Comment Meta -->
                                        <div class="comment-meta">
                                            <a href="#" class="post-author">Christian Williams</a>
                                            <a href="#" class="post-date">April 15, 2018</a>
                                            <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                                        </div>
                                    </div>
                                    <ol class="children">
                                        <li class="single_comment_area">
                                            <!-- Comment Content -->
                                            <div class="comment-content d-flex">
                                                <!-- Comment Author -->
                                                <div class="comment-author">
                                                    <img src="{{asset('site/img/bg-img/31.jpg')}}" alt="author">
                                                </div>
                                                <!-- Comment Meta -->
                                                <div class="comment-meta">
                                                    <a href="#" class="post-author">Sandy Doe</a>
                                                    <a href="#" class="post-date">April 15, 2018</a>
                                                    <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </li>

                                <!-- Single Comment Area -->
                                <li class="single_comment_area">
                                    <!-- Comment Content -->
                                    <div class="comment-content d-flex">
                                        <!-- Comment Author -->
                                        <div class="comment-author">
                                            <img src="{{asset('site/img/bg-img/32.jpg')}}" alt="author">
                                        </div>
                                        <!-- Comment Meta -->
                                        <div class="comment-meta">
                                            <a href="#" class="post-author">Christian Williams</a>
                                            <a href="#" class="post-date">April 15, 2018</a>
                                            <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div> --}}

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
                    <!-- Popular News Widget -->
                    <div class="popular-news-widget mb-30">
                        <h3>4 Most Recent Updates</h3>
                        {{-- @foreach ($latest_articles as $key => $latest)
                            <!-- Single Popular Blog -->
                            <div class="single-popular-post">
                                <a href="{{URL::to('articles/'.$latest['article_type'].'/'.$latest['id'])}}">
                                <h6><span>{{$key + 1}}.</span> {{$latest['article_title']}}</h6>
                                </a> --}}
                                {{-- <p>{{$latest['created_at']->diffforHumans()}}</p> --}}
                            {{-- </div>
                        @endforeach --}}
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
            {{-- @endif --}}
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->
    @endif
@endsection