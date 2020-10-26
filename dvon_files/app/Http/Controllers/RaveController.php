<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article as Article;
use App\TempData as TempData;
use App\User as User;
use Illuminate\Support\Facades\Auth as Auth;

//use the Rave Facade
use Rave;

class RaveController extends Controller
{
  /**
   * Create Rave subscription
   * @return void
   */
  public function createPaymentPlan()
  {
    $data = Rave::createPaymentPlan();

    
    $data = $data->data;

    $temp_data = TempData::where('email',Auth::user()->email)->get();

    if(count(json_decode($temp_data))>0){
      TempData::update(['subscription_id'=>$data->id])->save();
    }else{
      TempData::create(['email'=>Auth::user()->email, 'subscription_id'=>$data->id])->save();
    }
    return view('site.pay', ['sub_data'=>$data]);
  }
  /**
   * Initialize Rave payment process
   * @return void
   */
  public function initialize()
  {
    //This initializes payment and redirects to the payment gateway
    //The initialize method takes the parameter of the redirect URL
    Rave::initialize(route('callback'));
  }

  /**
   * Obtain Rave callback information
   * @return void
   */
  public function callback()
  {
    // return response()->json(json_decode(request()->resp)->data->transactionobject);
    // exit;
    $data = json_decode(request()->resp)->data->transactionobject;
    $data = Rave::verifyTransaction($data->txRef);

    // dd($data);
    $payment_status = $data->status;
    $email =  $data->data->custemail;
    $subscription_id = TempData::where('email',$email)->first()->subscription_id;
    $user = User::where('email', $email)->first();

    if($payment_status == 'success'){
      $user->subscription_id = $subscription_id;
      $user->subscribed = true;
      $user->save();
      return view('site.payment-complete');
    }else{
      echo "error occurred";
    }
  }

  public function fetchPaymentPlan($id, $q)
  {
    $data = Rave::fetchPaymentPlan($id, $q);

    dd($data->data->paymentplans[0]);
    return $data->data->paymentplans[0];
  }
  public function updateSubStatus(){
    $users = User::all();
    
    if(count($articles)>0){
      foreach ($users as $key => $user) {
        $sub = RaveController::fetchPaymentPlan($user->subscription_id, 'Subscription to read articles');
        $user->subscription_id = $sub->status;
        $user->save();
      }
    }
  }
}
