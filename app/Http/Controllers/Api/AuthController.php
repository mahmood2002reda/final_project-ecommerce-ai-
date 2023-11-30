<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
        ], [], [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(422, 'Register validation errors', $validator->messages()->all());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data['token'] = $user->createToken('api')->plainTextToken;
        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return ApiResponse::sendResponse(201, 'User created successfully', $data);
    }
    

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ], [], [
            'email' => 'Email',
            'password' => 'Password',
        ]);
    
        if ($validator->fails()) {
            return ApiResponse::sendResponse(422, 'Login validation errors', $validator->messages()->all());
        }
    
        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password])) {
           
           /** @var \App\Models\User $user **/  $user = Auth::user();
 
    
            $data['token'] = $user->createToken('api')->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
    
            return ApiResponse::sendResponse(200, 'User authenticated successfully', $data);
        } else {
            return ApiResponse::sendResponse(401, 'Login credentials are invalid', null);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendResponse(200, 'Loged out successfully ', []);

    }
    

    
    
    // ...
    
    public function redirectToProvider($provider)
    {
        $allowedProviders = ['google', 'github', 'twitter']; // المزيد من المزودين يمكن إضافتهم هنا
        if (!in_array($provider, $allowedProviders)) {
            return response()->json(['error' => 'Invalid provider.'], 422);
        }
        
        return Socialite::driver($provider)->stateless()->redirect();
    }
    
    public function handleProviderCallback($provider)
    {
        $allowedProviders = ['google', 'github', 'twitter']; // المزيد من المزودين يمكن إضافتهم هنا
        if (!in_array($provider, $allowedProviders)) {
            return response()->json(['error' => 'Invalid provider.'], 422);
        }
       
    
        try {
            /** @var \App\Models\User $user */
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provider.'], 422);
        }
    
        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ]
        );
    
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        $data['token'] = $userCreated->createToken('api')->plainTextToken;
        $data['email'] = $userCreated->email;
        $data['name'] = $userCreated->name;
        return ApiResponse::sendResponse(200, 'Login  successfully ',$data);

    
      
    }
    
   
}