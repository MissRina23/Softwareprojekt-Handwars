@extends('main')
@section('css')
    <link href="{!! asset('public/css/homeContactLegal.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')



    <div id="contactForm">
        <div id="innerContactForm">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            {!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}

            <div class="form-group">
                {!! Form::label('Your name') !!}
                {!! Form::text('name', null,
                    array('required', 'autocomplete'=>'off',
                          'class'=>'form-control',
                          'placeholder'=>'....')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your e-mail Address') !!}
                {!! Form::text('email', null,
                    array('required', 'autocomplete'=>'off',
                          'class'=>'form-control',
                          'placeholder'=>'....')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your message') !!}
                {!! Form::textarea('message', null,
                    array('required', 'autocomplete'=>'off',
                          'class'=>'form-control',
                          'placeholder'=>'....')) !!}
            </div>

            <div class="form-group">
                <button id='submitContact'>Contact us!</button>
            </div>
            {!! Form::close() !!}

            <div id="robotDiv">
                <img id="robots" class="img-responsive" src="{{secure_asset('public/img/starpics/C3PO.png')}}">
            </div>
        </div>
    </div>


@stop