<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\ReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dt = new DateTime();
        // dd(Carbon::now());
         Reservation::where('date','<',Carbon::now())->delete();
        $resevrations = Reservation::all();
        return view('admin.resevation.indexResevation', compact('resevrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        return view('admin.resevation.addResevation', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        Reservation::create($request->validated());
        return redirect()->route('reservations.index')->with([
            'success' => 'Created successfully',
        ]);
        // Reservation::create([
        //     'patient_id' => $request->name,
        //     'date' => $request->date,
        // ]);
        // return redirect()->route('reservation.index');
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
        $reservations_selected=Patient::find($id)->reservations->max('date');
        $patient_select= Patient::find($id);
        $patients = Patient::all();
        return view('admin.resevation.editReservation',compact('patients','patient_select','reservations_selected'));
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
            'date' =>'date',
        ]);
        $x=Patient::with('reservations')->where('id',$id)->first();
        // dd(();
        $id=$x->reservations[0]->id;
        Reservation::find($id)->update([
            'date'=>$request->date,
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
