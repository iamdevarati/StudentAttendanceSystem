<?php
// Routes
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
function sortweekday($result)
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
//home
$app->get('/', function ($request, $response, $args) {
   	// Render index view
	return $this->renderer->render($response, 'index.php', $args);
});
//login
$app->post('/login', function ($request, $response, $args) {
   	// Render index view
   	$username = $_POST['username'];
   	$password = $_POST['password'];
	$conn = dbConn();

	$sql = "SELECT * FROM users WHERE (uname='$username' and pass='$password')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	// set the resulting array to associative
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result  = $stmt->fetchAll();

	if($result!=null){
		$args['id'] = $result[0]['id'];
		$args['role'] = $result[0]['role'];
		return $response->withRedirect('/dashboard?'. http_build_query($args));
	}
	else{
		$args['error']="Invalid username or password";
		return $response->withRedirect('/?'.http_build_query($args));
	}
});
//dashboard
$app->get('/dashboard', function ($request, $response, $args) {
	$conn=dbConn();
	$id=$_GET['id'];
	$sql="SELECT * FROM studentdetails WHERE studID='$id'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	// set the resulting array to associative
	$details = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$details  = $stmt->fetchAll();
	$dept=$details[0]['dept'];
	$sem=$details[0]['semester'];
	$sec=$details[0]['section'];

	$result=extrctRoutine($dept,$sem,$sec,$conn);
	if($result!=null){
		$args['rows'] = sortweekday($result);
		//echo json_encode($args);
  		return $this->renderer->render($response, 'dashboard.php', $args);
	}
	else{
		$args['error']="Routine is not available";
		return $response->withRedirect('/?'.http_build_query($args));
	}
});
//registration
$app->get('/registration', function ($request, $response, $args) {
	
	return $this->renderer->render($response, 'registration.php', $args);
});
//registering
$app->post('/register', function ($request, $response, $args) {
    if($_POST['password'] != $_POST['rtyPassword'])
    {  
        $args['error'] = "Passwords do not match!";
        return $response->withRedirect('/registration?'.http_build_query($args));
    }
    $name=$_POST['name'];
    $dept=$_POST['dept'];
    $section=$_POST['section'];
    $semester=$_POST['semester'];
	$username = $_POST['uname'];
   	$password = $_POST['password'];
	$conn = dbConn();

	$sql="SELECT * FROM users WHERE (uname='$username' and pass='$password')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	// set the resulting array to associative
	$user = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$user  = $stmt->fetchAll();

	if(is_null($user[0]))
	{
		$sql_user = "INSERT INTO users(uname,pass,role) VALUES ('$username','$password','student')";
		$stmt = $conn->prepare($sql_user);
		$stmt->execute();
		// set the resulting array to associative
		$id = $conn->lastInsertId();
		$sql_student = "INSERT INTO studentdetails(studID,name,dept,section,semester) VALUES ('$id','$name','$dept','$section','$semester')";
		$stmt = $conn->prepare($sql_student);
		$stmt->execute();
		return $response->withRedirect('/?'.http_build_query($args));
	}
	else
	{
		$args['error']= "User already exists";
		return $response->withRedirect('/registration?'.http_build_query($args));
	}
});