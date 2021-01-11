<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrator
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An administrator user';
        $role_admin->save();

        // User
        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'An ordinary user';
        $role_user->save();

        // Doctor
        $role_doctor = new Role();
        $role_doctor->name = 'doctor';
        $role_doctor->description = 'A doctor';
        $role_doctor->save();

        // Patient
        $role_patient = new Role();
        $role_patient->name = 'patient';
        $role_patient->description = 'A patient';
        $role_patient->save();

    }
}
