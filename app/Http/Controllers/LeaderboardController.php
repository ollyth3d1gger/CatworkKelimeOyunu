<?php

namespace App\Http\Controllers;

use App\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Topic;
use App\Answer;
use App\Question;
use Illuminate\Support\Facades\Input;

class LeaderboardController extends Controller
{
    public function index($id){



        htmlentities($id, ENT_QUOTES, 'UTF-8', false);
        $leaderboard = DB::select(DB::raw('SELECT users.name, topics.title,leaderboard.points FROM leaderboard INNER JOIN topics ON topics.id = :id LEFT JOIN users on users.id = leaderboard.user_id ORDER by leaderboard.points DESC, time ASC'), ['id'=>$id]);

        return view('leaderboard',compact('leaderboard'));


    }
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        $answers = Answer::where('topic_id', $topic->id)->get();
        $students = User::all();
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

        return view('leaderboard', compact('filtStudents', 'answers', 'c_que', 'topic'));
    }

}
