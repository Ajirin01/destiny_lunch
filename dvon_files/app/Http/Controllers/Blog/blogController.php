<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog as Blog;
use App\BlogName as Slug;
use Validator;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
    public function blog_index(Request $request, $user_name, $blog_name){
        echo "Blog index"."<br>";
        echo "The username is: ".$user_name."<br>";
        echo "The blog name is: ".$blog_name."<br>";
    }

    public function blog_detail($id){
        echo "The user ID is: ".$id."<br>";
    }

    public function create_blog_form(){
        return view('site.blog-creation-form');
    }

    public function create_blog(Request $request){
        $Slug = new Slug;

        $rules = [
            'blog_name'=>'required|min:3|max:100',
            'blog_logo'=> 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            if($request->hasFile('blog_logo')){
                $image = $request->file('blog_logo');
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'blog_logo'.rand(123456789,999999999).'.'.$image_extension;
                $upload_path = public_path('uploads/');
                $image->move($upload_path, $image_name);
                // $path = $request->file('blog_logo')->storeAs('public/uploads', $image_name );

                $blog_name = $request->get('blog_name');
                $blog_logo = "/dvon_files/public/uploads/".$image_name;
                $user_id = Auth::user()->id;

                $get_blog_name = Slug::where('blog_owner_id', $user_id)->where('blog_name', $blog_name)->get();

                if(count($get_blog_name)>0){
                    return redirect()->back()->with('error','ERROR! Blog Name already exists. Please Choose another name and try again later');
                }else{
                    $create_blog_name = Slug::create([
                        'blog_owner_id'=>$user_id,
                        'blog_name'=>$blog_name,
                        'blog_logo'=>$blog_logo,]);
        
                    if($create_blog_name->save()){
                        // $image->move($upload_path, $image_name);
                        return redirect()->back()->with('msg','Blog Name was successfully created!');
                    }
                }
            }else{
                return redirect()->back()->with('error','ERROR! could not create Blog Name!');
            }
        }
    }
}
