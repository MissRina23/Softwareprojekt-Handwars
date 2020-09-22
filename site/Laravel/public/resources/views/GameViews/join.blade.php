@extends('main')
@section('content')<div id="homeText">
    <h1>Wir brauchen noch ein paar Angaben bevor es losgeht</h1>
    {!! Form::open(['url' => 'join/'.$url]) !!}
    <div class="form-group center-block">
        {!! Form:: label('name','Dein Name')!!}
        {!! Form:: text('name')!!}
    </div>
    {{ Form::hidden('url', $url) }}
    <div class ="form-group center-block">
        <button id='submit'>Los geht`s</button>
    </div>
    {!! Form::close() !!}
    </div>

    <img id="leia" class="center-block" src="{{secure_asset('public/img/starpics/leia.png')}}">
@stop