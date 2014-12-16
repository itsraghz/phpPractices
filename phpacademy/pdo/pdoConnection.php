<html>
	<head>
		<title>PDO - Connection to Database</title>
		<link type="text/css" rel="stylesheet" href="../style/style.css"/>
	</head>
	<body>
<?php

	include_once('../inc/header.php');

	// DB Properties
	$mysql_host = "localhost";
	$mysql_db = "itsraghz";
	$mysql_user = "itsraghz";
	$mysql_pwd = "NJ#76AW2";

    $mysql_user = "root";
    $mysql_pwd = "root";

	$debug=false;

	if(isset($_GET['debug']) && !empty($_GET['debug']))
	{
		if(strcmp($_GET['debug'], 'Y') || strcmp($_GET['debug'],'y'))
		{
			$debug = true;
		}
	}

	if($debug)
	{
		echo "<b>Available DB Drivers with PDO </b> ";
		echo "<pre>";
		print_r(PDO::getAvailableDrivers());
		echo "</pre>";
	}

	try {
		$handler = new PDO("mysql:host=$mysql_host;dbname=$mysql_db", $mysql_user,$mysql_pwd);
		$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($debug)
		{
			echo "Connection to the Database successful!";
		}
	}catch(PDOException $e) {
		echo "<span class='error'>";
		echo "<b>Database Error.</b><br/>";
		echo $e->getMessage();
		echo "</span>";
	}

?>
	</body>
</html>