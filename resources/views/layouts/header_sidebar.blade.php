<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">
        <title>Employees - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
		<!--[if lt IE 9]>
			<script src="assets/js/php5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index.php" class="logo">
						<img src="{{asset('img/logo.png')}}" width="40" height="40" alt="">
					</a>
                </div>
                <div class="page-title-box pull-left">
					<h3>Employee Management System</h3>
                </div>
				<a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul class="nav navbar-nav navbar-right user-menu pull-right">
					
						
					<li class="dropdown">
						<a href="{{route('profile')}}" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
							<span class="user-img"><img class="img-circle" src="{{asset('img/user.jpg')}}" width="40" alt="Admin">
							<span class="status online"></span></span>
							<span>Admin</span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="profile.php">My Profile</a></li>
							<li><a href="edit-profile.php">Edit Profile</a></li>
							<li><a href="login.php">Logout</a></li>
						</ul>
					</li>
				</ul>
				<div class="dropdown mobile-user-menu pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="profile.php">My Profile</a></li>
						<li><a href="edit-profile.php">Edit Profile</a></li>
						<li><a href="login.php">Logout</a></li>
					</ul>
				</div>
            </div>
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							
							<li><a class="active" href="{{route('index')}}">All Employees</a></li>
							<!-- <li><a href="">Holidays</a></li> -->
							<!-- <li><a href=""><span>Leave Requests</span> <span class="badge bg-primary pull-right">1</span></a></li> -->
							<!-- <li><a href="{{route('attendance')}}">Attendance</a></li>
							<li><a href="{{route('departments')}}">Departments</a></li>
							<li><a href="{{route('designations')}}">Designations</a></li> -->
							<li><a href="{{route('add-attendance3')}}">Attendance</a></li>
							<li><a href="javascript:void(0);">Departments</a></li>
							<li><a href="javascript:void(0);">Designations</a></li>
							
						</ul>
						
					</div>
                </div>
            </div>