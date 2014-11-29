<?php

 /* Ref URL : http://stackoverflow.com/questions/8028957/how-to-fix-headers-already-sent-error-in-php?lq=1 */

    ob_start();

    function getBaseDir()
    {
        $loc_pos_2 = strpos($_SERVER['REQUEST_URI'], "/", 1);
        $baseDir = substr($_SERVER['REQUEST_URI'], 0, $loc_pos_2);

        return $baseDir;
    }

    function getDocumentRoot()
    {
        return getBaseDir() . '/' . 'raghs-nextGen';
    }

    define('DOCUMENT_ROOT', getDocumentRoot());
?>
<html>
<head>
	<title>Raghs Prsnl PHP (Next Gen)</title>
	<link rel="stylesheet" 
	href="<?php echo DOCUMENT_ROOT;?>/inc/style/raghsPrsnl.css">
</head>
<a href="<?php echo getDocumentRoot();?>/index.php">Raghs-nextGen</a> &nbsp; | &nbsp;
<a href="<?php echo getDocumentRoot();?>/bankAcct/">Bank Accts</a> &nbsp; | &nbsp;
<hr color="purple"/>
<br/>
<body>
