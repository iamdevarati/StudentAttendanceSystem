<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<h1>Welcome to Hogwarts</h1>
	<?php if(isset($_GET['error']) && ($_GET['error']!=null)) { ?>
		<div class="error">
			<h3><?= $_GET['error']?></h3> 
		</div>
	<?php } ?>
		
	<form action="/login" method="post">
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" class="form-control">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" id="password" name="password" class="form-control">
		</div>
		<input type="submit" class="btn btn-primary btn-lg" value="Login">
	</form>
	</div>
</body>
</html>