<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = array(
            array(
                'id' => 1,
                'fname' => 'John',
                'lname' => 'Doe', 
                'mname' => 'Dorak', 
                'email' => 'doarak@gmail.com', 
            ),
            array(
                'id' => 2,
                'fname' => 'Olamide',
                'lname' => 'Soyoye', 
                'mname' => 'Temitope', 
                'email' => 'olamide@gmail.com', 
            ),
            array(
                'id' => 3,
                'fname' => 'Jane',
                'lname' => 'Gate', 
                'mname' => 'Lucy', 
                'email' => 'lucy@gmail.com', 
            ),
            
        );
        foreach ($user as $value) {
            $user = Student::updateOrCreate($value);
        }
    }
}
