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

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = Registration::with(['doctor', 'patient', 'room'])->orderByDesc('id')->get();

        return view('backend.registrations.index', [
            'registrations' => $registrations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::all();
        
        return view('backend.registrations.create', [
            'doctors' => $doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ['required', 'string', 'min:2'],
            "gender" => ['required', 'boolean'],
            "phone_number" => ['required', 'digits_between:10,12'],
            "address" => ['required', 'string'],
            "dob" => ['required'],
            "pob" => ['required', 'string'],
            "room_id" => ['required'],
            "doctor_id" => ['required'],
        ]);

        $maxNoRM = Patient::latest()->first();
        $maxnoRegistration = Registration::where('registration_date', now()->startOfDay())->latest()->first();

        if(empty($maxNoRM)){
            $maxRM = sprintf("%06s", 1);
        }else{
            $maxRM = sprintf("%06s", $maxNoRM->norm + 1);
        }

        if(empty($maxnoRegistration)){
            $maxNoRegis = now()->format('Ymd') . 1;
        }else{
            $maxNoRegis = $maxnoRegistration->noregistration + 1;
        }

        DB::transaction(function () use($request, $maxRM, $maxNoRegis) {

            $newPatient = new Patient();
            $newPatient->norm = $maxRM;
            $newPatient->name = $request->name;
            $newPatient->gender = $request->gender;
            $newPatient->address = $request->address;
            $newPatient->phone_number = $request->phone_number;
            $newPatient->dob = $request->dob;
            $newPatient->pob = $request->pob;
            $newPatient->save();

            $newRegistration = new Registration();
            $newRegistration->noregistration = $maxNoRegis;
            $newRegistration->room_id = $request->room_id;
            $newRegistration->doctor_id = $request->doctor_id;
            $newRegistration->patient_id = $newPatient->id;
            $newRegistration->registration_date = now();
            $newRegistration->save();

        });

        return redirect()->route('registration_patients.index')->with([
            'type' => 'success',
            'message' => 'Pendaftaran Pasien Berhasil'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registration = Registration::findOrFail($id);
        $doctors = Doctor::all();

        return view('backend.registrations.edit', [
            'registration' => $registration,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $registration = Registration::find($id);
        $registration->room_id = $request->room_id;
        $registration->doctor_id = $request->doctor_id;
        $registration->update();

        return redirect()->route('registration_patients.index')->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui registrasi'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Registration::findOrFail($id)->delete();

            return response()->json([
                'statusCode' => 200,
                'message' => 'success',
            ], 200);

        } catch (\Throwable $e) { 

            return response()->json([
                'statusCode' => 500,
                'message' => 'There is an error',
            ], 500);

        }

    }

    public function oldPatient($id)
    {
        $patient_registration = Patient::findOrFail($id);
        $doctors = Doctor::all();

        return view('backend.registrations.old_patient', [
            'patient_registration' => $patient_registration,
            'doctors' => $doctors
        ]);
    }

    public function registration_patient_old(Request $request)
    {
        $request->validate([
            "room_id" => ['required'],
            "doctor_id" => ['required'],
        ]);

        $maxNoRM = Patient::latest()->first();
        $maxnoRegistration = Registration::where('registration_date', now()->startOfDay())->latest()->first();

        if(empty($maxNoRM)){
            $maxRM = sprintf("%06s", 1);
        }else{
            $maxRM = sprintf("%06s", $maxNoRM->norm + 1);
        }

        if(empty($maxnoRegistration)){
            $maxNoRegis = now()->format('Ymd') . 1;
        }else{
            $maxNoRegis = $maxnoRegistration->noregistration + 1;
        }

        $newRegistration = new Registration();
        $newRegistration->noregistration = $maxNoRegis;
        $newRegistration->room_id = $request->room_id;
        $newRegistration->doctor_id = $request->doctor_id;
        $newRegistration->patient_id = $request->patient;
        $newRegistration->registration_date = now();
        $newRegistration->save();


        return redirect()->route('registration_patients.index')->with([
            'type' => 'success',
            'message' => 'Pendaftaran Pasien Berhasil'
        ]);

    }

}
