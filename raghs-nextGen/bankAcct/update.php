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
 */

include_once '../inc/header.php';
require_once 'model/BankAcctBO.php';
require_once 'data/BankAcctDAO.php';

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>Update</b> &nbsp;&nbsp; | &nbsp;&nbsp; <a class='grayed' href="index.php">Home</a>
    <br/><br/>
<?php

if (isset($_GET['Id']) && !empty($_GET['Id'])) {
    $id = $_GET['Id'];

    echo "<p>Here you can update records for the row " . $id . "</p>";

    updateData();
} else {
    echo "<span class='error'>Invalid or missing Id. Please recheck.</span>";
}

function updateData()
{
    $bankBO = new BankAcctBO();
    $bankBO->injectFromHttpRequest($_POST);

    //echo "<b>After injection : </b> <br/>";
    //echo "<pre>" , print_r($bankBO) . "</pre>";

    $bankAcctDAO = new BankAcctDAO();

    $error = 0;

    try {
        $bankAcctDAO->update($bankBO);

    } catch (Exception $e) {
        echo "<span class='error'>Error occurred. Message -> [" . $e->getMessage() . "]";
        echo "<br/>";
        $error = 1;
    }

    if ($error == 0) {
        echo "<pre>", print_r($bankBO) . "</pre>";
        header('Location: view.php?Id=' . $bankBO->Id);
    }
}

include_once '../inc/footer.php';
?>