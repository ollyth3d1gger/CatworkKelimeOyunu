<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Topic;
use App\Answer;
use App\Question;

class TopReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $topics = Topic::all();
         $questions = Question::all();
         return view('admin.top_reports.index', compact('questions', 'topics'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
         $topic = Topic::findOrFail($id);
         $answers = Answer::where('topic_id', $topic->id)->get();
         $students = User::where('id', '!=', Auth::id())->get();
         $c_que = Question::where('topic_id', $id)->count();

         $filtStudents = collect();
         foreach ($students as $student) {
           foreach ($answers as $answer) {
             if ($answer->user_id == $student->id) {
               $filtStudents->push($student);
             }
           }
         }

         $filtStudents = $filtStudents->unique();
         $filtStudents = $filtStudents->flatten();

         return view('admin.top_reports.show', compact('filtStudents', 'answers', 'c_que', 'topic'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
