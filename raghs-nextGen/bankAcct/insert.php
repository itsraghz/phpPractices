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
 */

include_once '../inc/header.php';
require_once 'model/BankAcctBO.php';
require_once 'data/BankAcctDAO.php';

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>Insert</b> &nbsp;&nbsp; | &nbsp;&nbsp; <a class='grayed' href="index.php">Home</a>
    <br/><br/>
<?php

insertData();

function insertData()
{
    $bankBO = new BankAcctBO();
    $bankBO->injectFromHttpRequest($_POST);

    //echo "<b>After injection : </b> <br/>";
    //echo "<pre>" , print_r($bankBO) . "</pre>";

    $bankAcctDAO = new BankAcctDAO();

    $error = 0;

    try {
        $bankBO = $bankAcctDAO->insert($bankBO);

    } catch (Exception $e) {
        echo "<span class='error'>Error occurred. Message -> [" . $e->getMessage() . "]";
        echo "<br/>";
        $error = 1;
    }

    if ($error == 0) {
        //echo "<pre>" , print_r($bankBO) . "</pre>";

        //echo "BankBO lastInsertId :: " . $bankBO->Id . "<br/>";

        header('Location: view.php?Id=' . $bankBO->Id);

    }

}

include_once '../inc/footer.php';
?>