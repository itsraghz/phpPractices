<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

 	echo "<h3>Getting the total number of rows through rowCount() method of query!</h3>";

 	$sql = "SELECT * from TblUser";

 	$query = $handler->query($sql);

 	if($query->rowCount()) {
 		echo "Result has #" . $query->rowCount() . " rows";
 	} else {
 		echo "No Results";
 	}

 	echo "<h3>Getting all the userIds based on the rowCount() value!</h3>";

 	$sql = "SELECT * from TblUser";

 	$query = $handler->query($sql);

 	if($query->rowCount()) {
 		while($r = $query->fetch(PDO::FETCH_OBJ)) {
 			echo $r->UserName , "<br/>";
 		}
 	} else {
 		echo "No Results";
 	} 	

 	echo "<h3>Getting the total number of rows through rowCount() method of query (with LIMIT 0)!</h3>";

 	$sql = "SELECT * from TblUser LIMIT 0";

 	$query = $handler->query($sql);

 	if($query->rowCount()) {
 		echo "Result has #" . $query->rowCount() . " rows";
 	} else {
 		echo "No Results";
 	} 	

	include_once('../inc/footer.php');
?>