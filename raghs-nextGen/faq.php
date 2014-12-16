<?php
/**
 * Created by PhpStorm.
 * User: Raghz
 * Date: 07/12/14
 * Time: 5:47 PM
 */

/*
 *  Version History
 *  ================
 *
 * 1. 07 Dec 2014 - Initial Version
 *
 */

include_once 'inc/header.php';
?>

<h3>Good Links - for Knowledge</h3>

<?php
/*
    echo getHTMLTableBegin().
            getHTMLTableRowBegin().
                getHTMLTableHeaderBegin();
?>
                    Sl #
<?php

    echo
                getHTMLTableHeaderClose();
            getHTMLTableRowClose();
*/
?>



<?php

    /*echo getHTMLTableClose();*/
    $i = 1;

?>

<table border="1" cellspacing="5" cellpadding="5">
    <tr>
        <th>Sl #</th>
        <th>Item</th>
        <th>Link</th>
        <th>Remarks</th>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>HTTP Headers and the PHP Header() Function</td>
        <td><a href="http://web.archive.org/web/20080430141149/http://www.expertsrt.com/tutorials/Matt/HTTP_headers.html" target="_blank">Link</a></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>Stack Overflow (SO) - PHP Wiki Q & A</td>
        <td><a href="http://stackoverflow.com/questions/12769982/reference-what-does-this-error-mean-in-php/12778634#12778634" target="_blank">Link</a></td>
        <td>Set of Q & A on typical PHP Errors! <i>Awesome :)</i></td>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>Stack Overflow (SO) - PHP Undefined Variable</td>
        <td><a href="http://stackoverflow.com/questions/4261133/php-notice-undefined-variable-and-notice-undefined-index" target="_blank">Link</a></td>
        <td>Discussion on PHP Undefined Variable! <i>Good one :)</i></td>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>MySQL - Invalid Use of NULL Value</td>
        <td><a href="http://stackoverflow.com/questions/22971586/mysql-alter-table-causes-error-invalid-use-of-null-value" target="_blank">Link</a></td>
        <td>Occurs when you add a NOT NULL Constraint to a column that already has some NULL values. Update those values prior.Update</td>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>MySQL - PDO - bindParam() Vs bindValue()</td>
        <td>
            <a href="http://stackoverflow.com/questions/14413326/confusion-between-bindvalue-and-bindparam?lq=1" target="_blank">Link</a>
            <br/>
            <a href="http://stackoverflow.com/questions/1179874/pdo-bindparam-versus-bindvalue" target="_blank">Link</a>
        </td>
        <td>bindParam() is for varaibles that can be reused later. bindValue() is for values  (fixed) and can't be changed during later executions.
            <br/>Look for the examples in the links
        </td>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>SO - Wiki - PHP Parse / Syntax Errors</td>
        <td><a href="http://stackoverflow.com/questions/18050071/php-parse-syntax-errors-and-how-to-solve-them" target="_blank">Link</a></td>
        <td>Awesome compilation :)</td>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>SO - What is stdClass in PHP</td>
        <td><a href="http://stackoverflow.com/questions/931407/what-is-stdclass-in-php" target="_blank">Link</a></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><?php echo $i++;?></td>
        <td>Dummy</td>
        <td><a href="" target="_blank">Link</a></td>
        <td>&nbsp;</td>
    </tr>
</table>

<?php
include_once 'inc/footer.php';
?>