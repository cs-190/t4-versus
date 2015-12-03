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

$email = mysqli_real_escape_string(strip_tags($email));
$firstname = $_POST['first-name'];
$firstname = mysqli_real_escape_string(strip_tags($firstname));
$lastname = $_POST['last-name'];
$lastname = mysqli_real_escape_string(strip_tags($lastname));
$password = $_POST['sign-up-password'];
$password = mysqli_real_escape_string(strip_tags($password));
$password = password_hash($password, PASSWORD_DEFAULT);

#checking for empty fields
if (empty($email) || empty($firstname) || empty($lastname) || empty($password)) {
    echo "Please fill out every form!";
 }

#strcasecmp(verifyEmail($email, $email),"valid") == 0)
elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {

	$duplicheck = "SELECT * FROM users WHERE email=:email";
	$resource = mysqli_query($duplicheck);
	#$array = $resource->fetch_array(MYSQLI_ASSOC);#
	$numrows = mysqli_num_rows($resource);
	if ($numrows == 0) {

		$sqlq = "INSERT INTO users (email, first_name, last_name, password) VALUES (:email, :firstname, :lastname, :password)";

		$getready = $db->prepare($sqlq);
		$getready->execute(array(':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname, ':password' => $password));

		$msg = 'You have successfully signed up. Please verify by clicking the activation link that has been sent to your email.';

		$_SESSION['email'] = $email;
		$_SESSION['first_name'] = $firstname;
		$_SESSION['last_name'] = $lastname;
		$_SESSION['user_id'] = $db->lastInsertId();
		$_SESSION['just_logged_in'] = "yes"; 

		header('Location: workspace.php');
	}
	else {
		echo "Email has already been registered.";
	}
}

else {
	echo "Invalid email format. Please try again."; 
}

?>



