<?php 

	session_start();

	if(!isset($_SESSION['online'])) {
		header('Location: index.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Referee Statistic</title>
</head>

<body>
	
	<?php 

		echo "<p><b>Jesteś zalogowany jako: </b>".$_SESSION['names']."!";
		echo '<br><br>';
		echo '<a href="logout.php">Wyloguj się!</a>';

	?>

</body>
</html>