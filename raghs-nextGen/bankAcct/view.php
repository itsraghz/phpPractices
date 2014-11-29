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
 * 1. 23 Nov 2014 Sunday - Initial Version
 *
 * 2. 25 Nov 2014 Tuesday
 * -----------------------
 *      a. Adding Edit and Delete link here in view as well (in addition to list.php page)
 *      b. Added Copy Link for inserting a new transactions with the details of this transaction.
 *
 */

include_once '../inc/header.php';
require_once 'data/BankAcctDAO.php';

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>View</b> &nbsp;&nbsp; | &nbsp;&nbsp; <a class='grayed' href="index.php">Home</a>
    <br/><br/>
<?php

if (isset($_GET['Id']) && !empty($_GET['Id'])) {
    $id = $_GET['Id'];

    $msg = "You can view records for the row " . $id;

    $editLink = " | " . "<a href='edit.php?Id=" . $id . "'>Edit</a>";

    $deleteLink = " | " . "<a href='delete.php?Id=" . $id . "'>Delete</a>";

    $copyLink = " | " . "<a href='copy.php?Id=" . $id . "'>Copy</a>";

    echo "<p>" . $msg . $editLink . $deleteLink . $copyLink . "</p>";

    getData($id);
} else {
    echo "<span class='error'>Invalid Id passed. Please recheck.</span>";
}

function getData($id)
{
    $fullHeaderArray = array("Id", "AcctNo", "AcctType", "Provider", "Bank", "Branch", "City", "ShortName", "CVV",
        "ValidThru", "NameRegistered", "EmailRegistered", "MemberSince", "URL", "Remarks");

    /*$headerArray = array("Id", "AcctNo", "AcctType", "Provider", "Bank", "ShortName", "CVV",
        "ValidThru", "NameRegistered", "MemberSince", "Remarks");*/

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
        echo getHTMLTableForData($bankBO, $fullHeaderArray);
    } else {
        echo "<span class='error'>" . $errorMsg . "</span>";
        echo "<br/>";
    }
}

//@todo: reuse with list.php
function getCellData($data)
{
    if (empty($data)) {
        //$data = "&nbsp;";
        $data = "";
    }

    return $data;
}

function getEditableTableData($dataObj, $name)
{
    //$data = $dataObj->dataArray[$name];
    $data = $dataObj->$name;

    $data = getCellData($data);

    //@todo make reusable for readonly, editable etc., with flags
    $data = "<input class='readonly' type='text' name='" . $name . "' value='" . $data . "' size='50' readonly />";

    return $data;
}

function getSubmitCancelBtns()
{
    $submitCancelTxt = "<tr>" .
        "<td><input class='submit' type='submit' name='Update' value='Update'/> </td>" .
        "<td><input class='reset' type='reset' name='Cancel' value='Cancel'/> </td>" .
        "</tr>";

    return $submitCancelTxt;
}

function getHTMLTableForData($dataObj, $fieldHeaderArray)
{
    $htmlTableBegin = "<table border=1 cellspacing=5 cellpadding=5>";
    $htmlTableClose = "</table>";

    //$htmlTableData = "<form name='editAcctForm' method='post' action='update.php?Id=" . $dataObj->Id . "'>";

    $htmlTableData = $htmlTableBegin;

    $tableHeaderArray = array("Field", "Value");

    $htmlTableData .= getTableHeaderRow($tableHeaderArray);

    $htmlRowData = '';
    foreach ($fieldHeaderArray as $fieldHeader) {
        $htmlRowData .= "<tr>";

        $htmlRowData .= "<td>" . $fieldHeader . "</td>";
        $htmlRowData .= "<td>" . getEditableTableData($dataObj, $fieldHeader) . "</td>";

        $htmlRowData .= "</tr>";
    }

    //$htmlRowData .= getSubmitCancelBtns();

    $htmlTableData .= $htmlRowData;

    $htmlTableData .= $htmlTableClose;

    //$htmlTableData .= "</form>";

    return $htmlTableData;

}

function getTableHeaderRow($headerArray)
{
    $tableHeaderData = '<tr>';

    foreach ($headerArray as $header) {
        $tableHeaderData .= "<th>" . $header . "</th>";
    }

    $tableHeaderData .= "</tr>";

    return $tableHeaderData;
}

include_once '../inc/footer.php';
?>