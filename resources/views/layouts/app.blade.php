<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="{{asset('/images/logo/'. $setting->favicon)}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!--[if IE]>
    <link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
    <![endif]-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <title>{{$setting->welcome_txt}}</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{ asset('js/share.js') }}"></script>

<script>

    </script>
    <!-- Styles -->
    @yield('head')

<style>
    .loader-wrapper {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: #242f3f;
        display:flex;
        justify-content: center;
        align-items: center;
    }
    .loader {
        display: inline-block;
        width: 30px;
        height: 30px;
        position: relative;

        border: 4px solid #Fff;
        animation: loader 2s infinite ease;
    }
</style>
    <script>
        $(window).on("load",function(){
            $(".loader-wrapper").fadeOut("slow");

        });

    </script>

</head>
<body>
<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
    <div style="background: #f8f8f8;" id="app" style="position: relative;">
        @yield('top_bar')
        @yield('content')
        <br>
        <br>
    </div>
    @php
     $ct = App\copyrighttext::where('id','=',1)->first();
    @endphp
   <div style="padding:15px;color: #FFF;background-color:#317d95; position: fixed; width: 100%; bottom: 0;">
        <div class="container" >
            <div class="row">
                <div class="col-md-6">
                    {{ $ct->name }}
                </div>
                <div class="col-md-6">
                    @php
                    $si = App\SocialIcons::all();
                    @endphp
                    @foreach($si as $s)
                    @if($s->status==1)
                        <a target="_blank" title="Visit {{ $s->title }}" href="{{ $s->url }}"><img width="32px" src="{{ asset('images/socialicons/'.$s->icon) }}" alt="{{ $s->title }}" title="{{ $s->title }}" style="margin-top:-5px;"></a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>
