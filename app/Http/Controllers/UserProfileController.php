<?php

namespace App\Http\Controllers;

use App\Models\billing_details;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    function FrontendProfile()
    {
        $billing_details = billing_details::where('user_id', auth()->id())->with('order_summaries')->get();
        return view('frontend.pages.profile', [
            'billing_details' => $billing_details,
        ]);
    }
}
