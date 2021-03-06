<?php
session_start();
error_reporting(E_ALL);
$dsn = 'mysql:host=cgi.cs.duke.edu;port=3306;dbname=rz30;';
$username = 'rz30';
$password = '9klB3Oh7nuMxI';
try {
    $db = new PDO($dsn, $username, $password);
} catch(PDOException $e) {
    die('Could not connect to the database:<br/>' . $e);
}
$sqlq = "INSERT INTO users (email, first_name, last_name, password) VALUES (:email, :firstname, :lastname, :password)";
$email = $_POST['sign-up-email'];
$firstname = $_POST['first-name'];
$lastname = $_POST['last-name'];
$password = $_POST['sign-up-password'];
$password = password_hash($password, PASSWORD_DEFAULT);

if (empty($email) || empty($firstname) || empty($lastname) || empty($password)) {
    header('Location: index.php?signup_error=Please%20fill%20out%20every%20form!');
    exit();
 }

 #strcasecmp(verifyEmail($email, $email),"valid") == 0)
elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$duplicheck = "SELECT * FROM users WHERE email=:email";
	#$resource = mysqli_query($duplicheck);
	#$array = $resource->fetch_array(MYSQLI_ASSOC);#
	#$numrows = mysqli_num_rows($resource);

	$getready1 = $db->prepare($duplicheck);
	$getready1->execute(array(':email' => $email));
	$result = $getready1->fetch();
	$matches = count($result);
	if ($matches == 0) {

		$adduserq = "INSERT INTO users (email, first_name, last_name, password) VALUES (:email, :firstname, :lastname, :password)";

		$getready = $db->prepare($adduserq);
		$getready->execute(array(':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname, ':password' => $password));

		$msg = 'You have successfully signed up. Please verify by clicking the activation link that has been sent to your email.';
		echo "Welcome to gylt! <a href='workspace.php'>Start designing here</a>";

	}
	else {
		header('Location: index.php?signup_error=Email%20already%20registered!');
    	exit();
	}
}

else {
	header('Location: index.php?signup_error=Email%20not%20formatted%20correctly,%20try%20again.');
	exit();
}

$getready = $db->prepare($sqlq);
$getready->execute(array(':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname, ':password' => $password));

echo "You have successfully signed up. An email was sent to ";
echo $email;
echo ". Welcome to gylt! <a href='workspace.php'>Start designing here</a>";
$_SESSION['email'] = $email;
$_SESSION['first_name'] = $firstname;
$_SESSION['last_name'] = $lastname;
$_SESSION['user_id'] = $db->lastInsertId();
$_SESSION['just_logged_in'] = "yes"; 
header('Location: workspace.php');
?>

