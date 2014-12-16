<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

 	echo "<h3>Truncating TblUser from the database</h3>";

 	$sql = "TRUNCATE TblUser";

	try {

		$query = $handler->query($sql);

		echo "TblUser succesfully truncated from database..";

	}catch(PDOException $e) {
		echo "<span class='error'>";
		echo "<b>Database Error.</b><br/>";
		echo $e->getMessage();
		echo "</span>";
		echo "<p><b>Query : </b><font color=gray>" . $sql . "</font></p>";
	}

 	echo "<h3>Initializing the TblUser</h3>";

 	$sql = "INSERT INTO `TblUser` (`Id`, `UserName`, `FirstName`, `LastName`, `EmailId`, `City`, 
 		`Country`, `DateRegistered`, `Remarks`) VALUES
		(1, 'itsraghz', 'Raghavan alias Saravanan', 'Muthu', 'Raghavan.30May1981@gmail.com', 
			'Bangalore', 'India', '2011-09-25 15:38:45', NULL),
		(2, 'meenakshi', 'Meenakshi', 'Raghavan', 'ramyamuru.meenakshi@gmail.com', 
			'Bangalore', 'India', '2011-09-25 15:38:45', NULL)";

	try {

		$query = $handler->query($sql);

		echo "TblUser succesfully initialized with # " . $query->rowCount() . "rows in database..";

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