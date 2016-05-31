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
	.error{
		font-size:23px; 
		color:red;
		padding:10px;
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
		<li class="active"><a data-toggle="tab" href="#routine" id='rout'><strong>Routine</strong></a></li>
		<li><a data-toggle="tab" href="#attendance" id='att'><strong>Check Attendance</strong></a></li>
		<li><a data-toggle="tab" href="#personal" id='per'><strong>Personal Info</strong></a></li>
	</ul>
	<div class="tab-content">
		<div id="routine" class="tab-pane fade in active">
			<h3>Routine</h3>
			<?php if(isset($_GET['errorRout']) && ($_GET['errorRout']!=null)) { ?>
					<div class="error" style="font-size:23px; color:red">
						<?= $_GET['errorRout']?> 
					</div>
				<?php } ?>
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
							<td><?php echo  (isset($row['p1'])&&($row['p1']!=null)) ? $row['p1'] : '-----'; ?></td>
							<td><?php echo  (isset($row['p2'])&&($row['p2']!=null)) ? $row['p2'] : '-----'; ?></td>
							<td><?php echo  (isset($row['p3'])&&($row['p3']!=null)) ? $row['p3'] : '-----'; ?></td>
							<td>-----</td>
							<td><?php echo  (isset($row['p4'])&&($row['p4']!=null)) ? $row['p4'] : '-----'; ?></td>
							<td><?php echo  (isset($row['p5'])&&($row['p5']!=null)) ? $row['p5'] : '-----'; ?></td>
							<td><?php echo  (isset($row['p6'])&&($row['p6']!=null)) ? $row['p6'] : '-----'; ?></td>
						</tr>
						<?php }
					} ?>
				</tbody>
			</table>
		</div>
		<div id="attendance" class="tab-pane fade"></div>
		<div id="personal" class="tab-pane fade">
			<form action="/update" method="post" class="form-horizontal" role="form" onsubmit="check()">
				<div class="form-group">
				    <label class="control-label col-sm-2" for="username">Username:</label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="username" name="username" style="font-size:23px" disabled value="<?php echo $userDetails['uname']?>">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label class="control-label col-sm-2" for="pass">Password:</label>
				    <div class="col-sm-7">
				      <input type="password" class="form-control" id="pass" name="pass" style="font-size:23px" disabled value="<?php echo $userDetails['pass']?>">
				    </div>
			  	</div>
			  	<div class="form-group" style="display:none" id="rtyPassDiv">
				    <label class="control-label col-sm-2" for="rtypass">Retype Password:</label>
				    <div class="col-sm-7">
				      <input type="password" class="form-control" id="rtypass" name="rtypass" style="font-size:23px" disabled>
				    </div>
			  	</div>
				<div class="form-group"> 
				    <div class="col-sm-offset-2 col-sm-5">
				      <input type="button" class="btn btn-primary btn-lg" id="editButton" onclick="edit()" value="Edit">
				    </div>
				</div>
				<input type="text" class="form-control" name="ID" style="display:none;font-size:23px" value="<?php echo $userDetails['id']?>">
				<div class="form-group"> 
				    <div class="col-sm-offset-2 col-sm-5">
				      <input type="submit" class="btn btn-primary btn-lg" id="saveButton" style="display:none" value="Save">
				    </div>
				</div>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
	$('body').addClass('text-primary');
	<?php if(isset($_GET['errorPI']) && $_GET['errorPI']!=null) { ?>
		document.getElementById("per").click();
	<?php } ?>
});
$("#subjects li a").click(function(){
	var subject = $(this).text();
	$(".attendance").css("display","none");
	$("#"+subject).css("display","block");
});
function edit()
{
	$("#username").removeAttr('disabled');
	$("#pass").removeAttr('disabled');
	$("#rtypass").removeAttr('disabled');
	$("#rtyPassDiv").css("display","block");
	$("#saveButton").css("display","block");
	$("#editButton").css("display","none");
}
function check()
{
	if($("#pass").val()!=$("#rtypass").val())
		alert("passwords do not match!");
}
</script>
</html>