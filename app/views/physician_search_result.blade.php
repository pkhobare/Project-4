<section>
	<h2>{{ $physician['name'] }}</h2>

	<p>			
	{{ $physician['speciality'] }} 
	</p>

	<p>
		@foreach($['hospitals'] as $hospital) 
			{{ $hospital->name }}
		@endforeach
	</p>
	<br>
	<a href='/physician/edit/{{ $physician->id }}'>Edit</a>
</section>