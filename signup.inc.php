<?php


if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['uid'];
	$pwd = $_POST['pwd'];
	$pwdRepeat = $_POST['pwdRepeat'];

	require_once "dba.inc.php";
	require_once "function.inc.php";

	if (emptyInput($name, $email, $username, $pwd, $pwdRepeat ) !== false) {
		header("location:../signup.php?error=emptyinputfield");
	exit();
	}

	if (invalidUid($username) !== FALSE) {
		header("location:../signup.php?error=invaliduid");
	exit();
	}

	if (invalidEmail($email) !== FALSE) {
		header("location:../signup.php?error=invalidemail");
	exit();
	}

	if (passwordMatch($pwd, $pwdRepeat) !== FALSE) {
		header("location:../signup.php?error=invalidpassword");
	exit();
	}

	if (passwordMatch($pwd, $pwdRepeat) !== FALSE) {
		header("location:../signup.php?error=passwordnotmatch");
	exit();
	}

	if (uidExist($conn, $username, $email) !== FALSE) {
		header("location:../signup.php?error=useralreadytaken");
	exit();
	}

	creatUser($conn, $name, $email, $username, $pwd);

}else{
	header("location:../signup.php");
	exit();
}
