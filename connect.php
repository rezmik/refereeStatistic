<?php

	$host = "localhost";
	$db_user = "root";
	$db_password = "hofoxcwgh";
	$db_name = "refereeStatistic";


	try {
		$connection = new PDO('mysql:host='.$host.';dbname='.$db_name.';encoding=utf8', $db_user, $db_password);
		$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	} catch ( PDOException $e ) {
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności!</span>';
		echo '<br />Informacja developerska: '.$e->getMessage();
	}

?>
