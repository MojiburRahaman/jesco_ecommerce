<?php

namespace App\Http\Controllers;

use App\Models\billing_details;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    function FrontendProfile()
    {
        $billing_details = billing_details::where('user_id', auth()->id())->with('order_summaries')->get();
        return view('frontend.pages.profile', [
            'billing_details' => $billing_details,
        ]);
    }
    function ProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
            'newsletter' => ['nullable']
        ]);
        $name = strip_tags($request->name);
        $email = strip_tags($request->email);


        $user = User::findorfail(auth()->id());
        $user->name = $name;
        $user->email = $email;
        if (auth()->user()->email != $email) {
            $user->email_verified_at = null;
        }
        $user->save();

        if ($request->newsletter == '') {
            $new = Newsletter::where('user_id', auth()->id())->first();
            $new->status = '2';
            $new->save();
        }
        if ($request->newsletter == 'newsletter') {
            $new = Newsletter::where('user_id', auth()->id())->first();
            $new->status = '1';
            $new->save();
        }

        return back()->with('success', 'Profile Updated Successfully');
    }
    function ChangeUserPass(Request $request)
    {
        // return $request;
        $request->validate([
            'current_pass' => ['required', 'min:8'],
            'new_pass' => ['required', Password::min(8)],
            'confirm_pass' => ['required', 'same:new_pass', 'min:8'],
        ], [
            'current_pass.min' => 'Current Password must be minimum 8 Charecter',
            'current_pass.required' => 'Current Password field required',
            'new_pass.required' => 'New Password field required',
            'new_pass.min' => 'New Password must be minimum 8 Charecter',
            'confirm_pass.min' => 'Confirm Password must be minimum 8 Charecter',
            'confirm_pass.min' => 'Confirm Password must be minimum 8 Charecter',
        ]);
        $current_pass = strip_tags($request->current_pass);
        $new_pass = strip_tags($request->new_pass);
        $confirm_pass = strip_tags($request->confirm_pass);
        $user = auth()->user();

        if (Hash::check($current_pass, $user->password)) {
            $user->update([
                'password' => bcrypt($new_pass),
            ]);
            return back()->with('success', 'Password Updated Successfully');
        } else {

            return back()->with('warning', 'Password not matched');
        }
    }
}
