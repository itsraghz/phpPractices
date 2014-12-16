<?php
/**
 * Created by PhpStorm.
 * User: Raghz
 * Date: 06/12/14
 * Time: 17:53 PM
 */

/*
 * Version History
 * ===============
 * 1. 06 Dec 2014 Saturday - Initial Version
 *
 */

include_once '../inc/header.php';
require_once 'model/BankAcctBO.php';

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>Add</b> &nbsp;&nbsp; | &nbsp;&nbsp; <a class='grayed' href="index.php">Home</a>
    <br/><br/>

<?php

    getData();

function getData()
{
    global $fullHeaderArray;

    $bankBO = new BankAcctBO();

    echo getHTMLTableForDataForCopy($bankBO, $fullHeaderArray, "add");
}

//@todo: Move it globally. Be Careful here there is a change in Text!
function getSubmitCancelBtns()
{
    /*$submitCancelTxt = "<tr>" .
        "<td><input class='submit' type='submit' name='Add' value='Add'/> </td>" .
        "<td><input class='reset' type='reset' name='Cancel' value='Cancel'/> </td>" .
        "</tr>";

    return $submitCancelTxt;*/

    $submitBtnName = 'Add';
    global $submitBtnClass;
    $submitBtnValue = "Add New";

    $submitCancelTxt = getHTMLTableRowBegin().
        getSubmitBtnWithHtmlTDCustom($submitBtnName, $submitBtnValue, $submitBtnClass).
        getResetBtnWithHtmlTD() .
        getHTMLTableRowClose();

    return $submitCancelTxt;
}

include_once '../inc/footer.php';
?>