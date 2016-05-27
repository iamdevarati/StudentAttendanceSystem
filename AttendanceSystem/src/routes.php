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
   	// Render index view
<<<<<<< HEAD
	return $this->renderer->render($response, 'dashboard.php', $args);
=======
    return $this->renderer->render($response, 'dashboard.php', $args);
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
>>>>>>> e3c145a2ca277705d130f49c29764c60b4bf4d63
});