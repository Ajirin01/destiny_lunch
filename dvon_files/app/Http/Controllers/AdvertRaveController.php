<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use App\Article as Article;
use App\AdvertTempData as TempData;
use App\User as User;
use App\Advert as Advert;
use DB;


//use the Rave Facade
use Rave;

class AdvertRaveController extends Controller
{
  /**
   * Create Rave subscription
   * @return void
   */
  public function createPaymentPlan(Request $request)
  {
    $data = Rave::createPaymentPlan();

    
    $data = $data->data;
    
    // dd($data);

    $temp_data = TempData::where('subscription_id', $data->id)->where('email',Auth::user()->email)->get();

    if(count(json_decode($temp_data))>0){
      TempData::update(['temp_data'=>json_encode($request->all()), 'subscription_id'=>$data->id])->save();
    }else{
      TempData::create(['email'=>Auth::user()->email,'temp_data'=>json_encode($request->all()), 'subscription_id'=>$data->id])->save();
    }
    return view('site.advert-pay', ['sub_data'=>$data]);
  }
  /**
   * Initialize Rave payment process
   * @return void
   */
  public function initialize()
  {
    //This initializes payment and redirects to the payment gateway
    //The initialize method takes the parameter of the redirect URL
    Rave::initialize(route('advertcallback'));
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
    $temp_data = TempData::where('email',$email)->first();
    $user = User::where('email', $email)->first();


    if($payment_status == 'success'){
        DB::table('adverts')->where('advert_set_reference', $temp_data->advert_set_reference)->update(array('subscription_id' => $temp_data->subscription_id));
        // Advert::where('advert_set_reference', $temp_data->advert_set_reference)->update(['subscription_id '=>$temp_data->subscription_id ]);
        
        return view('site.payment-complete');
    }else{
        echo "Whoops! Payment was not successful";
    }
  }

  public function fetchPaymentPlan($id, $q)
  {
    $data = Rave::fetchPaymentPlan($id, $q);

    // dd($data);
    return $data->data->paymentplans[0];
  }
}
