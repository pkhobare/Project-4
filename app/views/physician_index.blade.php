@extends('_master')


@section('head')
	<link rel="stylesheet" href="docfinder.css" type="text/css">
@stop

@section('title')
	Physician Search Results
@stop

@section('content')

	<h2>Physicians</h2>

	@if(trim($query) != "")
		<p>You searched for &nbsp;<strong>{{{ $query }}}</strong></p>

		@if(count($physicians) == 0)
			<p>No matches found</p>
		@endif

	@endif

	@foreach($physicians as $doc)

		<section>
            <h3>{{ $doc['name'] }}</h3>

			<p>			
			     {{ $doc['speciality']}} 
			</p>
			<p>
				@foreach($doc['hospitals'] as $hospital) 
					{{ $hospital->name }}
				@endforeach
			</p>
			<br>
			<a href='/doc/edit/{{ $doc->id }}'>Edit</a>
		</section>

	@endforeach

@stop