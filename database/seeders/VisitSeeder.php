<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Visit;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
            // Define faker for filling visit with fake data
            $faker = \Faker\Factory::create();

            // Get all users with the role of patient and doctor
            $role_patient = Role::where('name', 'patient')->first();
            $role_doctor = Role::where('name', 'doctor')->first();
            $doctors = $role_doctor->users;

            // Loop through patients and create a visit for each
            foreach ($role_patient->users as $user) {
                //Get a random doctor and assign them to the visit
                $doctor = $doctors[rand(0, count($doctors) - 1)];

                $visit = new Visit();
                // Populate visit with faker data
                $visit->notes = $faker->sentence();
                $visit->duration = $faker->numberBetween($min = 5, $max = 180);
                $visit->cost = $faker->numberBetween($min = 10, $max = 100);
                $visit->date = $faker->date($format = "Y-m-d", $startDate = 'today');
                $visit->time = $faker->time();
                // Assign foreign keys to visit
                $visit->patient_id = $user->patient->id;
                $visit->doctor_id = $doctor->doctor->id;
                // Save visit
                $visit->save();     
        }
    }
}
