
<header class="main-header">
	<!-- Logo -->
	<a href="{{url('/')}}" class="logo"><b>Addwebsolution</b></a>
	<!-- Header Navbar: style can be found in header.less -->
	
	<nav class="navbar navbar-static-top" role="navigation">
	  <!-- Sidebar toggle button-->
	  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>

	  <div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
			  
			  <li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <i class="fa fa-bell-o"></i><span class="label label-warning">0</span>
					</a>

					<ul class="dropdown-menu">
					  <li class="header hide">You have 10 notifications</li>
						<li>
							<ul class="menu">
								<li>
									<a href="#">
									<i class="fa fa-users text-aqua"></i>New Ticket
									</a>
								</li>
							</ul>
						</li>
					  <li class="footer hide"><a href="{{route('admin.support.index')}}">View all</a></li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="#" class="loginUser">
						@if(!empty(Auth::user())) {{Auth::user()->name}} @else Hello @endif
					</a>
			  </li>
			</ul>
	  </div>
	</nav>

</header>
