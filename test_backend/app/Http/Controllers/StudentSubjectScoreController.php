<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentSubjectScore;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentSubjectScoreController extends Controller
{
    public function get_subjects()
    {
        $subjects = subject::all();
        return response()->json(['status' => true, 'data' => $subjects],200);

    }
    public function score_student(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'result' => 'required|array'
        ]);

        $student = Student::find($request->student_id);
        $insertArr=[];
        foreach ($request->result as $key => $value) {
            $insertArr[$value['subject_id']] = ['score' => $value['score']];
        }
        try {
            $student->subject()->sync($insertArr);
            return response()->json(['status' => true, 'Message' => "Score Uploaded Successfully"],200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'Message' => $th],405);
        }
    }

    public function retrieve_score()
    {
        $student = Student::select('*')->get();
        foreach ($student as $key => $value) {
            $result_per_student = StudentSubjectScore::where('student_subject_scores.student_id',$value['id'])
            ->join('subjects as s','s.id','student_subject_scores.subject_id')
            ->select('student_subject_scores.subject_id',
                    's.subject_name','student_subject_scores.score',
                    )
            ->get();
            
            if (!count($result_per_student)) {
                for ($i=0; $i < 5; $i++) { 
                    $result_per_student[]=['score'=> '-'];
                }
            }
            $mean = StudentSubjectScore::where('student_subject_scores.student_id',$value['id'])
            ->selectRaw("AVG(score) as mean")->value('mean');
            $median = DB::select("
                SELECT AVG(dd.score) as median
                FROM (
                SELECT d.score, @rownum:=@rownum+1 as `row_number`, @total_rows:=@rownum
                FROM student_subject_scores d, (SELECT @rownum:=0) r
                WHERE d.score is NOT NULL && student_id =? ORDER BY d.score
                ) as dd
                WHERE dd.row_number IN ( FLOOR((@total_rows+1)/2), FLOOR((@total_rows+2)/2) )
            ", [$value['id']]);

            $mode = DB::select("
                SELECT score, COUNT( * ) FROM student_subject_scores
                WHERE student_id = ? GROUP BY score
                ORDER BY COUNT( * ) DESC LIMIT 1;
            ", [$value['id']]);
            $value['result']=$result_per_student;
            $value['mean']= floor($mean);
            if ($mode) {
                $value['mode']= $mode[0]->score;
            }
            if ($median) {
                $value['median']= floor($median[0]->median);
            }
        }
        return response()->json(['status' => true, 'data' => $student],200);
    }
    public function purge_scores(Request $request)
    {
        $student_d = $request->id;
        $delete=StudentSubjectScore::where('student_id',$student_d)->delete();
        return response()->json(['status' => true, 'message' => 'scores deleted'],200);
    }
}
