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
 * 3. 06 Dec 2014 Saturday
 * -----------------------
 *      1. Added Javadoc to the methods
 *      2. Added isActive member (added the same to DB Table today) & other methods wherever applicable
 *      2. Added a placeHolder Array to be used in add.php (placeholder will be useful to give hint to user while adding a new record)
 *
 */

class BankAcctBO
{
    public $Id, $AcctNo, $AcctType, $Provider, $Bank, $Branch, $City, $ShortName, $CVV,
        $ValidThru, $NameRegistered, $EmailRegistered, $MemberSince, $URL, $Remarks, $IsActive;

    /**
     * <p>
     * An array to hold all the data members of the class.
     * </p>
     *
     * <p>
     * @todo: Need to revisit and document is purpose! :(
     * </p>
     *
     * @var dataArray
     */
    public $dataArray;

    /**
     * <p>
     * An array to have the placeholder text to be used in the Add New (C in CRUD) aspect
     * to display the hint to the user in the Web Page
     * </p>
     *
     * @var placeHolderArray
     */
    public $placeHolderArray;

    /**
     * <p>
     * The constructor of the class <tt>BankAcctBO</tt>.
     * </p>
     *
     * <p>
     * It will prepare the <tt>dataArray</tt> with the other members of the class.
     * </p>
     */
    public function __construct()
    {
        $this->prepareArray();
        $this->preparePlaceHolderArray();

        /*echo "Object of class TblBankBo instantiated... <br/>";
        echo "<hr/>";
        echo "<pre>", print_r($this) , "</pre>";
        echo "<hr/>";*/
    }

    /**
     * <p>
     * This method will prepare the <tt>dataArray</tt> member of the
     * <tt>BankAcctBO</tt> instance with the other class members
     * </p>
     */
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
            "Remarks" => $this->Remarks,
            "IsActive" => $this->IsActive
        );

        /*echo "dataArray of BankAcctBO prepared..";
        echo "<br/>";
        echo "<pre>" , print_r($this->dataArray) . "</pre>";
        echo "<br/>";*/
    }

    /**
     * <p>
     * This method acts as a <tt>copy constructor</tt> to copy the values of
     * members from the passed instance of the same class to <tt>this</tt> instance.
     * </p>
     * @param $dataObj
     */
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
        $this->IsActive = $dataObj->IsActive;

        //echo "<i>BankAcctBO is cloned with dataObj...</i><br/>";

        $this->prepareArray();
    }

    /**
     * <p>
     * This method will inject the <tt>BankAcctBO</tt> instance with the appropriate
     * values from the <tt>HttpRequest</tt>. It it agnostic of the Http Method (Get/Post),
     * as it expects that array to be passed from the caller.
     * </p>
     *
     * @param $httpArray
     */
    public function injectFromHttpRequest($httpArray)
    {
        //echo "<pre>" , print_r($httpArray) , "</pre>";

        $this->Id = fetchValueFromRequestMap($httpArray, 'Id');
        $this->AcctNo = fetchValueFromRequestMap($httpArray, 'AcctNo');
        $this->AcctType = fetchValueFromRequestMap($httpArray, 'AcctType');
        $this->Provider = fetchValueFromRequestMap($httpArray, 'Provider');
        $this->Bank = fetchValueFromRequestMap($httpArray, 'Bank');
        $this->Branch = fetchValueFromRequestMap($httpArray, 'Branch');
        $this->City = fetchValueFromRequestMap($httpArray, 'City');
        $this->ShortName = fetchValueFromRequestMap($httpArray, 'ShortName');
        $this->CVV = fetchValueFromRequestMap($httpArray, 'CVV');
        $this->ValidThru = fetchValueFromRequestMap($httpArray, 'ValidThru');
        $this->NameRegistered = fetchValueFromRequestMap($httpArray, 'NameRegistered');
        $this->EmailRegistered = fetchValueFromRequestMap($httpArray, 'EmailRegistered');
        $this->MemberSince = fetchValueFromRequestMap($httpArray, 'MemberSince');
        $this->URL = fetchValueFromRequestMap($httpArray, 'URL');
        $this->Remarks = fetchValueFromRequestMap($httpArray, 'Remarks');
        $this->IsActive = fetchValueFromRequestMap($httpArray, 'IsActive');

        //echo "<i>BankAcctBO is cloned with dataObj...</i><br/>";

        $this->prepareArray();
    }

    /**
     * <p>
     * This method will prepare the <tt>placeHolderArray</tt> member of the
     * <tt>BankAcctBO</tt> instance with the predefinex text to show hint to the user
     * while entering the values to create a new entity (C in CRUD).
     * </p>
     *
     * <p>
     * <b>Note:</b> As it would be entered within the text box and it may be of an average length of 20 to 40 chars,
     * it is good to keep the placeholder text to be short and sweet! :)
     * </p>
     */
    public function preparePlaceHolderArray()
    {
        $this->placeHolderArray = array(
            "Id" => "An unique Identifier", /* May not be needed as it is hidden from user while getting inputs */
            "AcctNo" => "Account number",
            "AcctType" => "Type of the Acct (Debit/Credit etc.,)",
            "Provider" => "Service Provider (Visa/MasterCard etc.,)",
            "Bank" => "Name of the Financial Institution",
            "Branch" => "Branch at which the acct is held",
            "City" => "City where the acct is held",
            "ShortName" => "Short Name to identify this acct (Ex. CitiPlatinum)",
            "CVV" => "3 or 4 digit CVV number for security",
            "ValidThru" => "validity period (mm/yy)",
            "NameRegistered" => "Name Registered with this Acct",
            "EmailRegistered" => "Email Registered for this Acct",
            "MemberSince" => "Since when the acct is held",
            "URL" => "URL of the Bank Website",
            "Remarks" => "Remarks if any",
            "IsActive" => "Whether it is Active (Y/N)"
        );

        /*echo "dataArray of BankAcctBO prepared..";
        echo "<br/>";
        echo "<pre>" , print_r($this->dataArray) . "</pre>";
        echo "<br/>";*/
    }
}