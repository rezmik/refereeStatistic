<?php
	session_start();

	require_once "connect.php";

	$competition = $_POST['competition'];
	$mainref = $_POST['mainref'];
	$referee1 = $_POST['referee1'];
	$referee2 = $_POST['referee2'];
	$home = $_POST['home'];
	$away = $_POST['away'];
	$hGoals = $_POST['hGoals'];
	$aGoals = $_POST['aGoals'];
	$hyellow = $_POST['hyellow'];
	$ayellow = $_POST['ayellow'];
	$hred = $_POST['hred'];
	$ared = $_POST['ared'];
	$matchDate = $_POST['matchDate'];


	$connection = @new mysqli($host, $db_user, $db_password, $db_name);

	if ($connection->connect_errno != 0 ) {
		echo 'Error: '.$connection->connect_errno;
	}
	else {

		if ($connection->query("INSERT INTO matches VALUES (NULL, '$matchDate', '$home', '$away', '$hGoals', '$aGoals', '$hyellow', '$ayellow', '$hred', '$ared', '$mainref', '$referee1', '$referee2', '$competition')")) {
			$_SESSTION['addRecord'] = true;
			if (isset($_SESSTION['addRecord'])) {
				echo 'Powodzenie';
			}
			header('Location: add.php');
			//echo 'Wszystko ok.';

			$connection->close();
		}
		else {
			/*$_SESSTION['addRecordFail'] = 'Dodawanie meczu nie powiodło się prosimy spróbować później.';
			header('Location: add.php');*/
			throw new Exception($connection->error);
			
		}

	}


?>