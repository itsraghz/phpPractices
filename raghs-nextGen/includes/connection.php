<?php

/**
===================================================================================================================
                                        Ref Links for best practices followed
                                        *************************************

1) http://php.net/manual/en/class.pdo.php#85256
   ---------------------------------------------

    Keep in mind, you MUST NOT use 'root' user in your applications, unless your application designed
        to do a database maintenance.
    And storing username/password inside class is not a very good idea for production code. You would
        need to edit the actual working code to change settings, which is bad.

2) http://php.net/manual/en/class.pdo.php#89019
   ---------------------------------------------

    "And storing username/password inside class is not a very good idea for production code."

    Good idea is to store database connection settings in *.ini files but you have to restrict access to them.
    For example this way:

    my_setting.ini:
    ---------------
        [database]
        driver = mysql
        host = localhost
        port = 3306
        schema = db_schema
        username = user
        password = secret

    Database connection:
    --------------------
        <?php
        class MyPDO extends PDO
        {
            public function __construct($file = 'my_setting.ini')
            {
                if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');

                $dns = $settings['database']['driver'] .
                ':host=' . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
                ';dbname=' . $settings['database']['schema'];

                parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
            }
        }
        ?>

    Database connection parameters are accessible via human readable ini file for those who screams even if
        they see one PHP/HTML/any_other command.

    ===================================================================================================================
**/

try {

	$pdo = new PDO('mysql:host=localhost;dbname=itsraghz', 'root','root');
}catch(PDOException $e) {
	exit('Database error.');
}

// Sample: $pdo = new PDO('mysql:host=localhost;dbname=<dbName>', '<dbUser>','<dbPwd>');


//@todo clean up and make it OOP!

/*
class MyPDO extends PDO
{
    public $pdo;

    public function __construct($file = 'my_setting.ini')
    {
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');

        $dns = $settings['database']['driver'] .
            ':host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['schema'];

        $this->$pdo = parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }
}
*/


/*
$file='my_setting.ini';
if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');

$DNSSetting = '\'' . $settings['database']['driver'] . ':host=' . $settings['database']['host'] .
        ';dbname=' . $settings['database']['schema'] . '\' , \''. $settings['database']['username'] .'\', \'' . $settings['database']['password'] . '\'';

echo "DNS Settings :: <i><u>" . $DNSSetting . "</u></i><br/>";

/*echo "<b>Available DB Drivers with PDO </b> ";
echo "<pre>";
print_r(PDO::getAvailableDrivers());
echo "</pre>";*/


//$pdo = new PDO($DNSSetting);

/*
$dbDriver = $settings['database']['driver'];
$dbHost = $settings['database']['host'];
$dbName = $settings['database']['schema'];
$dbUser = $settings['database']['username'];
$dbPwd = $settings['database']['password'];
*/

//$pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_db", $mysql_user,$mysql_pwd);

/*
$pdo = new PDO($settings['database']['driver'] . ":host=" . $settings['database']['host'] . ";dbname=" . $settings['database']['schema'] . ", "
    . $settings['database']['username'] , $settings['database']['password']);
*/
//$pdo = new PDO("$dbDriver:host=$dbHost;dbname=$dbName", $dbUser,$dbPassword);
?>