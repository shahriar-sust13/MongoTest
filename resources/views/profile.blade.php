
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/course.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('/css/profile.css')}}">

<style type="text/css">
	.cover-section{
		background-image: url( {{ url('images/cover.jpg')  }} );
	}
	#tab1 {
		background-color: #17AFCA;
		color: #F3F3F3;
		//box-shadow: inset 0px 0px 20px 2px rgba(0, 0, 0, 0.6);
	}
</style>

@include('font')

@section('content')

<div class="container-fluid background">
	<div class="container">
		<div class="cover-section">
			<button class="picture-btn"  style="visibility: hidden;">Change Picture</button>
			<div class="course-name-bar">
				<h3 class="course-name">{{ $user_name }} ({{$user_reg}})</h3>
			</div>
		</div>
		<div class="course-menu-section">
			@if( \Auth::user()->type == 1 )
			<a id="tab1" class="text-center menu-item disable-item" href="#">Courses</a><a id="tab2" class="text-center menu-item disable-item" href="{{ url('addcourse') }}">Add Course</a>
			@else
			<a id="tab1" class="text-center menu-item disable-item" href="#">Courses</a>
			@endif
		</div>

		<div class="profile-body">
			<div class="row">

				@foreach($courses as $course)
					<div class="col-md-3 course-container">
						<div class="course-section text-center">
							<a href="{{ url('course/'.$course->_id.'/1') }}">{{ $course->name }}</a>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	</div>
</div>

@endsection