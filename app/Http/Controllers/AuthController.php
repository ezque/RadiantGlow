<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email|unique:customers,email',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'contactNumber' => 'required|digits_between:1,13',
            'password' => 'required|string|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customer = Customer::create([
            'email' => $request->email,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'contactNumber' => $request->contactNumber,
            'password' => Hash::make($request->password),
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        Notification::create([
            'message' => 'New customer registered: ' . $request->lastName,
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Check if the user exists in the User table
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::guard('web')->login($user);  // Use the 'web' guard for User
            $request->session()->regenerate();

            // Fetch the corresponding customer information
            $customer = Customer::where('email', $user->email)->first();

            // Attach the customer information to the authenticated user session or pass it to the frontend
            session(['customer' => $customer]);

            // Check the user's role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin-dashboard');
            }

            // Default role is customer, redirect to user dashboard
            return redirect()->intended('/user-dashboard');
        }

        // Return error if authentication failed
        throw ValidationException::withMessages([
            'email' => [__('auth.failed')],
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();  // Log the user out
        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate CSRF token

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
    public function resetNotifications()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Log the user object to see if it's being retrieved properly
    Log::info('Authenticated user:', ['user' => $user]);

    // Check if the user is authenticated
    if ($user) {
        try {
            // Log the current notification_count before updating
            Log::info('Current notification_count:', ['notification_count' => $user->notification_count]);

            // Update the notification_count to 0
            $user->update(['notification_count' => 0]);

            // Log the successful update
            Log::info("Notification count reset for user: {$user->id}");

            return response()->json(['message' => 'Notifications reset successfully!']);
        } catch (\Exception $e) {
            // Log the exception error
            Log::error('Error resetting notification count:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to reset notifications.'], 500);
        }
    }

    return response()->json(['message' => 'User not authenticated'], 401);
}







}
