<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Visit;


class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = Visit::all();
        return view('admin.visits.index')->with([
            'visits' => $visits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('admin.visits.create')->with([
            'doctors' => $doctors,
            'patients' => $patients
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
            'duration' => 'required|integer',
            'notes' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer'
        ]);

        $visit = new Visit();
        $visit->duration = $request->input('duration');
        $visit->notes = $request->input('notes');
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->patient_id = $request->input('patient_id');

        $visit->save();

        return view('admin.visits.show')->with([
            'visit' => $visit
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
        $visit = Visit::findOrFail($id);

        return view('admin.visits.show')->with([
            'visit' => $visit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visit = Visit::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('admin.visits.edit')->with([
            'visit' => $visit,
            'doctors' => $doctors,
            'patients' => $patients
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
        $visit = Visit::findOrFail($id);

        $request->validate([
            'duration' => 'required|integer',
            'notes' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer'
        ]);

        $visit->duration = $request->input('duration');
        $visit->notes = $request->input('notes');
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->patient_id = $request->input('patient_id');

        $visit->save();

        return view('admin.visits.show')->with([
            'visit' => $visit
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
        $visit = Visit::findOrFail($id);
        $visit->delete();

        return redirect()->route('admin.visits.index');
    }

    /**
     * Cancel the Visit
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id) {

        $visit = Visit::findOrFail($id);
        $visit->cancelled = true;
        $visit->save();

        return redirect()->route('admin.visits.show', $visit->id);
    }
}
