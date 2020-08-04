<?php

namespace App\Http\Controllers;

use App\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\Topic;
use App\Answer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;


class MainQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $answer = Input::get('answer');
        htmlentities($answer, ENT_QUOTES, 'UTF-8', false);
        Input::merge(array('answer' => decrypt($answer)));
        $input = $request->all();
        Answer::create($input);

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
          $auth = Auth::user();

          if ($auth) {
            if ($answers = Answer::where('user_id', $auth->id)->get()) {
                $all_questions = collect();
                $q_filter = collect();
                foreach ($answers as $answer) {
                  $q_id = $answer->question_id;
                  $q_filter = $q_filter->push(Question::where('id', $q_id)->get());
                }
                $all_questions = $all_questions->push(Question::where('topic_id', $topic->id)->get());
                $all_questions = $all_questions->flatten();
                $q_filter = $q_filter->flatten();
                $questions = $all_questions->diff($q_filter);
                $questions = $questions->flatten();
                $questions = $questions->shuffle();
                return response()->json(["questions" => $questions, "auth"=>$auth, "topic" => $topic->id]);
            }
            $questions = collect();
            $questions = Question::where('topic_id', $topic->id)->get();
            $questions = $questions->flatten();
            $questions = $questions->shuffle();
            return response()->json(["questions" => $questions, "auth"=>$auth]);
          }
          return redirect('/');
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
    public function uphell(Request $request,$id)
    {
        $mark = Input::get('mark');
        htmlentities($mark, ENT_QUOTES, 'UTF-8', false);

        $question = Input::get('question_id');
        htmlentities($question, ENT_QUOTES, 'UTF-8', false);
        $user_id = Input::get('user_id');
        htmlentities($user_id, ENT_QUOTES, 'UTF-8', false);
        $topic_id = Input::get('topic_id');
        htmlentities($topic_id, ENT_QUOTES, 'UTF-8', false);

        $correct = Input::get('answer');
        htmlentities($correct, ENT_QUOTES, 'UTF-8', false);

        Answer::where('question_id','=',$question)->update(['user_answer' => decrypt($correct)]);
        $point = Answer::where('user_id' ,'=' ,$user_id)->where('user_answer','=','answer')->count();
        DB::table('leaderboard')->where('topic_id','=',$topic_id)->where('user_id','=', $user_id)->increment('points',$mark);
        $count = DB::table('leaderboard')->where('user_id','=',$user_id)->count();
        if($count >1){
            DB::insert('DELETE FROM leaderboard WHERE user_id='.$user_id.' ORDER BY id ASC LIMIT 1');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();
        return back()->with('deleted', 'Kayıt Silindi');
    }
}
