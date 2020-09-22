@extends('main')

@section('content')
    <?php $url = substr(str_shuffle(MD5(microtime())), 0, 6); ?>
    <div id="homeText">
        <br>
        <p>Um ein Spiel zu starten gib deinen Namen ein</p><br>

        {!! Form::open(['url' => 'start/'.$url]) !!}
        <div class="form-group center-block">
            {!! Form:: label('name','Dein Name')!!}
            {!! Form:: text('name')!!}
        </div>
        <br>
        {{ Form::hidden('url', $url) }}
        <div class="form-group center-block">
            <button id='submit'>Los geht`s</button>
        </div>
        {!! Form::close() !!}
    </div>
    <img class="img-responsive center-block" width="300px" src="{{secure_asset('public/img/starpics/Vader.png')}}">
@stop