@extends('main')

@section('content')
    <div id="homeText">
        <p>Wähle deine Waffe:</p>
        <br>
        {!! Form::open(['action' => 'RealGameController@wait']) !!}
            <label>
                <input onChange="this.form.submit();" id="stein" type="radio" name="wahl" value="stein"/>
                <img width="300px" src="{{secure_asset('public/img/Stein.png')}}">
                <label>
                    <label>
                        <input onChange="this.form.submit();" id="schere" type="radio" name="wahl" value="schere"/>
                        <img width="300px" src="{{secure_asset('public/img/Schere.png')}}">
                    </label>
                    <label>
                        <input onChange="this.form.submit();" id="papier" type="radio" name="wahl" value="papier"/>
                        <img width="300px" src="{{secure_asset('public/img/Papier.png')}}">
                    </label>
                </label>
            </label>
        {!! Form::close() !!}
    </div>

    <img id="yoda" src="{{secure_asset('public/img/starpics/C3PO.png')}}">
    <img id="kyloren" src="{{secure_asset('public/img/starpics/R2D2.png')}}">
@stop