<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExternalLinks as ExternalLinks;
use Validator;

class linksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ExternalLinks = new ExternalLinks;
        $all_Links = ExternalLinks::paginate(10);
        return view('Admin.links.ExternalLinks-dashboard', ['links' => $all_Links]);
    }
    public function create()
    {
        return view('Admin.links.ExternalLinks-creation-form');
    }

    public function store(Request $request)
    {
        $links = (['Links_name' => $request->Links_name, 'Links_url' => $request->Links_code]);
        $ExternalLinks = new ExternalLinks;
        $size_Links = count($links['Links_name']);
        $loop_times = $size_Links;
        if($links['Links_name'] == [null] || $links['Links_code'] == [null]){
            return redirect()->back()->with('errors','Error! Please fill up all fields');
        }else{
            $created = false;
            for($i=0; $i < $loop_times; $i++){
                $Links_name = $links['Links_name'][$i];
                $Links_code = $links['Links_code'][$i];
                if($Links_name == null || $Links_code == null){
                    if($i == 0){
                        $error = "ExternalLinks ".($i+1)." could not be successfully added to record because ExternalLinks name or ExternalLinks code can not be empty!";    
                    }else{
                        $error = "ExternalLinks ".($i+1)." could not be successfully added to record because ExternalLinks name or ExternalLinks code can not be empty! NB: OTHERS MAY HAVE BEEN CREATED SUCCESSFULLY";                       
                    }
                    return redirect()->back()->with('errors',$error);
                }else{
                    $ExternalLinks = ExternalLinks::where('Links_code',$Links_code)->first();
                    if($ExternalLinks != null){
                        $error = 'ExternalLinks "'.$Links_name.'" could not be successfully added to record because ExternalLinks code "'.$Links_code.'" already exists!';
                        return redirect()->back()->with('errors',$error);
                    }else{
                        $create_Links = ExternalLinks::create(['Links_name'=> $Links_name,
                        'Links_code' => $Links_code]);
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

    public function edit($id)
    {
        $ExternalLinks = new ExternalLinks;
        $ExternalLinks = ExternalLinks::findOrFail($id);
        return view('Admin.links.edit-ExternalLinks', ['ExternalLinks'=> $ExternalLinks]);
    }

    public function update(Request $request, $id)
    {
        $ExternalLinks = new ExternalLinks;
        $ExternalLinks = ExternalLinks::findOrFail($id);
        $rules = [
            'Links_name' => 'required|min:5|max:50',
            'Links_code' => 'required|max:50',
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            $Links_name = $request->Links_name;
            $Links_code = $request->Links_code;
            $create_Links= $ExternalLinks->update(['Links_name'=>$Links_name,
            'Links_code'=>$Links_code]);

            if($create_Links){
                return redirect()->back()->with('msg','ExternalLinks was successfully Updated!');
            }else{
                return redirect()->back()->with('error','ERROR! could not update ExternalLinks!');
            }
        }
    }

    public function destroy($id)
    {
        $ExternalLinks = new ExternalLinks;
        $ExternalLinks = ExternalLinks::where('id',$id)->first();
        $delete_Links= $ExternalLinks->delete();
        if($delete_Links){
            return redirect()->back()->with('msg','ExternalLinks was successfully deleted!');
        }else{
            return redirect()->back()->with('error','ERROR! could not delete ExternalLinks!');
        }
    }
}
