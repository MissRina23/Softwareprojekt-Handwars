@extends('main')
@section('content')
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <script>window.twttr = (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function (f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));</script>
    <script src="public/js/clipboard.min.js"></script>
    <script>
        var clipboard = new Clipboard('.btn');
        clipboard.on('success', function(e) {
            console.log(e);
        });
        clipboard.on('error', function(e) {
            console.log(e);
        });
    </script>
    <br>
    <div id="homeText">


        <p>Die Url zu deinem Spiel lautet :</p>

        <input type="text" id="foo" value="handwars.app/join/{{$url}}" readonly><br>
        <button class="btn btn-primary btn-xs" data-clipboard-target="#foo">
            <span class="glyphicon glyphicon-file">Copy</span>
        </button>
            <div class="fb-send" data-href="https://handwars.app/join/{{$url}}"></div>
            <a class="twitter-share-button"
               href="handwars.app/join{{$url}}?text=Spiele%20gegen%20mich%20eine%20Runde%20Handwars"
               data-size="small">Tweet</a>
            <a href="whatsapp://send?text= Ich%20fordere%20dich%20zu%20einer%20Runde%20Handwars%20herraus%20unter%20https%3A%2F%2Fhandwars.app%2Fjoin{{$url}}"
               class="WhatsAppLink" style="display:none;">Per
                WhatsApp empfehlen</a>
            <img class="img-responsive center-block " width="300px"
                 src="{{secure_asset('public/img/starpics/HanAndChuwie.png')}}"
                 alt="HanAndChuwie">
            <br>
            <div class="center-block">
                <img id="img-spinner" src="{{secure_asset('public/img/spinner.gif')}}" alt="Loading"/>
                Warte darauf, dass sich ein anderer Spieler verbindet
            </div>
    </div>
@stop