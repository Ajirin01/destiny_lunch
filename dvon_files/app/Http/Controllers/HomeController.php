<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\BlogName as Slug;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getArticleIndex($article_index, $index){
        $article_at_index = $article_index[$index];
        $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
        $data = array('type'=>$article_at_index, 'title'=>$article_title);
        return $data;
    }

    public function index()
    {
        define("filenameH", "article_index.json");
        $json = file_get_contents(filenameH);
        $article_index = json_decode($json);
        
        $Slug = new Slug();
        $Articles = new Article();
        $random_articles_array = array();
        $latest_articles_array = array();

        $links = $Slug::all();

        for($i = 0; $i< count($article_index); $i++){
            $article_at_index = HomeController::getArticleIndex($article_index,$i);
            $articles = $Articles::where('article_type', $article_at_index['type'])->inRandomOrder()->first();
            $articles = json_decode($articles, true);
            if($articles != null){
                array_push($random_articles_array,$articles);
            }
            
        }
        for($i = 0; $i< count($article_index); $i++){
            $article_at_index = HomeController::getArticleIndex($article_index,$i);
            $articles = $Articles::where('article_type', $article_at_index['type'])->latest()->first();
            $articles = json_decode($articles, true);
            if($articles != null){
                array_push($latest_articles_array,$articles);
            }
            
        }
        
        return view('site.home',['random_articles'=> $random_articles_array, 'latest_articles'=> $latest_articles_array]);
    }
}
