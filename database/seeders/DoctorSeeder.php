<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Role;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_doctor = Role::where('name', 'doctor')->first();

        foreach ($role_doctor->users as $user) {
            $doctor = new Doctor();

            $doctor->start_date = $this->random_date();
            $doctor->user_id = $user->id;
            $doctor->save();
        }
    }
    private function random_date()
    {
        $faker = \Faker\Factory::create();

        return $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = 'Europe/Paris');
    }
}
