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
                <h4 class="page-title">Add Article</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 offset-lg-1">
            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Article Section</label>
                    @if(session('errors'))
                    <div class="text text-danger">{{session('errors')->first('article_title')}}*</div>
                    @endif
                    <select name="article_type" class="form-control" id="">
                        <option value="">Please select the article type to create</option>
                        <?php
                            $article_index = [
                            'nigerians-at-home-achievers',
                            'nigerians-in-diaspora-achievers',
                            'notable-profiles',
                            'regional-updates',
                            'disapora-updates',
                            'global-updates',
                            'tribes-and-culture',
                            'agriculture',
                            'mineral-resources',
                            'tourism',
                            'technology-tips',
                            'business-supports',
                            'industrial-development',
                            'made-in-nigeria-products',
                            'exclusive-services',
                            'promotions',
                            'invest-in-nigeria',
                            'not-for-profits',
                            'humanitarian',
                            'destiny-nigeria-development-projects-initiatives',
                        ];
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
                    <label>Article Title</label>
                    @if(session('errors'))
                    <div class="text text-danger">{{session('errors')->first('article_title')}}*</div>
                    @endif
                    <input class="form-control" type="text" name="article_title" required>
                </div>
                <div class="form-group">
                    <label>Article Intro Image</label>
                    @if(session('errors'))
                    <div class="text text-danger">{{session('errors')->first('article_image')}}*</div>
                    @endif
                    <div>
                        <input class="form-control" type="file" name="article_intro_image" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Article Introduction</label>
                    @if(session('errors'))
                    <div class="text text-danger">{{session('errors')->first('article_description')}}*</div>
                    @endif
                    <textarea cols="30" rows="10" class="form-control" id="intro" name="article_intro"></textarea>
                </div>
                <div class="form-group">
                    <label>Article Description</label>
                    @if(session('errors'))
                    <div class="text text-danger">{{session('errors')->first('article_description')}}*</div>
                    @endif
                    <textarea cols="30" rows="15" class="form-control" id="myTextArea" name="article_description"></textarea>
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