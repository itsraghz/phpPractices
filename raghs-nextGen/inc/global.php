<?php
/**
 * Created by PhpStorm.
 *
 *
 * User: Raghz
 * Date: 06/12/14
 * Time: 8:54 PM
 */

function getBaseDir2()
{
    /* DOES NOT work as it gives the abosulte path in disk :( */

    $DirOfThisFile = dirname(__FILE__);
    $loc = strrpos($DirOfThisFile, "/", 0);
    //echo "<i>Last Index of '/' is :  </i> " . $loc . " | ";
    $baseDir1 = substr($DirOfThisFile, 0, $loc);
    //echo "<i>BaseDir computed : </i> " . $baseDir1 . "<br/>";

    return $baseDir1;
}

function getBaseDir()
{
    $loc_pos_2 = strpos($_SERVER['REQUEST_URI'], "/", 1);
    $baseDir = substr($_SERVER['REQUEST_URI'], 0, $loc_pos_2);

    return $baseDir;
}

function getDocumentRoot()
{
    //echo "<b> BaseDir : </b> " . getBaseDir() . "<br/>";

    $docRoot =  getBaseDir() . '/' . 'raghs-nextGen';

    //$docRoot = getBaseDir2();

    return $docRoot;
}

define('DOCUMENT_ROOT', getDocumentRoot());

/**
 * <p>
 * A header array containing all the fields of the BankAcct Module matching with the Database Table 'TblBankAcct'
 * </p>
 */
$fullHeaderArray = array(
        "Id",
        "AcctNo",
        "AcctType",
        "Provider",
        "Bank",
        "Branch",
        "City",
        "ShortName",
        "CVV",
        "ValidThru",
        "NameRegistered",
        "EmailRegistered",
        "MemberSince",
        "URL",
        "Remarks",
        "IsActive"
);

/**
 * <p>
 * A partial header array to be used in the Listing of accounts where we may *NOT* need only few headers!
 * </p>
 */
$headerArrayForList =  array("Id", "AcctNo", "AcctType", "Provider", "Bank", "ShortName", "CVV",
    "ValidThru", "NameRegistered", "MemberSince", "Remarks"
);

//@todo: Fix the else part
$previous = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'javascript:history.go(-1);';


$submitBtnName = 'Submit';
$submitBtnClass = 'submit';
$submitBtnValue = 'Update';

$resetBtnName = 'Cancel';
$resetBtnClass = 'reset';
$resetBtnValue = 'Reset';

$backBtnName = 'Go Back';
$backBtnClass = 'reset';
$backBtnValue = 'Back';

function fetchValueFromRequestMap($array, $key)
{
    $data = '';

    if(isset($array[$key]) && !empty(trim($array[$key]))) {
        //echo "<hr/><b>DEBUG: </b> : array['" . $key . "'] is set and non-empty value! <br/> ";
        $data = trim($array[$key]);
    }
    else {
        //echo "<b>DEBUG: </b> : array['" . $key . "'] is NOT set OR empty value! <br/> ";
        $data = null;
    }

    echo "<b>DEBUG: </b> : array['" . $key . "'] -> " ;
    echo var_dump($data) . "<br/> ";

    return $data;
}

function getCellDataWithSpace($data, $spaceIfEmpty)
{
    if (empty($data))
    {
        if(!empty($spaceIfEmpty)) {
            $data = "&nbsp;";
        }
        else {
            $data = "";
        }
    }

    return trim($data);
}

function getEditableTableDataForCopy($dataObj, $name, $addPlaceHolderText)
{
    //$data = $dataObj->dataArray[$name];
    $data = $dataObj->$name;

    $data = getCellDataWithSpace($data, '');

    if (strcmp($name, "Id") != 0)
    {
        $data = "<input type='text' name='" . $name . "' value='" . $data . "' size='50' ";
    }

    if($addPlaceHolderText)
    {
        $data .= " placeholder='". $dataObj->placeHolderArray[$name] . "' ";
    }

    $data .= " />";

    return $data;
}

function getEditableTableDataForEdit($dataObj, $name)
{
    //$data = $dataObj->dataArray[$name];
    $data = $dataObj->$name;

    $data = getCellDataWithSpace($data, '');

    $data = "<input type='text' name='" . $name . "' value='" . $data . "' size='50'";

    if (strcmp($name, "Id") == 0) {
        $data .= " readonly class='readonly'";
    }

    $data .= " />";

    return $data;
}

function getEditableTableDataForView($dataObj, $name)
{
    //$data = $dataObj->dataArray[$name];
    $data = $dataObj->$name;

    $data = getCellDataWithSpace($data, '');

    //@todo make reusable for readonly, editable etc., with flags
    $data = "<input class='readonly' type='text' name='" . $name . "' value='" . $data . "' size='50' readonly />";

    return $data;
}

function getEditableTableData($dataObj, $name, $mode)
{
    $data = '';

    if(strcmp($mode, "edit")==0) {
        $data = getEditableTableDataForEdit($dataObj, $name);
    }
    else if(strcmp($mode, "copy")==0) {
        $data = getEditableTableDataForCopy($dataObj, $name, 0);
    }  else if(strcmp($mode, "add")==0) {
        $data = getEditableTableDataForCopy($dataObj, $name, 1);
    } else {
        $data = getEditableTableDataForView($dataObj, $name);
    }

    return $data;
}

/*function getSubmitCancelBtns()
{
    $submitCancelTxt = "<tr>" .
        "<td><input class='submit' type='submit' name='Update' value='Update'/> </td>" .
        "<td><input class='reset' type='reset' name='Cancel' value='Go Back' onclick='window.history.back();'/> </td>" .
        "</tr>";

    return $submitCancelTxt;
}*/

function getHTMLTRWithSubmitCancelBtns($mode)
{
    $submitCancelTxt =
        getHTMLTableRowBegin() ;

    $submitBtnTxt = '';

    global $submitBtnName;
    global $submitBtnClass;
    global $submitBtnValue;

    if(strcmp($mode, "edit")==0) {
        $submitBtnTxt = getSubmitBtn($submitBtnName, $submitBtnValue, $submitBtnValue);
    } else if (strcmp($mode, "copy")==0) {

    } else {
        $submitBtnTxt = getSubmitBtnWithHtmlTD();
    }

    $submitCancelTxt .= $submitBtnTxt;

    $submitCancelTxt .=
            getResetBtnWithHtmlTD().
        getHTMLTableRowClose();

    return $submitCancelTxt;
}

/*function getHTMLTRWithSubmitBackBtns()
{
    $submitCancelTxt =
        getHTMLTableRowBegin()  .
            getSubmitBtnWithHtmlTD().
            getBackBtnOnClickWithHtmlTD().
        getHTMLTableRowClose();

    return $submitCancelTxt;
}

function getHTMLTRWithSubmitCancelBackBtns()
{
    $submitCancelTxt =
        getHTMLTableRowBegin()  .
            getSubmitBtnWithHtmlTD().
            getResetBtnWithHtmlTD().
            getBackBtnOnClick().
        getHTMLTableRowClose();

    return $submitCancelTxt;
}*/

function getSubmitBtnWithHtmlTD()
{
    global $submitBtnName;
    global $submitBtnClass;
    global $submitBtnValue;

    $submitBtnTxt  =

        getHTMLTableDataBegin().
            getSubmitBtn($submitBtnName, $submitBtnValue, $submitBtnClass) .
        getHTMLTableDataClose() ;

    return $submitBtnTxt;
}

function getSubmitBtnWithHtmlTDCustom($submitBtnName, $submitBtnValue, $submitBtnClass)
{
    $submitBtnTxt  =

        getHTMLTableDataBegin().
            getSubmitBtn($submitBtnName, $submitBtnValue, $submitBtnClass) .
        getHTMLTableDataClose() ;

    return $submitBtnTxt;
}

function getResetBtnWithHtmlTD()
{
    global $resetBtnName;
    global $resetBtnClass;
    global $resetBtnValue;

    $resetBtnTxt  =

        getHTMLTableDataBegin().
            getResetBtn($resetBtnName, $resetBtnValue, $resetBtnClass) .
        getHTMLTableDataClose() ;

    return $resetBtnTxt;
}

function getBackBtnOnClickWithHtmlTD()
{

    $backBtnTxt  =

        getHTMLTableDataBegin().
            getBackBtnOnClick() .
        getHTMLTableDataClose() ;

    return $backBtnTxt;
}

function getBackBtnOnClick()
{
    global $backBtnName;
    global $backBtnClass;
    global $backBtnValue;

    $backBtnOnClick = '';

    global $previous; //Needed otherwise, it declares 'undefined variable' error!

    //echo "<b>Debug - PREVIOUS (1) </b> :: " . $_SERVER['HTTP_REFERER'] . "<br/>";

    /* If PHP Superglobal is set, assign it! Else, go with Javascript! */
    if(!empty($previous)) {
        $backBtnOnClick = $previous;
    } else {
        $backBtnOnClick = 'window.history.back();'; // Javascript way! Can also use 'history.go(-1)';
    }

    //echo " <b>Debug - PREVIOUS</b> :: " . $previous . "<br/>";
    //echo " <b>Debug - \$backBtnOnClick</b> :: " . $backBtnOnClick . "<br/>";

    $backBtnTxt  = getBackBtnWithOnClick($backBtnName, $backBtnValue, $backBtnClass, $backBtnOnClick) ;

    return $backBtnTxt;
}

function getSubmitBtn($name, $value, $class)
{
    $submitBtnTxt = getHTMLBtn($name, 'submit', $value, $class, '');

    return $submitBtnTxt;
}

function getSubmitBtnWithOnClick($name, $value, $class, $onclick)
{
    $submitBtnTxt = getHTMLBtn($name, 'submit', $value, $class, $onclick);

    return $submitBtnTxt;
}

function getResetBtn($name, $value, $class)
{
    $resetBtnTxt = getHTMLBtn($name, 'reset', $value, $class, '');

    return $resetBtnTxt;
}

/**
 * <p>
 * Mostly the Back button will be used ONLY with the onclick functionality!
 * Hence, the other (3 arg) verison of getBackBtn() is NOT written.
 * </p>
 *
 * @param $name
 * @param $value
 * @param $class
 * @param $onclick
 * @return string
 */
function getBackBtnWithOnClick($name, $value, $class, $onclick)
{
    $backBtnTxt = getHTMLBtn($name, 'submit', $value, $class, $onclick);

    return $backBtnTxt;
}

function getHTMLBtn($name, $type, $value, $class, $onclick)
{
    $htmlBtnTxt = "<input class='" . $class . "' type='". $type . "' name='" . $name . "' value='" . $value . "' ";

    if(!empty($onclick))
    {
        $htmlBtnTxt .= " onclick='" . $onclick . "' ";
    }

    $htmlBtnTxt .= " />";

    return $htmlBtnTxt;
}

function getHTMLTableBegin()
{
    //@todo: Try to Bootstrap table, once CRUD with MVC is complete!
    $htmlTableBegin = "<table border=1 cellspacing=5 cellpadding=5>";

    return $htmlTableBegin;
}

function getHTMLTableClose()
{
    $htmlTableClose = "</table>";

    return $htmlTableClose;
}

function getHTMLTableRowBegin()
{
    $htmlTRBegin = "<tr>";

    return $htmlTRBegin;
}

function getHTMLTableRowClose()
{
    $htmlTRClose = "</tr>";

    return $htmlTRClose;
}

function getHTMLTableDataBegin()
{
    $htmlTDBegin = "<td>";

    return $htmlTDBegin;
}

function getHTMLTableDataClose()
{
    $htmlTDClose = "</td>";

    return $htmlTDClose;
}

function getHTMLTableHeaderBegin()
{
    $htmlTHBegin = "<th>";

    return $htmlTHBegin;
}

function getHTMLTableHeaderClose()
{
    $htmlTHClose = "</th>";

    return $htmlTHClose;
}

function getHTMLFormBegin($formName, $httpMethod, $actionURL, $params)
{
    $htmlFormBegin = "<form ";

    /* ----- Form Name ----- */

    $lFormName = 'myForm'; //default

    if(!empty($formName)) {
        $lFormName =  $formName;
    }

    $htmlFormBegin .= " name='" . $lFormName . "' ";

    /* ----- Form HTTP Method ----- */

    $lHttpMethod = 'GET'; //default

    if(!empty($httpMethod)) {
        $lHttpMethod =  $httpMethod;
    }

    $htmlFormBegin .= " method='" . $lHttpMethod . "' ";

    /* ----- Form Action URL ----- */

    $lActionURL = '$_SERVER[\'PHP_SELF\']'; //default to the same php script

    if(!empty($actionURL)) {
        $lActionURL =  $actionURL;
    }

    $htmlFormBegin .= " action='" . $actionURL; // the value for action tag is NOT closed, kept open for Params if any

    /* ----- Form Parameters ----- */

    if(!empty($params)) {
        $htmlFormBegin .= "?" . $params ; // close the tag
    }

    //close the value for Action Tag!
    $htmlFormBegin .=  "'";

    /* ----- Form Element Close ----- */

    $htmlFormBegin .= " >";

    return $htmlFormBegin;
}

function getHTMLFormClose()
{
    $htmlFormClose = "</form>";

    return $htmlFormClose;
}

function getHTMLTableForDataForCopy($dataObj, $fieldHeaderArray, $mode)
{
    //"<form name='editAcctForm' method='post' action='insert.php'>";
    $action = 'insert.php';
    $params = '';
    $formName = 'editAcctForm';
    $method = 'post';

    return getHTMLTableForData($dataObj, $fieldHeaderArray, $mode, $action, $params, $formName, $method);
}

function getHTMLTableForDataForEdit($dataObj, $fieldHeaderArray, $mode)
{
    //$htmlTableData .= "<form name='editForm' method='post' action='update.php?Id=" . $dataObj->Id . "'>";
    $action = 'update.php';
    $params = 'Id=' . $dataObj->Id;
    $formName = 'editAcctForm';
    $method = 'post';

    return getHTMLTableForData($dataObj, $fieldHeaderArray, $mode, $action, $params, $formName, $method);
}

function getHTMLTableForDataForView($dataObj, $fieldHeaderArray, $mode)
{
    return getHTMLTableForData($dataObj, $fieldHeaderArray, $mode, '', '', '', '');
}


function getHTMLTableForData($dataObj, $fieldHeaderArray, $mode, $action, $params, $formName, $method)
{
    $htmlTableData = '';

    $editMode = !empty($mode) && (strcmp($mode, "edit")==0);

    $copyMode = !empty($mode) && (strcmp($mode, "copy")==0);

    $addMode = !empty($mode) && (strcmp($mode, "add")==0);

    $isEditMode = $editMode || $copyMode || $addMode;

    //echo "<b>[DEBUG] </b> Edit Mode ? " . $isEditMode . "<br/>";

    if($isEditMode) {
        $htmlFormBegin = getHTMLFormBegin($formName, $method, $action, $params);
        //$htmlTableData .= "<form name='editForm' method='post' action='update.php?Id=" . $dataObj->Id . "'>";
        $htmlTableData .= $htmlFormBegin;
    }

    $htmlTableData .= getHTMLTableBegin();

    $tableHeaderArray = array("Field", "Value");

    $htmlTableData .= getTableHeaderRow($tableHeaderArray);

    $htmlRowData = '';

    foreach ($fieldHeaderArray as $fieldHeader) {
        $htmlRowData .= getHTMLTableRowBegin();

        if(($copyMode || $addMode) && (strcmp($fieldHeader, "Id")==0)) {
            continue;
        }

        $htmlRowData .= getHTMLTableDataBegin() . $fieldHeader . getHTMLTableDataClose();
        $htmlRowData .= getHTMLTableDataBegin() . getEditableTableData($dataObj, $fieldHeader, $mode) . getHTMLTableDataClose();

        $htmlRowData .= getHTMLTableRowClose();
    }

    if($isEditMode) {
        $htmlRowData .=  getSubmitCancelBtns();//getHTMLTRWithSubmitCancelBtns($mode);
    }

    $htmlTableData .= $htmlRowData;

    $htmlTableData .= getHTMLTableClose();

    if($isEditMode) {
        $htmlTableData .= getHTMLFormClose();
    }

    return $htmlTableData;

}

function getTableHeaderRow($headerArray)
{
    $tableHeaderData = getHTMLTableRowBegin();

    foreach ($headerArray as $header) {
        $tableHeaderData .= getHTMLTableHeaderBegin() . $header . getHTMLTableHeaderClose();
    }

    $tableHeaderData .= getHTMLTableRowClose();

    return $tableHeaderData;
}