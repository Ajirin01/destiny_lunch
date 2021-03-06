<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="icon" href="{{asset('site/img/core-img/destiny-logo.png')}}">
    <title>Destiny &amp; Voice of Nigeria</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
    <!--[if lt IE 9]>
		<script src="{{ asset('admin/assets/js/html5shiv.min.js') }}"></script>
		<script src="{{ asset('admin/assets/js/respond.min.js') }}"></script>
    <![endif]-->
    
</head>

<body>
    
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="{{ url('admin/dashoard') }}" class="logo">
					<img style="width: 220px; height: 40px" src="{{asset('site/img/core-img/destiny-logo.png')}}" width="35" height="35" alt="">
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="{{ asset('admin/assets/img/user.jpg') }}" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
						<span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>
						{{-- <a class="dropdown-item" href="{{ url('admin/profile/'.Auth::user()->id.'/edit ') }}">Edit Profile</a> --}}
						<a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                        </form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ url('admin/profile/Auth::user->id/edit ') }}">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        @can('isAdmin')
                            <li class="active">
                                <a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('country.index') }}"><i class="fa fa-group"></i> <span>Countries</span></a>
                            </li> --}}
                            <li>
                                <a href="{{ route('external-links.index') }}"><i class="fa fa-group"></i> <span>External links</span></a>
                            </li>
                            
                            <li class="submenu">
                                <a href="#"><i class="fa fa-commenting-o"></i> <span> Newsletter</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{ url('admin/newsletters') }}">Newsletter Subscribers</a></li>
                                    <li><a href="{{ url('admin/newsletters/send-newsletters/form') }}">Send Newsletter</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}"><i class="fa fa-group"></i> <span>Users</span></a>
                            </li>
                            <li>
                                <a href="{{ route('adverts.index') }}"><i class="fa fa-book"></i> <span>adverts</span></a>
                            </li>
                            
                            <li>
                                
                            <li class="submenu">
                                <a href="#"><i class="fa fa-commenting-o"></i> <span> Articles</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{ route('article.create') }}">Add Article</a></li>
                                    <li class="submenu">
                                        <a href="#"><i class="fa fa-commenting-o"></i> <span> Articles List </span> <span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <?php
                                                define("filenameB", "article_index.json");
                                                $json = file_get_contents(filenameB);
                                                $article_index = json_decode($json);
                                                function getArticleIndex($article_index, $index){
                                                    $article_at_index = $article_index[$index];
                                                    $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
                                                    $data = array('type'=>$article_at_index, 'title'=>$article_title);
                                                    return $data;
                                                }
                                                for($i = 0; $i< count($article_index); $i++){
                                                    echo "
                                                    <li onclick=' this.children[0].submit();'>
                                                        <form action='".route('article.index')."' method='GET'>
                                                            <input type='hidden' name='article_type' value='".getArticleIndex($article_index, $i)['type']."'>
                                                        </form>
                                                        <a href='".getArticleIndex($article_index, $i)['type']."' onclick=' event.preventDefault();'>
                                                            ".getArticleIndex($article_index, $i)['title']."
                                                        </a>
                                                    </li>
                                                    ";
                                                }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @can('isAuthor')
                            <li>
                                <a href="{{ route('blog-post.index') }}"><i class="fa fa-group"></i> <span>Blog Posts</span></a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add links</h4>
                        <h4 class="page-title text-center text-success">
                            @if(session('msg'))
                            {{session('msg')}}
                            @endif
                        </h4>
                        <h4 class="page-title text-center text-danger">
                            @if(session('errors'))
                            {{session('errors')}} <br>
                            {{-- {{session('errors')->first('links_code[]')}} --}}
                            @endif
                        </h4>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action="{{ url('admin/external-links/'.$ExternalLink->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div id="form">
                                <div class="form-group">
                                    <label>Link Name</label>
                                    <input class="form-control" type="text" name="link_name" value="{{$ExternalLink->link_name}}">
                                </div>
                                    <div class="form-group">
                                    <label>Link URL</label>
                                    <input class="form-control" type="text" name="link_url" value="{{$ExternalLink->link_url}}">
                                </div>
                                <div class="form-group">
                                    <label>Link Intro Background</label>
                                <input class="form-control" type="file" name="link_intro_background" value="{{$ExternalLink->link_intro_background}}">
                                </div>
                                <div class="form-group">
                                    <label>Link Intro Description</label>
                                    <textarea cols="30" rows="15" class="form-control"  name="link_intro_description">
                                        @php
                                            echo $ExternalLink->link_intro_description
                                        @endphp
                                    </textarea>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="sidebar-overlay" data-reff=""></div>
    </div>
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin/assets/js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery-ui.min.html') }}"></script>
    <script src="{{ asset('admin/assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.fullcalendar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/js/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
                selector: "textarea",
                plugins: 'textcolor colorpicker textpattern preview link wordcount lists',
                toolbar1:'insertfole undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
                toolbar2:'preview link | forecolor backcolor fontselect',
            });
        
    </script>
    
</body>





