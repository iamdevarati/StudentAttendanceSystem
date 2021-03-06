<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Allura' rel='stylesheet' type='text/css'>
</head>
<style>
	body{ 
		background: url(background.jpg) no-repeat;
		background-size : cover;
		font-family: 'Allura', cursive;
	}
	label,a {
		font-size: 200%;
	}
	h1{
		font-size: 400%;
	}
	.error{
		font-weight: bold;
	}
</style>
<body>
	<div class="container">
		<h1>Welcome to Hogwarts</h1>
		<?php if(isset($_GET['error']) && ($_GET['error']!=null)) { ?>
			<div class="error text-danger">
				<h3><?= $_GET['error']?></h3> 
			</div>
		<?php } ?>
		
		<form action="/login" method="post">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" >
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" >
			</div>
			<div class="row">
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary btn-lg" value="Login" >
				</div>
				<div class="col-sm-2">
					<a href="/registration">Register Here!</a>
				</div>
			</div>
		</form>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('body').addClass('text-primary');
	});
</script>
</html>