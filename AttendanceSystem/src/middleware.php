<?php
// Application middleware

function dbConn()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "dbproject";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $conn;
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
}
//obtaining student routine
function extrctStudentRoutine($dept,$sem,$sec,$conn)
{
	$sql="CALL extrctStudentRoutine('$dept','$sem','$sec')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	// set the resulting array to associative
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result  = $stmt->fetchAll();
	return $result;
}
//obtain teacher routine
function extrctFacultyRoutine($id,$conn)
{
	$sql="CALL extrctFacultyRoutine($id)";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	// set the resulting array to associative
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result  = $stmt->fetchAll();
	return arrangeResult($result);
}
//arrange teacher result
function arrangeResult($results)
{
	$days=['Monday','Tuesday','Wednesday','Thursday','Friday'];
	$sortedRoutine=[];	
	foreach ($days as $day) {
		$row=["p1"=>["subject"=>"-----","sec"=>"","sem"=>""], "p2"=>["subject"=>"-----","sec"=>"","sem"=>""], "p3"=>["subject"=>"-----","sec"=>"","sem"=>""],"p4"=>["subject"=>"-----","sec"=>"","sem"=>""], "p5"=>["subject"=>"-----","sec"=>"","sem"=>""], "p6"=>["subject"=>"-----","sec"=>"","sem"=>""]];
		foreach ($results as $result) {
			if($day==$result['Day']){				
				
				$row['day'] =$day; 

				if($result['Period']=='P1'){
					$row['p1']['subject']=$result['SubjectCode'];
					$row['p1']['sec']=$result['Sec'];
					$row['p1']['sem']=$result['Sem'];
				}
				else if($result['Period']=='P2'){
					$row['p2']['subject']=$result['SubjectCode'];
					$row['p2']['sec']=$result['Sec'];
					$row['p2']['sem']=$result['Sem'];
				}
				else if($result['Period']=='P3'){
					$row['p3']['subject']=$result['SubjectCode'];
					$row['p3']['sec']=$result['Sec'];
					$row['p3']['sem']=$result['Sem'];
				}
				else if($result['Period']=='P4'){
					$row['p4']['subject']=$result['SubjectCode'];
					$row['p4']['sec']=$result['Sec'];
					$row['p4']['sem']=$result['Sem'];
				}
				else if($result['Period']=='P5'){
					$row['p5']['subject']=$result['SubjectCode'];
					$row['p5']['sec']=$result['Sec'];
					$row['p5']['sem']=$result['Sem'];
				}
				else if($result['Period']=='P6'){
					$row['p6']['subject']=$result['SubjectCode'];
					$row['p6']['sec']=$result['Sec'];
					$row['p6']['sem']=$result['Sem'];
				}
			}
		}
		if($row!=["p1"=>["subject"=>"-----","sec"=>"","sem"=>""], "p2"=>["subject"=>"-----","sec"=>"","sem"=>""], "p3"=>["subject"=>"-----","sec"=>"","sem"=>""],"p4"=>["subject"=>"-----","sec"=>"","sem"=>""], "p5"=>["subject"=>"-----","sec"=>"","sem"=>""], "p6"=>["subject"=>"-----","sec"=>"","sem"=>""]])
			$sortedRoutine[]=$row;
	}
	return $sortedRoutine;
}
//sort the routine according to the weekday
function sortWeekday($routine)
{
	$days=['Monday','Tuesday','Wednesday','Thursday','Friday'];
	$num=0;
	$sortedRoutine=[];
		foreach ($days as $d) {
			foreach ($routine as $r) {
				if($r['day']==$d){
					$sortedRoutine[]=$r;
				}
			}
		}
	return $sortedRoutine;
}
//obtaining the attendance
function obtainAtt($id,$conn)
{
	$sql = "CALL getAttendance($id)";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmt->fetchAll();
	return $result;
}
//obtain attendance list for teacher
function obtainAttList($subject,$conn)
{
	$sql="CALL obtainAttList('$subject')";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmt->fetchAll();

	for($i=0; $i<sizeof($result); $i++)
	{
		$id=$result[$i]['studID'];
		$sql="CALL obtainStudentName($id)";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$name=$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$name=$stmt->fetchAll();
		$result[$i]['name']=$name[0]['name'];
	}
	return $result;
}