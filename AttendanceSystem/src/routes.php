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

$app->get('/', function ($request, $response, $args) {
   	// Render index view
	return $this->renderer->render($response, 'index.php', $args);
});
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

$app->get('/dashboard', function ($request, $response, $args) {
   	// Render index view
	return $this->renderer->render($response, 'dashboard.php', $args);
});