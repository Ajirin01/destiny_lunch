<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article as Article;
use Validator;
use	Illuminate\Support\Facades\Storage;

class articleController extends Controller
{
    public function getArticles($article_type){
        $Articles = new Article;
        $articles = $Articles::where('article_type',$article_type)->paginate(12);
        return $articles;
    }

    public function getArticleIndex($article_index, $index){
        $article_at_index = $article_index[$index];
        $article_title = strtoupper(preg_replace("/-/"," ",$article_at_index));
        $data = array('type'=>$article_at_index, 'title'=>$article_title);
        return $data;
    }
    
    public function index(Request $request){
        $type = $request->article_type;
        define("filenameA", "article_index.json");
        $json = file_get_contents(filenameA);
        $article_index = json_decode($json);

        //this next step checks if the article index request is valid. if its valid, the system fetches article correcting to the index
        //and if not valid, a not found(404) page is returned to the user
        if(in_array($type, $article_index)){
            for($i = 0; $i< count($article_index); $i++){
                if($type == articleController::getArticleIndex($article_index,$i)['type']){
                    $article_at_index = articleController::getArticleIndex($article_index,$i);
                    $title = articleController::getArticleIndex($article_index,$i)['title'];
                    $articles = articleController::getArticles($type);
                    return view('Admin.Article.article-dashboard',['articles'=> $articles, 'article_type'=> $title]);
                }
            }
        }else{
            return view('site.page404');
        }
    }

    public function create()
    {
        return view('Admin.Article.article-creation-form');
    }

    public function store(Request $request)
    {
        $image_src = preg_replace('/\.$/','', $request->image_src);
        $image_src = preg_replace("/\/dvon_files/","dvon_files", $image_src);
        $image_src = explode(',',$image_src);

        // return response()->json($image_src);
        // exit;

        $Article = new Article;

        $rules = [
            'article_type'=>'required',
            'article_title'=> 'required|min:10|max:20000',
            'article_intro_image'=> 'required',
            'paid'=> 'required',
            'article_intro'=> 'required|min:100|max:20000',
            'article_description'=> 'required|min:200|max:2000000000',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            if($request->hasFile('article_intro_image')){
                $image = $request->file('article_intro_image');
                // $image_extension = $image->getClientOriginalExtension();
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'article_intro_image'.rand(123456789,999999999).'.'.$image_extension;
                $upload_path = public_path('uploads/');
                $image->move($upload_path, $image_name);
                // $path = $request->file('article_intro_image')->storeAs('public/uploads', $image_name );

                $article_type = $request->get('article_type');
                $article_title = $request->get('article_title');
                $article_intro_image = "/dvon_files/public/uploads/".$image_name;
                $article_intro = $request->get('article_intro');
                $article_description = $request->get('article_description');
                $paid = $request->get('paid');
    
                $create_article_article = Article::create([
                    'article_type'=>$article_type,
                    'article_title'=>$article_title,
                    'article_intro_image'=>$article_intro_image,
                    'article_description_images_array'=>json_encode($image_src),
                    'article_intro'=>$article_intro, 
                    'paid'=> $paid,
                    'article_description'=>$article_description]);
    
                if($create_article_article->save()){
                    // $image->move($upload_path, $image_name);
                    return redirect()->back()->with('msg','article was successfully created!');
                }
            }else{
                return redirect()->back()->with('error','ERROR! could not create article!');
            }
        }
    }

    public function edit($id)
    {
        $Article = new Article;
        $article = Article::find($id);
        return view('Admin.Article.edit-article',['article'=> $article]);
    }

    public function update(Request $request, $id)
    {
        $image_src = preg_replace('/\.$/','', $request->image_src);
        $image_src = preg_replace("/\/dvon_files/","dvon_files", $image_src);
        $image_src = explode(',',$image_src);
        
        $Article = new Article;
        $article = Article::find($id);

        $rules = [
            'article_type'=>'required',
            'article_title'=> 'required|min:10|max:100',
            'paid'=> 'required',
            'article_intro'=> 'required|min:100|max:20000',
            'article_description'=> 'required|min:200|max:2000000000',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            if($request->hasFile('article_intro_image')){
                $image = $request->file('article_intro_image');
                // $image_extension = $image->getClientOriginalExtension();
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'article_intro_image'.rand(123456789,999999999).'.'.$image_extension;
                $upload_path = public_path('uploads/');
                $image->move($upload_path, $image_name);
                // $upload_path = public_path('uploads/');
                // $path = $request->file('article_intro_image')->storeAs('public/uploads', $image_name );

                $article_type = $request->get('article_type');
                $article_title = $request->get('article_title');
                $article_intro_image = "/dvon_files/public/uploads/".$image_name;
                $article_intro = $request->get('article_intro');
                $article_description = $request->get('article_description');
                $paid = $request->get('paid');
    
                $update_article_article = $article->update([
                    'article_type'=>$article_type,
                    'article_title'=>$article_title,
                    'article_intro_image'=>$article_intro_image,
                    'article_description_images_array'=>json_encode($image_src),
                    'article_intro'=>$article_intro, 
                    'paid'=> $paid,
                    'article_description'=>$article_description]);
    
                if($update_article_article){
                    return redirect()->back()->with('msg','article was successfully updated!');
                }
            }else{
                $article_type = $request->get('article_type');
                $article_title = $request->get('article_title');
                $article_intro_image = $article->article_intro_image;
                $article_intro = $request->get('article_intro');
                $article_description = $request->get('article_description');
                $paid = $request->get('paid');
    
                $update_article_article = $article->update([
                    'article_type'=>$article_type,
                    'article_title'=>$article_title,
                    'article_intro_image'=>$article_intro_image,
                    'article_intro'=>$article_intro, 
                    'paid'=> $paid,
                    'article_description'=>$article_description]);
                return redirect()->back()->with('msg','Article was updated successfully!');
            }
        }
    }

    public function destroy($id)
    {
        $Article = new Article;
        $article = Article::findOrFail($id);

        $image_src_array = $article->article_description_images_array;

        $image_name = preg_replace("/\/dvon_files/","dvon_files", $article->article_intro_image);

        for($i=0; $i<count(json_decode($image_src_array)); $i++){
            try{
                $path = json_decode($image_src_array)[$i];

                if(file_exists($path)){
                    unlink(json_decode($image_src_array)[$i]);
                }else{
                    ;
                }
                
            }catch(Exception $e){
                ;
            }
            
        }

        unlink($image_name);

        $delete_article = $article->delete();
        if($delete_article){

            return redirect()->back()->with('msg','article was successfully deleted!');
        }else{
            return redirect()->back()->with('error','ERROR! could not delete article!');
        }
    }
}
