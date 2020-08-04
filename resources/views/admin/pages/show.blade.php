@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
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
          <div class="col-md-4">
            <div class="navbar-header">
              <!-- Branding Image -->
              @if($setting)
                <a href="{{ url('/') }}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
              @endif
            </div>
          </div>

          <div class="col-md-4">
            {{-- @foreach ($si as $s)
              @if($s->status=="1")
              <a target="_blank" href="{{ $s->url }}"><img style="margin:5px 5px 0px;" width="32px" title="{{ $s->title }}" src="{{asset('/images/socialicons/'. $s->icon)}}"></a>
              @endif
            @endforeach --}}
          </div>

          <div class="col-md-4">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <ul class="nav navbar-nav">
                &nbsp;
              </ul>
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  
                  <li><a href="{{ route('login') }}" title="Login">Giriş Yap</a></li>
                  <li><a href="{{ route('register') }}" title="Register">Kaydol</a></li>
                  <li><a href="{{ "https://forrestsec.site/kurslar"}}" title="Kurslar">Kurslar</a></li>

                
                @else
                  
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Dashboard">Panel</a></li>
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
                 <li><a href="{{ route('faq.get') }}">FAQ</a></li>
                @endguest

            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('content')
 <div class="container">
   <h1>{{ $page->name }}</h1>
   <hr>

   {!! $page->details !!}
 </div>

@endsection
