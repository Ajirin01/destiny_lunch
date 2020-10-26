<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog as Blog;
use App\User as User;
use App\BlogName as Slug;
use Illuminate\Support\Facades\Auth;

class postsController extends Controller
{
    public function allPosts(Request $request, $user_name, $blog_name){
        $blog_owner = User::where('name', $user_name)->first();
        $blog_owner_id = $blog_owner->id;

        $blog_slug = Slug::where('blog_name',$blog_name)->first();

        $all_posts = Blog::where('blog_owner_id', $blog_owner_id)->where('blog_slug', $blog_name)->paginate(4);
        if($all_posts->count() >= 3){
            $popular_posts = Blog::all()->random(3);
        }else {
            $popular_posts = Blog::paginate(3);
        }
        $slug = $user_name."-".$blog_name;
        return view('site.all-posts',['posts'=>$all_posts, 'popular_posts'=>$popular_posts, 'slug'=>$slug, 'logo'=>$blog_slug->blog_logo, 'blog_owner'=> $blog_owner]);
    }

    public function onePost(Request $request, $user_name, $blog_name, $id){
        $Blog = new Blog;
        $post = Blog::findOrFail($id);
        $all_posts = Blog::all();

        $blog_owner = User::where('name', $user_name)->first();
        $blog_owner_id = $blog_owner->id;
        $blog_slug = Slug::where('blog_name',$blog_name)->first();
        $slug = $user_name."-".$blog_name; 

        if($all_posts->count() >= 3){
            $popular_posts = Blog::all()->random(3);
        }else {
            $popular_posts = Blog::paginate(3);
        }
        $comments = $post->comments()->get();
        $number_of_comments = $comments->count();

        return view('site.one-post',['post'=>$post, 'popular_posts' => $popular_posts, 'comments'=>$comments,
                    'number_of_comment'=> $number_of_comments, 'slug' => $slug, 'logo' => $blog_slug->blog_logo, 'blog_owner'=> $blog_owner]);
    }

    public function sendOnePostComment(Request $request, $user_name, $blog_name, $id){
        $comment = $request->get('comment');
        $username = $request->get('username');
        $Blog = new Blog;
        $single_blog = Blog::findOrFail($id);
        $single_blog->comments()->create(['username'=>$username, 'user_id'=> Auth::user()->id, 'comment'=>$comment, 'status' => 'active']);
        return back();
    }
}
