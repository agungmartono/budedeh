<?php
/*
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
 */

namespace App\Http\Controllers\Backend;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patiens = Patient::orderByDesc('created_at')->get();

        return view('backend.patients.index', [
            'patiens' => $patiens
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
// 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $patient_registration = Patient::findOrFail($id);
        $doctors = Doctor::all();

        return view('backend.patients.edit', [
            'patient_registration' => $patient_registration,
            'doctors' => $doctors
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
        //    
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
            Patient::findOrFail($id)->delete();

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
}
