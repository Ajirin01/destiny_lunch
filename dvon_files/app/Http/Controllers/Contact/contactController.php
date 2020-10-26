<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use	Illuminate\Support\Facades\Mail; 

class contactController extends Controller
{
    //
    public function show(){
        return view('contact.contact-form');
    }

    public function send(Request $request){
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        );
        if(Mail::send(new ContactUs($request->all()))){
            return redirect()->back()->with('msg','profile was successfully update!');
        }else{
            return redirect()->back()->with('error','ERROR! could not update profile!');
        }
    }
}
