<section>
	<h2>{{ $physician['name'] }}</h2>

	<p>			
	{{ "Speciality:".$physician['speciality'] }} 
	</p>

	<p>
        {{ "Hospitals visited:" }}
		@foreach($['hospitals'] as $hospital) 
			{{ $hospital->name.<br> }}
		@endforeach
	</p>
	<br>
<!--	<a href='/physician/edit/{{ $physician->id }}'>Edit</a>-->
</section>