
<link rel="stylesheet" type="text/css" href="{{ asset('/css/questions-tab.css')}}">

<div class="post-form-container">
	<form method="POST" action="{{ url('question-post/'.$id) }}" enctype="multipart/form-data">
		{{ csrf_field() }} 
		<textarea autofocus="true" autofocus="true" class="form-item post-description" name="description" placeholder="Write New Question..." rows="3" cols="50"></textarea>
		<button type="submit" class="form-item post-submit-btn">
			Add This Question
		</button>
	</form>
</div>

<div>

@foreach($questions as $question)
<div class="post-container">
	<table>
		<tr>
			<td>
				<div class="author-section setter-section text-center">
					<a href="{{ url('profile/'.$question->author) }}">
						<h3 class="author-name">{{ $question->author_name }}</h3>
					</a>
					<h5>Posted on</h5>
					<p class="date">21/01/2018</p>
				</div>
			</td>
			<td>
				<div class="description-section question-section">
					<a class="" href="{{ url('question/'.$question->id) }}"><p class="description">{{ $question->description }}</p></a>
				</div>
			</td>
		</tr>
	</table>
</div>
@endforeach

<div class="text-center">{{ $questions->links() }}</div>

</div>