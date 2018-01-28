
@extends('layout')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/course.css')}}">

<style type="text/css">
	.cover-section{
		background-image: url("images/cover.jpg");
	}
</style>

@section('content')

<div class="container-fluid background">
	<div class="container">
		<div class="cover-section">
			<button class="picture-btn">Change Picture</button>
			<div class="course-name-bar">
				<h3 class="course-name">Advanced Database System</h3>
			</div>
		</div>
	</div>
</div>

@endsection