<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Advert as Advert;
use Validator;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Advert = new Advert;
        $all_adverts = Advert::paginate(10);
        return view('Admin.Adverts.Advert-dashboard', ['Adverts' => $all_adverts]);
    }
    public function create()
    {
        return view('Admin.Adverts.Advert-creation-form');
    }

    public function store(Request $request)
    {
        $Adverts = (['Advert_name' => $request->Advert_name, 'Advert_code' => $request->Advert_code]);
        $Advert = new Advert;
        $size_Adverts = count($Adverts['Advert_name']);
        $loop_times = $size_Adverts;
        if($Adverts['Advert_name'] == [null] || $Adverts['Advert_code'] == [null]){
            return redirect()->back()->with('errors','Error! Please fill up all fields');
        }else{
            $created = false;
            for($i=0; $i < $loop_times; $i++){
                $Advert_name = $Adverts['Advert_name'][$i];
                $Advert_code = $Adverts['Advert_code'][$i];
                if($Advert_name == null || $Advert_code == null){
                    if($i == 0){
                        $error = "Advert ".($i+1)." could not be successfully added to record because Advert name or Advert code can not be empty!";    
                    }else{
                        $error = "Advert ".($i+1)." could not be successfully added to record because Advert name or Advert code can not be empty! NB: OTHERS MAY HAVE BEEN CREATED SUCCESSFULLY";                       
                    }
                    return redirect()->back()->with('errors',$error);
                }else{
                    $Advert = Advert::where('Advert_code',$Advert_code)->first();
                    if($Advert != null){
                        $error = 'Advert "'.$Advert_name.'" could not be successfully added to record because Advert code "'.$Advert_code.'" already exists!';
                        return redirect()->back()->with('errors',$error);
                    }else{
                        $create_Advert = Advert::create(['Advert_name'=> $Advert_name,
                        'Advert_code' => $Advert_code]);
                        if($create_Advert->save()){
                            $created = true;
                        }else{
                            $created = false;
                        }
                    }
                }
            }
            if($created){
                return redirect()->back()->with('msg','Advert(s) was successfully created!');
            }else{
                return redirect()->back()->with('msg','Advert(s) could not be successfully created!');
            }
        }
    }

    public function edit($id)
    {
        $Advert = new Advert;
        $Advert = Advert::findOrFail($id);
        return view('Admin.Adverts.edit-Advert', ['Advert'=> $Advert]);
    }

    public function update(Request $request, $id)
    {
        $Advert = new Advert;
        $Advert = Advert::findOrFail($id);
        $rules = [
            'Advert_name' => 'required|min:5|max:50',
            'Advert_code' => 'required|max:50',
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->back()->with('errors',$validator->errors());
        }else{
            $Advert_name = $request->Advert_name;
            $Advert_code = $request->Advert_code;
            $create_Advert= $Advert->update(['Advert_name'=>$Advert_name,
            'Advert_code'=>$Advert_code]);

            if($create_Advert){
                return redirect()->back()->with('msg','Advert was successfully Updated!');
            }else{
                return redirect()->back()->with('error','ERROR! could not update Advert!');
            }
        }
    }

    public function destroy($id)
    {
        $Advert = new Advert;
        $Advert = Advert::where('id',$id)->first();
        $delete_Advert= $Advert->delete();
        if($delete_Advert){
            return redirect()->back()->with('msg','Advert was successfully deleted!');
        }else{
            return redirect()->back()->with('error','ERROR! could not delete Advert!');
        }
    }
}
