<?php
    function getArticlesIndexG($article_indexG, $index){
        $article_at_indexG = $article_indexG[$index];
        $article_titleG = strtoupper(preg_replace("/-/"," ",$article_at_indexG));
        $dataG = array('type'=>$article_at_indexG, 'title'=>$article_titleG);
        return $dataG;
    }
    define("filenameG", "article_index.json");
	$jsonG = file_get_contents(filenameG);
    $article_indexG = json_decode($jsonG);
        $ArticlesG = new App\Article();
        $random_articles = array();
        $latest_articles = array();
        for($i = 0; $i< count($article_indexG); $i++){
            $article_at_indexG = getArticlesIndexG($article_indexG,$i);
            $articlesG = $ArticlesG::where('article_type', $article_at_indexG['type'])->inRandomOrder()->first();
            $articlesG = json_decode($articlesG, true);
            if($articlesG != null){
                array_push($random_articles,$articlesG);
            }
            
        }
        for($i = 0; $i< count($article_indexG); $i++){
            $article_at_indexG = getArticlesIndexG($article_indexG,$i);
            $articlesG = $ArticlesG::where('article_type', $article_at_indexG['type'])->latest()->first();
            $articlesG = json_decode($articlesG, true);
            if($articlesG != null){
                array_push($latest_articles,$articlesG);
            }
            
        }
?>