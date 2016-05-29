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
//obtaining routine
function extrctRoutine($dept,$sem,$sec,$conn)
{
	$sql="SELECT * FROM studroutine WHERE (dept='$dept' and semester='$sem' and section='$sec')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	// set the resulting array to associative
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result  = $stmt->fetchAll();
	return $result;
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
function obtainAtt($id,$subCode,$conn)
{
	$sql="SELECT * FROM attendance WHERE studID='$id' and subjectCode='subCode'";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmt->fetchAll();
	return $result;
}
