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

				$user = $_SESSION['names'];


				function stats( $connection, $querys ) {

					$result = $connection->query( $querys );

					if ( !$result ) throw new Exception ( $connection->error );

					$variable = $result->rowCount();
					return $variable;

				}


				$query1 = "SELECT id FROM matches WHERE main='$user' OR assistant1='$user' OR assistant2='$user'";

				echo 'Liczba meczów ogółem: '.stats($connection, $query1).'</br>';

				$query2 = "SELECT id FROM matches WHERE main='$user'";

				echo 'Liczba meczów jak sędzia główny: '.stats($connection,$query2).'<br>';

				$rezultat = $connection->query("SELECT hyellow, ayellow FROM matches WHERE main='$user'");

				if ( !$rezultat ) throw new Exception ( $connection->error );

				$sum_all_yellow = 0;
				$sum_home_yellow = 0;
				$sum_away_yellow = 0;

				foreach($rezultat->fetchAll() as $value) {
					$sum_all_yellow += $value['hyellow'] + $value['ayellow'];
					$sum_home_yellow += $value['hyellow'];
					$sum_away_yellow += $value['ayellow'];
				}

				echo 'Ilość udzielonych napomnień: '.$sum_all_yellow.'<br>';

				echo 'Ilość udzielonych napomnień gospodarzą: '.$sum_home_yellow.'<br>';

				echo 'Ilość udzielonych napomnień gością: '.$sum_away_yellow.'<br>';

				$avarage_all_yellow = $sum_all_yellow / stats($connection, $query2);
				$avarage_home_yellow = $sum_home_yellow / stats($connection, $query2);
				$avarage_away_yellow = $sum_away_yellow / stats($connection, $query2);

				echo 'Średnia ilość żółtych kartek na mecz: '.round($avarage_all_yellow, 2).'<br>';
				echo 'Średnia ilość żółtych kartek na mecz dla gospodarzy: '.round($avarage_home_yellow, 2).'<br>';
				echo 'Średnia ilość żółtych kartek na mecz dla gości: '.round($avarage_away_yellow, 2).'<br>';

			?>
		</div>

	</div>


</body>
</html>
