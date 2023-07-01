<?php
require_once('inc/mysql.php');
session_start();

try {
	if (!isset($_REQUEST['email'])) {
		die('Please provide email as a parameter to the url');
	}
	$email	=	$_REQUEST['email'];
	$sql = "SELECT health_report FROM users WHERE email_id='{$email}'";
	// die($sql);
	$query = $conn->query($sql);
	if ($query->num_rows > 0) {
	    $row = $query->fetch_assoc();
	    $file  = $row['health_report'];
	} else {
		die('No record found, for the email provided');
	}
} catch (\Throwable $th) {
    die($th->getMessage());
    $_SESSION['msg'] = $th->getMessage();
    header("Location: ../index.html");
    exit();
}
?>

<iframe src="<?= $file ?>" width="100%" height="100%" frameborder="0"></iframe>