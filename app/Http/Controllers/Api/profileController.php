<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Requests\Api\ProfileRequest; // Use the correct case for the request
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function create(ProfileRequest $request)
    {
        $data = $request->validated();
    
        // Upload and save the image
        if ($request->hasFile('image_profile')) {
            $image = $request->file('image_profile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profile'), $imageName);
            $data['image_profile'] = $imageName;
        }
    
        // Add the user ID to the data
        $data['user_id'] = Auth::user()->id;
    
        // Create the profile record
        $profile = Profile::create($data);
    
        // Create the address record
        $address = DB::table('addresses')->insert([
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'profile_id' => $profile->id,
        ]);
    
        if ($profile && $address) {
            return ApiResponse::sendResponse(201, 'Your profile was created successfully', $data);
        } else {
            return ApiResponse::sendResponse(500, 'Failed to create profile');
        }
    }

    public function show()
{
    $id = Auth::id();
    $user = User::find($id);
    
    if ($user) {
        return ApiResponse::sendResponse(200, 'Your profile', new ProfileResource($user));
    } else {
        return ApiResponse::sendResponse(404, 'User not found');
    }
}


    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . Auth::id(),
            'image_profile' => 'string',
            'mobile_number1' => 'string',
            'mobile_number2' => 'string',
        ]);
    
        $user = Auth::user();
    
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
    /** @var \App\Models\User $user **/

        $user->save();
    
        // Update profile data
        $profile = $user->profile; // Assuming a user has one profile
        if ($request->has('image_profile')) {
            $profile->image_profile = $request->input('image_profile');
        }
        if ($request->has('mobile_number1')) {
            $profile->mobile_number1 = $request->input('mobile_number1');
        }
        if ($request->has('mobile_number2')) {
            $profile->mobile_number2 = $request->input('mobile_number2');
        }
    
        // Save the profile changes
        $profile->save();
        return response()->json(['message' => 'Profile updated successfully']);

}
public function delete()
{
    $user = Auth::user();
        /** @var \App\Models\User $user **/

    $user->delete();
}
}
