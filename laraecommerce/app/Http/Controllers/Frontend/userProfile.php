<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userProfile extends Controller
{
    public function index()
    {
        
        return view('frontend.users.profile');
        
    }

    public function updateUserdetails(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->username,
        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address,
            ]
        );
        return redirect()->back()->with('message','user profile updated successfully');

    }
}
