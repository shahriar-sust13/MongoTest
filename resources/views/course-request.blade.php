
@extends('layouts.app')

@include('font')

@section('content')

<div class="container">
	<h3 class="text-center">You don't have the Permission</h3>
	
	<form class="text-center" method="GET" action="{{ url('/course-request/'.$id) }}">
		{{ csrf_field() }}
		<button type="submit">Request for This Course</button>
	</form>
	
</div>

@endsection