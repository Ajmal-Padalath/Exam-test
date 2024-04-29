<?php

namespace App\Http\Controllers;
use App\Questions;
use App\Student;
use Response;

use Illuminate\Http\Request;

class Exam extends Controller
{
    public function submitQuestions(Request $request) {
        $questions = new Questions;
        $questions->q_name = $request->Qname;
        $questions->options = $request->option;
        $questions->answer = $request->answer;
        $questions->save();
        return $request->all();
    }

    public function startExam(Request $request) {
        $questions = Questions::get();
        return view('start-exam', compact('questions'));
    }

    public function checkEmail(Request $request) {
        $email = $request->email;
        $emailCount = Student::where('email', $email)->get()->count();
        if ($emailCount > 0) {
            return Response::json(['status' => 1, 'message'=>'Email is Already Exist'], 200);
        } else {
            return Response::json(['status' => 2, 'message'=>'new email'], 200);
        }
    }

    public function submitAnswer(Request $request) {
        $questions = Questions::get();
        $mark = 0;
        foreach ($questions as $quest) {
            $id = "opt_".$quest->id;
            if ($request->$id) {
                if ($request->$id == $quest->answer) {
                    $mark++;
                }
            }
        }
        $student = new Student;
        $student->st_name = $request->cand_name;
        $student->email = $request->email;
        $student->mark = $mark;
        $student->save();
        return Response::json(['status' => 1, 'message'=>'Answer submited Successfully'], 200);
    }

    public function listStudents(Request $request) {
        $students = Student::get();
        return view('list-students', compact('students'));
    }
}
