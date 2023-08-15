@extends('admin.layout.main')
@section('content')

<section class="content-header">
	<div class="row">
	   <div class="col-md-6 text-dark">DashBoard > <b>Add Tickets</b>
	   </div>
	   <div class="col-md-6 text-right">
		   <a class="btn btn-danger" href="{{route('admin.support.index')}}">Back</a>
		</div>
    </div>
</section>
	<!-- Main content -->
<section class="content card">
    <form method="POST" action="{{route('admin.support.addTicket')}}">
		@csrf
		<div class="row">
			<div class="col-md-4 pt-3">
				<label>Assigned To</label>
				<select class="form-control" name="assigned_to">
			        <option selected value="">Choose...</option>
			        @foreach($user as $val)
			         <option value="{{$val->id}}" @if($val->id==old('assigned_to')) selected @endif>{{$val->name}}</option>
			        @endforeach
			      </select>
			      @if($errors->has('assigned_to'))
					<span class="text-danger">{{ $errors->first('assigned_to') }} </span>
				  @endif
			</div>

			<div class="col-lg-4 pt-3">
				<label>Title <sup style="color:red;">*</sup></label>
				<input type="text" name="title" value="{{ old('title',isset($title)?$title:'') }}" class="form-control"> 
				@if($errors->has('title'))
					<span class="text-danger">{{ $errors->first('title') }} </span>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 pt-3">
				<label>Description <sup style="color:red;">*</sup></label>
				<textarea name="description" class="form-control" rowspan="5" placeholder="Type description Here"></textarea>
				@if($errors->has('description'))
					<span class="text-danger">{{ $errors->first('description') }} </span>
				@endif
			</div>						
		</div>
		<div class="pt-3">
		  <input type="submit" name="submit" value="Add Ticket" class="btn btn-success">
		</div>
	</form>
</section>
@endsection