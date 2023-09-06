<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription as sub;
use Stripe\Subscription;
class SubscriptionController extends Controller
{
    //


    public function index(Request  $request){

         $user = Auth::user();


        $data['subscriptions']  =DB::select("Select users.*,users.name as user_name,subscriptions.*,subscriptions.id as sub_id,plans.* from users JOIN subscriptions on subscriptions.user_id = users.id JOIN plans on subscriptions.stripe_price = plans.strip_plan where users.id = $user->id order by sub_id desc ");
        //    print_r(   $data['subscriptions'] );exit;
        return view('user_subscription', $data);


    }
    public function sub_cancel(Request  $request,$id){
        $user = Auth::user();

        $subscription = $user->subscriptions()->where(['id'=>$id])->active()->get()->first();

        // We can immediately Cancelled //
//        $subscription->cancelNow();

        // We can  Cancel to next active date
//        $subscription->cancel();

        if($subscription->cancel()){
            $user->subscriptions()->where('id',$id)->update(['stripe_status'=>'deactivate']);
            $message = "Successfully Canceled";
        }else{
            $message = "An Error occurred, while canceling the Subscription ";
        }
        return redirect(url(route('user.sub')))->with('message',$message);

    }
}
