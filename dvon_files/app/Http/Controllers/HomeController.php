<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getArticleIndex($article_index, $index){
        $article_at_index = $article_index[$index];
        $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
        $data = array('type'=>$article_at_index, 'title'=>$article_title);
        return $data;
    }

    public function index()
    {
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
        $Articles = new Article();
        $random_articles_array = array();
        $latest_articles_array = array();
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
