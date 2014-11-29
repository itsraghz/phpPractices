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
 * 1. 22 Nov 2014 Saturday - Initial Version
 * 2. 23 Nov 2014 Sunday - modularized
 */

include_once '../inc/header.php';

$itemArray = array("List", "Edit", "Delete");

?>
    <header><h3>Account / Cards Management</h3></header>
    <table border="1" cellpadding="5" cellspacing="5">
        <tr>
            <th>Sl #</th>
            <th>Action</th>
            <th>Link</th>
        </tr>
        <tr>
            <td>1</td>
            <td>List the Bank Accounts</td>
            <td><a href="list.php">Link</a></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Edit an Account</td>
            <td><a href="edit.php">Link</a></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Delete an Account</td>
            <td><a href="delete.php">Link</a></td>
        </tr>
    </table>

<?php
include_once '../inc/footer.php';
?>