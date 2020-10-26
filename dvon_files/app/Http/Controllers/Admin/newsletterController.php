<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter as Newsletter;
use App\Mail\SendNewsletters;
use	Illuminate\Support\Facades\Mail; 

class newsletterController extends Controller
{
    public function index()
    {
        $all_newsletters = Newsletter::paginate(9);
        return view('Admin.Newsletters.newsletters-dashboard', ['newsletters' => $all_newsletters]);
    }

    public function sendNewslettersForm(){
        return view('Admin.Newsletters.send-newsletters-form');
    }

    public function sendNewsletters(Request $request){
        $active_newsletter = Newsletter::where('status', 'subscribed')->get();
        $emails = array();
        // for($i=0; $i < count($active_newsletter); $i++){
        //     $data = array(
        //         'name' => $active_newsletter[$i]->name,
        //         'email' => $active_newsletter[$i]->email,
        //         'newsletter' => $request->newsletter,
        //     );
        //     Mail::send(new SendNewsletters($data));
        // }
        $data = array(
                    'email' => 'hhoollaaggookkee.space@gmail.com',
                    'newsletter' => $request->newsletter,
                );
        for($i=0; $i < count($active_newsletter); $i++){
            $emails[$i] = $active_newsletter[$i]->email;
        }

        Mail::to('hhoollaaggookkee.space@gmail.com')
            ->cc($emails)
            ->send(new SendNewsletters($data));
        // $input = $request->newsletter;

        // Mail::send('newsletter.send', array('body' => $input),
        //     function($message) use ($emails, $input){
        //         $message->from('hhoollaaggookkee.space@gmail.com', 'admin')
        //                 ->subject('newsletter');

        //                 $message->to($emails);
        //     });
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $Newsletter = new Newsletter;
        $newsletter = Newsletter::find($id);

        $delete_newsletter = $newsletter->delete();
        if($delete_newsletter){
            return redirect()->back()->with('msg','newsletter was successfully deleted!');
        }else{
            return redirect()->back()->with('error','ERROR! could not delete newsletter!');
        }
    }
}
