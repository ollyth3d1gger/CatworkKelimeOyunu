<?php

use App\User;
use App\Topic;
use App\Answer;
use App\copyrighttext;
use App\Question;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'home');

Auth::routes();

/*facebook login route*/
// Route::get('login/o_auth/facebook  ', 'Auth\LoginController@redirectToProvider');
// Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');



/*Social Login*/
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider')->name('sociallogin');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');


/*Google login route*/

// Route::get('login/google', 'Auth\LoginController@redirectToProvider');
// Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/faqs',function(){
  return view('faq');
})->name('faq.get');

Route::get('/home', function(){
  $topics = Topic::all();
  $questions = Question::all();
  return view('home', compact('topics', 'questions'));
});
Route::get('/leaderboard/{id}','LeaderboardController@index')->name('leaderboard');
Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => 'http://example.com/callback',
        'response_type' => 'token', 
        'scope' => '',
    ]);

    return redirect('http://your-app.com/oauth/authorize?'.$query);
});

Route::group(['middleware'=> 'isadmin'], function(){

  Route::delete('delete/sheet/quiz/{id}','TopicController@deleteperquizsheet')->name('del.per.quiz.sheet');

  Route::get('/admin', function(){

    $user = User::where('role', '!=', 'A')->count();
    $question = Question::count();
    $quiz = Topic::count();
    $user_latest = User::where('id', '!=', Auth::id())->orderBy('created_at', 'desc')->get();

    return view('admin.dashboard', compact('user', 'question', 'quiz', 'user_latest'));
    //remove the answer line comment
    // return view('admin.dashboard', compact('user', 'question', 'answer', 'quiz', 'user_latest'));

  });

  Route::delete('reset/response/{topicid}/{userid}','AllReportController@delete');

  Route::resource('/admin/all_reports', 'AllReportController');
  Route::resource('/admin/top_report', 'TopReportController');
  Route::resource('/admin/topics', 'TopicController');
  Route::resource('/admin/questions', 'QuestionsController');
  Route::post('/admin/questions/import_questions', 'QuestionsController@importExcelToDB')->name('import_questions');
  Route::resource('/admin/answers', 'AnswersController');
  Route::resource('/admin/settings', 'SettingController');


  Route::post('/admin/users/destroy', 'DestroyAllController@AllUsersDestroy');
  Route::post('/admin/answers/destroy', 'DestroyAllController@AllAnswersDestroy');

});

Route::resource('/admin/users', 'UsersController');
Route::get('/admin/profile', function(){
  if (Auth::check()) {
    return view('admin.users.profile');
  } else {
    return redirect('/');
  }
});
Route::get('/admin/my_reports', 'MyReportsController@index')->name('my_report');
Route::get('/admin/my_reports/{my_reports}', 'MyReportsController@show')->name('my_report_show');


Route::get('start_quiz/{id}', function($id){
    $topic = Topic::findOrFail($id);
    $answers = Answer::where('topic_id','=',$topic->topic_id)->first();
    return view('main_quiz', compact('topic','answers'));
})->name('start_quiz');

Route::post('start_quiz/{id}', function($id, \Illuminate\Http\Request $request){
    session_start();
    $code = $request->input('captcha_code');
    $value = $_SESSION["captcha_code"];
    if($code == $value){


        $topic = Topic::findOrFail($id);
        $answers = Answer::where('topic_id','=',$topic->topic_id)->first();
        flash('Hoş Geldiniz!');
        return view('main_quiz', compact('topic','answers'));
    } else {

        flash('Captcha Hatalı!');
        return redirect("/home");
    }

})->name('start_quiz');





Route::resource('start_quiz/{id}/quiz', 'MainQuizController');

Route::post('start_quiz/{id}/quiz/update', 'MainQuizController@uphell');

Route::get('start_quiz/{id}/finish', function($id){
  $auth = Auth::user();
  $topic = Topic::findOrFail($id);
  $questions = Question::where('topic_id', $id)->get();
  $count_questions = $questions->count();
  $answers = Answer::where('user_id',$auth->id)
              ->where('topic_id',$id)->get(); 

  if($count_questions != $answers->count()){
    foreach($questions as $que){ 
      $a = false;   
      foreach($answers as $ans){ 
        if($que->id == $ans->question_id){ 
          $a = true;
        }
      }
      if($a == false){  
        Answer::create([
          'topic_id' => $id,
          'user_id' => $auth->id,
          'question_id' => $que->id,
          'user_answer' => 0,
          'answer' => $que->answer,
        ]);
      }
    }
  }

  $ans= Answer::all();
  $q= Question::all();
  
  return view('finish', compact('ans','q','topic', 'answers', 'count_questions'));
});


Route::get('/admin/pages','PagesController@index')->name('pages.index');

Route::get('/admin/pages/add','PagesController@add')->name('pages.add');

Route::post('/admin/pages/add','PagesController@store')->name('pages.store');

Route::get('pages/{slug}','PagesController@show')->name('page.show');


Route::get('/admin/pages/edit/{id}','PagesController@edit')->name('pages.edit');

Route::put('/admin/pages/edit/{id}','PagesController@update')->name('pages.update');

Route::delete('/delete/pages/{id}','PagesController@destroy')->name('pages.delete'); 




Route::get('admin/moresettings/faq/','FAQController@index')->name('faq.index');
Route::get('admin/moresettings/faq/add','FAQController@create')->name('faq.add');
Route::post('/admin/moresettings/faq/insert','FAQController@store')->name('faq.store');
Route::get('/admin/moresettings/faq/edit/{id}','FAQController@edit')->name('faq.edit');
Route::put('/admin/moresettings/faq/edit/{id}','FAQController@update')->name('faq.update');
Route::delete('/faq/delete/{id}','FAQController@destroy')->name('faq.delete');




Route::get('admin/moresettings/copyright','CopyrighttextController@index')->name('copyright.index');

Route::put('admin/moresettings/copyright/{id}','CopyrighttextController@update')->name('copyright.update');



Route::get('admin/moresettings/socialicons/','SocialController@index')->name('socialicons.index');
Route::post('/admin/moresettings/socialicons/insert','SocialController@store')->name('social.store');
 Route::put('/admin/moresettings/socialicons/active/{id}','SocialController@active')->name('social.active');
 Route::put('/admin/moresettings/socialicons/deactive/{id}','SocialController@deactive')->name('social.deactive');
 Route::delete('/admin/moresettings/socialicons/delete/{id}','SocialController@destroy')->name('social.delete');
//env.
 Route::get('/admin/mail-settings','Configcontroller@getset')->name('mail.getset');
 Route::post('admin/mail-settings', 'Configcontroller@changeMailEnvKeys')->name('mail.update');

   Route::get('/admin/custom-style-settings', 'CustomStyleController@addStyle')->name('customstyle');
    Route::post('/admin/custom-style-settings/addcss','CustomStyleController@storeCSS')->name('css.store');
    Route::post('/admin/custom-style-settings/addjs','CustomStyleController@storeJS')->name('js.store');
//payment getway
 Route::get('/admin/mail','ApiController@setApiView')->name('api.setApiView');
  Route::post('/admin/mail','ApiController@changeEnvKeys')->name('api.update');

  Route::get('admin/sociallogin/','ApiController@facebook')->name('set.facebook');

  Route::post('admin/facebook','ApiController@updateFacebookKey')->name('key.facebook');

  Route::post('admin/google','ApiController@updateGoogleKey')->name('key.google');

  Route::post('admin/gitlab','ApiController@updategitlabKey')->name('key.gitlab');

  
  Route::delete('admin/ans/{id}','AnswersController@destroy')->name('ans.del');


// route for processing payment








