<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FreeTrialUser;
use Illuminate\Support\Facades\Hash;

class FreeTrialUserController extends Controller
{
    public function register(Request $request)
    {
        
        // Validate request
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:free_trial_users,email',
            'company_name' => 'required',
            'country' => 'required',
            'mobile' => 'required|numeric',
            'domain' => 'required|unique:free_trial_users,domain'
        ]);

        // If validation passes, create user
        $user = FreeTrialUser::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'mobile' => $request->mobile,
            'domain' => $request->domain
        ]);

        return response()->json(['Response' => 'Signup successful!'], 201);
    }
}
