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
 * 3. 30 Nov 2014 Sunday - Added a confirmation before Deletion, as any accidental deletion should be saved!
 *
 * 4. 07 Dec 2014 Sunday - MVC-ized
 *
 */

include_once '../inc/header.php';
require_once 'model/BankAcctBO.php';
require_once 'data/BankAcctDAO.php';

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>Delete</b>
        &nbsp;&nbsp; | &nbsp;&nbsp;
            <a class='grayed' href="index.php">Home</a>
        &nbsp;&nbsp; | &nbsp;&nbsp;
            <a class='grayed' href="<? echo $previous; ?>">Back</a>
    <br/><br/>
<?php

    if (isset($_GET['Id']) && !empty($_GET['Id']))
    {
        $id = $_GET['Id'];

        $bankBO = new BankAcctBO();
        $bankBO->Id = $_GET['Id'];

        $bankAcctDAO = new BankAcctDAO();
        $error = 0;

        try {
            $bankAcctDAO->deletePreCheck($bankBO);
        }catch(Exception $e) {
            $error = 1;
            echo "<span class='error'>" . $e->getMessage() . "</span>";
        }

        if($error==0)
        {
            confirmDeletion();
        }
    }
    else if (isset($_POST['Delete']) && isset($_POST['Id']) && !empty($_POST['Id']))
    {
        $id = $_POST['Id'];

        //echo "The row of Id # " . $_POST['Id'] . " will be deleted!" . "<br/>";
        deleteData();

    }
    else if (isset($_POST['Cancel']) && isset($_POST['Id']) && !empty($_POST['Id']))
    {
        header('Location: view.php?Id=' . $_POST['Id']);
    }
    else
    {
        echo "<span class='error'>Invalid Id passed. Please recheck.</span>";
    }

function confirmDeletion()
{
    //echo "Request came from :  <i><u>" . $_SERVER['REQUEST_URI'] . "</u></i>";
    echo "Do you want to delete this row? <br/><br/>";
    ?>
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method="post">
        <!--<input type="radio" id="delete" name='delete' value="Yes">Yes</input>
        <input type="radio" id="delete" name='delete' value="No">No</input>
        <br/><br/>-->
        <input type="submit" value="Delete" name="Delete"/>
        <input type="submit" value="Cancel" name="Cancel"/>
        <input type="hidden" id="Id" name="Id" value="<?php echo $_GET['Id'];?>" />
    </form>
    <?php

}

function deleteData()
{
    $bankBO = new BankAcctBO();
    $bankBO->Id = $_POST['Id'];

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