<!doctype html>
<html lang="en" class="login">
<head>
	<meta charset="UTF-8">
	<title>GAME - Login</title>
	<link rel="stylesheet" href="/flatstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="/css/global.css" />
	<script type="text/javascript" src="/flatstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<form class="form-inline login-form" method="POST">
			@if (isset($message))
				<div class="alert alert-danger alert-dismissible" role="alert">
					{{$message}}
				</div>
			@endif
			<input type="text" placeholder="Username" name="username" />
			<input type="password" placeholder="Password" name="password" />
			<input type="submit" value="Login" class="btn btn-primary"/>
		</form>
	</div>
</body>
</html>
