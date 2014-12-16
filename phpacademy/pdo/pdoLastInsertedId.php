<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

	function prepareAndInsertValuesToDB($msg, $sql, $paramArray)
	{
		global $handler;

		echo "<h3>" . $msg . "</h3>"; 

		try {
	
			$query = $handler->prepare($sql);
			$query->execute($paramArray);

			echo "Row inserted successfully into database..";

		}catch(PDOException $e) {
			echo "<span class='error'>";
			echo "<b>Database Error.</b><br/>";
			echo $e->getMessage();
			echo "</span>";
			echo "<p><b>Query : </b><font color=gray>" . $sql . "</font></p>";
		}

		echo "<p><span class='note'>You might want to <a href='pdoFetchAllResults.php'>Fetch All Results</a></span></p>";
	}

	/* 
	ERROR if you don't set the following timezone.

	Warning: date() [function.date]: It is not safe to rely on the system's timezone settings. Y
	ou are *required* to use the date.timezone setting or the date_default_timezone_set() function. 
	In case you used any of those methods and you are still getting this warning, you most likely misspelled 
	the timezone identifier. We selected 'America/New_York' for 'EDT/-4.0/DST' instead in 
	/Applications/XAMPP/xamppfiles/htdocs/phpPractices/phpacademy/pdo/pdoPreparedStmt.php on line 48

	REASON:
	-------- 
	I had modified the default setting of date.timezone = 'UTC' in the php.ini file (in Mac's XAMPP the
	php.ini file is located at /Applications/XAMPP/etc/php.ini) to date.timezone = 'UTC-4' to adjust
	Canadian timezone. 

	My UNDERSTANDING : 
	-------------------
	I think modifyig the timezone in php.ini is not advisable. Hence PHP suggests us to modify the setting
	via API (date_default_timezone_set()).

	*/

	/* ---------------------------------- */
	//   4th Test
	/* ---------------------------------- */

	$UserName = 'haridossg';
	$FirstName = "Haridoss";
	$LastName = "Gowrirajan";
	$EmailId = "hrdass@gmail.com ";
	$City = "Bangalore";
	$Country = "India";
	$DateRegistered = date('Y-m-d H:i:s');
	$Remarks = "THBS Colleague and SHaDE Volunteer";

	$sql = "INSERT INTO TblUser (UserName, FirstName, LastName, EmailId, City, Country, DateRegistered, 
		Remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

	$msg= "Insert a row into the database directly using PreparedStatement - WildCard Parameters (?)";
	
	$query = $handler->prepare($sql);

 	$paramArray = array(
		$UserName,
		$FirstName,
		$LastName,
		$EmailId,
		$City,
		$Country,
		$DateRegistered,
		$Remarks
 		);

 	prepareAndInsertValuesToDB($msg, $sql, $paramArray); 

 	echo "<b>Last Insert Id : </b> " . $handler->lastInsertId() . "<br/><br/>";	

 	echo "<span class='warn-box'>BEWARE!</span> &nbsp;&nbsp; we get the lastInsertId() on the <b><u>handler</u></b> instance and NOT the query!";

	include_once('../inc/footer.php');
?>