
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/question.css')}}">

@include('font')

@section('content')

<div class="container-fluid question-top-bar text-center">
	<h3>Question</h3>
</div>

<div class="container question-body">
	<div class="headline-container">
		<h3><a href="#">{{ $question->description }}</a></h3>
		<h5>Posted by <a href="{{ url('profile/'.$question->author) }}">{{ $question->author_name }}</a></h5>
		@if( $question->score == -1 )
			<h5 class="point-bar">Point: N/A</h5>
		@else
			<h5 class="point-bar">Point: {{ $question->score }}</h5>
		@endif
		@if(Auth::user()->type == 1)
		<a href="#" class="change-point-btn" data-toggle="modal" data-target="#pointModal">Change Point</a>
		@endif
	</div>

	<!-- Modal -->
		<div class="modal fade" id="pointModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
			    <div class="modal-content">
			      	<div class="modal-header">
			        	<h3 class="modal-title text-center" id="exampleModalLabel">Change Point</h3>
			      	</div>
				    <div class="modal-body">
				        <form method="POST" action="{{ url('point/1/'.$question->_id) }}" enctype="multipart/form-data">
				        	{{ csrf_field() }}
				        	<input type="number" name="score" min="0" max="100" required="true">
				        	<button type="submit" class="btn btn-success">SUBMIT</button>
				        </form>
				    </div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
			      	</div>
			    </div>
		  	</div>
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
										@if( $answer->score == -1 )
											<h5 class="point-bar">Point: N/A</h5>
										@else
											<h5 class="point-bar">Point: {{ $answer->score }}</h5>
										@endif
										@if(Auth::user()->type == 1)
										<a href="#" class="change-point-btn" data-toggle="modal" data-target="#pointModal{{$answer->_id}}">Change Point</a>
										@endif
									</div>
								</td>
							</tr>
						</table>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="pointModal{{$answer->_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  	<div class="modal-dialog" role="document">
						    <div class="modal-content">
						      	<div class="modal-header">
						        	<h3 class="modal-title text-center" id="exampleModalLabel">Change Point</h3>
						      	</div>
							    <div class="modal-body">
							        <form method="POST" action="{{ url('point/2/'.$answer->_id) }}" enctype="multipart/form-data">
							        	{{ csrf_field() }}
							        	<input type="number" name="score" min="0" max="100" required="true">
							        	<button type="submit" class="btn btn-success">SUBMIT</button>
							        </form>
							    </div>
						      	<div class="modal-footer">
						        	<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
						      	</div>
						    </div>
					  	</div>
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