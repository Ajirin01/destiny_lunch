<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country as Country;
use App\Article as Article;
use App\ArticleComment as ArticleComment;
use Illuminate\Support\Facades\Auth; 
use Session;

class ArticlesController extends Controller
{
    public function getArticles($article_type){
        $Articles = new Article;
        $articles = $Articles::where('article_type',$article_type)->paginate(12);
        return $articles;
    }

    public function getSingleArticle($article_type, $id){
        $Articles = new Article;
        $article = $Articles::where('id',$id)
                            ->where('article_type',$article_type)->get();
        return $article;
    }

    public function getArticleIndex($article_index, $index){
        $article_at_index = $article_index[$index];
        $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
        $data = array('type'=>$article_at_index, 'title'=>$article_title);
        return $data;
    }
    
    public function index($type){
        define("filenameA", "article_index.json");
        $json = file_get_contents(filenameA);
        $article_index = json_decode($json);

        //this next step checks if the article index request is valid. if its valid, the system fetches article correcting to the index
        //and if not valid, a not found(404) page is returned to the user
        if(in_array($type, $article_index)){
            for($i = 0; $i< count($article_index); $i++){
                if($type == ArticlesController::getArticleIndex($article_index,$i)['type']){
                    $article_at_index = ArticlesController::getArticleIndex($article_index,$i);
                    $title = ArticlesController::getArticleIndex($article_index,$i)['title'];
                    $articles = ArticlesController::getArticles($type);
                    return view('site.articles-index',['title'=> $title, 'articles'=> $articles,'article_type'=> $type]);
                }
            }
        }else{
            return view('site.page404');
        }
    }

    public function details($type, $article){
        define("filenameA", "article_index.json");
        $json = file_get_contents(filenameA);
        $article_index = json_decode($json);

        //this next step checks if the article index request is valid. if its valid, the system fetches article correcting to the index
        //and if not valid, a not found(404) page is returned to the user
        if(in_array($type, $article_index)){
            for($i = 0; $i< count($article_index); $i++){
                if($type == ArticlesController::getArticleIndex($article_index,$i)['type']){
                    $article_at_index = ArticlesController::getArticleIndex($article_index,$i);
                    $title = ArticlesController::getArticleIndex($article_index,$i)['title'];
                    $articles = ArticlesController::getSingleArticle($type,$article);
                    return view('site.article-details',['title'=> $title, 'article'=> $articles, 'article_type'=> $type]);
                }
            }
        }else{
            return view('site.page404');
        }
    }

    public function postComment(Request $request, $type, $article){
        $comment = $request->comment;
        $Article = new Article;

        $article = $Article::find($article);
        $comment = new ArticleComment(['user_id'=> Auth::user()->id,'comment'=> $comment, 'status'=>'active']);
        
        $article->comments()->save($comment);
        Session::put('comment','');
        return redirect()->back()->with('msg','Comment posted!');
    }

}
