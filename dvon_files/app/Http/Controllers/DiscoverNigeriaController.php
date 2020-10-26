<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\BlogName as Slug;

class DiscoverNigeriaController extends Controller
{
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

        $article_index_discover_nigeria = [
            "regional-updates",
            "tribes-and-culture",
            "agriculture",
            "mineral-resources",
            "tourism",
            "made-in-nigeria-products",
            "invest-in-nigeria",
            "entertainment",
        ];
        
        $Slug = new Slug();
        $Articles = new Article();
        $random_articles_array = array();
        $latest_articles_array = array();

        $links = $Slug::all();

        for($i = 0; $i< count($article_index); $i++){
            $article_at_index = DiscoverNigeriaController::getArticleIndex($article_index,$i);
            $articles = $Articles::where('article_type', $article_at_index['type'])->inRandomOrder()->first();
            $articles = json_decode($articles, true);
            if($articles != null){
                array_push($random_articles_array,$articles);
            }
            
        }
        for($i = 0; $i< count($article_index); $i++){
            $article_at_index = DiscoverNigeriaController::getArticleIndex($article_index,$i);
            $articles = $Articles::where('article_type', $article_at_index['type'])->latest()->first();
            $articles = json_decode($articles, true);
            if($articles != null){
                array_push($latest_articles_array,$articles);
            }
            
        }

            $random_articles_array_discover_nigeria = array();
            $latest_articles_array_discover_nigeria = array();

        $links = $Slug::all();

            for($i = 0; $i< count($article_index_discover_nigeria); $i++){
                $article_at_index_discover_nigeria = DiscoverNigeriaController::getArticleIndex($article_index_discover_nigeria,$i);
                $articles_discover_nigeria = $Articles::where('article_type', $article_at_index_discover_nigeria['type'])->inRandomOrder()->first();
                $articles_discover_nigeria = json_decode($articles_discover_nigeria, true);
                if($articles_discover_nigeria != null){
                    array_push($random_articles_array_discover_nigeria,$articles_discover_nigeria);
            }
            
        }
        for($i = 0; $i< count($article_index_discover_nigeria); $i++){
            $article_at_index_discover_nigeria = DiscoverNigeriaController::getArticleIndex($article_index_discover_nigeria,$i);
            $articles_discover_nigeria = $Articles::where('article_type', $article_at_index_discover_nigeria['type'])->latest()->first();
            $articles_discover_nigeria = json_decode($articles_discover_nigeria, true);
            if($articles_discover_nigeria != null){
                array_push($latest_articles_array_discover_nigeria,$articles_discover_nigeria);
            }
            
        }
        
        return view('site.discover-nigeria',['random_articles'=> $random_articles_array, 'latest_articles'=> $latest_articles_array,
                    'random_articles_discover_nigeria'=> $random_articles_array_discover_nigeria, 'latest_articles_discover_nigeria'=> $latest_articles_array_discover_nigeria]);
    }
}
