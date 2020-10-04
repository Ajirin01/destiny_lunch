<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Advert as Advert;
use Validator;
use	Illuminate\Support\Facades\Storage;

class advertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Advert = new Advert;
        $all_adverts = Advert::paginate(9);
        return view('Admin.Adverts.adverts-dashboard', ['adverts' => $all_adverts]);
    }

    public function create()
    {
        return view('Admin.Adverts.advert-creation-form');
    }

    public function store(Request $request)
    {
        $Advert = new Advert;
        $rules = [
            'advert_image' => 'required',
            'pages' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);

        $upload_path = public_path('uploads/');
        $created = false;

        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else {
            if($request->hasFile('advert_image')){
                $image = $request->file('advert_image');
                $pages = $request->pages;
                for($i=0; $i < count($image); $i++){
                    $image_extension = $image[$i]->getClientOriginalExtension();
                    $image_name[$i] = 'advert_image'.rand(123456789,999999999).'.'.$image_extension;

                    $advert_image = "/dvon_files/public/uploads/".$image_name[$i];
                    $create_advert = Advert::create(['advert'=>$advert_image, 'pages'=> $pages[$i], 'status'=> 'active', 'expired'=> 'no']);
                    $image[$i]->move($upload_path, $image_name[$i]);
                    if($create_advert){
                        $created = true;
                    }
                }
                if($created){
                    return redirect()->back()->with('msg','advert(s) was successfully created!');
                }
            }else{
                return redirect()->back()->with('error','ERROR! could not create advert(s)!');
            }
        }

        
        
    }

    public function edit($id)
    {
        $Advert = new Advert;
        $advert = Advert::find($id);
        return view('Admin.Adverts.edit-advert', ['advert'=> $advert]);
    }

    public function update(Request $request, $id)
    {
        $pages = $request->pages;
        $status = $request->status;
        $expired = $request->expired;

        $Advert = new Advert;
        $advert = Advert::find($id);

        $rules = [
            'pages' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        
        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else {
            if($request->hasFile('advert_image')){
                $image = $request->file('advert_image');
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'advert_image'.rand(123456789,999999999).'.'.$image_extension;

                $advert_image = "/dvon_files/public/uploads/".$image_name;
                $update_advert = $advert->update(['advert'=>$advert_image, 'pages'=> $pages, 'status'=> $status, 'expired'=> $expired]);
                $image->move($upload_path, $image_name);
    
                if($update_advert){
                    return redirect()->back()->with('msg','advert was successfully Updated!');
                }
            }else{
                $advert_image = $advert->advert;
                $update_advert = $advert->update(['advert'=>$advert_image, 'pages'=> $pages, 'status'=> $status, 'expired'=> $expired]);
                return redirect()->back()->with('msg','advert was successfully Updated!');
            }
        }
    }

    public function destroy($id)
    {
        $Advert = new Advert;
        $advert = Advert::find($id);
        $delete_advert = $advert->delete();
        if($delete_advert){
            return redirect()->back()->with('msg','advert was successfully deleted!');
        }else{
            return redirect()->back()->with('error','ERROR! could not delete advert!');
        }
    }
}
