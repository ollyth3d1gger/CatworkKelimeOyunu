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
                                <li><a href="{{ "https://forrestsec.site/kurslar"}}" title="Kurslar">Kurslar</a></li>

                                @else
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if ($auth->role == 'A')
                                                <li><a href="{{url('/admin')}}" title="Dashboard">Dashboard</a></li>
                                            @elseif ($auth->role == 'S')
                                                <li><a href="{{url('/admin/my_reports')}}" title="Dashboard">Dashboard</a></li>
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
        </div>
    </nav>
@endsection

@section('content')
    <div class="container">
        @if ($auth)
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Yarışmacı</th>
                    <th scope="col">Başlık</th>
                    <th scope="col">Puan</th>
                    <th scope="col">Paylaş </th>
                </tr>
                </thead>
                <tbody>



                @php $key= 0; @endphp
                @foreach($leaderboard as $lead)
                    <tr>
                        @php $key++; @endphp
                        <th scope="row">{{$key}}</th>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->title }}</td>
                        <td>{{ $lead->points }} </td>
                        <td>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo url()->current();?>" class="social-button " id=""><span class="fa fa-facebook-official"></span></a>
                            <a href="https://twitter.com/intent/tweet?text=CATWORK Akademi Hafta Sonu Yarışması'nı {{ $lead->name }}, {{ $lead->points }} puan alarak {{ $key }}. tamamladı&amp;url=<?php echo url()->current();?>" class="social-button " id=""><span class="fa fa-twitter"></span></a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo url()->current();?>&amp;title=CATWORK AKADEMI Hafta Sonu Yarışması&amp;summary=CATWORK Akademi Hafta Sonu Yarışması'nı {{ $lead->name }}, {{ $lead->points }} puan alarak {{ $key }}. tamamladı" class="social-button " id=""><span class="fa fa-linkedin"></span></a>
                            <a href="https://wa.me/?text=CATWORK Akademi Hafta Sonu Yarışması'nı {{ $lead->name }}, {{ $lead->points }} puan alarak {{ $key }}. tamamladı.<?php echo url()->current();?>" class="social-button " id=""><span class="fa fa-whatsapp"></span></a>

                        </td>            </tr>

                @endforeach
                </tbody>
            </table>
        @endif
        @if (!$auth)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="home-main-block">
                        @if ($setting)

                        @endif
                        <blockquote>
                            Sonuçları görmek için lütfen  <a href="{{ route('login') }}">Giriş Yapın</a>
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
