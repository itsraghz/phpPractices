<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

	global $handler;

	$sql = "SELECT * from TblUser LIMIT 1";

	echo "<span class='note'><b>Note: </b>For brevity, the SQL query is restricted to fetch only 1 row!</span>";

	echo "<h3>Printing all rows of the database table - No fetch mode selected (Default)</h3>";

	$query = $handler->query($sql);

	while($r = $query->fetch()) {
		echo "<pre>", print_r($r) , "</pre>";
	}	

	echo "<br/>";

	echo "<h3>Printing all rows of the database table - with only Numeric Keys (PDO::FETCH_NUM mode)</h3>";

	$query = $handler->query($sql);

	while($r = $query->fetch(PDO::FETCH_NUM)) {
		echo "<pre>", print_r($r) , "</pre>";
	}

	echo "<br/>";

	echo "<h3>Printing all rows of the database table - with only Associated Array (Name) Keys (PDO::FETCH_ASSOC mode)</h3>";

	$query = $handler->query($sql);

	while($r = $query->fetch(PDO::FETCH_ASSOC)) {
		echo "<pre>", print_r($r) , "</pre>";
	}

	echo "<br/>";

	echo "<h3>Printing all rows of the database table - with both Numeric and Associated Array Keys (PDO::FETCH_BOTH mode)</h3>";

	$query = $handler->query($sql);

	while($r = $query->fetch(PDO::FETCH_BOTH)) {
		echo "<pre>", print_r($r) , "</pre>";
	}

	echo "<br/>";

	echo "<h3>Printing all rows of the database table - as an Object (PDO::FETCH_OBJ mode)</h3>";
	echo "<span class='note'>Please watch the anonymous object - <u><i>stdClass</i></u></span>";

	$query = $handler->query($sql);

	while($r = $query->fetch(PDO::FETCH_CLASS)) {
		echo "<pre>", print_r($r) , "</pre>";
	}	

	echo "<br/>";

	echo "<h3>Printing one column of all rows of the database table - as an Object (PDO::FETCH_OBJ mode)</h3>";

	$query = $handler->query("SELECT * FROM TblUser");

	while($r = $query->fetch(PDO::FETCH_OBJ)) {
		echo  $r->UserName, '<br/>';
	}	

	include_once('../inc/footer.php');	
?>