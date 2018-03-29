
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/course.css')}}">

<style type="text/css">
	.cover-section{
		background-image: url( {{ url('images/cover.jpg')  }} );
	}
	#tab{{$tab}} {
		background-color: #17AFCA;
		color: #F3F3F3;
	}

	#tab{{$tab}}:hover{
		background-color: #17AFCA !important;
		color: #F3F3F3 !important;
	}
</style>

@include('font')

@section('content')

<div class="container-fluid background">
	<div class="container">
		<div class="cover-section">
			<button class="picture-btn">Change Picture</button>
			<div class="course-name-bar">
				<h3 class="course-name">{{ $course_name }}</h3>
			</div>
		</div>
		<div class="course-menu-section">
			@if( \Auth::user()->type == 2 )
				<a id="tab1" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/1') }}">Teacher Post</a><a id="tab2" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/2') }}">Students Post</a><a id="tab4" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/4') }}">Questions</a><a id="tab5" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/5') }}">Leaderboard</a>
			@else
				<a id="tab1" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/1') }}">Teacher Post</a><a id="tab2" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/2') }}">Students Post</a><a id="tab3" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/3') }}">Requests <span class="badge request-badge">{{$totalRequest}}</span></a><a id="tab4" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/4') }}">Questions</a><a id="tab5" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/5') }}">Leaderboard</a>
			@endif
		</div>

		@if( $tab == 1 )
		<div class="teacher-section">

		@if( \Auth::user()->type == 1 )
			<div class="post-form-container">
				<form method="POST" action="{{ url('course-post/'.$id) }}" enctype="multipart/form-data">
					{{ csrf_field() }} 
					<textarea autofocus="true" class="form-item post-description" name="description" placeholder="Start from here..." rows="3" cols="50"></textarea>
					<input class="form-item" type="file" name="file">
					<button type="submit" class="form-item post-submit-btn">
						POST
					</button>
				</form>
			</div>
		@endif

			<div>
				@foreach($posts as $post)
				<div class="post-container">
					<table>
						<tr>
							<td>
								<div class="author-section text-center">
									<div class="img-container">
										<img src="{{ url('images/profiles/'.$post->image_id.'.jpg') }}">
									</div>
									<h3 class="author-name">{{ $post->name }}</h3>
									<h5>Posted on</h5>
									<p class="date">21/01/2018</p>
								</div>
							</td>
							<td>
								<div class="description-section">
									<p class="description">{{ $post->description }}</p>
									@if( !empty($post->file_id) )
										<a role="button" class="download-btn" href="{{ url('download/'.$post->file_id) }}">Download File</a>
									@endif
								</div>
							</td>
						</tr>
					</table>
				</div>
				@endforeach
				<div class="text-center">{{ $posts->links() }}</div>
			</div>

		</div>
		@endif


		@if( $tab == 2 )
		<div class="students-section">
			
			@if( \Auth::user()->type == 2 )
			<div class="post-form-container">
				<form method="POST" action="{{ url('course-post/'.$id) }}" enctype="multipart/form-data">
					{{ csrf_field() }} 
					<textarea autofocus="true" autofocus="true" class="form-item post-description" name="description" placeholder="Start from here..." rows="3" cols="50"></textarea>
					<button type="submit" class="form-item post-submit-btn">
						POST
					</button>
				</form>
			</div>
			@endif

			<div>
				@foreach($posts as $post)
				<div class="post-container">
					<table>
						<tr>
							<td>
								<div class="author-section text-center">
									<div class="img-container">
										<img src="{{ url('images/profiles/'.$post->image_id.'.jpg') }}">
									</div>
									<h3 class="author-name">{{ $post->name }}</h3>
									<h5>Posted on</h5>
									<p class="date">21/01/2018</p>
								</div>
							</td>
							<td>
								<div class="description-section">
									<p class="description">{{ $post->description }}</p>
								</div>
							</td>
						</tr>
					</table>
				</div>
				@endforeach
				<div class="text-center">{{ $posts->links() }}</div>
			</div>

		</div>
		@endif

		@if( $tab == 3 )
		<div class="request-section">
			@include('request')
		</div>
		@endif

		@if( $tab == 4 )
		<div class="questions-section">
			@include('questions-tab')
		</div>
		@endif

		@if( $tab == 5 )
		<div class="leaderboard-section">
			@include('leaderboard')
		</div>
		@endif

	</div>
</div>

@endsection