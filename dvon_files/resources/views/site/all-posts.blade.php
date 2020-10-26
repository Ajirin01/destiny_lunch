@extends('layouts.blog_base')

@section('content')
<section class="section db p120" style="padding-top: 150px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tagline-message page-title text-center">
                    <h3>Blog & News</h3>
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0)">{{$slug}}</a></li>
                        <li class="active">Blog</li>
                    </ul>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end section -->

<section class="section gb nopadtop">
    <div class="container">
        <div class="boxed boxedp4">
            <div class="row">
                <div class="col-md-8">
                    <div class="row blog-grid">
                        @foreach ($posts as $post)
                        <div class="col-md-6">
                            <div class="course-box">
                                <div class="image-wrap entry">
                                    <img style="height: 300px" src="{{$post->blog_image}}" alt="" class="img-responsive">
                                    <div class="magnifier">
                                         <a href="{{ url('blog/'.preg_replace("/-/","/", $slug).'/'.$post->id) }}" title=""><i class="flaticon-add"></i></a>
                                    </div>
                                </div><!-- end image-wrap -->
                                <div class="course-details">
                                    <h4>
                                    <a href="{{ url('blog/'.preg_replace("/-/","/", $slug).'/'.$post->id) }}" title="">{{$post->blog_title}}</a>
                                    </h4>
                                    <p style="word-break: break-word" id="blog_description"><?php echo substr($post->blog_description,0,100)?>...</p>
                                </div><!-- end details -->
                                <div class="course-footer clearfix">
                                    <div class="pull-left">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fa fa-clock-o"></i>{{$post->created_at->diffforHumans()}}</a></li>
                                        </ul>
                                    </div><!-- end left -->
                                </div><!-- end footer -->
                            </div><!-- end box -->
                        </div><!-- end col -->
                        @endforeach
                        
                    </div><!-- end row -->

                    <hr class="invis">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination">
                                {{$posts->links()}}
                            </ul>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end col -->

                <div class="sidebar col-md-4">
                    <div class="widget clearfix">
                        <h3 class="widget-title">Popular Posts</h3>
                        <div class="post-widget">
                            @foreach ($popular_posts as $popular)
                                <div class="media">
                                    <img width="70" height="70" src="{{$popular->blog_image}}" alt="" class="img-responsive alignleft img-rounded">
                                    <div class="media-body">
                                        <h5 class="mt-0"><a href="{{ url('blog/'.preg_replace("/-/","/", $slug).'/'.$popular->id) }}">{{$popular->blog_title}}</a></h5>
                                        <div class="blog-meta">
                                            <ul class="list-inline">
                                                <li>{{$popular->created_at->diffforHumans()}}</li>
                                            </ul>
                                        </div><!-- end blog-meta -->
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- end post-widget -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end row -->
        </div><!-- end boxed -->
    </div><!-- end container -->
</section>
@endsection