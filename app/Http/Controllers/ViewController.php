<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Services;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function home(){
        return Inertia::render('Home');
    }

    public function about(){
        return Inertia::render('About');
    }

    public function services(){
        return Inertia::render('Services');
    }

    public function contact(){
        return Inertia::render('Contact');
    }

    public function register(){
        return Inertia::render('auth/Register');
    }

    public function login(){
        return Inertia::render('auth/Login');
    }

    public function adminDashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {

                $categories = Category::all();
                $services = Services::all();
                $customers = Customer::all();
                $appointments = Appointment::with('service')->get();

                $unreadNotifications = Notification::where('user_id', $user->id)->get();

                // Weekly appointments query
                $weeklyAppointments = Appointment::select(
                    DB::raw('DAYOFWEEK(appointmentDate) as day'),
                    DB::raw('count(*) as count')
                )->groupBy('day')
                ->pluck('count', 'day');

                $appointmentsByDay = array_fill(0, 7, 0);
                foreach ($weeklyAppointments as $day => $count) {
                    $appointmentsByDay[$day - 1] = $count;
                }

                // Monthly appointments query
                $monthlyAppointments = Appointment::select(
                    DB::raw('MONTH(appointmentDate) as month'),
                    DB::raw('count(*) as count')
                )->groupBy('month')
                ->pluck('count', 'month');

                $appointmentsByMonth = array_fill(0, 12, 0);
                foreach ($monthlyAppointments as $month => $count) {
                    $appointmentsByMonth[$month - 1] = $count;
                }

                return Inertia::render('AdminDashboard/AdminDashboard', [
                    'categories' => $categories,
                    'services' => $services,
                    'customers' => $customers,
                    'appointments' => $appointments,
                    'unreadNotifications' => $unreadNotifications,
                    'appointmentsByDay' => $appointmentsByDay,
                    'appointmentsByMonth' => $appointmentsByMonth,
                ]);
            }

            return redirect('/');
        }

        return redirect('/login');
    }


    public function userDashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->role === 'customer' || $user->role === 'user') {
                $categories = Category::all();
                $services = Services::all();
                $appointments = Appointment::with('service')
                    ->where('userID', $user->id)  // Filter by user ID
                    ->get();

                $customer = Customer::where('email', $user->email)->first();

                $unreadNotifications = Notification::where('user_id', $user->id)->get();

                // Prepare data for the Vue component
                $upcomingAppointments = $appointments->filter(function ($appointment) {
                    return Carbon::parse($appointment->appointmentDate . ' ' . $appointment->appointmentTime)->isFuture();
                });

                $todaysAppointments = $appointments->filter(function ($appointment) {
                    return Carbon::parse($appointment->appointmentDate . ' ' . $appointment->appointmentTime)->isToday();
                });

                $historyAppointments = $appointments->filter(function ($appointment) {
                    return Carbon::parse($appointment->appointmentDate . ' ' . $appointment->appointmentTime)->isPast();
                });

                return Inertia::render('UserDashboard/UserDashboard', [
                    'categories' => $categories,
                    'services' => $services,
                    'appointments' => $appointments,
                    'upcomingAppointments' => $upcomingAppointments ?? [],
                    'todaysAppointments' => $todaysAppointments ?? [],
                    'historyAppointments' => $historyAppointments ?? [],
                    'customer' => $customer,
                    'unreadNotifications' => $unreadNotifications,
                ]);
            }

            return redirect('/');
        }

        return redirect('/login');
    }




}