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
//
function sortWeekday($result)
{
	$days=['Monday','Tuesday','Wednesday','Thursday','Friday'];
	$num=0;
	$res=[];
		foreach ($days as $d) {
			foreach ($result as $r) {
				if($r['day']==$d){
					$res[]=$r;
				}
			}
		}
	return $res;
}
// e.g: $app->add(new \Slim\Csrf\Guard);
