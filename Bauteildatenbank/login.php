<?php
session_start();
// remove all session variables
session_unset();
?>
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<title>Login Bauteildatenbank</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css" title="style" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
	<div class="wrapper">
		<form class="login" method="POST">
			<p class="title">Log in</p>
			<input type="text" placeholder="MitarbeiterNr" name="benutzername" id="benutzername" autofocus required />
			<i class="fa fa-user"></i>
			<input type="password" placeholder="Kennwort" name="kennwort" id="kennwort" required />
			<i class="fa fa-key"></i>
			<a href="http://localhost/Bauteildatenbank_Projekt_Fsst/Bauteildatenbank_V3/registration.php" >Registration</a>
			<button type="submit"  name="submit">
				<i class="spinner"></i>
				<span class="state">Log in</span>
			</button>
		</form>
		<!--<footer><a target="blank" href="http://boudra.me/">boudra.me</a></footer> -->
	</p>
</div>
<?php

/*<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script  src="js/index.js"></script>*/

//if (isset($_POST['username']) and isset($_POST['password'])){
if((isset($_POST['benutzername'])) and (isset($_POST['kennwort']))) {

	$benutzername = $_POST['benutzername'];
	$kennwort = $_POST['kennwort'];

	require('config.php');

	//mysql_select_db("test",[$conn]);

	$query = "SELECT * FROM `mitarbeiter` WHERE MitarbeiterNr='$benutzername' and Kennwort='$kennwort'";
	$result = mysqli_query ($conn,$query);
	$count = mysqli_num_rows($result);
	if ($count == 1) {	//echo "Du bist nun eingeloggt";
		$query = "SELECT Abteilung FROM `mitarbeiter` WHERE MitarbeiterNr='$benutzername' and Kennwort='$kennwort' and Abteilung='IT'";
		$result = mysqli_query ($conn,$query);
		$count = mysqli_num_rows($result);
		if ($count == 1) {
			$_SESSION["priority"] = "admin";
			header("Location: ./mitarbeiter.php");
		} else {
			$_SESSION["priority"] = "user";
			header("Location: ./table.php");
		}
		mysqli_close($conn);
	} else {	//echo "Falscher Benutzername/Kennwort";
		$_SESSION["priority"] = "error";
	}
	mysqli_close($conn);
}

?>
</body>
</html>