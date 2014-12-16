<?php

 /* Ref URL : http://stackoverflow.com/questions/8028957/how-to-fix-headers-already-sent-error-in-php?lq=1 */

    ob_start();

    require_once 'global.php';
?>
<html>
<head>
	<title>Raghs Prsnl PHP (Next Gen)</title>
	<link rel="stylesheet" 
	href="<?php echo DOCUMENT_ROOT;?>/inc/style/raghsPrsnl.css">
</head>
<a href="<?php echo getDocumentRoot();?>/index.php">Home</a> &nbsp; | &nbsp;
<a href="<?php echo getDocumentRoot();?>/bankAcct/">Bank Accts</a> &nbsp; | &nbsp;
<a href="<?php echo getDocumentRoot();?>/test/phpinfo.php">PHP Info</a> &nbsp; | &nbsp;
<a href="<?php echo getDocumentRoot();?>/faq.php">FAQ</a> &nbsp; | &nbsp;
<hr color="purple"/>
<b>PHP Process : </b> <? echo `whoami`;?> | <? echo getmypid();?> | <b>Doc Root : </b> <i><?php echo getDocumentRoot(); ?></i>
<br/>
<?php
/*
echo "<b> Request URI : </b> " . $_SERVER['REQUEST_URI'] . "<br/>";
echo "__DIR__ returns : " . __DIR__ . "  |  " . dirname(__FILE__) . "  |  " . __FILE__ ."<br/>";
echo "<b>Base Dir :: </b> ". getBaseDir() . "<br/>";*/

/*$foo = "0123456789a123456789b123456789c";

//0123456789a123456789b12345 6789c

var_dump(strrpos($foo, '7', -5));  // Starts looking backwards five positions
// from the end. Result: int(17)

var_dump(strrpos($foo, '7', 20));  // Starts searching 20 positions into the
// string. Result: int(27)

var_dump(strrpos($foo, '7', 28));  // Result: bool(false)*/

?>
<hr color="purple"/>
<?php
/*
?>
<hr/>
<b>Request URI</b> :: <i><u><?php echo $_SERVER['REQUEST_URI'] ;?></u></i> |
<b>HTTP Referrer </b> :: <i><u><?php echo $_SERVER['HTTP_REFERER'] ;?></u></i>
<hr/>
*/
?>
<body>
