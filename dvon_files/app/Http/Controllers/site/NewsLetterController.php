<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SubscribeNewsletter;
use	Illuminate\Support\Facades\Mail;
use App\Newsletter as Newsletter;

class NewsLetterController extends Controller
{
    public function subscribe(Request $request){
        $active_newsletter = Newsletter::where('email', $request->email)->first();
        if($active_newsletter != null){
            return redirect()->back();
        }else{
            Newsletter::create(['name'=>$request->name, 'email'=>$request->email, 'status'=> 'subscribed'])->save();
            $data = array(
                'name' => $request->name,
                'email' => $request->email,
            );
            if(Mail::send(new SubscribeNewsletter($request->all()))){
                return redirect()->back();
            }else{
                return redirect()->back();
            }
        }
        
    }

    public function unsubscribe($email){
        $active_newsletter = Newsletter::where('email', $email)->first();
        $active_newsletter->status = 'unsubscribed';
        $active_newsletter->save();
        
        return view('site.newsletter-unsubscribe-done');

    }

    public function unsubscribeDone(Request $request){
        return response()->json($request->all());
    }
}
