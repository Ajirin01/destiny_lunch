<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog as Blog;
use App\BlogName as Slug;
use Validator;
use	Illuminate\Support\Facades\Storage;

class blogPostController extends Controller
{
    public function index()
    {
        $Blog = new Blog;
        $all_posts = Blog::paginate(9);
        return view('Admin.Blog.blog-dashboard',['posts'=>$all_posts]);
    }

    public function create()
    {
        return view('Admin.Blog.blog-creation-form');
    }

    public function store(Request $request)
    {
        $Blog = new Blog;

        $rules = [
            'blog_owner_id' => 'required',
            'blog_slug' => 'required',
            'blog_title' => 'required|min:3|max:100',
            'blog_image' => 'required',
            'blog_description' => 'required|min:100|max:3000'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            if($request->hasFile('blog_image')){
                $image = $request->file('blog_image');
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'blog_image'.rand(123456789,999999999).'.'.$image_extension;
                $upload_path = public_path('uploads/');
                $image->move($upload_path, $image_name);
                // $path = $request->file('Post_intro_image')->storeAs('public/uploads', $image_name );

                $blog_owner_id = $request->get('blog_owner_id');
                $blog_slug = $request->get('blog_slug');
                $blog_title = $request->get('blog_title');
                $blog_image = "/dvon_files/public/uploads/".$image_name;
                $blog_description = $request->get('blog_description');

                $single_slug_to_create_post = Slug::where('blog_owner_id', $blog_owner_id)->where('blog_name', $blog_slug)->first();
                
                $create_Post_Post = $single_slug_to_create_post->blogs()->create([
                    'blog_owner_id'=>$blog_owner_id,
                    'blog_slug'=>$blog_slug,
                    'blog_image'=>$blog_image,
                    'blog_title'=>$blog_title, 
                    'blog_description'=>$blog_description]);
    
                if($create_Post_Post->save()){
                    // $image->move($upload_path, $image_name);
                    return redirect()->back()->with('msg','Post was successfully created!');
                }
            }else{
                return redirect()->back()->with('error','ERROR! could not create Post!');
            }
        }

        
    }

    public function edit($id)
    {
        $Blog = new Blog;
        $blog = Blog::find($id);
        return view('Admin.Blog.edit-blog',['post'=> $blog]);
    }

    public function update(Request $request, $id)
    {
        $Blog = new Blog;
        $blog = Blog::find($id);

        $rules = [
            'blog_owner_id' => 'required',
            'blog_slug' => 'required',
            'blog_title' => 'required|min:3|max:100',
            'blog_description' => 'required|min:100|max:3000'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            if($request->hasFile('blog_image')){
                $image = $request->file('blog_image');
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'blog_image'.rand(123456789,999999999).'.'.$image_extension;
                $upload_path = public_path('uploads/');
                $image->move($upload_path, $image_name);
                // $path = $request->file('Post_intro_image')->storeAs('public/uploads', $image_name );

                $blog_owner_id = $request->get('blog_owner_id');
                $blog_slug = $request->get('blog_slug');
                $blog_title = $request->get('blog_title');
                $blog_image = "/dvon_files/public/uploads/".$image_name;
                $blog_description = $request->get('blog_description');
    
                $update_blog_post = $blog->update(['blog_owner_id'=>$blog_owner_id,
                'blog_slug'=>$blog_slug,
                'blog_image'=>$blog_image,
                'blog_title'=>$blog_title, 
                'blog_description'=>$blog_description]);
    
                if($update_blog_post){
                    return redirect()->back()->with('msg','post was successfully updated!');
                }
            }else{
                $blog_owner_id = $request->get('blog_owner_id');
                $blog_slug = $request->get('blog_slug');
                $blog_title = $request->get('blog_title');
                $blog_image = $blog->blog_image;
                $blog_description = $request->get('blog_description');
    
                $update_blog_post = $blog->update(['blog_owner_id'=>$blog_owner_id,
                'blog_slug'=>$blog_slug,
                'blog_image'=>$blog_image,
                'blog_title'=>$blog_title, 
                'blog_description'=>$blog_description]);
                return redirect()->back()->with('msg','post was successfully updated!');
            }
        }

        
    }

    public function destroy($id)
    {
        $Blog = new Blog;
        $blog = Blog::findOrFail($id);
        $image_name = preg_replace("/\/dvon_files/","dvon_files", $blog->blog_image);
        unlink($image_name);
        $delete_blog = $blog->delete();

        if($delete_blog){
            // Storage::delete($blog->blog_image);
            return redirect()->back()->with('msg','post was successfully deleted!');
        }else{
            return redirect()->back()->with('error','ERROR! could not delete post!');
        }
    }

}
