<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Models\Role;

class PatientController extends Controller
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
        $users = User::all();
        $returnedUsers = array();
        foreach ($users as $user) {
            if ($user->patient) {
                array_push($returnedUsers, $user);
            }
        }
        return view('admin.patients.index')->with([
            'users' => $returnedUsers
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patients.create');
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
            'name' => 'required|max:191|string',
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|min:8',
            'address' => 'required|max:255|string',
            'phone' => 'required|max:10|string',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->password = bcrypt('password');

        $user->save();

        $user->roles()->attach(Role::where('name', 'patient')->first());

        $patient = new patient();
        $patient->user_id = $user->id;

        $patient->save();

        return redirect()->route('admin.patients.show', $user->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        // $visits = Visit::orderBy('date', 'DESC')->get();
        // $returnedVisits = array();
        // foreach($visits as $visit) {
        //     if($user->patient->id == $visit->patient_id) {
        //         array_push($returnedVisits, $visit);
        //     }
        // }
        return view('admin.patients.show')->with([
            'user' => $user,
            //'visits' => $returnedVisits
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
        $user = User::findOrFail($id);
        return view('admin.patients.edit')->with([
            'user' => $user
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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email,' . $id . '|max:191',
            'password' => 'min:8',
            'address' => 'required|max:255|string',
            'phone' => 'required|max:10|string',
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        $user->save();

        $user->patient->save();

        return redirect()->route('admin.patients.show', $user->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.patients.index');
    }
}
