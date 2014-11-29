<?php
/**
 * Created by PhpStorm.
 * User: Raghz
 * Date: 23/11/14
 * Time: 12:14 PM
 */

require_once('../includes/connection.php');
include_once '../inc/header.php';
require_once 'model/BankAcctBO.php';

/*
 * Version History
 * ===============
 * 1. 22 Nov 2014 Saturday - Initial Version
 *
 */


/* ---------------------------------------------------------------------------------------- */
/*                          Functions Section - START                                       */
/* ---------------------------------------------------------------------------------------- */

function printTableHeaders()
{
    echo "<table border=\"1\" cellspacing=\"2\" cellpadding=\"2\">";

    /* Full List */
    /*$fullHeaderArray = array("Id", "AcctNo", "AcctType", "Provider", "Bank", "Branch", "City", "ShortName", "CVV",
        "ValidThru", "NameRegistered", "EmailRegistered", "MemberSince", "URL", "Remarks");*/

    $headerArray = array("Id", "AcctNo", "AcctType", "Provider", "Bank", "ShortName", "CVV",
        "ValidThru", "NameRegistered", "MemberSince", "Remarks");

    printTHData($headerArray);
}

function printTHData($thArray)
{
    $thData = "<tr>";

    foreach ($thArray as $th) {
        $th = ucwords($th);
        $thData = $thData . "<th>" . $th . "</th>";
    }

    $thData = $thData . "</tr>";

    echo $thData;
}

function getCellData($data)
{
    if (empty($data)) {
        $data = "&nbsp;";
    }

    return $data;
}

function getRUDLink($data, $colName)
{
    /*
    $editLink = "<a href='edit.php?" . $colName . "?=" . $data . "'>Edit</a>";
    $viewLink = "<a href='view.php?" . $colName . "?=" . $data . "'>View</a>";
    $delLink = "<a href='delete.php?" . $colName . "?=" . $data . "'>Delete</a>";
    */

    $actionArray = array("", "E", "D");
    $linkArray = array("view.php", "edit.php", "delete.php");

    $linkTxt = '';
    $actionTxt = '';

    for ($i = 0; $i < count($actionArray); $i++) {

        $linkTxt = $linkTxt . "<a href='" . $linkArray[$i] . "?" . $colName . "=" . $data . "'>";

        if ($i == 0) {
            $actionTxt = $data;
        } else {
            $actionTxt = $actionArray[$i];
        }

        $linkTxt = $linkTxt . $actionTxt . "</a>";

        if ($i != (count($actionArray) - 1)) {
            $linkTxt = $linkTxt . " | ";
        }
    }

    return $linkTxt;

}

function printRowData($r)
{
    //echo "--------------------------- <br/>";
    //echo " <b>DEBUG:</b><pre>", print_r($r) , "</pre>";

    $tdData = "<tr>";

    $tdData = $tdData . "<td>" . getRUDLink(getCellData($r->Id), 'Id') . "</td>";
    $tdData = $tdData . "<td>" . getCellData($r->AcctNo) . "</td>";
    $tdData = $tdData . "<td>" . getCellData($r->AcctType) . "</td>";
    $tdData = $tdData . "<td>" . getCellData($r->Provider) . "</td>";
    $tdData = $tdData . "<td>" . getCellData($r->Bank) . "</td>";
    //$tdData = $tdData . "<td>" . getCellData($r->Branch) . "</td>" ;
    //$tdData = $tdData . "<td>" . getCellData($r->City) . "</td>" ;
    $tdData = $tdData . "<td>" . getCellData($r->ShortName) . "</td>";
    $tdData = $tdData . "<td>" . getCellData($r->CVV) . "</td>";
    $tdData = $tdData . "<td>" . getCellData($r->ValidThru) . "</td>";
    $tdData = $tdData . "<td>" . getCellData($r->NameRegistered) . "</td>";
    //$tdData = $tdData . "<td>" . getCellData($r->EmailRegistered) . "</td>" ;
    $tdData = $tdData . "<td>" . getCellData($r->MemberSince) . "</td>";
    //$tdData = $tdData . "<td>" . getCellData($r->URL) . "</td>" ;
    $tdData = $tdData . "<td>" . getCellData($r->Remarks) . "</td>";

    $tdData = $tdData . "</tr>";

    return $tdData;
}


function printTableClose()
{
    echo "</table>";

    echo "<br/>";
}

/* ---------------------------------------------------------------------------------------- */
/*                          Main Content Area - START                                       */
/* ---------------------------------------------------------------------------------------- */

?>
    <header><h3>Account / Cards Management</h3></header>
    <b>Listing</b> &nbsp;&nbsp; | &nbsp;&nbsp; <a class='grayed' href="index.php">Home</a>

    <script language="javascript">
        function showHideDiv($var) {
            if ($var == "Debit") {
                //alert('Debit type selected');
                document.getElementById('CardType-Debit').style.display = 'inline';
                document.getElementById('CardType-Credit').style.display = 'none';
                document.getElementById('CardType-Misc').style.display = 'none';
            }
            else if ($var == "Credit") {
                //alert('Credit type selected');
                document.getElementById('CardType-Debit').style.display = 'none';
                document.getElementById('CardType-Credit').style.display = 'inline';
                document.getElementById('CardType-Misc').style.display = 'none';
            }
            else {
                //alert('Misc type selected');
                document.getElementById('CardType-Debit').style.display = 'none';
                document.getElementById('CardType-Credit').style.display = 'none';
                document.getElementById('CardType-Misc').style.display = 'inline';
            }
        }
    </script>

<?php

$sql = "SELECT * from TblBankAcct";
//$sql = $sql .  " where AcctType NOT in ('Credit', 'Debit')";
//$sql .= " LIMIT 2";

//echo "<b>Query :: </b> " . $sql . "<br/>";

$query = $pdo->query($sql);

$tdData = '';

$debitArray = array("Type" => "Debit");
$creditArray = array("Type" => "Credit");
$miscArray = array("Type" => "Misc");

$query->setFetchMode(PDO::FETCH_CLASS, "BankAcctBO");

while ($r = $query->fetchObject()) {
    //$tdData = $tdData . printRowData($r);
    //echo "<pre>", print_r($r) , "</pre>";

    if (strcmp($r->AcctType, "Debit") == 0) {
        $debitArray[] = $r;
    } else if (strcmp($r->AcctType, "Credit") == 0) {
        $creditArray[] = $r;
    } else {
        $miscArray[] = $r;
    }
}

$acctTypeMasterArray = array();
$acctTypeMasterArray[0] = $debitArray;
$acctTypeMasterArray[1] = $creditArray;
$acctTypeMasterArray[2] = $miscArray;

?>

    <table width="100%" border="1" cellspacing="5" cellpadding="5">
        <tr>

            <?php
            foreach ($acctTypeMasterArray as $master) {
                ?>

                <td class="tdHeader" align="center">
                    <b><a class="tdHeader"
                          href="javascript:showHideDiv('<?php echo $master["Type"]; ?>')"><?php echo $master["Type"]; ?></a></b>
                </td>
            <?php
            }

            echo "<hr/>";
            ?>

        </tr>
    </table>

    <br/><br/>
<?php

for ($j = 0; $j < count($acctTypeMasterArray); $j++) {
    $master = $acctTypeMasterArray[$j];

    $tdData = '';

    for ($i = 0; $i < count($master) - 1; $i++) {
        //echo "<pre>", print_r($r) , "</pre>";
        $tdData = $tdData . printRowData($master[$i]);
    }

    ?>
    <div id="CardType-<?php echo $master["Type"]; ?>" style="display:none">
        <?php
        if (count($master) > 1) {
            printTableHeaders();
            echo $tdData;
            printTableClose();
        } else {
            echo "<span class='error'>No matching records for the <b>" . $master["Type"] . "</b> type.</span>";
            echo "<br/>";
        }

        ?>
    </div>
<?php
}

include_once '../inc/footer.php';

?>