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
<p> Sign up to create a user account. Log in if already signed up and you will be taken to the page to start searching for physicians.</p>
@stop           

@section('footer')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="/js/search.js"></script>
@stop