
@extends('layout')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/course.css')}}">

<style type="text/css">
	.cover-section{
		background-image: url( {{ url('images/cover.jpg')  }} );
	}

	.teacher-section{
		@if( $tab == 1 )
			display: block;
		@else 
			display: none;
		@endif
	}

	.students-section{
		@if( $tab == 2 )
			display: block;
		@else 
			display: none;
		@endif
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
				<h3 class="course-name">Advanced Database System</h3>
			</div>
		</div>
		<div class="course-menu-section">
			<a id="tab1" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/1') }}">Teacher Post</a><a id="tab2" class="text-center menu-item disable-item" href="{{ url('course/'.$id.'/2') }}">Students Post</a>
		</div>

		<div class="teacher-section">

			<div class="post-form-container">
				<form method="POST" action="{{ url('') }}" enctype="multipart/form-data">
					{{ csrf_field() }} 
					<textarea autofocus="true" class="form-item post-description" name="description" placeholder="Start from here..." rows="3" cols="50"></textarea>
					<input class="form-item" type="file" name="file">
					<button type="submit" class="form-item post-submit-btn">
						POST
					</button>
				</form>
			</div>

			<div class="post-container">
				<table>
					<tr>
						<td>
							<div class="author-section text-center">
								<div class="img-container">
									<img src="{{ url('images/enam.jpg') }}">
								</div>
								<h3 class="author-name">Enamul Hasan</h3>
								<h5>Posted on</h5>
								<p class="date">21/01/2018</p>
							</div>
						</td>
						<td>
							<div class="description-section">
								<p class="description">This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post.</p>
								<a role="button" class="download-btn">Download File</a>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="post-container">
				<table>
					<tr>
						<td>
							<div class="author-section text-center">
								<div class="img-container">
									<img src="{{ url('images/enam.jpg') }}">
								</div>
								<h3 class="author-name">Enamul Hasan</h3>
								<h5>Posted on</h5>
								<p class="date">21/01/2018</p>
							</div>
						</td>
						<td>
							<div class="description-section">
								<p class="description">This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post.</p>
								<a role="button" class="download-btn">Download File</a>
							</div>
						</td>
					</tr>
				</table>
			</div>

		</div>



		<div class="students-section">
			
			<div class="post-form-container">
				<form method="POST" action="{{ url('') }}" enctype="multipart/form-data">
					{{ csrf_field() }} 
					<textarea autofocus="true" autofocus="true" class="form-item post-description" name="description" placeholder="Start from here..." rows="3" cols="50"></textarea>
					<button type="submit" class="form-item post-submit-btn">
						POST
					</button>
				</form>
			</div>

			<div class="post-container">
				<table>
					<tr>
						<td>
							<div class="author-section text-center">
								<div class="img-container">
									<img src="{{ url('images/enam.jpg') }}">
								</div>
								<h3 class="author-name">Enamul Hasan</h3>
								<h5>Posted on</h5>
								<p class="date">21/01/2018</p>
							</div>
						</td>
						<td>
							<div class="description-section">
								<p class="description">This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post.</p>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="post-container">
				<table>
					<tr>
						<td>
							<div class="author-section text-center">
								<div class="img-container">
									<img src="{{ url('images/enam.jpg') }}">
								</div>
								<h3 class="author-name">Enamul Hasan</h3>
								<h5>Posted on</h5>
								<p class="date">21/01/2018</p>
							</div>
						</td>
						<td>
							<div class="description-section">
								<p class="description">This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post. This is a Test Post.</p>
							</div>
						</td>
					</tr>
				</table>
			</div>

		</div>

	</div>
</div>

@endsection