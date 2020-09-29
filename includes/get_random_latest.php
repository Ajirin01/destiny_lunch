<?php
    function getArticlesIndex($article_index, $index){
        $article_at_index = $article_index[$index];
        $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
        $data = array('type'=>$article_at_index, 'title'=>$article_title);
        return $data;
    }
    define("filename", "article_index.json");
	$json = file_get_contents(filename);
    $article_index = json_decode($json);
        $Articles = new App\Article();
        $random_articles = array();
        $latest_articles = array();
        for($i = 0; $i< count($article_index); $i++){
            $article_at_index = getArticlesIndex($article_index,$i);
            $articles = $Articles::where('article_type', $article_at_index['type'])->inRandomOrder()->first();
            $articles = json_decode($articles, true);
            if($articles != null){
                array_push($random_articles,$articles);
            }
            
        }
        for($i = 0; $i< count($article_index); $i++){
            $article_at_index = getArticlesIndex($article_index,$i);
            $articles = $Articles::where('article_type', $article_at_index['type'])->latest()->first();
            $articles = json_decode($articles, true);
            if($articles != null){
                array_push($latest_articles,$articles);
            }
            
        }
?>