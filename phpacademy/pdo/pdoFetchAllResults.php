<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

	global $handler;

	$sql = "SELECT * from TblUser LIMIT 1";
	$sql = "SELECT * from TblUser";

	//echo "<span class='note'><b>Note: </b>For brevity, the SQL query is restricted to fetch only 1 row!</span>";

	echo "<h3>Printing the first row of the result set - 'query->fetch()' directly in a statement</h3>";

	echo "<span class='note'>Please note that it fetches both NUM and ASSOC arrays (fetch()) - default!</span>";

	$query = $handler->query($sql);

	echo "<pre>", print_r($query->fetch()) , "</pre>";

	echo "<br/>";	

	echo "<h3>Printing the first row of the result set - 'query->fetch(FETCH_ASSOC)' directly in a statement</h3>";

	$query = $handler->query($sql);

	echo "<pre>", print_r($query->fetch(PDO::FETCH_ASSOC)) , "</pre>";	

	echo "<br/>";	

	echo "<h3>Printing ALL the rows of the result set - 'query->fetchAll(FETCH_ASSOC)' directly in a statement</h3>";

	echo "<span class='note'>Please note that it returns an <b><u><i>Array of Arrays!</i></u></b></span>";

	$query = $handler->query($sql);

	echo "<pre>", print_r($query->fetchAll(PDO::FETCH_ASSOC)) , "</pre>";	

	include_once('../inc/footer.php');
?>