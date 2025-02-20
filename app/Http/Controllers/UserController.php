<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Services;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\User;
use App\Models\Notification;

class UserController extends Controller
{
    public function userAddAppointment(Request $request)
    {
        $validated = $request->validate([
            'serviceID' => 'required|exists:services,id',
            'customerName' => 'required|string|max:255',
            'contactNumber' => 'required|string|max:15',
            'appointmentDate' => 'required|date',
            'appointmentTime' => 'required|date_format:H:i',
        ]);

        // Create the appointment with status set to 'pending'
        $appointment = Appointment::Create($validated + [
            'userID' => auth()->id(),
            'status' => 'pending',
        ]);

        // Assuming the admin has role 'admin'
        $admin = User::where('role', 'admin')->first(); 
        
        // Create a notification for the new appointment
        Notification::create([
            'message' => 'New appointment scheduled for ' . $validated['customerName'] . 
                        ' on ' . $validated['appointmentDate'] . 
                        ' at ' . $validated['appointmentTime'],
            'user_id' => $admin->id,
        ]);

        return response()->json([
            'message' => 'Appointment successfully created.',
            'appointment' => $appointment,
        ], 201);
    }


    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $request->id,
            'contactNumber' => 'nullable|string|max:20',
        ]);

        $customer = Customer::findOrFail($request->id);
        $customer->update($validated);

        return response()->json($customer);
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $validated = $request->validate([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|min:5|confirmed', // Ensure confirmPassword is validated
        ]);

        // Check if the old password is correct
        if (!Hash::check($validated['oldPassword'], $user->password)) {
            // Flash error message and go back to the previous page
            return back()->with('error', 'Old password is incorrect.');
        }

        // Update the password
        $user->password = Hash::make($validated['newPassword']);
        $user->save();

        // Flash success message and go back to the previous page
        return back()->with('success', 'Password changed successfully.');
    }


}
