<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country as Country;
use App\Article as Article;

class ArticlesController extends Controller
{
    public function getArticles($article_type){
        $Articles = new Article;
        $articles = $Articles::where('article_type',$article_type)->paginate(12);
        return $articles;
    }

    public function getArticleIndex($article_index, $index){
        $article_at_index = $article_index[$index];
        $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
        $data = array('type'=>$article_at_index, 'title'=>$article_title);
        return $data;
    }
    
    public function index($type){
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

        //this next step checks if the article index request is valid. if its valid, the system fetches article correcting to the index
        //and if not valid, a not found(404) page is returned to the user
        if(in_array($type, $article_index)){
            for($i = 0; $i< count($article_index); $i++){
                if($type == ArticlesController::getArticleIndex($article_index,$i)['type']){
                    $article_at_index = ArticlesController::getArticleIndex($article_index,$i);
                    $title = ArticlesController::getArticleIndex($article_index,$i)['title'];
                    $articles = ArticlesController::getArticles($type);
                    return view('site.articles-index',['title'=> $title, 'articles'=> $articles, 'error'=> false, 'upper'=> true, 'lower'=> true]);
                }
            }
        }else{
            return view('site.page404');
        }
    }

    public function details($type, $article){
        function getArticles($model){
            return $model;
        }

        if($type == "nigerians-at-home-achievers"){
            $data = getArticles("App\Country");
            return view('site.article-details',['data'=>$data, 'title'=> 'Know About Nigeria article 1', 'error'=>false, 'upper'=>false, 'lower'=>true]);
        }elseif($type == "nigerians-in-diaspora-achievers"){
            return view('site.article-details-akeem',['title'=> 'Invest in Nigeria article 1', 'error'=>false, 'upper'=>true, 'lower'=>true]);
        }else{
            $error = "Ops! Article does not exist";
            return view('site.article-details',['title'=> $error, 'error'=>true, 'upper'=>false, 'lower'=>false]);
        }
    }

}
