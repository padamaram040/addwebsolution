<head>
	<meta charset="UTF-8">
	<title>Addwebsolution</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/x-icon" href="{{ asset('public/logo.png') }}">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

	<!-- Bootstrap 3.3.2 -->
	
	<link href="{{ asset('public/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />    
	<!-- FontAwesome 4.3.0 -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	
	<!-- Theme style -->
	<link href="{{ asset('public/admin/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link href="{{ asset('public/admin/css/skins/__all-skins.min.css') }}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

	<style>
		.no-print {
		display: none;
		}
		
	</style>
</head>