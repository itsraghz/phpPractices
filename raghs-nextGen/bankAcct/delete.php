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
 * 2. 25 Nov 2014 Tuesday - Completed the functionality with deleteData() method
 *
 */

include_once '../inc/header.php';
require_once 'model/BankAcctBO.php';
require_once 'data/BankAcctDAO.php';

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>Delete</b> &nbsp;&nbsp; | &nbsp;&nbsp; <a class='grayed' href="index.php">Home</a>
    <br/><br/>
<?php

if (isset($_GET['Id']) && !empty($_GET['Id'])) {
    $id = $_GET['Id'];

    deleteData();
} else {
    echo "<span class='error'>Invalid Id passed. Please recheck.</span>";
}

function deleteData()
{
    $bankBO = new BankAcctBO();
    $bankBO->Id = $_GET['Id'];

    //echo "<b>After injection : </b> <br/>";
    //echo "<pre>" , print_r($bankBO) . "</pre>";

    $bankAcctDAO = new BankAcctDAO();

    $error = 0;
    $errorMsg = null;

    try {
        $bankAcctDAO->delete($bankBO);

    } catch (Exception $e) {
        //echo "<span class='error'>Error occurred. Message -> [" . $e->getMessage() . "]";
        //echo "<br/>";
        $error = 1;
        $errorMsg = $e->getMessage();
    }

    if ($error == 0) {
        //echo "<pre>" , print_r($bankBO) . "</pre>";
        //echo "BankBO lastInsertId :: " . $bankBO->Id . "<br/>";

        echo "<p>Data pertaining to row # " . $bankBO->Id . " has been successfully deleted. </p>";
        echo "<p>Click here to go to the <a href='list.php'>listing</a>.</p>";
        //header('Location: view.php?Id='. $bankBO->Id);
    } else {
        echo "<span class='error'>" . $errorMsg . "</span>";
        echo "<br/>";
    }

}

include_once '../inc/footer.php';
?>