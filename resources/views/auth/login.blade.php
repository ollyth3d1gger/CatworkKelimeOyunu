@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
      margin-bottom: 16px;
      background: #f2f2f2 url({{asset('captcha.php')}}) repeat-y;
      padding-left: 85px;
    }
  </style>
@endsection

@section('content')
  <div class="">
    <div class="container">
      @if (Session::has('error'))
        <div class="alert alert-danger sessionmodal">
          {{session('error')}}
        </div>
      @endif
      <div class="login-page">
        <div class="logo">
          @if ($setting)
            <a href="{{url('/')}}" title="{{$setting->welcome_txt}}"><img src="{{asset('/images/logo/'.$setting->logo)}}" class="login-logo img-responsive" alt="{{$setting->welcome_txt}}"></a>
          @endif
        </div>
        <h4 class="user-register-heading text-center">Giriş Yap</h4>
        <div class="row">
          @php
            $fb_status = App\Setting::select('fb_login')->where('id','=',1)->first();
            $g_status = App\Setting::select('google_login')->where('id','=',1)->first();
            $gitlab_status = App\Setting::select('gitlab_login')->where('id','=',1)->first();
          @endphp
          @if($fb_status->fb_login == 1)
          <div class="col-md-12">
            
            <a onclick="window.open('{{ route('sociallogin','facebook') }}','popup','width=600','height=600')" class="btn btn-facebook btn-block">
              <i class="fa fa-facebook"></i> Facebook
            </a>
            
          </div>
          @endif
          
          @if($g_status->google_login == 1)
          <div class="gap col-md-12">
             
             <a  onclick="window.open('{{ route('sociallogin','google') }}','popup','width=600','height=600')"  class="btn btn-google btn-block">
              <i class="fa fa-google"></i> Google
            </a>
          
          </div>
            @endif
          @if($gitlab_status->gitlab_login == 1)
            <div class="gap col-md-12">
              <a  onclick="window.open('{{ route('sociallogin','gitlab') }}','popup','width=600','height=600')"  class="btn btn-gitlab btn-block">
              <i class="fa fa-gitlab"></i> Gitlab
            </a>
            </div>
            @endif
        </div>
        <br>
        <form class="form login-form" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input style="background: #F2F2F2;" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-postanızı girin" required autofocus>
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input style="background: #F2F2F2;" id="password" type="password" class="form-control" name="password" placeholder="Şifrenizi Girin" required>
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
          <div style="display: flex" class="form-group">
            <div style="    margin-top: 23px;" class="col-sm">
              <span style="margin-top: 16px;" class="demo-input captcha-input"></span>
            </div>
            <div class="col-sm">
              <input style="background: #F2F2F2;margin-top: 16px;" name="captcha_code"  class="form-control">
            </div>




          </div>

          <div class="form-group">
            <div class="checkbox remember-me">
              <label>
                @include('flash::message')
              </label>

            </div>
          </div>
          <div class="form-group">
            <div class="checkbox remember-me">
              <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              </label>
               Beni Hatırla
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-wave">
                Giriş Yap
            </button>
            <p class="messege text-center">Henüz bir hesabın yok mu? <a href="{{url('/register')}}" title="Create An Account">Kaydol</a></p>
          </div>
          <div class="form-group text-center">
            <a href="{{url('/password/reset')}}" title="Forgot Password">Şifremi Unuttum?</a>
          </div>
        </form>
      </div>
    </div>
  </div>    
@endsection

@section('scripts')
  <script>
    $(function () {
      $( document ).ready(function() {
         $('.sessionmodal').addClass("active");
         setTimeout(function() {
             $('.sessionmodal').removeClass("active");
        }, 4500);
      });
    });
  </script>
@endsection
