<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

 	echo "<h3>Deleting all the rows of TblUser (whichever inserted)!</h3>";

 	$sql = "DELETE from TblUser WHERE id>2";

	try {

		$query = $handler->query($sql);

		echo "# " . $query->rowCount() . " Rows deleted from database..";

	}catch(PDOException $e) {
		echo "<span class='error'>";
		echo "<b>Database Error.</b><br/>";
		echo $e->getMessage();
		echo "</span>";
		echo "<p><b>Query : </b><font color=gray>" . $sql . "</font></p>";
	}

	echo "<p><span class='note'>You might want to <a href='pdoFetchAllResults.php'>Fetch All Results</a></span></p>";

	include_once('../inc/footer.php');
?>