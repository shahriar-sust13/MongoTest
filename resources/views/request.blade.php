
<link rel="stylesheet" type="text/css" href="{{ asset('/css/request.css')}}">

@foreach($requests as $request)
	<div class="request-container">
		<a href="{{ url('user/'.$request->user_id) }}" class="requested-user">{{$request->name}}</a> Requested for this Course <span class="btn-span"><a class="accept-btn text-center" href="{{ url('accept/'.$id.'/'.$request->user_id) }}">Accept</a>  <a class="decline-btn text-center" href="{{ url('decline/'.$id.'/'.$request->user_id) }}">Decline</a></span>
	</div>
@endforeach

<div class="text-center">{{ $requests->links() }}</div>