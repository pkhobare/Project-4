@extends('_master')

@section('title')
	Welcome to DocFinder
@stop

@section('content')

	<br><br>

<h1> DocFinder App </h1>
<br><br>
<h2>Find a doctor with speciality:</h2>
<br><br>
	
   <!-- Populate all specialities from the physician db into a drop down list -->
    
   {{ Form::open(array('action' => 'PhysicianController@getIndex', 'method' => 'GET')) }}
		{{ Form::label('query','Search by hospital name/speciality:') }} &nbsp;
        {{ Form::text('query') }} &nbsp;
		{{ Form::submit('Search!') }}

	{{ Form::close() }}

{{ Form::open(array('action' => 'PhysicianController@getIndexBySpeciality', 'method' => 'GET')) }}
		{{ Form::label('query1','Search by speciality:') }} &nbsp;
        {{ Form::select('query1', $speciality) }}
		{{ Form::submit('Search by speciality!') }}

	{{ Form::close() }}


@stop           

@section('footer')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="/js/search.js"></script>
@stop