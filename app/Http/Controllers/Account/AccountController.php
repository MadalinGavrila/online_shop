<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\AccountUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordChangeRequest;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('account.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('account.edit', compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
        $request->user()->update($request->only('first_name', 'last_name', 'email'));

        return redirect()->route('account')->withSuccess('Your account has been updated !');
    }

    public function password()
    {
        $user = auth()->user();

        return view('account.password', compact('user'));
    }

    public function change_password(PasswordChangeRequest $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('account')->withSuccess('Your password has been changed !');
    }

    public function orders()
    {
        $user = auth()->user();

        $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(8);

        return view('account.orders', compact('user', 'orders'));
    }

    public function reviews()
    {
        $user = auth()->user();

        $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(8);

        return view('account.reviews', compact('user', 'reviews'));
    }

    public function destroy_review($id)
    {
        auth()->user()->reviews()->findOrFail($id)->delete();

        return redirect()->route('account.reviews')->withSuccess('The review has been deleted !');
    }
}
