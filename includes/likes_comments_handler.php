<?php
    function getLikesH($article_id){
        $likes = App\Like::where('article_id',$article_id)->get();
        return count($likes);
    }

    function getCommentsH($article_id){
        $comments = App\ArticleComment::where('article_id',$article_id)->get();
        return count($comments);
    }

    function getLikeUserH($article_id, $user_id){
        $likes = App\Like::where('user_id',$user_id)->where('article_id',$article_id)->get();
        return count($likes);
    }

    function getCommentUserH($article_id, $user_id){
        $likes = App\ArticleComment::where('user_id',$user_id)->where('article_id',$article_id)->get();
        return count($likes);
    }

?>