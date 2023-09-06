<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlansController as plan;
use App\Http\Controllers\SubscriptionController as sub;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
 return redirect('/login');
});

Auth::routes();
Route::get('/home', [plan::class, 'index'])->name('plans');
Route::get('/plans', [plan::class, 'index'])->name('plans');

Route::middleware("auth")->group(function(){

    Route::get('plans/show/{id}',[plan::class,'show'])->name('plan.show');
    Route::post('plans/payment',[plan::class,'payment'])->name('plan.payment');


    Route::get('user/subscription',[sub::class,'index'])->name('user.sub');
    Route::get('user/subscription/cancel/{id?}',[sub::class,'sub_cancel'])->name('sub.cancel');


});

