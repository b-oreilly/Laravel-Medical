<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Role;

class DoctorController extends Controller
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
            if ($user->doctor) {
                array_push($returnedUsers, $user);
            }
        }
        return view('admin.doctors.index')->with([
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
        return view('admin.doctors.create');
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
            'start_date' => 'required|date'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->password = bcrypt('password');

        $user->save();

        $user->roles()->attach(Role::where('name', 'doctor')->first());

        $doctor = new Doctor();
        $doctor->start_date = $request->input('start_date');
        $doctor->user_id = $user->id;

        $doctor->save();

        return redirect()->route('admin.doctors.show', $user->id);
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
        //     if($user->doctor->id == $visit->doctor_id) {
        //         array_push($returnedVisits, $visit);
        //     }
        // }
        return view('admin.doctors.show')->with([
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
        return view('admin.doctors.edit')->with([
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
            'start_date' => 'required|date'
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->doctor->start_date = $request->input('start_date');

        $user->save();

        $user->doctor->save();

        return redirect()->route('admin.doctors.show', $user->id);
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

        return redirect()->route('admin.doctors.index');
    }
}

