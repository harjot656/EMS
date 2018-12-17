
<!DOCTYPE html>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="{{secure_asset('img/favicon.png')}}">
        <title>Login - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('css/style.css')}}">
		<!--[if lt IE 9]>
			<script src="assets/js/php5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Employee Management Login</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.php"><img src="{{secure_asset('img/logo2.png')}}" alt="Focus Technologies"></a>
							</div>
							<form name="login" method="POST" action="{{route('performLogin')}}">
								@csrf
								<div class="form-group form-focus">
									<label class="control-label">Username or Email</label>
									<input class="form-control floating" type="text" name="username">
								</div>
								@if ($errors->has('username'))
									    <div class="error-ems">{{ $errors->first('username') }}</div>
									@endif
								<div class="form-group form-focus">
									<label class="control-label">Password</label>
									<input class="form-control floating" type="password" name="password">	
								</div>
								@if ($errors->has('password'))
									    <div class="error-ems">{{ $errors->first('password') }}</div>
									@endif
								<div class="form-group text-center">
									<button class="btn btn-primary btn-block account-btn" type="submit">Login</button>
								</div>
								@if ($errors->has('errors'))
									    <div class="error-ems">{{ $errors->first('errors') }}</div>
									@endif
								
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="{{secure_asset('js/jquery-3.2.1.min.js')}}"></script>
        <script type="text/javascript" src="{{secure_asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{secure_asset('js/app.js')}}"></script>
    </body>

</html>
