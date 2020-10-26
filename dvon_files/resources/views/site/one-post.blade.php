@extends('layouts.blog_base')

@section('content')
<section class="section db p120">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tagline-message page-title text-center">
                    <h3>Blog & News</h3>
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0)">IsaacOlabisiEdu</a></li>
                        <li class="active">Blog</li>
                    </ul>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end section -->

<section class="section gb nopadtop">
    <div class="container">
        <div class="boxed">
            <div class="row">
                <div class="col-md-8">
                    <div class="content blog-list">
                        <div class="blog-wrapper clearfix">
                            <div class="blog-meta">
                                <h3>{{$post->blog_title}}</h3>
                                <ul class="list-inline">
                                    <li>{{$post->created_at->diffforHumans()}}</li>
                                </ul>
                            </div><!-- end blog-meta -->

                            <div class="blog-media">
                                <img src="{{$post->blog_image}}" alt="" class="img-responsive img-rounded">
                            </div><!-- end media -->

                            <div class="blog-desc-big" style="word-wrap: break-word">

                                <p><?php echo $post->blog_description ?></p>

                                <hr class="invis">

                            </div><!-- end desc -->
                        </div><!-- end blog -->
                    </div><!-- end content -->

                    <div class="content boxed-comment clearfix">
                        @if ($number_of_comment == 0)
                        <h3 class="small-title">No comments yet, be the first to comment</h3>
                        @else
                            @if ($number_of_comment == 1)
                            <h3 class="small-title">{{$number_of_comment}} Comment</h3>
                            @else
                            <h3 class="small-title">{{$number_of_comment}} Comments</h3>
                            @endif
                        @endif
                        <div class="comments-list">
                            @if ($comments)
                                @foreach ($comments as $comment)
                                <div class="media">
                                    <p class="pull-right"><small>{{$comment->created_at->diffforHumans()}}</small></p>
                                    <a class="media-left" href="#">
                                        <div style="width: 70px;
                                        height:70px;
                                        border-radius:50%;
                                        display:flex;
                                        justify-content:center;
                                        align-items: center;
                                        background-color: gray
                                        ">
                                           <span style="font-size: 3rem" class="fa fa-user-o"></span>
                                        </div>
                                        
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading user_name">{{$comment->username}}</h4>
                                        <p>{{$comment->comment}}</p>
                                    </div>
                            </div>
                                @endforeach
                            
                            @endif
                        </div>
                    </div><!-- end content -->

                    <div class="content boxed-comment clearfix">
                        <h3 class="small-title">Leave a Comment</h3>
                    <form class="big-contact-form" action="{{ url('blog/'.preg_replace("/-/","/", $slug).'/'.$post->id.'/comment ')}}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            @if (Auth::check())
                            <input type="hidden" name="username" value="{{Auth::user()->name}}">
                            @else
                            <input type="hidden" name="username" value="">
                            @endif
                            
                            <textarea placeholder="Your message" class="form-control" name="comment"></textarea>
                            <button class="btn btn-primary" type="submit">SEND COMMENT</button>
                        </div>
                        </form>
                    </div><!-- end content -->

                </div><!-- end col -->

                <div class="sidebar col-md-4">
                    <div class="widget clearfix">
                        <h3 class="widget-title">Popular Posts</h3>
                        <div class="post-widget">
                            @foreach ($popular_posts as $popular)
                                <div class="media">
                                    <img width="70" height="70" src="{{$popular->blog_image}}" alt="" class="img-responsive alignleft img-rounded">
                                    <div class="media-body">
                                        <h5 class="mt-0"><a href="{{ url('blog/post/'.$popular->id) }}">{{$popular->blog_title}}</a></h5>
                                        <div class="blog-meta">
                                            <ul class="list-inline">
                                                <li>{{$popular->created_at->diffforHumans()}}</li>
                                            </ul>
                                        </div><!-- end blog-meta -->
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div><!-- end post-widget -->
                        <div class="widget clearfix">
                            <h3 class="widget-title">Popular Tags</h3>
                            <div class="tags-widget">   
                                <ul class="list-inline">
                                    {{-- @foreach ($tags as $tag)
                                    <li><a href="#">{{$tag}}</a></li>
                                    @endforeach --}}
                                </ul>
                            </div><!-- end list-widget -->
                        </div><!-- end widget -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end row -->
        </div><!-- end boxed -->
    </div><!-- end container -->
</section>
@endsection