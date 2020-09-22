@extends('main')
@section('css')
    <link href="{!! asset('public/css/joinID.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div id="inhalt">
        <div id="enterYourIdText">Enter your friend's Game ID</div>

        {!! Form::open() !!}

        <div class="form-group">
            {{ Form::text('id', null, array( 'id' => 'id', 'autocomplete'=>'off')) }}

        </div>
        <div class="form-group">
            {{--<input type="button" id="gamelink" onclick="location.href='#';" value="Go"/>--}}
            <button id="gamelink" type="button" onclick="location.href='#';">Go <span>and join your friend</span></button>
        </div>
        {!! Form::close() !!}

        <img id="vader" src="{{secure_asset('public/img/starpics/Vader.png')}}">

    </div>

@stop
