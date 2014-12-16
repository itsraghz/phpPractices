<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

	echo "<h3>Printing one column from all the rows of the database table</h3>";

	global $handler;

	$sql = "SELECT * from TblUser";

	$query = $handler->query($sql);

	while($r = $query->fetch()) {
		echo $r['UserName'] . "<br/>";
	}

	echo "<br/>";

	echo "<h3>Selecting and Printing all rows of the database table</h3>";

	$query = $handler->query($sql);

	while($r = $query->fetch()) {
		echo "<pre>", print_r($r) , "</pre>";
	}
	
	include_once('../inc/footer.php');
?>