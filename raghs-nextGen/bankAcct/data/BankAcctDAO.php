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
 * 1. 23 Nov 2014 Sunday - Initial Version
 * 2. 25 Nov 2014 Tuesday
 * ----------------------
 *      a. Added insert() and related methods
 *      b. Added delete() method
 *
 */

require_once('model/BankAcctBO.php');
require_once('../includes/connection.php');

class BankAcctDAO
{
    public function update($bankAcctBO)
    {
        global $pdo;

        $sql = "UPDATE TblBankAcct ";

        $sqlUpdateSet = $this->sqlUpdateSet($bankAcctBO->dataArray);

        //echo "sqlUpdateSet :: <i>" . $sqlUpdateSet . "</i><br/>";

        $sql .= $sqlUpdateSet;

        $sql .= " WHERE id=?";

        //echo "sql query :: <i>" . $sql . "</i><br/>";

        $query = $pdo->prepare($sql);

        $query->bindValue(1, $bankAcctBO->Id);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $retVal = '-1';

        try {
            $retVal = $query->execute();
        } catch (PDOException $e) {
            echo "Exception occurred : " . $e->getMessage();
            throw new Exception($e);
        }

        //echo "Return Value (after) ::: " . $retVal . "<br/>";
    }

    public function sqlUpdateSet($dataArray)
    {
        echo "<pre>", print_r($dataArray), "</pre><br/>";

        $sqlUpdateSet = ' SET ';

        $key = '';
        $dataType = 'char';
        $i = 0;

        foreach ($dataArray as $key => $value) {
            //echo " .. <u>Key : </u> " . $key . ", <u>Value : </u> [" . $value . "]<br/>";

            if (strcmp($key, "Id") == 0) {
                $dataType = "int";
            } else {
                $dataType = 'char';
            }

            $sqlUpdateSet .= $key . '=' . $this->getDataValueForSqlDML($value, $dataType);

            if ($i != count($dataArray) - 1) {
                $sqlUpdateSet .= " , ";
            }

            $i++;
        }

        return $sqlUpdateSet;
    }

    public function getDataValueForSqlDML($data, $dataType)
    {
        //echo "   ---> data : " . $data . ", dataType : " . $dataType . "<br/>";

        if (strcmp($dataType, "char") == 0) {
            return "'" . $data . "'";
        } else {
            return $data;
        }
    }

    public function insert($bankAcctBO)
    {
        global $pdo;

        $sql = "INSERT INTO TblBankAcct ";

        $sqlInsertClause = $this->getSQLInsertData($bankAcctBO->dataArray);

        //echo "$sqlInsertClause :: <i>" . $sqlInsertClause . "</i><br/>";

        $sql .= $sqlInsertClause;

        //echo "sql query :: <i>" . $sql . "</i><br/>";

        $query = $pdo->prepare($sql);

        $retVal = '-1';

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $retVal = $query->execute();
        } catch (PDOException $e) {
            echo "Exception occurred : " . $e->getMessage();
            throw new Exception($e);
        }

        //echo "Return Value (after) ::: " . $retVal . "<br/>";

        $lastInsertedId = $pdo->lastInsertId();

        $bankAcctBO->Id = $lastInsertedId;
        $bankAcctBO->dataArray['Id'] = $lastInsertedId;

        return $bankAcctBO;
    }

    public function getSQLInsertData($dataArray)
    {
        //echo "<pre>" , print_r($dataArray) , "</pre><br/>";

        $sqlInsertKeys = ' ( ';
        $sqlInsertValues = ' VALUES ( ';

        $key = '';
        $dataType = 'char';
        $i = 0;

        foreach ($dataArray as $key => $value) {
            //echo " .. <u>Key : </u> " . $key . ", <u>Value : </u> [" . $value . "]<br/>";

            if (strcmp($key, "Id") == 0) {
                continue;
            } else {
                $dataType = 'char';
            }

            $sqlInsertKeys .= $key;

            $sqlInsertValues .= $this->getDataValueForSqlDML($value, $dataType);

            if ($i != count($dataArray) - 2) //because omitting 'Id' field
            {
                $sqlInsertKeys .= " , ";
                $sqlInsertValues .= " , ";
            }

            $i++;
        }

        $sqlInsertKeys .= " ) ";
        $sqlInsertValues .= " ) ";

        return $sqlInsertKeys . $sqlInsertValues;
    }

    public function delete($bankAcctBO)
    {
        global $pdo;

        $sql = "DELETE FROM TblBankAcct WHERE id=?";

        //echo "sql query :: <i>" . $sql . "</i><br/>";

        $query = $pdo->prepare($sql);

        $query->bindValue(1, $bankAcctBO->Id);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $retVal = '-1';

        $bankAcctBOObj = null;

        try {
            $bankAcctBOObj = $this->fetch($bankAcctBO->Id);
        } catch (Exception $e) {
            throw new Exception("No matching rows with Id # " . $bankAcctBO->Id);
        }

        try {
            $retVal = $query->execute();

            //echo "Return Value (after) ::: " . $retVal . "<br/>";

            if (!$retVal) {
                throw new Exception("No matching rows with Id # " . $bankAcctBO->Id);
            }

        } catch (PDOException $e) {
            echo "Exception occurred : " . $e->getMessage();
            throw new Exception($e);
        }
    }

    public function fetch($id)
    {
        $bankAcctBO = new BankAcctBO();

        global $pdo;

        $query = $pdo->prepare("SELECT * from TblBankAcct where id=?");

        $query->setFetchMode(PDO::FETCH_CLASS, "BankAcctBO");

        $query->bindValue(1, $id);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $retVal = '-1';

        try {
            $query->execute();
            $dataObj = $query->fetchObject();

            if (null == $dataObj) {
                throw new Exception('No matching rows');
            }

        } catch (PDOException $e) {
            echo "Exception occurred : " . $e->getMessage();
            throw new Exception($e);
        }

        /*echo "<b>DAO ::: </b><br/>";
        echo "<pre>" , print_r($dataObj) , "</pre>";
        echo "<hr/>";*/

        $bankAcctBO->setup($dataObj);

        return $bankAcctBO;
    }

}