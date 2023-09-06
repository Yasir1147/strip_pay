<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Stripe\Subscription;

class PlansController extends Controller
{
    //
    public function index()
    {

        $data['subscriptions'] = Plan::all()->toArray();
//        echo "<pre>";
//        print_r($subscription);exit;

        return view('plans', $data);

    }

    public function show($slug, Request $req)
    {

        $intent = auth()->user()->createSetupIntent();
        $plan = Plan::where(['slug' => $slug])->first()->toArray();
        return view('subscription_details', compact('plan', 'intent'));

    }

    public function payment(Request $req)
    {

        $plan = Plan::find($req->planid)->toArray();
        $sub =$req->user()->newSubscription($req->planid,$plan['strip_plan'])->create($req->token);
        return redirect(url(route('user.sub')))->with('message','Successfully Subscribed');

                //$req->user()->subscription('default')->canceled();
       // print_r();exit;

    }

}
