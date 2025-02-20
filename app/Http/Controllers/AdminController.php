<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Services;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Notification;

class AdminController extends Controller
{
    public function addCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|string|max:255|unique:categories',
            'categoryDescription' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:9048', // Reduce max size to 2MB for quicker uploads
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); 
        }

        // Store the image and get its path
        $imagePath = $request->file('image')->store('images/categories', 'public');

        // Create the category with the provided data
        Category::create([
            'categoryName' => $request->categoryName,
            'categoryDescription' => $request->categoryDescription,
            'image' => $imagePath,
        ]);

        // Send success message as JSON response
        return response()->json([
            'message' => 'Category added successfully',
        ], 200);
    }
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
    public function toggleCategoryStatus($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }
        $category->status = $category->status === 'active' ? 'inactive' : 'active';
        $category->save();
        return response()->json([
            'message' => 'Category status updated successfully.',
            'status' => $category->status,
        ]);
    }
    public function updateCategoryName(Request $request, $id)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $category->categoryName = $request->categoryName;
        $category->save();

        return response()->json([
            'message' => 'Category name updated successfully.',
            'categoryName' => $category->categoryName,
        ]);
    }

    public function addServices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serviceName' => 'required|string',
            'categoryID' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'required|image|max:22048',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation errors: ', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = $request->file('image')->store('images/services', 'public');

        $service = Services::create([
            'serviceName' => $request->serviceName,
            'categoryID' => $request->categoryID,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Service added successfully',
            'image_url' => asset('storage/' . $imagePath)
        ], 200);

    }

    public function addAppointment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'customerName' => 'required',
                'contactNumber' => 'required',
                'appointmentDate' => 'required|date',
                'appointmentTime' => 'required|date_format:H:i',
                'selectedService' => 'required|exists:services,id',
            ]);

            if ($validator->fails()) {
                \Log::error('Validation errors: ', $validator->errors()->toArray());
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $appointment = new Appointment([
                'customerName' => $request->customerName,
                'contactNumber' => $request->contactNumber,
                'appointmentDate' => $request->appointmentDate,
                'appointmentTime' => $request->appointmentTime,
                'serviceID' => $request->selectedService,
                'userID' => auth()->id(),
                'status' => 'confirmed', 
            ]);

            $appointment->save();

            return response()->json([
                'message' => 'Appointment added successfully',
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error during appointment creation: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }
    public function blockCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = $request->input('status');
        $customer->save();

        return response()->json(['message' => 'Customer status updated successfully.'], 200);   
    }
    public function unblockCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = 'active';
        $customer->save();
        return response()->json(['message' => 'Customer status updated successfully.'], 200);
    }
    public function deleteAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully.'], 200);
    }
    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,confirmed,rejected,active,cancelled,done',
        ]);

        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->status = $request->status;
            $appointment->save();


            // Create a notification for the user
            Notification::create([
                'user_id' => $appointment->userID,
                'message' => "Your appointment status has been updated to {$request->status}.",
                'is_read' => false,
            ]);

            return response()->json([
                'message' => "Appointment marked as {$request->status}.",
                'appointment' => $appointment
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update appointment status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
