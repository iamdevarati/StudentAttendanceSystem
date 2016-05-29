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
		background: url(dashboard.jpg) no-repeat;
		background-size : cover;
		font-family: 'Allura', cursive;
	}
	label ,li, button, p{
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
	.attendance{
		display: none;
	}
	.container {
		padding:  20px 40px;
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
			<div class="col-sm-4">
				<h3>Check Attendance</h3>	
			</div>
			<div class="col-sm-4">
				<div class="container ">
					<div class="dropdown">
					<button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown">Select Subject
					<span class="caret"></span></button>
						<ul class="dropdown-menu" id="subjects">
							<?php foreach($att as $a)  {?>
								<li><a href="#"><?= $a['subjectCode'] ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>	
			</div>
			<div class="col-sm-4">
				<?php foreach($att as $a)  {?>
					<div class="attendance" id="<?= $a['subjectCode'] ?>">
						<h3><?= $a['subjectCode'] ?></h3>
						<p> Classes attended : <?= $a['att'] ?></p>
					</div>
				<?php } ?>
			</div>
			
			
		</div>
		<div id="personal" class="tab-pane fade">
			<h3>Personal Info</h3>
		</div>
	</div>
</body>
<script>
	$(document).ready(function(){
		$('body').addClass('text-primary');
	});
	$("#subjects li a").click(function(){
		var subject = $(this).text();
		$(".attendance").css("display","none");
		$("#"+subject).css("display","block");
	});
	
</script>
</html>