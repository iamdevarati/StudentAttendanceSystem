<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
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
	label ,a{
		font-size: 200%;
	}
	table{
		color:white;
		font-weight: bold;
		font-size: 22px;
	}
	h1,h3{
		font-size: 400%;
	}
</style>
<body>
	<h1>Dashboard</h1>
	<ul class="nav nav-tabs nav-justified">
		<li class="active"><a data-toggle="tab" href="#routine"><strong>Routine</strong></a></li>
		<li><a data-toggle="tab" href="#attendance"><strong>Check Attendance</strong></a></li>
		<li><a data-toggle="tab" href="#personal"><strong>Personal Info</strong></a></li>
	</ul>

	<div class="tab-content">
		<div id="routine" class="tab-pane fade in active">
			<h3>Routine</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Day</th>
						<th>Period 1</th>
						<th>Period 2</th>
						<th>Period 3</th>
						<th>Break</th>
						<th>Period 4</th>
						<th>Period 5</th>
						<th>Period 6</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if(isset($rows) && $rows!=null){
							foreach($rows as $row) { ?>
						<tr>
							<td><strong><?= $row['day'] ?><strong></td>
							<td><?= $row['p1'] ?></td>
							<td><?= $row['p2'] ?></td>
							<td><?= $row['p3'] ?></td>
							<td>-----</td>
							<td><?= $row['p4'] ?></td>
							<td><?= $row['p5'] ?></td>
							<td><?= $row['p6'] ?></td>
						</tr>
						<?php }
					} ?>
				</tbody>
			</table>
		</div>
		<div id="attendance" class="tab-pane fade">
			<h3>Check Attendance</h3>
			<div class="container text-center">
				<form action="javascript:getAttendance()">
					<form-group>
						<label for="subject">Enter Subject Code : </label>
						<input type="text" name="subject" id="subject"> 
					</form-group>
					<input type="submit" value="Check" class="btn btn-primary btn-lg">
				</form>
			</div>
		</div>
		<div id="personal" class="tab-pane fade">
			<h3>Personal Info</h3>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('body').addClass('text-primary');
		function getAttendance(){
			var subject = $(#subject).value();

		}
	});
	
</script>
</html>