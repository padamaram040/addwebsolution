@extends('admin.layout.main')
@section('content')
<section class="content">         
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
				  <h3>{{$ticket_closed+$ticket_open}}</h3>
				  <p>Total Tickets</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-add"></i>
				</div>
				<a href="{{route('admin.support.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-gray">
				<div class="inner">
				  <h3>{{$ticket_open}}</h3>
				  <p>Open Tickets</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-add"></i>
				</div>
				<a href="{{route('admin.support.index')}}?status=1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>


		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
				  <h3>{{$ticket_closed}}</h3>
				  <p>Closed Tickets</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-add"></i>
				</div>
				<a href="{{route('admin.support.index')}}?status=2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
</section>
@endsection

@section('js')
<script type="text/javascript">
	// for faq
	$(document).ready(function () {
		
	});
</script>
@endsection

