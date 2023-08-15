<!DOCTYPE html>
<html>
	@include('admin.layout.header')
	<body class="skin-blue">
		<div class="wrapper">
			@include('admin.layout.topbar')
		</div>

		<div class="content-wrapper">
			@include('admin.layout.sidebar')

			@if(session('success'))
				<div class="alert alert-success flashMsg" role="alert">{{ session('success') }}</div>
				@php session()->forget('success');@endphp
	        @endif

	        @if(session('error'))
				<div class="alert alert-danger flashMsg" role="alert">{{ session('error') }}</div>
				@php session()->forget('error');@endphp
	        @endif

			@yield('content')
		</div>
		@include('admin.layout.footer')
		@yield('js')
	</body>
</html>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;
var pusher = new Pusher('e0b113487bed740f027a', {
  cluster: 'ap2'
});

var channel = pusher.subscribe('StatusChanged'+{{Auth::user()->id}});
channel.bind('App\\Events\\StatusChanged', function(data) {
  //alert(JSON.stringify(data));
   var notification = JSON.parse(localStorage.getItem("notification") || "[]");
   notification.push(data['nt']);
   localStorage.setItem("notification", JSON.stringify(notification));
   setNotification();
});

setNotification();

function setNotification(){
	let notification = JSON.parse(localStorage.getItem("notification") || "[]");
	let nthtml='';
	$.each(notification,function(key,val){
		nthtml+=`<li>
			<a href="{{url('admin/support/view')}}/`+val['id']+`" class="ntClick" data-id="`+val['id']+`">
			  <span class="text-primary"><b>Status `+val['status']+`</b></span> of ticket `+val['title']+`
			</a>
		</li>`;
	});

	$(".notifications-menu ul ul").html(nthtml);
	$(".notifications-menu .label-warning").text(notification.length);
	if(notification.length>1){
	  $(".notifications-menu .footer").removeClass('hide');
	}
}

$(".ntClick").on("click",function(e){
  let id=$(this).attr('data-id');
  var notification = JSON.parse(localStorage.getItem("notification") || "[]");
    notification = notification.filter(function(obj) {
	  return obj.id!==id;
	});

   localStorage.setItem("notification", JSON.stringify(notification));
   setNotification();
});


</script>