<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExternalLinks as ExternalLinks;
use Validator;

class linksController extends Controller
{
    public function index()
    {
        $ExternalLinks = new ExternalLinks;
        $all_Links = ExternalLinks::paginate(10);
        return view('Admin.Links.ExternalLinks-dashboard', ['links' => $all_Links]);
    }
    public function create()
    {
        return view('Admin.Links.ExternalLinks-creation-form');
    }

    public function store(Request $request)
    {
        $links = (['Link_name' => $request->links_name, 'Link_url' => $request->links_url, 'link_intro_description' => $request->link_intro_description]);
        $ExternalLinks = new ExternalLinks;
        $size_Links = count($links['Link_name']);
        $loop_times = $size_Links;
        if($links['Link_name'] == [null] || $links['Link_url'] == [null]){
            return redirect()->back()->with('errors','Error! Please fill up all fields');
        }else{
            $created = false;
            if($request->hasFile('link_background')){
                for($i=0; $i < $loop_times; $i++){
                    $image= $request->file('link_background');
                    // $image_extension = $image->getClientOriginalExtension();
                    $image_extension = $image[$i]->getClientOriginalExtension();
                    $image_name[$i] = 'article_intro_image'.rand(123456789,999999999).'.'.$image_extension[$i];
                    $upload_path = public_path('uploads/');
                    $image[$i]->move($upload_path, $image_name[$i]);
                    $link_intro_background = "/dvon_files/public/uploads/".$image_name[$i];
                    $Link_name = $links['Link_name'][$i];
                    $Link_url = $links['Link_url'][$i];
                    $link_description = $links['link_intro_description'][$i];
                    
                    if($Link_name == null || $Link_url == null){
                        if($i == 0){
                            $error = "ExternalLinks ".($i+1)." could not be successfully added to record because ExternalLinks name or ExternalLinks code can not be empty!";    
                        }else{
                            $error = "ExternalLinks ".($i+1)." could not be successfully added to record because ExternalLinks name or ExternalLinks code can not be empty! NB: OTHERS MAY HAVE BEEN CREATED SUCCESSFULLY";                       
                        }
                        return redirect()->back()->with('errors',$error);
                    }else{
                        $ExternalLinks = ExternalLinks::where('Link_url',$Link_url)->first();
                        if($ExternalLinks != null){
                            $error = 'ExternalLinks "'.$Link_name.'" could not be successfully added to record because ExternalLinks code "'.$Link_url.'" already exists!';
                            return redirect()->back()->with('errors',$error);
                        }else{
                            $create_Links = ExternalLinks::create(['link_name'=> $Link_name,
                            'link_url' => $Link_url,
                            'link_intro_background' => $link_intro_background,
                            'link_intro_description' => $link_description
                            ]);
                            if($create_Links->save()){
                                $created = true;
                            }else{
                                $created = false;
                            }
                        }
                    }
                }
                if($created){
                    return redirect()->back()->with('msg','ExternalLinks(s) was successfully created!');
                }else{
                    return redirect()->back()->with('msg','ExternalLinks(s) could not be successfully created!');
                }
            }
        }
    }

    public function edit($id)
    {
        $ExternalLinks = new ExternalLinks;
        $ExternalLinks = ExternalLinks::findOrFail($id);
        return view('Admin.Links.edit-ExternalLink', ['ExternalLink'=> $ExternalLinks]);
    }

    public function update(Request $request, $id)
    {
        $ExternalLinks = new ExternalLinks;
        $ExternalLinks = ExternalLinks::findOrFail($id);
        $rules = [
            'link_name' => 'required|min:5|max:50',
            'link_url' => 'required|max:50',
        ];
        $validator = Validator::make($request->all(),$rules);

        $Link_name = $request->link_name;
        $Link_url = $request->link_url;
        $link_intro_description = $request->link_intro_description;

        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            if($request->hasFile('link_background')){
                $image= $request->file('link_background');
                // $image_extension = $image->getClientOriginalExtension();
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'article_intro_image'.rand(123456789,999999999).'.'.$image_extension;
                $upload_path = public_path('uploads/');
                $image->move($upload_path, $image_name);
                $link_intro_background = "/dvon_files/public/uploads/".$image_name;
                
                $update_link = $ExternalLinks->update(['link_name'=> $Link_name,
                                                        'link_url' => $Link_url,
                                                        'link_intro_background' => $link_intro_background,
                                                        'link_intro_description' => $link_intro_description
                                                        ]);
                if($update_link){
                    return redirect()->back()->with('msg','Link was successfully Updated!');
                }else{
                    return redirect()->back()->with('error','ERROR! could not update Link!');
                }
            }else{
                $link_intro_background = $ExternalLinks->link_intro_background;
                $update_link = $ExternalLinks->update(['link_name'=> $Link_name,
                                                        'link_url' => $Link_url,
                                                        'link_intro_background' => $link_intro_background,
                                                        'link_intro_description' => $link_intro_description
                                                        ]);
                if($update_link){
                    return redirect()->back()->with('msg','Link was successfully Updated without Change in Background!');
                }else{
                    return redirect()->back()->with('error','ERROR! could not update Link!');
                }
            }
        }
    }

    public function destroy($id)
    {
        $ExternalLinks = new ExternalLinks;
        $ExternalLinks = ExternalLinks::findOrFail($id);
        $delete_Links= $ExternalLinks->delete();
        if($delete_Links){
            return redirect()->back()->with('msg','ExternalLinks was successfully deleted!');
        }else{
            return redirect()->back()->with('error','ERROR! could not delete ExternalLinks!');
        }
    }
}
