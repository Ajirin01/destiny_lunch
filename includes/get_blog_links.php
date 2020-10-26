<?php 
    use App\BlogName as Slug;

    function get_blog_links(){
        $Slug = new Slug;
        $links = $Slug::all();
        return $links;
    }
?>