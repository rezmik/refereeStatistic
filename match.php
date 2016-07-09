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

					$connection = new PDO('mysql:host='.$host.';dbname='.$db_name.';encoding=utf8', $db_user, $db_password);
					$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );

				} catch ( PDOException $e ) {
					echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności!</span>';
					echo '<br />Informacja developerska: '.$e->getMessage();
				}

				/*@new mysqli($host, $db_user, $db_password, $db_name);
					if ($connection->connect_errno!=0) {
						throw new Exception(mysqli_connect_errno());
					}
					else {*/

				$user = $_SESSION['names'];

				$result = $connection->query("SELECT * FROM matches WHERE main='$user' OR assistant1='$user' OR assistant2='$user'");

				if(!$result) throw new Exception($connection->error);

				//$row = $result->fetch_assoc();

				echo '<table>';
					echo '<tr>';

						echo '<th>Data</th>';
						echo '<th>Gospodarze</th>';
						echo '<th>Wynik</th>';
						echo '<th>Goście</th>';
						echo '<th data-tooltip="Żółte kartki ogółem">ŻO</th>';
						echo '<th data-tooltip="Żółte kartki dla gospodarzy">ŻH</th>';
						echo '<th data-tooltip="Żółte kartki dla gości">ŻA</th>';
						echo '<th data-tooltip="Czerwone kartki ogółem">CO</th>';
						echo '<th data-tooltip="Czerwone kartki dla gospodarzy">CH</th>';
						echo '<th data-tooltip="Czerwone kartki dla gości">CA</th>';

					echo '</tr>';

				foreach ($result->fetchAll() as $value) {
					/*echo '<pre>';
					print_r( $value );*/

					echo '<tr>';

						echo '<td>'.$value['date'].'</td>';
						echo '<td>'.$value['home'].'</td>';
						echo '<td>'.$value['hgoals'].' : '.$value['agoals'].'</td>';
						echo '<td>'.$value['away'].'</td>';

						$syellow = $value['hyellow']+$value['ayellow'];

						echo '<td>'.$syellow.'</td>';
						echo '<td>'.$value['hyellow'].'</td>';
						echo '<td>'.$value['ayellow'].'</td>';

						$sred = $value['hred']+$value['ared'];

						echo '<td>'.$sred.'</td>';
						echo '<td>'.$value['hred'].'</td>';
						echo '<td>'.$value['ared'].'</td>';


					echo '</tr>';

				}

				echo '</table>';

				


			?>

		</div>

	</div>


</body>
</html>