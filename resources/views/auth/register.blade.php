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
    <div class="login-page">
      <div class="logo">
        @if ($setting)
          <a href="{{url('/')}}" title="{{$setting->welcome_txt}}"><img src="{{asset('/images/logo/'.$setting->logo)}}" class="img-responsive login-logo" alt="{{$setting->welcome_txt}}"></a>
        @endif
      </div>
      <h3 class="user-register-heading text-center">Kaydol</h3>
      <form class="form login-form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'İsim') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Tam İsminizi Girin']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          {!! Form::label('email', 'E-posta Adresi') !!}
          {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'eg: foo@bar.com']) !!}
          <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          {!! Form::label('password', 'Şifre') !!}
          {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Bir Şifre Girin']) !!}
          <small class="text-danger" style="color: red; background-color: #FFF;">{{ $errors->first('password') }}</small>
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          {!! Form::label('password_confirmation', 'Şifreni Onayla') !!}
          {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Şifrenizi Tekrar Girin']) !!}
          <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
        </div>
        {!! Form::label('captcha_code', 'Captcha Kodu') !!}
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
        <div class="mr-t-20">
          <button type="submit" class="btn btn-wave">Kaydol</button>
          <a href="{{url('/login')}}" class="text-center btn-block" title="Already Have Account">Bir Hesabın var mı ?</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
