<?php

namespace App\Http\Controllers\Api\Auth;

use Otp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\ResetPassword;
use App\Http\Requests\Api\ForgetPassword;

use Illuminate\Validation\Rules\Password;
use  App\Notifications\ResetPasswordNotification;

class ResetPasswordController extends Controller
{
    
    private $otp;


    public function __construct()
{

    $this->otp = new Otp;
}
public function passwordReset(ResetPassword $request)
{
    $otp2 = $this->otp->validate($request->email, $request->otp);
    if (!$otp2->status) {
        return response()->json(['error' => $otp2], 401);
    }

    $user = User::where('email', $request->email)->first();
    if ($user) {
        $user->update(['password' => Hash::make($request->password)]);
        $user->tokens()->delete();
        $success['success'] = true;
        return response()->json($success, 200);
    }

    $error['error'] = 'User not found';
    return response()->json($error, 404);
}
}