<?php

namespace Tests\Unit;

use Tests\TestCase;

class ScoreTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_adds_student_score()
    {
        $response = $this->post('api/score_student',[
            "student_id"=>"1",
            "result"=>[
                [
                    "subject_id"=>"1",
                    "score"=>56
                ],
                [
                    "subject_id"=>"2",
                    "score"=>36
                ],
                [
                    "subject_id"=>"3",
                    "score"=>46
                ],
                [
                    "subject_id"=>"4",
                    "score"=>66
                ],
                [
                    "subject_id"=>"5",
                    "score"=>76
                ]
            ]
        ]);
        $response->assertStatus(200);
    }
    public function test_retrieve_students_score()
    {
        $response = $this->get('api/retrieve_score');

        $response->assertStatus(200);
    }
    public function test_get_subjects()
    {
        $response = $this->get('api/get_subjects');
        $response->assertStatus(200);
    }
    public function test_delete_student_score()
    {
        $response = $this->post('api/purge_scores',[
            "id"=>1
        ]);
        $response->assertStatus(200);
    }
}
