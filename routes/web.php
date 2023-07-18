<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\PasswordResetConfirm;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\User;
use Illuminate\Auth\Events\Verified;

Route::get('mail-test', function () {
    dump(SECRET_MANAGER_DATA);
    \Mail::raw('Hi, This is mail test!', function($message) {
        $message->to('max@yopmail.com', 'Max Steve')->subject('Basic Testing Mail from '.\Config::get('app.env'));
    });
    dd("Email is Sent.");
});

Route::get('cron-test', function () {
    \Artisan::call('calculate:scores');
    return "success";
});

Route::get('/health-check', function () {
    return \Illuminate\Support\Facades\Response::json(['status'=>'OK'],200);
});

Route::get('/', App\Http\Livewire\MerchantLogin::class);
Route::get('/merchant-login', App\Http\Livewire\MerchantLogin::class);
Route::get('/reset-password', App\Http\Livewire\MerchantResetPassword::class);
Route::get('/create-password/{token}', App\Http\Livewire\CreateNewPass::class)->name('create.password');
Route::get('/create-account', App\Http\Livewire\CreateAccount::class);
Route::get('/email-verify', App\Http\Livewire\EmailVerify::class);
Route::get('/terms-conditions', App\Http\Livewire\TermsConditions::class);
Route::get('/password-reset-confirm', PasswordResetConfirm::class);

//added authorization group
Route::group(['middleware' => ['auth','verified']], function() {

    Route::get('/merchant-dash/home', App\Http\Livewire\MerchantHome::class);
    Route::get('/merchant-claim', App\Http\Livewire\MerchantClaim::class);
    Route::get('/merchant-dash/business', function()
    {
        return View::make('layouts.merchant-business');
    });
    Route::get('/merchant-dash/resources', App\Http\Livewire\MerchantResources::class);
    Route::get('/merchant-dash/settings', App\Http\Livewire\AccountSetting::class);
    Route::get('/business-edit-page', App\Http\Livewire\BusinessInfo::class);
    Route::get('/account-setting', App\Http\Livewire\AccountSetting::class);
    Route::get('/merchant-dash/blog/{post}', [App\Http\Controllers\PostController::class, 'show']);
    Route::get('/update-password', App\Http\Livewire\UpdatePassword::class);
    Route::get('/edit-account', App\Http\Livewire\EditAccount::class);
});



Route::get('/merchant-claimed', function()
{
    return View::make('layouts.merchant-claimed');
});
Auth::routes();
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/email/verify', function () {
    // return view('auth.verify-email');
    return redirect('/email-verify')->with( ['resend' => 1] );
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);
    $user->markEmailAsVerified();

    event(new Verified($user));

    if($user->getRoleNames()->contains('Merchant')) {
        return redirect('/merchant-dash/home');
    }

    return View::make('livewire.user-email-verified');
})->middleware(['signed'])->name('verification.verify');

Route::get('/apple-app-site-association', function () {
    $json = file_get_contents(public_path('.well-known/apple-app-site-association'));
    return response($json, 200)
        ->header('Content-Type', 'application/json');
});


