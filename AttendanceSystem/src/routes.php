<?php
// Routes
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
	$id = $_GET['id'];
	$sql="SELECT role FROM users WHERE id='$id'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$details = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$details  = $stmt->fetchAll();
	$role = $details[0]['role'];
	if($role=='student'){
		//obtaining student details
		$sql="SELECT * FROM studentdetails WHERE studID='$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$details = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$details  = $stmt->fetchAll();
		$dept=$details[0]['dept'];
		$sem=$details[0]['semester'];
		$sec=$details[0]['section'];

		//obtaining user details
		$sql="SELECT * FROM users WHERE id='$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$user = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user  = $stmt->fetchAll();
		$args['id']=$id;
		//for routine
		$result=extrctStudentRoutine($dept,$sem,$sec,$conn);
		if($result!=null){
			$args['rows'] = sortWeekday($result);
			$args['studDetails']=$details[0];
			$args['userDetails']=$user[0];
		}
		else{
			$args['errorRout']="Routine is not available";
			return $response->withRedirect('/dashboard?'.http_build_query($args));
		}
		//for attendance
		$result=obtainAtt($id,$conn);
		if($result!=null)
		{
			$args['att'] = $result;
			return $this->renderer->render($response, 'studentDashboard.php', $args);
		}
		else
		{
			$args['errorAtt']="No attendance available";
			return $response->withRedirect('/dashboard?'.http_build_query($args));
		}	
	}
	else if($role=='faculty'){

	}
	
});
$app->post('/update', function ($request, $response, $args) {
	$id=$_POST['ID'];
	$username = $_POST['username'];
   	$password = $_POST['pass'];
   	$args['id']=$id;
	$conn = dbConn();

	$sql="SELECT * FROM users WHERE (uname='$username')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	// set the resulting array to associative
	$user = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$user  = $stmt->fetchAll();

	if($user[0]['id']==$id and $user[0]['uname']==$username)//is_null($user[0]))
	{
		$sql_user = "UPDATE users SET uname='$username', pass='$password'  WHERE id='$id'";
		$stmt = $conn->prepare($sql_user);
		$stmt->execute();
		$args['errorPI']= "change updated";
		return $response->withRedirect('/dashboard?'.http_build_query($args));
	}
	else
	{
		$args['errorPI']= "User already exists. Choose different username.";
		return $response->withRedirect('/dashboard?'.http_build_query($args));
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
		$args['error']="The user has been successfully created!Please log in to view dashboard.";
		return $response->withRedirect('/?'.http_build_query($args));
	}
	else
	{
		$args['error']= "User already exists";
		return $response->withRedirect('/registration?'.http_build_query($args));
	}
});