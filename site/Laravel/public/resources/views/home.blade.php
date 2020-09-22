@extends('main')

@section('css')
    <link href="{!! asset('public/css/homeContactLegal.css') !!}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <?php $url = substr(str_shuffle(MD5(microtime())), 0, 6); ?>
    <br>
    <div id="homeText">A long time ago in a galaxy far far away,
        the end drew near in one of the greatest fights of all time.
        Who will restore freedom to the galaxy and gain the upper hand in Handwars....
    </div>
    <br>

    <div id="homeBereich">

        <div id="homePageButtons">
            <button id="startButton" type="button" onclick="window.location='{{ url('game/'.$url) }}'">Start <span>a game you want, hmm?</span></button>
            <br>
            <button id="joinButton" type="button" onclick="window.location='{{ url('joinID') }}'">Join <span>the dark side!</span></button>
        </div>
        <br>

        <img id="yoda" src="{{secure_asset('public/img/starpics/yoda.png')}}">
        <img id="kyloren" src="{{secure_asset('public/img/starpics/Kylo.png')}}">

    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{!! asset('public/js/yodaKylo.js') !!}"></script>
@stop
