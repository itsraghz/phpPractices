<?php

	//include_once('../inc/header.php'); --> Not needed as already got included in pdoConnection.php!
	include_once('pdoConnection.php');

	class TblUser 
	{

		public $UserName, $FirstName, $LastName, $EmailId, $City, $Country,
			 $DateRegistered, $Remarks;

		//public $id; // NOT Needed as it is created automatically in the same name (AutoInteger, PK)

		public $entry;

		public function __construct()
		{
			$this->entry = "{$this->FirstName}, {$this->LastName} has an username :: {$this->UserName}";
		}
	}



	global $handler;

	$sql = "SELECT * from TblUser LIMIT 1";

	echo "<span class='note'><b>Note: </b>For brevity, the SQL query is restricted to fetch only 1 row!</span>";

	echo "<h3>Printing all rows of the database table - as a  (PDO::FETCH_CLASS mode)</h3>";

	echo "<span class='note'><b>Note: </b>This mandates a new class (TblUser) to be created and a setFetchMode() method to be called for \$query object.</span>";

	$query = $handler->query($sql);
	$query->setFetchMode(PDO::FETCH_CLASS, "TblUser");

	while($r = $query->fetch()) {
		echo "<pre>", print_r($r) , "</pre>";
	}	

	echo "<br/>";	

	echo "<h3>Printing a constructed parameter of all rows of the database table - via __construct() method</h3>";

	$query = $handler->query("SELECT * from TblUser");
	$query->setFetchMode(PDO::FETCH_CLASS, "TblUser");

	while($r = $query->fetch()) {
		echo $r->entry , "</br>";
	}		

	echo "<br/>";	

	echo "<h3>Printing a constructed parameter of all rows of the database table - via __construct() method</h3>";

	echo "<span class='note'>Notice the new member of the class <b><u><i>'entry'</i></u></b></span>";

	$query = $handler->query($sql);
	$query->setFetchMode(PDO::FETCH_CLASS, "TblUser");

	while($r = $query->fetch()) {
		echo "<pre>", print_r($r) , "</pre>";
	}		

	include_once('../inc/footer.php');		
?>