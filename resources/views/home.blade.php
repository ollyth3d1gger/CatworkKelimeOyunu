@extends('layouts.app')

@section('head')

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
  <style>

      .demo-error {
          display:inline-block;
          color:#FF0000;
          margin-left:5px;
      }
      .demo-input {
          width: 100%;
          border-radius: 5px;
          border: #CCC 1px solid;
          padding: 10px;
          margin-top: 5px;
      }
      .demo-btn {
          padding: 10px;
          border-radius: 5px;
          background: #478347;
          border: #325a32 1px solid;
          color: #FFF;
          font-size: 1em;
          width: 100%;
          cursor:pointer;
      }
      .demo-heading {
          font-size: 1.5em;
          border-bottom: #CCC 1px solid;
          margin-bottom:5px;
      }
      .demo-table {
          background: #dcfddc;
          border-radius: 5px;
          padding: 10px;
      }
      .demo-success {
          margin-top: 5px;
          color: #478347;
          background: #e2ead1;
          padding: 10px;
          border-radius: 5px;
      }
      .captcha-input {
          margin-bottom: 12px;
          background:#FFffff url({{asset('captcha.php')}}) repeat-y;
          padding-left: 85px;
      }
  </style>
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
                <a class="tt" title="CATWORK AKADEMI YARIŞMA PLATFORMU" href="{{url('/')}}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
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
                        Çıkış Yap
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
    <div class="quiz-main-block">
      <div class="row">
        @if ($topics)
          @foreach ($topics as $topic)
            <div class="col-md-4">
              <div class="topic-block">
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">{{$topic->title}}</span>
                    <p title="{{$topic->description}}">{{str_limit($topic->description, 120)}}</p>
                    <div class="row">
                      <div class="col-xs-6 pad-0">
                        <ul class="topic-detail">
                          <li>Soru Başına Puan <i class="fa fa-long-arrow-right"></i></li>
                          <li>Toplam Puan <i class="fa fa-long-arrow-right"></i></li>
                          <li>Toplam Soru <i class="fa fa-long-arrow-right"></i></li>
                          <li>Süre <i class="fa fa-long-arrow-right"></i></li>

                        </ul>
                      </div>
                      <div class="col-xs-6">
                        <ul class="topic-detail right">
                          <li>{{$topic->per_q_mark}}</li>
                          <li>
                            @php
                                $qu_count = 0;
                            @endphp
                            @foreach($questions as $question)
                              @if($question->topic_id == $topic->id)
                                @php 
                                  $qu_count++;
                                @endphp
                              @endif
                            @endforeach
                            {{$topic->per_q_mark*$qu_count}}
                          </li>
                          <li>
                            {{$qu_count}}
                          </li>
                          <li>
                            {{$topic->timer}} dakika
                          </li>


                        </ul>
                      </div>
                    </div>
                  </div>


               <div class="card-action text-center">
                  
                  @if (Session::has('added'))
                    <div class="alert alert-success sessionmodal">
                      {{session('added')}}
                    </div>
                  @elseif (Session::has('updated'))
                    <div class="alert alert-info sessionmodal">
                      {{session('updated')}}
                    </div>
                  @elseif (Session::has('deleted'))
                    <div class="alert alert-danger sessionmodal">
                      {{session('deleted')}}
                    </div>
                  @endif

                    @if($auth->topic()->where('topic_id', $topic->id)->exists())
                          Captcha Code: <div id="error-captcha" class="demo-error"><?php if(isset($error_message)) { echo $error_message; } ?></div><br/>
                          <input name="captcha_code" type="text" class="demo-input captcha-input form-control">
                          <a href="{{route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Yarışmaya Başla </a>
                    @else


                        <input type="hidden" name="topic_id" value="{{$topic->id}}"/>
                         @if(!empty($topic->amount)) 

                        <button type="submit" class="btn btn-default">Pay  <i class="{{$setting->currency_symbol}}"></i>{{$topic->amount}}</button>
                          @else
                              {!! Form::open(array('url' => "start_quiz/$topic->id")) !!}
                              {{ csrf_field() }}
                             <span style="color: wheat;">Captcha Kodu:</span>  @include('flash::message')
                              <input name="captcha_code" type="text" class="demo-input captcha-input form-control">
                          <button type="submit" class="btn btn-block" title="Start Quiz">Yarışmaya Başla </button>
                              {!! Form::close() !!}
                        @endif


                    @endif
                  </div>


                {{--   <div class="card-action">
                    @php 
                      $a = false;
                      $que_count = $topic->question ? $topic->question->count() : null;
                      $ans = $auth->answers;
                      $ans_count = $ans ? $ans->where('topic_id', $topic->id)->count() : null;
                      if($que_count && $ans_count && $que_count == $ans_count){
                        $a = true;
                      }
                    @endphp
                    <a href="{{$a ? url('start_quiz/'.$topic->id.'/finish') : route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz
                    </a>
                  </div> --}}
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  @endif
  @if (!$auth)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="home-main-block">
              @if ($setting)

              @endif
                <blockquote>
                  Yarışmaya katılmak için lütfen  <a href="{{ route('login') }}">Giriş Yapın</a>
                </blockquote>
            </div>
        </div>
    </div>
  @endif
</div>


@endsection

@section('scripts')

<script>
   $( document ).ready(function() {
       $('.sessionmodal').addClass("active");
       setTimeout(function() {
           $('.sessionmodal').removeClass("active");
      }, 4500);
    });
</script>


 @if($setting->right_setting == 1)
  <script type="text/javascript" language="javascript">
   // Right click disable
    $(function() {
    $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
    });
    });
      // End Right click disable
  </script>
@endif

@if($setting->element_setting == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
      $(function() {
      var isCtrl = false;
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}

      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>


@endif
@endsection
