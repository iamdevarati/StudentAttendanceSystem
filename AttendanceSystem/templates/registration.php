<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<h1>Registration</h1>

	<?php if(isset($_GET['error']) && ($_GET['error']!=null)) { ?>
		<div class="error">
			<?= $_GET['error']?>
		</div>
	<?php } ?>

<form action="/register" method="post" class="form-horizontal" role="form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="dept">Department:</label>
    <div class="col-sm-7 list-group" style="padding-left: 15px"> 
    	<select id="dept" name="dept" class="form-control">
	    	<option value="Defence" class="list-group-item active">Defence</option>
	    	<option value="Transfiguration" class="list-group-item">Transfiguration</option>
	    	<option value="Potions" class="list-group-item">Potions</option>
	  	</select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="section">Section:</label>
      <div class="col-sm-7 list-group" style="padding-left: 15px"> 
    	<select id="section" name="section" class="form-control">
	    	<option value="A" class="list-group-item active">A</option>
	    	<option value="B" class="list-group-item">B</option>
	  	</select>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="semester">Semester:</label>
    <div class="col-sm-7 list-group" style="padding-left: 15px"> 
    	<select id="semester" name="semester" class="form-control">
	    	<option value="one" class="list-group-item active">First</option>
	    	<option value="two" class="list-group-item">Second</option>
	    	<option value="three" class="list-group-item">Third</option>
	   	</select>
	</div>
  </div>


  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="uname" name="uname" placeholder="Choose a username">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="password">Password:</label>
    <div class="col-sm-7"> 
      <input type="password" class="form-control" id="password" name="password" placeholder="Choose a password">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="rtyPassword">Retype Password:</label>
    <div class="col-sm-7"> 
      <input type="password" class="form-control" id="rtyPassword" name="rtyPassword" placeholder="Re-enter the password">
    </div>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</body>
</html>