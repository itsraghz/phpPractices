<?php
/**
 * Created by PhpStorm.
 * User: Raghz
 * Date: 08/12/14
 * Time: 1:23 PM
 */

require_once ('../../inc/header.php');

//require_once (getDocumentRoot() . '/bankAcct/model/BankAcctBO.php');
//require_once (getDocumentRoot() . '/bankAcct/data/BankAcctDAO.php');
require_once ('../model/BankAcctBO.php');
require_once ('BankAcctDAO.php');

/*class Test
{
    public $bankAcctBO;
    public $name = "Raghs";

    public function __construct()
    {
        echo "Test class instantiated.... <br/>";
        $bankAcctBO = new BankAcctBO();
        echo "<pre>" , print_r($bankAcctBO) , "</pre>";
    }
}*/

?>

<h3>Dummy Test - BankAcct - ADD</h3>

<?php

    echo ("<b>Debug -> </b> : " . getDocumentRoot() . '/bankAcct/model/BankAcctBO.php'. "<br/>");

    //$obj = new Test();
    //echo "<pre>" , print_r($obj) , "</pre>";

    $bankAcctBO = new BankAcctBO();

    $bankAcctBO->Id = -1;
    $bankAcctBO->AcctNo = "2351";
    $bankAcctBO->AcctType = null;
    $bankAcctBO->Provider = "Visa";
    $bankAcctBO->Bank = "ABN Amro";
    $bankAcctBO->Branch = "MEPZ Tambaram";
    $bankAcctBO->City = "Chennai";
    $bankAcctBO->ShortName = "ABNAMROSalary";
    $bankAcctBO->CVV = null;
    $bankAcctBO->ValidThru = null;
    $bankAcctBO->NameRegistered = "Raghavan alias Saravanan M";
    $bankAcctBO->EmailRegistered = null;
    $bankAcctBO->MemberSince = "2003-12-01";
    $bankAcctBO->URL = null;
    $bankAcctBO->Remarks = "First Salary Acct in IT Industry through Covansys";
    $bankAcctBO->IsActive = null;

    $bankAcctBO->prepareArray();

    /*$bankAcctBO->dataArray = array(
        "Id" => -1,
        "AcctNo" => "2351",
        "AcctType" => null,
        "Provider" => "Visa",
        "Bank" => "ABN Amro",
        "Branch" => "MEPZ Tambaram",
        "City" => "Chennai",
        "ShortName" => "ABNAMROSalary",
        "CVV" => null,
        "ValidThru" => null,
        "NameRegistered" => "Raghavan alias Saravanan M",
        "EmailRegistered" => null,
        "MemberSince" => "2003-12-01",
        "URL" => null,
        "Remarks" => "First Salary Acct in IT Industry through Covansys",
        "IsActive" => null
    );*/

    //echo "<pre>" , print_r($bankAcctBO) , "</pre>";
    //echo "<hr/>";
    echo "<b>var_dump(\$bankAcctBO) ---> </b><br/>";
    echo "<pre>" , var_dump($bankAcctBO) , "</pre>";
    echo "<hr/>";

    createAcct($bankAcctBO);

    function createAcct($bankAcctBO)
    {
        $bankAcctDAO = new BankAcctDAO();

        $error = 0;

        try {
            $bankBO = $bankAcctDAO->insert($bankBO);

        } catch (Exception $e) {
            echo "<span class='error'><b>Error occurred</b>. Message -> [" . $e->getMessage() . "]";
            echo "<br/>";
            $error = 1;
        }

        if ($error == 0) {
            echo "<pre>", print_r($bankBO) . "</pre>";
            echo "BankBO lastInsertId :: " . $bankBO->Id . "<br/>";
            //header('Location: view.php?Id=' . $bankBO->Id);
            getData($bankBO->Id);
        }
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
            echo "<pre>" , print_r($bankBO) . "</pre>";
            //echo getHTMLTableForDataForView($bankBO, $fullHeaderArray, "view");
        } else {
            echo "<span class='error'>" . $errorMsg . "</span>";
            echo "<br/>";
        }
    }

require_once('../../inc/footer.php');
?>
