
@extends('layout')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/question.css')}}">

@include('font')

@section('content')

<div class="container-fluid question-top-bar text-center">
	<h3>Question</h3>
</div>

<div class="container question-body">
	<div class="headline-container">
		<h3><a href="#">{{ $question->description }}</a></h3>
		<h5>Posted by <a href="#">{{ $question->author_name }}</a></h5>
	</div>

	<div class="answers-section">
		
		@if( isset($answers) || Auth::user()->type == 1 )
			@if( count($answers) == 0 )
				<div class="alert alert-danger text-center answer-alert" role="alert">
				  	<strong>No Answers Yet!</strong>
				</div>
			@else
				@foreach($answers as $answer)
					<div class="post-container">
						<table>
							<tr>
								<td>
									<div class="author-section setter-section text-center">
										<a href="{{ url('profile/'. $answer->author) }}">
											<h3 class="author-name">{{ $answer->author_name }}</h3>
										</a>
										<h5>Posted on</h5>
										<p class="date">21/01/2018</p>
									</div>
								</td>
								<td>
									<div class="description-section question-section">
										<p class="description">{{ $answer->description }}</p>
									</div>
								</td>
							</tr>
						</table>
					</div>
				@endforeach
			@endif
		@else
			<div class="alert alert-success text-center answer-alert" role="alert">
			  	<strong>You have to post an answer to view other answers!</strong>
			</div>

			<div class="post-form-container">
				<form method="POST" action="{{ url('post-answer/'.$id) }}" enctype="multipart/form-data">
					{{ csrf_field() }} 
					<textarea autofocus="true" autofocus="true" class="form-item post-description" name="description" placeholder="Write Answer..." rows="3" cols="50" required="true"></textarea>
					<button type="submit" class="form-item post-submit-btn">
						Post This Answer
					</button>
				</form>
			</div>
		@endif

	</div>
</div>

@endsection