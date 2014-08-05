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
	<label for='query'>Search:</label>
	<input type='text' id='query' name='query' value='Internal Medicine'><br><br>

	<button id='practice'>Search</button><br><br>

	<div id='results'></div>           

@stop           

@section('footer')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="/js/search.js"></script>
@stop