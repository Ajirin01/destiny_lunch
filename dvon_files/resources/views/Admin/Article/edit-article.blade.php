@extends('layouts.admin_base')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-9  offset-lg-1">
                <h4 class="page-title text-center text-success">
                    @if(session('msg'))
                    {{session('msg')}}
                    @endif
                </h4>
                <h4 class="page-title text-center text-danger">
                    @if(session('error'))
                    {{session('error')}}
                    @endif
                </h4>
            </div>
            <div class="col-lg-9 offset-lg-1">
                <h4 class="page-title">Edit Article</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 offset-lg-1">
                <form action="{{ url('admin/article/'.$article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Article Section</label>
                        @if(session('errors'))
                        <div class="text text-danger">{{session('errors')->first('article_title')}}*</div>
                        @endif
                        <select name="article_type" class="form-control" id="">
                        <option value="{{$article->article_type}}"><?php echo strtoupper(preg_replace("/-/"," ",$article->article_type));?></option>
                            <?php
                                define("filename", "article_index.json");
                                $json = file_get_contents(filename);
                                $article_index = json_decode($json);
                                function getArticleIndice($article_index, $index){
                                    $article_at_index = $article_index[$index];
                                    $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
                                    $data = array('type'=>$article_at_index, 'title'=>$article_title);
                                    return $data;
                                }
                                for($i = 0; $i< count($article_index); $i++){
                                    echo "
                                    <option id='$i' value='".getArticleIndice($article_index, $i)['type']."'>".getArticleIndice($article_index, $i)['title']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subscription Required?</label>
                        @if(session('errors'))
                        <div class="text text-danger">{{session('errors')->first('article_title')}}*</div>
                        @endif
                        <select name="paid" class="form-control" id="">
                            @if ($article->paid == true)
                                <option value="1">Yes</option>
                            @else
                                <option value="0">No</option>
                            @endif
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Article Title</label>
                        @if(session('errors'))
                        <div class="text text-danger">{{session('errors')->first('article_title')}}*</div>
                        @endif
                        <input class="form-control" type="text" name="article_title" value="{{$article->article_title}}" required>
                    </div>
                    <div class="form-group">
                        <label>Article Intro Image</label>
                        @if(session('errors'))
                        <div class="text text-danger">{{session('errors')->first('article_image')}}*</div>
                        @endif
                        <div>
                            <input class="form-control" type="file" name="article_intro_image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Article Introduction</label>
                        @if(session('errors'))
                        <div class="text text-danger">{{session('errors')->first('article_description')}}*</div>
                        @endif
                        <textarea cols="30" rows="10" class="form-control" id="intro" name="article_intro"><?php echo $article->article_intro ;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Article Description</label>
                        @if(session('errors'))
                        <div class="text text-danger">{{session('errors')->first('article_description')}}*</div>
                        @endif
                        <textarea cols="30" rows="15" class="form-control" id="myTextArea" name="article_description"><?php echo preg_replace("'../../'","../../../",($article->article_description)) ;?></textarea>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Publish Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection