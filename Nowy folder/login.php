<?php 

	session_start();

	if((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";

	$connection = @new mysqli($host, $db_user, $db_password, $db_name);

	if( $connection->connect_errno!=0 ) {
		echo "Error: ".$connection->connect_errno;
	}
	else {
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

		if( $result = @$connection->query(sprintf("SELECT * FROM users WHERE login='%s' AND pass='%s'", mysqli_real_escape_string($connection, $login),mysqli_real_escape_string($connection, $haslo)))) {
			$nr_users = $result->num_rows;
			if( $nr_users > 0 ) {
				$_SESSSION['online'] = true;

				$row = $result->fetch_assoc(); //wrzucenie wyników zapytania do tablicy asocjacyjnej
				$_SESSION['id'] = $row['id'];
				$_SESSION['names'] = $row['name'];

				unset($_SESSION['blad']);
				$result->free();
				header('Location: statistic.php');
			} 
			else {

				$_SESSION['blad'] = '<span style="color: red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');

			}
		}

		$connection->close();
	}

?>