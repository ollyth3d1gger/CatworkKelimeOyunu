@extends('layouts.app')

@section('head')
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

  </script><script>
      window.onload = function() {
          if(!window.location.hash) {
              window.location = window.location + '#loaded';
              window.location.reload();
          }
      }
  </script>

@endsection

@section('top_bar')
  <nav class="navbar navbar-default navbar-static-top">
    <div class="logo-main-block">
      <div class="container">
        @if ($setting)
          <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
            <img src="{{asset('/images/logo/'. $setting->logo)}}" class="img-responsive" alt="{{$setting->welcome_txt}}">
          </a>
        @endif
      </div>
    </div>
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Branding Image -->
              @if($setting)
                <a title="CATWORK AKADEMI Anasayfa" class="tt" href="{{ url('/') }}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">             
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  <li><a href="{{ route('login') }}" title="Login">Giriş Yap</a></li>
                  <li><a href="{{ route('register') }}" title="Register">Kaydol</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Dashboard">Yönetim Paneli</a></li>
                      @elseif ($auth->role == 'S')
                        <li><a href="{{url('/admin/my_reports')}}" title="Dashboard">Yönetim Paneli</a></li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      </li>
                    </ul>
                 </li>
                @endguest
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('content')
<div class="container">
  @if ($auth)
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="home-main-block">

               

        @if($topic->show_ans==1)
        
         <div class="question-block">
            <h2 class="text-center main-block-heading">{{$topic->title}} ANSWER REPORT</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Question</th>                  
                  
                  <th style="color: green;">Correct Answer</th>
                  <th style="color: red;">Your Answer</th>
                  <th>Answer Explnation</th>
                </tr>
              </thead>
              <tbody>
                @php
                 $answers = App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->get();

                @endphp             
               
                @php
                $x = $count_questions;               
                $y = 1;
                @endphp
                @foreach($answers as $key=> $a)


                  @if($a->user_answer != "0" && $topic->id == $a->topic_id)
                    <tr>
                      <td>{{ $a->question->question }}</td>
                      <td>{{ $a->answer }}</td>
                      <td>{{ $a->user_answer }}</td>
                      <td>{{ $a->question->answer_exp }}</td>
                    </tr>
                    @php                
                      $y++;
                      if($y > $x){                 
                        break;
                      }
                    @endphp
                  @endif
                @endforeach              
               
              </tbody>
            </table>
            
          </div>

          @endif
          @php
            $mark = 0;
            $correct = 0;
               $answerdelete = App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->where('user_answer','0')->delete();
          @endphp
          @php
            $mark = 0;
            $time = 0;
            $correct = collect();
            $points = 0;
          @endphp
          @foreach ($answers as $answer)
            @if ($answer->answer == $answer->user_answer)
                @if(!empty($answer->points))
                @php
                  $points+=$answer->points;

                @endphp
                @else
                   @php
                     $mark++;
                     @endphp
                @endif
              @endif
          @endforeach
          @php
            $correct = $mark*$topic->per_q_mark;
            $correct += $points;
          @endphp

          @php

            DB::insert('insert into leaderboard (topic_id, user_id, points) values (?, ?, ?)',[$topic->id, Auth::user()->id, $correct  ]);
            $count = DB::table('leaderboard')->where('user_id','=',Auth::user()->id)->count();
            if($count >1){
            DB::insert('DELETE FROM leaderboard WHERE user_id='.Auth::user()->id.' ORDER BY id ASC LIMIT 1');
            }


          @endphp



          <div class="question-block">


            <h2 class="text-center">Yarışmaya katıldığın için Teşekkürler!<br>Test Soruların değerlendirildi.Klasik Sorular değerlendirildikten sonra Sıralama güncellenecektir.<br>Sıralamayı kontrol etmek için <a href="/leaderboard/{{ $topic->id }}">Tıklayın</a></h2>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
      });
    });
  </script>
@endsection
