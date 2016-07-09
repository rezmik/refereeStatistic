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
				<li><a href="#">Statystyki</a></li>
				<li><a href="add.php">Dodaj</a></li>
				<li><a href="match.php">Mecze</a></li>
				<li><a href="logout.php">Wyloguj się</a></li>
			</ol>

		</div>

		<div id="container2">
			<?php 

				try {
					$connection = new PDO('mysql:host='.$host.';dbname='.$db_name.';encoding=utf8', $db_user, $db_password);
					$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				} catch ( PDOException $e ) {
					echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności!</span>';
					echo '<br />Informacja developerska: '.$e->getMessage();
				}

				$user = $_SESSION['names'];


				function stats( $querys ) {

					$result = $connection->query( $querys );

					if ( !$result ) throw new Exception ( $connection->error );

					$variable = $result->rowCount();
					return $variable;

				}


				$zapytanie = "SELECT id FROM matches WHERE main='$user' OR assistant1='$user' OR assistant2='$user'";
				

				echo 'Liczba meczów ogółem: '.stats($zapytanie).'</br>';

				$result = $connection->query("SELECT id FROM matches WHERE main='$user'");

				if ( !$result ) throw new Exception ( $connection->error );

				$matchAsMain = $result->rowCount();

				echo 'Liczba meczów jak sędzia główny: '.$matchAsMain;

			?>
		</div>

	</div>


</body>
</html>