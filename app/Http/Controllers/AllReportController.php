<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Topic;
use App\Answer;
use App\Question;
use Illuminate\Support\Facades\DB;



class AllReportController extends Controller
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
        return view('admin.all_reports.index', compact('topics', 'questions'));
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
        $mix = DB::select(DB::raw('select questions.question,topics.per_q_mark, answers.*,users.name ,users.id,topics.title from questions INNER JOIN answers ON questions.id = answers.question_id LEFT JOIN users on users.id = answers.user_id RIGHT JOIN topics on topics.id = answers.topic_id where questions.type="klasik" and topics.id='.e($id)));



        return view('admin.all_reports.show', compact('mix'));
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
    public function delete($topicid, $userid)
    {   
         $topicid.$userid;
         $answer = Answer::where('user_id',$userid)->where('topic_id','=',$topicid)->delete();
        
        return back()->with('deleted','Başarıyla Sıfırlandı !');
    }
}
