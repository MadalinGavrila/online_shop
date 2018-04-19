<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationResendController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResendForm()
    {
        return view('auth.activate.resend');
    }

    public function resend(Request $request)
    {
        $this->validateResendRequest($request);

        $user = User::byEmail($request->email)->first();

        if($user->active){
            return redirect()->route('login')->withSuccess('Your account is already activated');
        }

        event(new UserRequestedActivationEmail($user));

        return redirect()->route('login')->withSuccess('Account activation email has been resend');
    }

    protected function validateResendRequest(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|exists:users,email'
        ], [
            'email.exists' => 'Could not find that account'
        ]);
    }
}
