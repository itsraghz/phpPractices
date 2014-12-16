<?php
/**
 * Created by PhpStorm.
 * User: Raghz
 * Date: 08/12/14
 * Time: 12:59 PM
 */

/*
 * Version History
 * ---------------
 * 1. 08 Dec 2014 Monday - Initial Version
 *
 */

require_once('../../inc/header.php');
require_once(getDocumentRoot() . '/bankAcct/data/BankAcctDAO.php');
//require_once(getDocumentRoot() . '/bankAcct/model/BankAcctBO.php');

/**
 * <p>
 * A class to do the Unit Testing of <tt>BankAcct</tt> CREATE functionality (add.php).
 * </p>
 */
/*class TestBankAcctAdd
{
    //BankAcctBO $bankAcctBO = null;//new BankAcctBO();

}

TestBankAcctAdd $obj = new TestBankAcctAdd();

echo "<pre>" , print_r($obj) , "</pre>";*/
?>

<h3>Test - Add BankAcct</h3>

<?php

    echo "Document Root : " . getDocumentRoot() . "<br/>";

require_once('../../inc/footer.php');
?>