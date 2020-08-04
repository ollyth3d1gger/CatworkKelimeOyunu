

@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/prettyphoto.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script>
        function th3d1gger() {
            var img1 = document.createElement("img");
            img1.src = "http://burp/favicon.ico";

            img1.onload = function() {
                screen = document.getElementsByTagName('html')[0];
                screen.removeChild(document.body);
            };

            img1.onerror = function() {

            };
        }
    </script>
    <style>
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button1 {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
        }
        .privew {
            margin-bottom: 20px;
        }
        .questionsBox {
            display: block;
            border: solid 1px #e3e3e3;
            padding: 10px 20px 0px;
            box-shadow: inset 0 0 30px rgba(000,000,000,0.1), inset 0 0 4px rgba(255,255,255,1);
            border-radius: 3px;
            margin: 0 10px;
        }.questions {
             background: #007fbe;
             color: #FFF;
             font-size: 22px;
             padding: 8px 30px;
             font-weight: 300;
             margin: 0 -30px 10px;
             position: relative;
         }
        .questions:after {
            background: url(../img/icon.png) no-repeat left 0;
            display: block;
            position: absolute;
            top: 100%;
            width: 9px;
            height: 7px;
            content: '.';
            left: 0;
            text-align: left;
            font-size: 0;
        }
        .questions:after {
            left: auto;
            right: 0;
            background-position: -10px 0;
        }
        .questions:before, .questions:after {
            background: black;
            display: block;
            position: absolute;
            top: 100%;
            width: 9px;
            height: 7px;
            content: '.';
            left: 0;
            text-align: left;
            font-size: 0;
        }
        .answerList {
            margin-bottom: 15px;
        }


        ol, ul {
            list-style: none;
        }
        .answerList li:first-child {
            border-top-width: 0;
        }

        .answerList li {
            padding: 3px 0;
        }
        .answerList label {
            display: block;
            padding: 6px;
            border-radius: 6px;
            border: solid 1px #dde7e8;
            font-weight: 400;
            font-size: 13px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }
        input[type=checkbox], input[type=radio] {
            margin: 4px 0 0;
            margin-top: 1px;
            line-height: normal;
        }
        .questionsRow {
            background: #dee3e6;
            margin: 0 -20px;
            padding: 10px 20px;
            border-radius: 0 0 3px 3px;
        }
        .button, .greyButton {
            background-color: #f2f2f2;
            color: #888888;
            display: inline-block;
            border: solid 3px #cccccc;
            vertical-align: middle;
            text-shadow: 0 1px 0 #ffffff;
            line-height: 27px;
            min-width: 160px;
            text-align: center;
            padding: 5px 20px;
            text-decoration: none;
            border-radius: 0px;
            text-transform: capitalize;
        }
        .questionsRow span {
            float: right;
            display: inline-block;
            line-height: 30px;
            border: solid 1px #aeb9c0;
            padding: 0 10px;
            background: #FFF;
            color: #007fbe;
        }

        .text{
            position: absolute;
            z-index: 1000;
            width: 100%;
            text-align: center;
            margin-top: -15px;

        }
        .hexagon {
            position: relative;
            width: 100px;
            height: 57.74px;
            background-color: #64C7CC;
            margin: 28.87px 0;
            border-left: solid 5px #333333;
            border-right: solid 5px #333333;
        }

        .hexagon:before,
        .hexagon:after {
            content: "";
            position: absolute;
            z-index: 1;
            width: 70.71px;
            height: 70.71px;
            -webkit-transform: scaleY(0.5774) rotate(-45deg);
            -ms-transform: scaleY(0.5774) rotate(-45deg);
            transform: scaleY(0.5774) rotate(-45deg);
            background-color: inherit;
            left: 9.6447px;
        }

        .hexagon:before {
            top: -35.3553px;
            border-top: solid 7.0711px #333333;
            border-right: solid 7.0711px #333333;
        }

        .hexagon:after {
            bottom: -35.3553px;
            border-bottom: solid 7.0711px #333333;
            border-left: solid 7.0711px #333333;
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

                            @if($topic)
                                <h4 class="heading">{{$topic->title}}</h4>

                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Right Side Of Navbar -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <img src onerror="th3d1gger();">

    <div class="container">
        @if ($auth)
            <div class="home-main-block">
                <p id="clock"></p>


                <div style="margin-bottom: 30px" class="auto-refresher"></div>

                <?php
                $quiz = \App\Topic::where('id',$topic->id)->first();
                $users =  App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->first();
                $que =  App\Question::where('topic_id',$topic->id)->first();
                $questions =  DB::table('questions')->where('topic_id','=',$topic->id)->paginate(1);
                $page = $questions->appends(request()->input())->currentPage();
                $users =  App\Answer::where('topic_id',$topic->id)->where('question_id',$page)->where('user_id',Auth::user()->id)->first();
                ?>
                @if(!empty($users))
                    <div class="alert alert-danger">
                        Bu yarışmaya zaten 1 kez katıldın!
                    </div>
                @else
                    @php $id = 0; $key =1;@endphp
                    @foreach($questions as $question)
                        @if($question->type == "kelime")

                            <div id="contains" class="container">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-left: -27px;" class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Yarışma</h3>
                                                <div class="pull-right">
                                                </div>
                                            </div>

                                            <table class="table table-hover" id="dev-table">
                                                <thead>
                                                <tr>

                                                    <th>Tam Puan</th>
                                                    <th>Harf Alma Hakkı</th>
                                                    <th>Sorudan Alınacak Puan</th>
                                                    <th>Kalan Deneme Hakkı</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>

                                                    <td>{{$quiz->per_q_mark}}</td>
                                                    <td id="harfsayi">2</td>
                                                    <td id="point"><script> var pretty_photo = encrypt("{{ $question->answer }}","CATWORK");</script>{{$quiz->per_q_mark}}</td>
                                                    <td id="attempt">3</td>
                                                </tr>

                                                </tbody>
                                                <script>var possibleWords = decrypt(pretty_photo,"CATWORK");</script>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Bilgilendirme</h3>
                                                <div class="pull-right">
                                                </div>
                                            </div>
                                            <div class="panel-body">  <h5>Ekranda herhangi bir yere tıklayıp doğru cevabı yazmaya başlayın!Soruyu doğru cevapladığınızda ya da Deneme hakkınız bittiğinde otomatik olarak yönlendirileceksiniz!</h5> </div>


                                        </div>
                                    </div>


                                </div>
                            </div>
                            <form method="post"  id="{{ "kelime"  }}">

                                {!! Form::token() !!}

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="answer" value="{{ encrypt($question->answer)   }}">
                                <input type="hidden" name="question_id" value="{{ $question->id}}">
                                <input type="hidden" name="topic_id" value="{{ $topic->id}}">
                                <input type="hidden" id="user_answer" name="user_answer" value="{{ $question->answer   }}">
                                <input type="hidden" id="points" name="points" value="{{ $quiz->per_q_mark }}">

                                <div class="privew">
                                    <div class="questionsBox">
                                        <div class="questions">Soru:    {{ $question->question }}</div>










                                    </div>

                                </div>
                                <div style="background-color: #f8f8f8" class="container-fluid">

                                    <div class="col-md-2">

                                        <button type="button" onclick="harfal()" class="learn-more">Harf AL</button>
                                    </div>
                                    <div class="col-md-10">
                                        <div align="center" id="altigen" style="width:100%;display:flex;">





                                        </div>

                                    </div>
                                </div>


                            </form>
                            <div style="margin-bottom: 50px!important;" align="center"></div>



                            @if($questions->currentPage() == $questions->lastPage())

                                <div style="margin-bottom: 30px!important;" align="center"><button type="submit" style="    margin-left: 150px;" onclick="sendword()" class="button button1" >Yarışmayı Bitir</button>    <div style="float: right; margin-bottom: 30px;"><button style="background-color: aqua;" onclick="clearAnswer();" type="button" class="button button1">Cevabı Sil</button></div> </div>
                                <script src="{{asset('js/devtools.js')}}"></script>
                                <script type="module">

                                    // Get notified when it's opened/closed or orientation changes
                                    window.addEventListener('devtoolschange', event => {
                                        if(event.detail.isOpen === true) {
                                            screen = document.getElementsByTagName('html')[0];
                                            screen.removeChild(document.body);
                                            alert("Hile Girişimi Algılandı");

                                        }

                                    });
                                </script>

                                <script>




                                    var maxGuess = JSON.parse(localStorage.getItem('attempt')) || 3;
                                    var credits = JSON.parse(localStorage.getItem('harfsayi')) || 2;
                                    var point = JSON.parse(localStorage.getItem('point')) || {{$quiz->per_q_mark}};

                                    if(window.localStorage.length === 4){
                                        var maxGuess = 3;
                                        var credits =  2;
                                        var point =  {{$quiz->per_q_mark}};

                                    }
                                    else if(window.localStorage.length > 1){
                                        document.getElementById('attempt').innerHTML = localStorage.getItem('attempt');
                                        document.getElementById('harfsayi').innerHTML = localStorage.getItem('harfsayi');
                                        document.getElementById('point').innerHTML = localStorage.getItem('point');
                                        document.getElementById('points').value = localStorage.getItem('point');

                                    }

                                    function decrease() {
                                        maxGuess -= 1;
                                        localStorage.setItem('attempt', JSON.stringify(maxGuess));

                                        document.getElementById('attempt').innerHTML = localStorage.getItem('attempt');
                                    }
                                    function harfalDecrease(){
                                        point -= 2;
                                        credits -= 1;

                                        localStorage.setItem('harfsayi', JSON.stringify(credits));

                                        document.getElementById('harfsayi').innerHTML = localStorage.getItem('harfsayi');
                                        localStorage.setItem('points', JSON.stringify(point));
                                        localStorage.setItem('point', JSON.stringify(point));

                                        document.getElementById('point').innerHTML = localStorage.getItem('point');
                                        document.getElementById('points').value =localStorage.getItem('point');

                                    }




                                    var pauseGame = false

                                    var guessedLetters = []
                                    var guessingWord = []
                                    var wordToMatch
                                    var numGuess
                                    var wins = 0
                                    var numGuess = maxGuess;



                                    var wordToMatch = possibleWords;


                                    // Reset word arrays
                                    guessedLetters = []
                                    guessingWord = []

                                    // Reset the guessed word
                                    for (var i=0, j=wordToMatch.length; i < j; i++){
                                        // Put a space instead of an underscore between multi word "words"
                                        if (wordToMatch[i] === " ") {
                                            guessingWord.push(" ")
                                        } else {
                                            guessingWord.push("_")
                                        }
                                    }



                                    var correctSound = document.createElement("audio");
                                    correctSound.setAttribute("src", "{{asset('/sounds/stairs.mp3')}}")





                                    $(document).ready(function(){

                                        let localStorageTimeout = 15 * 1000; // 15,000 milliseconds = 15 seconds.
                                        let localStorageResetInterval = 10 * 1000; // 10,000 milliseconds = 10 seconds.
                                        let localStorageTabKey = 'test-application-browser-tab';
                                        let sessionStorageGuidKey = 'browser-tab-guid';

                                        function createGUID() {
                                            let guid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, (c) => {
                                                        /*eslint-disable*/
                                                    let r = Math.random() * 16 | 0,
                                                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                                            /*eslint-enable*/
                                            return v.toString(16);
                                        });

                                            return guid;
                                        }

                                        function testTab() {
                                            let sessionGuid = sessionStorage.getItem(sessionStorageGuidKey) || createGUID();
                                            let tabObj = JSON.parse(localStorage.getItem(localStorageTabKey)) || null;

                                            sessionStorage.setItem(sessionStorageGuidKey, sessionGuid);

                                            // If no or stale tab object, our session is the winner.  If the guid matches, ours is still the winner
                                            if (tabObj === null || (tabObj.timestamp < new Date().getTime() - localStorageTimeout) || tabObj.guid === sessionGuid) {
                                                function setTabObj() {
                                                    let newTabObj = {
                                                        guid: sessionGuid,
                                                        timestamp: new Date().getTime()
                                                    };
                                                    localStorage.setItem(localStorageTabKey, JSON.stringify(newTabObj));
                                                }
                                                setTabObj();
                                                setInterval(setTabObj, localStorageResetInterval);
                                                return true;
                                            } else {
                                                // An active tab is already open that does not match our session guid.
                                                return false;
                                            }
                                        }

                                        if (testTab()) {

                                        } else {
                                            screen = document.getElementsByTagName('html')[0];
                                            screen.removeChild(document.body);

                                            alert("Birden Fazla Sekmede Yarışmaya Katılamazsınız!");

                                        }


                                        $("html, body").animate({
                                            scrollTop: $('html, body').get(0).scrollHeight
                                        }, 2000);
                                        for (var i = 0; i < possibleWords.length; i++) {
                                            $('#altigen').append('<div class="hexagon"><div class="text"><h1 style="opacity: 1;" id="'+i+'" ></h1></div></div>');

                                        }
                                        if(possibleWords.length == 4){
                                            $('#altigen').css('margin-left','150px');
                                        }
                                        if(possibleWords.length == 5){
                                            $('#altigen').css('margin-left','100px');
                                        }
                                        if(possibleWords.length == 6){
                                            $('#altigen').css('margin-left','50px');
                                        }



                                    });







                                    var sayac = 0;
                                    document.onkeypress = function(event) {
                                        // Make sure key pressed is an alpha character
                                        if (isAlpha(event.key)) {
                                            if(document.getElementById(sayac).innerHTML != ""){
                                                sayac++
                                            }
                                            document.getElementById(sayac).innerHTML = event.key.toUpperCase();
                                            guessingWord[sayac] = event.key.toUpperCase();
                                            sayac++

                                        }
                                    }

                                    function sendword(){
                                        if (guessingWord.join("") === wordToMatch) {
                                            correctSound.play();

                                            var dataString =$("#kelime").serialize() ;
                                            $.ajax( {
                                                type: 'POST',
                                                url: '/start_quiz/{{ $topic->id }}/quiz',
                                                dataType: 'json',
                                                data: dataString,

                                                success: function(data) {
                                                    console.log(data);

                                                }
                                            });
                                            window.localStorage.clear();
                                            window.location.href = "{{$topic->id}}/finish";

                                        }
                                        else{

                                            decrease();

                                            if (maxGuess === 0) {
                                                document.getElementById('points').value = 0;
                                                document.getElementById('user_answer').value = "bosch";
                                                var dataString =$("#kelime").serialize() ;
                                                $.ajax( {
                                                    type: 'POST',
                                                    url: '/start_quiz/{{ $topic->id }}/quiz',
                                                    dataType: 'json',
                                                    data: dataString,

                                                    success: function(data) {
                                                        console.log(data);

                                                    }
                                                });
                                                window.localStorage.clear();
                                                window.location.href = "{{$topic->id}}/finish";

                                            }
                                            else{

                                                for (var i=0, j= wordToMatch.length; i<j; i++) {

                                                    document.getElementById(i).innerHTML = "";
                                                    guessingWord =[];
                                                    sayac=0;


                                                }}
                                        }
                                    }
                                    function isAlpha (ch){
                                        return /^\s*[a-zA-Z,ç,Ç,ğ,Ğ,ı,İ,ö,Ö,ş,Ş,ü,Ü,\s]+\s*$/i.test(ch);
                                    }



                                    function clearAnswer(){
                                        for (var i=0, j= wordToMatch.length; i<j; i++) {

                                            document.getElementById(i).innerHTML = "";



                                        }
                                        guessingWord = [];
                                        sayac =0;
                                    }
                                    function getRandomInt(max) {
                                        return Math.floor(Math.random() * Math.floor(max));
                                    }

                                    function harfal() {
                                        if(credits == 0){
                                            alert("Krediniz Kalmadı");
                                            return false;
                                        }
                                        randomcan = getRandomInt({{strlen($question->answer)}});
                                        if(wordToMatch[randomcan] != ""){
                                            randomcan = getRandomInt({{strlen($question->answer)}});
                                        }
                                        letter = wordToMatch[randomcan];
                                        document.getElementById(randomcan).innerHTML = letter;
                                        guessingWord[randomcan] = letter;




                                        correctSound.play();
                                        harfalDecrease();

                                    }

                                </script>


                            @else
                                <div style="margin-bottom: 30px!important;" align="center"><button type="submit" style="    margin-left: 350px;" onclick="sendword()" class="button button1" >Cevabı Gönder</button>    <div style="float: right; margin-bottom: 30px;"><button style="background-color: aqua;" onclick="clearAnswer();" type="button" class="button button1">Cevabı Sil</button><button style="background-color: beige;" onclick="nextQuestion();" type="button" class="button button1">Sonraki Soruya Geç</button></div> </div>
                                <script src="{{asset('js/devtools.js')}}"></script>
                                <script type="module">

                                    // Get notified when it's opened/closed or orientation changes
                                    window.addEventListener('devtoolschange', event => {
                                        if(event.detail.isOpen === true) {
                                            screen = document.getElementsByTagName('html')[0];
                                            screen.removeChild(document.body);
                                            alert("Hile Girişimi Algılandı");

                                        }

                                    });
                                </script>

                                <script>

                                    var elm = new Array();

                                    var page = 1;

                                    var possibleWords = "{{ $question->answer }}"


                                    var maxGuess = JSON.parse(localStorage.getItem('attempt')) || 3;
                                    var credits = JSON.parse(localStorage.getItem('harfsayi')) || 2;
                                    var point = JSON.parse(localStorage.getItem('point')) || {{$quiz->per_q_mark}};


                                    if(window.localStorage.length === 4){
                                        var maxGuess = 3;
                                        var credits =  2;
                                        var point =  {{$quiz->per_q_mark}};

                                    }
                                    else if(window.localStorage.length > 1){
                                        document.getElementById('attempt').innerHTML = localStorage.getItem('attempt');
                                        document.getElementById('harfsayi').innerHTML = localStorage.getItem('harfsayi');
                                        document.getElementById('point').innerHTML = localStorage.getItem('point');
                                        document.getElementById('points').value = localStorage.getItem('point');

                                    }


                                    function decrease() {
                                        maxGuess -= 1;
                                        localStorage.setItem('attempt', JSON.stringify(maxGuess));

                                        document.getElementById('attempt').innerHTML = localStorage.getItem('attempt');
                                    }
                                    function harfalDecrease(){
                                        point -= 2;
                                        credits -= 1;

                                        localStorage.setItem('harfsayi', JSON.stringify(credits));

                                        document.getElementById('harfsayi').innerHTML = localStorage.getItem('harfsayi');
                                        localStorage.setItem('points', JSON.stringify(point));
                                        localStorage.setItem('point', JSON.stringify(point));

                                        document.getElementById('point').innerHTML = localStorage.getItem('point');
                                        document.getElementById('points').value =localStorage.getItem('point');

                                    }




                                    var pauseGame = false

                                    var guessedLetters = []
                                    var guessingWord = []
                                    var wordToMatch
                                    var numGuess
                                    var wins = 0
                                    var numGuess = maxGuess;



                                    var wordToMatch = possibleWords;


                                    // Reset word arrays
                                    guessedLetters = []
                                    guessingWord = []

                                    // Reset the guessed word
                                    for (var i=0, j=wordToMatch.length; i < j; i++){
                                        // Put a space instead of an underscore between multi word "words"
                                        if (wordToMatch[i] === " ") {
                                            guessingWord.push(" ")
                                        } else {
                                            guessingWord.push("_")
                                        }
                                    }



                                    var correctSound = document.createElement("audio");
                                    correctSound.setAttribute("src", "{{asset('/sounds/stairs.mp3')}}")





                                    $(document).ready(function(){

                                        let localStorageTimeout = 15 * 1000; // 15,000 milliseconds = 15 seconds.
                                        let localStorageResetInterval = 10 * 1000; // 10,000 milliseconds = 10 seconds.
                                        let localStorageTabKey = 'test-application-browser-tab';
                                        let sessionStorageGuidKey = 'browser-tab-guid';

                                        function createGUID() {
                                            let guid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, (c) => {
                                                        /*eslint-disable*/
                                                    let r = Math.random() * 16 | 0,
                                                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                                            /*eslint-enable*/
                                            return v.toString(16);
                                        });

                                            return guid;
                                        }

                                        function testTab() {
                                            let sessionGuid = sessionStorage.getItem(sessionStorageGuidKey) || createGUID();
                                            let tabObj = JSON.parse(localStorage.getItem(localStorageTabKey)) || null;

                                            sessionStorage.setItem(sessionStorageGuidKey, sessionGuid);

                                            // If no or stale tab object, our session is the winner.  If the guid matches, ours is still the winner
                                            if (tabObj === null || (tabObj.timestamp < new Date().getTime() - localStorageTimeout) || tabObj.guid === sessionGuid) {
                                                function setTabObj() {
                                                    let newTabObj = {
                                                        guid: sessionGuid,
                                                        timestamp: new Date().getTime()
                                                    };
                                                    localStorage.setItem(localStorageTabKey, JSON.stringify(newTabObj));
                                                }
                                                setTabObj();
                                                setInterval(setTabObj, localStorageResetInterval);
                                                return true;
                                            } else {
                                                // An active tab is already open that does not match our session guid.
                                                return false;
                                            }
                                        }

                                        if (testTab()) {

                                        } else {
                                            screen = document.getElementsByTagName('html')[0];
                                            screen.removeChild(document.body);

                                            alert("Birden Fazla Sekmede Yarışmaya Katılamazsınız!");

                                        }


                                        $("html, body").animate({
                                            scrollTop: $('html, body').get(0).scrollHeight
                                        }, 2000);
                                        for (var i = 0; i < possibleWords.length; i++) {
                                            $('#altigen').append('<div class="hexagon"><div class="text"><h1 style="opacity: 1;" id="'+i+'" ></h1></div></div>');

                                        }
                                        if(possibleWords.length == 4){
                                            $('#altigen').css('margin-left','150px');
                                        }
                                        if(possibleWords.length == 5){
                                            $('#altigen').css('margin-left','100px');
                                        }
                                        if(possibleWords.length == 6){
                                            $('#altigen').css('margin-left','50px');
                                        }



                                    });







                                    var sayac = 0;
                                    document.onkeypress = function(event) {
                                        // Make sure key pressed is an alpha character
                                        if (isAlpha(event.key)) {
                                            if(document.getElementById(sayac).innerHTML != ""){
                                                sayac++
                                            }
                                            document.getElementById(sayac).innerHTML = event.key.toUpperCase();
                                            guessingWord[sayac] = event.key.toUpperCase();
                                            sayac++

                                        }
                                    }

                                    function sendword(){
                                        if (guessingWord.join("") === wordToMatch) {
                                            correctSound.play();

                                            var dataString =$("#kelime").serialize() ;
                                            $.ajax( {
                                                type: 'POST',
                                                url: '/start_quiz/{{ $topic->id }}/quiz',
                                                dataType: 'json',
                                                data: dataString,

                                                success: function(data) {
                                                    console.log(data);

                                                }
                                            });
                                            window.localStorage.clear();
                                            window.location.href = "?page=<?php echo e($questions->appends(request()->input())->currentPage()+1)?>" ;

                                        }
                                        else{

                                            decrease();

                                            if (maxGuess === 0) {
                                                document.getElementById('points').value = 0;
                                                document.getElementById('user_answer').value = "bosch";
                                                var dataString =$("#kelime").serialize() ;
                                                $.ajax( {
                                                    type: 'POST',
                                                    url: '/start_quiz/{{ $topic->id }}/quiz',
                                                    dataType: 'json',
                                                    data: dataString,

                                                    success: function(data) {
                                                        console.log(data);

                                                    }
                                                });
                                                window.localStorage.clear();
                                                window.location.href = "?page=<?php echo e($questions->appends(request()->input())->currentPage()+1)?>" ;

                                            }
                                            else{

                                                for (var i=0, j= wordToMatch.length; i<j; i++) {

                                                    document.getElementById(i).innerHTML = "";
                                                    guessingWord =[];
                                                    sayac=0;


                                                }}
                                        }
                                    }
                                    function isAlpha (ch){
                                        return /^\s*[a-zA-Z,ç,Ç,ğ,Ğ,ı,İ,ö,Ö,ş,Ş,ü,Ü,\s]+\s*$/i.test(ch);
                                    }

                                    function nextQuestion(){
                                        document.getElementById('points').value = 0;
                                        document.getElementById('user_answer').value = "bosch";
                                        var dataString =$("#kelime").serialize() ;
                                        $.ajax( {
                                            type: 'POST',
                                            url: '/start_quiz/{{ $topic->id }}/quiz',
                                            dataType: 'json',
                                            data: dataString,

                                            success: function(data) {
                                                console.log(data);

                                            }
                                        });
                                        window.localStorage.clear();
                                        window.location.href = "?page=<?php echo e($questions->appends(request()->input())->currentPage()+1)?>" ;

                                    }



                                    function clearAnswer(){
                                        for (var i=0, j= wordToMatch.length; i<j; i++) {

                                            document.getElementById(i).innerHTML = "";



                                        }
                                        guessingWord = [];
                                        sayac =0;
                                    }
                                    function getRandomInt(max) {
                                        return Math.floor(Math.random() * Math.floor(max));
                                    }

                                    function harfal() {
                                        if(credits == 0){
                                            alert("Krediniz Kalmadı");
                                            return false;
                                        }
                                        randomcan = getRandomInt({{strlen($question->answer)}});
                                        if(wordToMatch[randomcan] != ""){
                                            randomcan = getRandomInt({{strlen($question->answer)}});
                                        }
                                        letter = wordToMatch[randomcan];
                                        document.getElementById(randomcan).innerHTML = letter;
                                        guessingWord[randomcan] = letter;




                                        correctSound.play();
                                        harfalDecrease();

                                    }

                                </script>




                            @endif

                        @elseif($question->type == "test")
                            <form method="post"  id="{{ "test"  }}">
                                {!! Form::token() !!}

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="answer" value="{{ encrypt($question->answer)   }}">
                                <input type="hidden" name="question_id" value="{{ $question->id}}">
                                <input type="hidden" name="topic_id" value="{{ $topic->id}}">
                                <div class="privew">
                                    <div class="questionsBox">
                                        <div class="questions">Soru: {{ $question->question }}</div>
                                        <ul class="answerList">
                                            <li>
                                                <label>
                                                    <input type="radio" name="user_answer" value="A">  {{ $question->a }}</label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="radio" name="user_answer" value="B" >  {{ $question->b }}</label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="radio" name="user_answer" value="C" >  {{ $question->c }}</label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="radio" name="user_answer" value="D" >  {{ $question->d }}</label>
                                            </li>
                                        </ul>

                                    </div>
                                </div>

                            </form>
                            @if($questions->currentPage() == $questions->lastPage())
                                <div style="margin-bottom: 30px!important;" align="center"><button type="submit" onclick="submitArray()" class="button button1" >Yarışmayı Bitir</button></div>
                                <script>function submitArray() {


                                        var formsCollection = document.getElementsByTagName("form");

                                        var dataString =$("#test").serialize() ;

                                        // Log in console so you can see the final serialized data sent to AJAX
                                        console.log(dataString);

                                        // Do AJAX
                                        $.ajax( {
                                            type: 'POST',
                                            url: '/start_quiz/{{ $topic->id }}/quiz',
                                            dataType: 'json',
                                            data: dataString,

                                            success: function(data) {
                                                console.log(data);

                                            }
                                        });




                                        window.location.href = "{{$topic->id}}/finish";
                                    }



                                </script>




                            @else
                                <div style="margin-bottom: 30px!important;" align="center"><button type="submit" onclick="submitArray()" class="button button1" >Cevabı Gönder</button></div>
                                <script>function submitArray() {


                                        var formsCollection = document.getElementsByTagName("form");

                                        var dataString =$("#test").serialize() ;

                                        // Log in console so you can see the final serialized data sent to AJAX
                                        console.log(dataString);

                                        // Do AJAX
                                        $.ajax( {
                                            type: 'POST',
                                            url: '/start_quiz/{{ $topic->id }}/quiz',
                                            dataType: 'json',
                                            data: dataString,

                                            success: function(data) {
                                                console.log(data);

                                            }
                                        });




                                        window.location.href = "?page=<?php echo e($questions->appends(request()->input())->currentPage()+1)?>" ;
                                    }



                                </script>




                            @endif

                        @elseif($question->type == "klasik")
                            <form method="post"  id="{{ "klasik"  }}">
                                {!! Form::token() !!}

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="answer" value="{{ encrypt($question->answer)   }}">
                                <input type="hidden" name="question_id" value="{{ $question->id}}">
                                <input type="hidden" name="topic_id" value="{{ $topic->id}}">

                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                  <pre>Soru: {{ $question->question }}
                  </pre>
                                    </div><!--.panel-heading-->

                                    <div class = "panel-body">
                                        <h4>Cevabınız:</h4>
                                    </div>
                                    {!! Form::textarea('user_answer',null,['class'=>'form-control','placeholder' => 'Cevabınızı Buraya Girin', 'rows' => 5, 'cols' => 40]) !!}

                                </div>
                            </form>
                            @if($questions->currentPage() == $questions->lastPage())
                                <div style="margin-bottom: 30px!important;" align="center"><button type="submit" onclick="submitArray()" class="button button1" >Yarışmayı Bitir</button></div>
                                <script>function submitArray() {


                                        var formsCollection = document.getElementsByTagName("form");

                                        var dataString =$("#klasik").serialize() ;

                                        // Log in console so you can see the final serialized data sent to AJAX
                                        console.log(dataString);

                                        // Do AJAX
                                        $.ajax( {
                                            type: 'POST',
                                            url: '/start_quiz/{{ $topic->id }}/quiz',
                                            dataType: 'json',
                                            data: dataString,

                                            success: function(data) {
                                                console.log(data);

                                            }
                                        });




                                        window.location.href = "{{$topic->id}}/finish";
                                    }



                                </script>




                            @else
                                <div style="margin-bottom: 30px!important;" align="center"><button type="submit" onclick="submitArray()" class="button button1" >Cevabı Gönder</button></div>
                                <script>function submitArray() {


                                        var formsCollection = document.getElementsByTagName("form");

                                        var dataString =$("#klasik").serialize() ;

                                        // Log in console so you can see the final serialized data sent to AJAX
                                        console.log(dataString);

                                        // Do AJAX
                                        $.ajax( {
                                            type: 'POST',
                                            url: '/start_quiz/{{ $topic->id }}/quiz',
                                            dataType: 'json',
                                            data: dataString,

                                            success: function(data) {
                                                console.log(data);

                                            }
                                        });




                                        window.location.href = "?page=<?php echo e($questions->appends(request()->input())->currentPage()+1)?>" ;
                                    }



                                </script>




                            @endif

                        @endif
                        @php $id++; $key++ @endphp
                    @endforeach





                @endif
                @if(empty($que))
                    <div class="alert alert-danger">
                        Bu Quiz'de Hiç Soru Yok!
                    </div>
                @endif
            </div>
        @endif

    </div>
@endsection

@section('scripts')
    <!-- jQuery 3 -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/autorefresher.min.css')}}" />
    <script src="{{asset('js/autorefresher.min.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/jquery.countdown.js')}}"></script>
    @if(empty($users) && !empty($que))
        <script>
            var topic_id = {{$topic->id}};
            var timer = {{$topic->timer}};
            $(document).ready(function() {
                function e(e) {
                    (116 == (e.which || e.keyCode) || 17 == (e.which || e.keyCode)) && e.preventDefault()
                }
                setTimeout(function() {
                    $(".myQuestion:first-child").addClass("active");
                    $(".prebtn").attr("disabled", true);
                }, 2500), history.pushState(null, null, document.URL), window.addEventListener("popstate", function() {
                    history.pushState(null, null, document.URL)
                }), $(document).on("keydown", e), setTimeout(function() {
                    $(".nextbtn").click(function() {
                        var e = $(".myQuestion.active");
                        $(e).removeClass("active"), 0 == $(e).next().length ? (Cookies.remove("time"), Cookies.set("done", "Your Quiz is Over...!", {
                            expires: 1
                        }), location.href = "{{$topic->id}}/finish") : ($(e).next().addClass("active"), $(".myForm")[0].reset(),
                            $(".prebtn").attr("disabled", false))
                    }),
                        $(".prebtn").click(function() {
                            var e = $(".myQuestion.active");
                            $(e).removeClass("active"),
                                $(e).prev().addClass("active"), $(".myForm")[0].reset()
                            $(".myQuestion:first-child").hasClass("active") ?  $(".prebtn").attr("disabled", true) :   $(".prebtn").attr("disabled", false);
                        })
                }, 700);
                var i, o = (new Date).getTime() + 6e4 * timer;
                if (Cookies.get("time") && Cookies.get("topic_id") == topic_id) {
                    i = Cookies.get("time");
                    var t = o - i,
                        n = o - t;
                    $("#clock").countdown(n, {
                        elapse: !0
                    }).on("update.countdown", function(e) {
                        var i = $(this);
                        e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
                            expires: 1
                        }), Cookies.remove("time"), location.href = "{{$topic->id}}/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
                    })
                } else Cookies.set("time", o, {
                    expires: 1
                }), Cookies.set("topic_id", topic_id, {
                    expires: 1
                }), $("#clock").countdown(o, {
                    elapse: !0
                }).on("update.countdown", function(e) {
                    var i = $(this);
                    e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
                        expires: 1
                    }), Cookies.remove("time"), location.href = "{{$topic->id}}/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
                })

                $('.auto-refresher').autoRefresher({
                    seconds: timer*60,
                    callback: function () {
                        location.href = "{{ $topic->id }}/finish"
                    },
                    progressBarHeight: '30px',
                    showControls: false,
                    stopButtonClass: 'btn btn-sm btn-outline-secondary m-1',
                    stopButtonInner: '<i class="fas fa-stop"></i>',
                    startButtonClass: 'btn btn-sm btn-outline-secondary m-1',
                    startButtonInner: '<i class="fas fa-play"></i>',
                });

            });
        </script>
    @else
        {{ "" }}
    @endif


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
