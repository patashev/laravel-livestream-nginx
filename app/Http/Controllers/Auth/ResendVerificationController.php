<?php

namespace App\Http\Controllers\Auth;

use Password;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\WebsiteController;
use User;
use App\Http\Controllers\Controller;
use App\Mailer\AppMailer;

class ResendVerificationController extends Controller
{
  public function resendVerification($id, AppMailer $mailer) {
      $user = User::where('id',$id)->firstOrFail();

      dd($user);
      if ($user->activated === 0){
          //email the user there key
          $mailer->sendEmailConfirmationTo($user);
          $message = ('We just sent you the verification link at your email ('.$user->email.') again, please check it.');
          return view('auth.message')->with('message',$message);
      }
      else {
          return redirect('/')->withErrors(array('message' => 'Your Email is already active, please contact us at info@islamicda.com if you have any problem.'));
      }
  }

}
