<?php

namespace Database\Seeders;

use App\Models\subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    



    public function run()
    {
        $subject = array(
            array('id' => 1,'subject_name' => 'ENGLISH LANGUAGE', 'subject_code' => 'ENG', 'status' => 'active'),
            array('id' => 2,'subject_name' => 'MATHEMATICS', 'subject_code' => 'MTH', 'status' => 'active'),
            array('id' => 3,'subject_name' => 'CHEMISTRY', 'subject_code' => 'CHM', 'status' => 'active'),
            array('id' => 4,'subject_name' => 'PHYSICS', 'subject_code' => 'PHY', 'status' => 'active'),
            array('id' => 5,'subject_name' => 'BIOLOGY', 'subject_code' => 'BIO', 'status' => 'active'),
        );
    
    
        foreach ($subject as $value) {
            $user = subject::updateOrCreate($value);
        }
    }

}
