<?php
/*
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
 */
/*
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
 */

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Registration;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $patient = Patient::count();
        $registration = Registration::count();
        $room = Room::count();
        $doctor = Doctor::count();

        return view('backend.pages.dashboard', [
            'patient' => $patient,
            'registration' => $registration,
            'room' => $room,
            'doctor' => $doctor,
        ]);
    }
}
