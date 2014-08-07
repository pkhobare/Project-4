@extends('_master')


@section('head')
	<link rel="stylesheet" href="docfinder.css" type="text/css">
@stop

@section('title')
	Physician Search Results
@stop

@section('content')

	<h1>Physicians</h1>

	@if(trim($query) != "")
		<p>You searched for &nbsp;<strong>{{{ $query }}}</strong></p>

		@if(count($physicians) == 0)
			<p>No matches found</p>
		@endif

	@endif

	@foreach($physicians as $doc)

		<section>
            <h2>{{ $doc['name'] }}</h2><br>
            <p> Speciality:&nbsp;{{ $doc['speciality']}}</p>    
            
			<h3>Hospitals</h3>
            <p>
				@foreach($doc['hospitals'] as $hospital) 
                     {{ $hospital->name }}<br><br>
				@endforeach
                <br>
			</p>
			<br>
<!--			<a href='/doc/edit/{{ $doc->id }}'>Edit</a>-->
		</section>

	@endforeach

@stop