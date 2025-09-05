<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmAccountController extends Controller
{
    public function confirmAccount($token)
    {
        // check if the token is valid 
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            abort(403, 'Invalid confirmation token.');
        }

        return view('auth.confirm-account', compact('user')); // atalho para criar um array associativo onde a chave é o nome da variável e o valor é o conteúdo dessa variável. Ex.: ['user' => $user]
    }

    public function confirmAccountSubmit(Request $request)
    {
        // validate the form data
        $request->validate([
            'token' => 'required|string|size:60',
            'password' => 'required|confirmed|min:8|max:16|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        $user = User::where('confirmation_token', $request->token)->first();
        $user->password = bcrypt($request->password);
        $user->confirmation_token = null; // clear the token to prevent reuse
        $user->email_verified_at = now(); // mark email as verified
        $user->save();

        // redirect to login page with success message
        return redirect()->route('login')->with('status', 'Your account has been confirmed and your password has been set. You can now log in.');
    }
}
