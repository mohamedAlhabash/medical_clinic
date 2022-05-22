<?php

// namespace App\Http\Controllers;

// use App\Models\Patient;
// use App\Models\Payment;
// use App\Models\Reservation;
// use Illuminate\Routing\Controller;
// use Illuminate\Support\Facades\Request;
// use App\Http\Requests\Backend\PatientRequest;

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\PatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Reservation::where('date','<',Carbon::now())->delete();
         $patients = Patient::orderBy('id','DESC')->get();
         return view('admin.patient.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patient.addPatient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        Patient::create($request->validated());
        return redirect()->route('patients.index')->with([
            'success' => 'Created successfully',
        ]);
        // $request->validate([
        //     'name'              => 'required|min:3|max:30',
        //     'phone'             => 'required',
        //     'treatment_state'   => 'required',
        //     'identity_number'   => 'required|unique:patients,identity_number',
        // ]);
        // Patient::create([
        //     'name'=>$request->name,
        //     'phone'=>$request->phone,
        //     'treatment_state'=>$request->state,
        //     'identity_number'=>$request->identity_number,
        // ]);
        // return redirect()->route('patient.index')->with([
        //         'success' => 'Created successfully',
        //     ]);
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
    public function edit(Patient $patient)
    {
        // $patient = $patient->withMax('reservations', 'date')->firstOrFail();
        return view('admin.patient.EditPatient', compact('patient'));
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
        $request->validate([
            'name'              => 'required|min:3|max:30',
            'phone'             => 'required|numeric|digits:10',
            'treatment_state'   => 'nullable',
            'identity_number'   => 'required|numeric|unique:patients,identity_number,'.$id,
        ]);
        Patient::find($id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_number' => $request->identity_number,
            'treatment_state' => $request->treatment_state,

        ]);
            return redirect()->route('patients.index')->with([
            'success' => 'Updated successfully',
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
        //
    }
}
