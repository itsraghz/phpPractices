<?php
/**
 * Created by PhpStorm.
 * User: Raghz
 * Date: 22/11/14
 * Time: 12:59 AM
 */

/*
 * Version History
 * ===============
 * 1. 25 Nov 2014 Tuesday - Initial Version
 *
 * 2. 07 Dec 2014 Sunday - MVC-ized
 *
 */

include_once '../inc/header.php';
require_once 'data/BankAcctDAO.php';

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>Copy</b>
    &nbsp;&nbsp; | &nbsp;&nbsp;
        <a class='grayed' href="index.php">Home</a>
    &nbsp;&nbsp; | &nbsp;&nbsp;
        <a class='grayed' href="<? echo $previous; ?>">Back</a>
    <br/><br/>
<?php

if (isset($_GET['Id']) && !empty($_GET['Id'])) {
    $id = $_GET['Id'];

    //echo "<p>Here you can edit records for the row " . $id . "</p>";

    getData($id);
} else {
    echo "<span class='error'>Invalid Id passed. Please recheck.</span>";
}

function getData($id)
{
    global $fullHeaderArray;

    $bankAcctDAO = new BankAcctDAO();

    $error = 0;
    $errorMsg = null;
    $bankBO = null;

    try {
        $bankBO = $bankAcctDAO->fetch($id);

    } catch (Exception $e) {
        //echo "<span class='error'>Error occurred. Message -> [" . $e->getMessage() . "]";
        $error = 1;
        $errorMsg = $e->getMessage();
    }

    if ($error == 0) {
        //echo "<pre>" , print_r($bankBO) . "</pre>";
        echo getHTMLTableForDataForCopy($bankBO, $fullHeaderArray, "copy");
    } else {
        echo "<span class='error'>" . $errorMsg . "</span>";
        echo "<br/>";
    }
}

function getSubmitCancelBtns()
{
    $submitBtnName = 'InsertAsNew';
    global $submitBtnClass;
    $submitBtnValue = "Insert As New";

    $submitCancelTxt = getHTMLTableRowBegin().
            getSubmitBtnWithHtmlTDCustom($submitBtnName, $submitBtnValue, $submitBtnClass).
            getResetBtnWithHtmlTD() .
        getHTMLTableRowClose();

    return $submitCancelTxt;
}

include_once '../inc/footer.php';
?>