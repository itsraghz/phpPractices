<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

	function insertValuesToDB($msg, $sql)
	{
		global $handler;

		echo "<h3>" . $msg . "</h3>"; 

		try {
	
			$query = $handler->query($sql);

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

	$sql = "INSERT INTO TblUser (UserName, FirstName, LastName, EmailId, City, Country, DateRegistered, 
		Remarks) VALUES ('kanna', 'Dr. Subramanian SenthilKannan', 'Muthu', 'senthilkannan@gmail.com', 
		'Kowloon', 'Hong Kong', NOW(), NULL)";


	$msg= "Insert a row into the database directly using Direct Values";
	
	insertValuesToDB($msg, $sql);

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

	echo "<br/><br/>";
	echo "<span class='warn-box'>BEWARE!</span> &nbsp;&nbsp; Modified the timezone via date_default_timezone_set('America/New_York') method!";
	echo "<br/><br/>";

	date_default_timezone_set('America/New_York');

	echo "<br/><br/><font color=green>TEST: date('Y-m-d H:i:s') --> <b>" . date('Y-m-d H:i:s') . "</b></font><br/>";

	/* ---------------------------------- */
	//  2nd Test
	/* ---------------------------------- */

	$UserName = 'SathishkumarT';
	$FirstName = "Sathish Kumar";
	$LastName = "Thiyagarajan";
	$EmailId = "sathishkumar.thiyagarajan@gmail.com";
	$City = "Bangalore";
	$Country = "India";
	$DateRegistered = date('Y-m-d H:i:s');
	$Remarks = "AITEC BE IT Classmate (99IT47)";


	$sql = "INSERT INTO TblUser (UserName, FirstName, LastName, EmailId, City, Country, DateRegistered, 
		Remarks) VALUES ('$UserName', '$FirstName', '$LastName', '$EmailId', '$City', 
		'$Country', '$DateRegistered', '$Remarks')";

	$msg= "Insert a row into the database directly using Variables";
	
	insertValuesToDB($msg, $sql);

	/* ---------------------------------- */
	//   3rd Test
	/* ---------------------------------- */

	$UserName = 'JhananiPriyaV';
	$FirstName = "Jhanani Priya";
	$LastName = "V";
	$EmailId = "naanal1102002@gmail.com ";
	$City = "Chennai";
	$Country = "India";
	$DateRegistered = date('Y-m-d H:i:s');
	$Remarks = "CTS Colleague and SHaDE Volunteer";

	$sql = "INSERT INTO TblUser (UserName, FirstName, LastName, EmailId, City, Country, DateRegistered, 
		Remarks) VALUES (:UserName, :FirstName, :LastName, :EmailId, :City, :Country, 
		:DateRegistered, :Remarks)";

	$msg= "Insert a row into the database directly using PreparedStatement - Named Parameters";

	/*
	$query = $handler->prepare($sql);

	$query->execute(
		array(
		':UserName' => $UserName,
		':FirstName' => $FirstName,
		':LastName' => $LastName,
		':EmailId' => $EmailId,
		':City' => $City,
		':Country' => $Country,
		':DateRegistered' => $DateRegistered,
		':Remarks' => $Remarks
 		)
 	);
 	*/

 	$paramArray = array(
		':UserName' => $UserName,
		':FirstName' => $FirstName,
		':LastName' => $LastName,
		':EmailId' => $EmailId,
		':City' => $City,
		':Country' => $Country,
		':DateRegistered' => $DateRegistered,
		':Remarks' => $Remarks
 		);

 	prepareAndInsertValuesToDB($msg, $sql, $paramArray);

	/* ---------------------------------- */
	//   4th Test
	/* ---------------------------------- */

	$UserName = 'SampathKS';
	$FirstName = "Sampath Kumar";
	$LastName = "Sadayappan";
	$EmailId = "sampath.sadayappan@gmail.com ";
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

	include_once('../inc/footer.php');
?>