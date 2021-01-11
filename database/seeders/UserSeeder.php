<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();
        $role_doctor = Role::where('name', 'doctor')->first();
        $role_patient = Role::where('name', 'patient')->first();

        // Administrator
        $admin = new User();
        $admin->name = 'Miss Admin';
        $admin->address = '01 Hacker Avenue';
        $admin->phone = '0854329876';
        $admin->email = 'admin@medcentre.ie';
        $admin->password = Hash::make('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        // Basic user
        $user = new User();
        $user->name = 'Sample User';
        $user->address = '10 Hacker Way';
        $user->phone = '0898765432';
        $user->email = 'sampleuser@medcentre.ie';
        $user->password = Hash::make('secret');
        $user->save();
        $user->roles()->attach($role_user);

        //Doctor
        $doctor = new User();
        $doctor->name = 'Paula OConnell';
        $doctor->address = 'Louth';
        $doctor->phone = '0836534567';
        $doctor->email = 'paulaoc@medcentre.ie';
        $doctor->password = Hash::make('secret');
        $doctor->save();
        $doctor->roles()->attach($role_doctor);

        //Patient
        $patient = new User();
        $patient->name = 'Una Tobin';
        $patient->address = 'Kerry';
        $patient->phone = '0851238567';
        $patient->email = 'unat@medcentre.ie';
        $patient->password = Hash::make('secret');
        $patient->save();
        $patient->roles()->attach($role_patient);

    }
}
