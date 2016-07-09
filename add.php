<?php

	session_start();
	
	if (!isset($_SESSION['online'])) {
		header('Location: index.php');
		exit();
	}

	if(isset($_SESSION['addRecord'])) {
		echo 'Dodawanie rekordu przebiegło pomyślnie'; }
	
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
				<li><a href="#">Dodaj</a></li>
				<li><a href="match.php">Mecze</a></li>
				<li><a href="logout.php">Wyloguj się</a></li>
			</ol>

		</div>

		<div id="container2">
			
			<form action="addmatch.php" method="post">
				<div id="matchesClass">
					Mecz rozgrywany w klasie: 
					<select name="competition" id="comp">
						<option>KKO</option>
						<option>Okręgówka</option>
						<option>Klasa "A"</option>
						<option>Klasa "B"</option>
						<option>Junior starszy</option>
						<option>Junior młodszy</option>
						<option>Trmpkarz</option>
						<option>II liga kobiet</option>
						<option>III liga kobiet</option>
					</select>
				</div>

				<div id="matchDate">
					W dniu:
					<input type="date" name="matchDate">
				</div>

				<div style="clear: both;"></div>
				

				<br>

				Sędziowie: </br>
				<div class="ref">
					<div style="text-align: right;">
						Sędzia główny: </br>
						Sędzia asystent nr 1: </br>
						Sędzia asystent nr 2: </br>
					</div>
				</div>
				<div class="ref">
					<div style="text-align: left;">
						<input type="text" name="mainref"></br>
						<input type="text" name="referee1"></br>
						<input type="text" name="referee2"></br>
					</div>
				</div>

				<div style="clear: both;"></div>
				</br><br>

				<input type="text" placeholder="Gospodarze" name="home"> 
				<input type="number" name="hGoals">
				<input type="number" name="aGoals">
				<input type="text" placeholder="Goście" name="away">

				<br><br>
				<div id="yellowCart">
					Ilość napomnień: <br>
					<input type="text" name="hyellow"> <br>
					Ilość wykluczeń: <br>
					<input type="text" name="hred"> <br>
				</div>

				<div id="redCart">
					Ilość napomnień: <br>
					<input type="text" name="ayellow"> <br>
					Ilość wykluczeń: <br>
					<input type="text" name="ared"> <br>
				</div>
				
				<div style="clear: both;"></div>
				<input type="submit" value="Dodaj">
			</form>


		</div>

	</div>


</body>
</html>