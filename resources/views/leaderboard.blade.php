
<link rel="stylesheet" type="text/css" href="{{ asset('/css/leaderboard.css')}}">

<div class="container">

	<div class="leaderboard-container">
		<table class="col-md-8 col-md-offset-2 ">
			<tr class="rank-bar">
				<th class="text-center">Name</th>
				<th class="text-center">Registration No</th>
				<th class="text-center">Score</th>
			</tr>
			@foreach($students as $student)
				<tr class="rank-bar">
					<td class="text-center">{{ $student["name"] }}</td>
					<td class="text-center">{{ $student["regno"] }}</td>
					<td class="text-center">{{ $student["score"] }}</td>
				</tr>
			@endforeach
		</table>
	</div>

</div>