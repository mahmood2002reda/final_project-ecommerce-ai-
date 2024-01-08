<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgetPassword;
use App\Models\User;
use  App\Notifications\ResetPasswordNotification;

class ForgetPasswordController extends Controller
{
    public function forgotPassword(ForgetPassword $request)
    {
        $input = $request->email;
        $user = User::where('email', $input)->first();
    
        if ($user) {
            $user->notify(new ResetPasswordNotification());
            $success['success'] = true;
            return response()->json($success, 200);
        }
    
        $error['error'] = 'User not found';
        return response()->json($error, 404);
    }

}