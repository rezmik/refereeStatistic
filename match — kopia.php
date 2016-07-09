<?php

	session_start();

	require_once "connect.php";
	
	if (!isset($_SESSION['online']))
	{
		header('Location: index.php');
		exit();
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Referee statistic</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>
	<div id="navbar_top">
		<div id="navbar_top_left">
			<?php

				echo '<p><b>Zalogowany jako: </b> '.$_SESSION['names'];
			?>
		</div>
	</div>
	<div id="container">
		<div id="navbar">

			<ol>
				<li><a href="statistic.php">Statystyki</a></li>
				<li><a href="add.php">Dodaj</a></li>
				<li><a href="#">Mecze</a></li>
				<li><a href="logout.php">Wyloguj się</a></li>
			</ol>

		</div>

		<div id="container2">
			<?php 
				try {

					$connection = @new mysqli($host, $db_user, $db_password, $db_name);
					if ($connection->connect_errno!=0) {
						throw new Exception(mysqli_connect_errno());
					}
					else {

						$user = $_SESSION['names'];

						$result = $connection->query("SELECT * FROM classa WHERE main='$user' OR assistant1='$user' OR assistant2='$user'");

						$row = $result->fetch_assoc();

						foreach ($row as $value) {
							echo '<pre>';
							print_r( $value );
						}


						if(!$result) throw new Exception($connection->error);

						$connection->close();
					}

				} catch (Exception $e) {
					echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
					echo '<br />Informacja developerska: '.$e;
				}
			?>
			<center>Brak danych do wyświetlenia!</center>
		</div>

	</div>


</body>
</html>