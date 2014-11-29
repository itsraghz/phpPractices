<?php
/**
 * Created by PhpStorm.
 * User: Raghz
 * Date: 22/11/14
 * Time: 1:14 AM
 */
/*
 * Version History
 * ===============
 * 1. 22 Nov 2014 Saturday - Initial Version
 * 2. 25 Nov 2014 Tuesday - updated injectFromHttpRequest() with conditional update (ternary) of Id field from HTTP Post (for Copy/Insert)
 *
 */

class BankAcctBO
{
    public $Id, $AcctNo, $AcctType, $Provider, $Bank, $Branch, $City, $ShortName, $CVV,
        $ValidThru, $NameRegistered, $EmailRegistered, $MemberSince, $URL, $Remarks;

    public $dataArray;

    public function __construct()
    {
        //echo "Object of class TblBankBo instantiated... <br/>";
        //echo "<pre>", print_r($this) , "</pre>";
        //echo "<hr/>";
        $this->prepareArray();
    }

    public function prepareArray()
    {
        $this->dataArray = array(
            "Id" => $this->Id,
            "AcctNo" => $this->AcctNo,
            "AcctType" => $this->AcctType,
            "Provider" => $this->Provider,
            "Bank" => $this->Bank,
            "Branch" => $this->Branch,
            "City" => $this->City,
            "ShortName" => $this->ShortName,
            "CVV" => $this->CVV,
            "ValidThru" => $this->ValidThru,
            "NameRegistered" => $this->NameRegistered,
            "EmailRegistered" => $this->EmailRegistered,
            "MemberSince" => $this->MemberSince,
            "URL" => $this->URL,
            "Remarks" => $this->Remarks
        );

        /*echo "dataArray of BankAcctBO prepared..";
        echo "<br/>";
        echo "<pre>" , print_r($this->dataArray) . "</pre>";
        echo "<br/>";*/
    }

    public function setup($dataObj)
    {
        $this->Id = $dataObj->Id;
        $this->AcctNo = $dataObj->AcctNo;
        $this->AcctType = $dataObj->AcctType;
        $this->Provider = $dataObj->Provider;
        $this->Bank = $dataObj->Bank;
        $this->Branch = $dataObj->Branch;
        $this->City = $dataObj->City;
        $this->ShortName = $dataObj->ShortName;
        $this->CVV = $dataObj->CVV;
        $this->ValidThru = $dataObj->ValidThru;
        $this->NameRegistered = $dataObj->NameRegistered;
        $this->EmailRegistered = $dataObj->EmailRegistered;
        $this->MemberSince = $dataObj->MemberSince;
        $this->URL = $dataObj->URL;
        $this->Remarks = $dataObj->Remarks;

        //echo "<i>BankAcctBO is cloned with dataObj...</i><br/>";

        $this->prepareArray();
    }

    public function injectFromHttpRequest($httpArray)
    {
        //echo "<pre>" , print_r($httpArray) , "</pre>";

        $this->Id = (isset($httpArray['Id']) ? $httpArray['Id'] : -1);
        $this->AcctNo = $httpArray['AcctNo'];
        $this->AcctType = $httpArray['AcctType'];
        $this->Provider = $httpArray['Provider'];
        $this->Bank = $httpArray['Bank'];
        $this->Branch = $httpArray['Branch'];
        $this->City = $httpArray['City'];
        $this->ShortName = $httpArray['ShortName'];
        $this->CVV = $httpArray['CVV'];
        $this->ValidThru = $httpArray['ValidThru'];
        $this->NameRegistered = $httpArray['NameRegistered'];
        $this->EmailRegistered = $httpArray['EmailRegistered'];
        $this->MemberSince = $httpArray['MemberSince'];
        $this->URL = $httpArray['URL'];
        $this->Remarks = $httpArray['Remarks'];

        //echo "<i>BankAcctBO is cloned with dataObj...</i><br/>";

        $this->prepareArray();
    }
}