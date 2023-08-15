@extends('admin.layout.main')
@section('content')

<section class="content-header">
	<div class="row">
	   <div class="col-md-6 text-dark">DashBoard > <b>Tickets View</b>
	   </div>
	   <div class="col-md-6 text-right">
		   <a class="btn btn-danger" href="{{route('admin.support.index')}}">Back</a>
		</div>
    </div>
</section>
	<!-- Main content -->
<section class="content card">

	<div class="table-responsive mt-2">
		<table class="table table-bordered">
			<tr>
				<th>Title</th>
				<td colspan="2">{{$ticket->title}}</td>
				<th>Created Date</th>
				<td>{{$ticket->createdAt()}}</td>
				<th>Assigned To </th>
				<td>{{$ticket->assignedTo->name}}</td>
			</tr>
			<tr>
				<th>Description</th>
				<td colspan="6">{{$ticket->description}}</td>
			</tr>

			@foreach($ticket->reply as $val)
			<tr>
				<th>Reply Date</th>
				<td>{{$val->createdAt()}}</td>
				<th>Reply By </th>
				<td>{{$val->createdBy->name}}</td>
			</tr>
			 <tr>
				<th>Reply {{$loop->iteration}}</th>
				<td colspan="6">{{$val->description}}</td>
			 </tr>
			@endforeach
		</table>
	</div>
		
	<h3>Add Replay</h3>
	<form method="POST" action="{{route('admin.support.reply',Crypt::encrypt($ticket->id))}}">
		@csrf
		<div class="row">
			<div class="col-lg-12 pt-3">
				<textarea name="reply" class="form-control" rowspan="5" placeholder="Type Reply Here"></textarea>
			</div>						
		</div>
		<div class="pt-3"><br>
		  <input type="submit" name="submit" value="Reply Now" class="btn btn-success">
		</div>
	</form>
</section>
@endsection