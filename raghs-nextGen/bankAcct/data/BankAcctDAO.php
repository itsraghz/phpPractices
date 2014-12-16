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
 *
 * 2. 25 Nov 2014 Tuesday
 * ----------------------
 *      a. Added insert() and related methods
 *      b. Added delete() method
 *
 * 3. 30 Nov 2014 Sunday - Moved the functionality in delete to a diff method - deletePreCheck() so that it will be
 *                      reused in delete.php before actually getting a confirmation of the deletion.
 */

require_once(getDocumentRoot() . '/bankAcct/model/BankAcctBO.php');
require_once(getDocumentRoot() . '/includes/connection.php');

//require_once('model/BankAcctBO.php');
//require_once('../includes/connection.php');

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

    public function bindParams($dataArray, $query)
    {
        foreach ($dataArray as $key => $value) {
            if(is_null($value)) {
                echo " ***** <b>DEBUG:</b> Set to NULL for [" . $key . "] :) <br/>";
                $query->bindValue(':'. $key, $n=null, PDO::PARAM_INT);
            }else {
                echo " *********** <b>DEBUG:</b> Key [" . $key . "] set to  [" . $value . "] <br/>";
                $query->bindValue(':' . $key , $value);
            }
        }

        echo "--------------------------------- <br/>";
        echo "<b>DEBUG : </b> after binding --> " . print_r($query) . "<br/>";
        echo "--------------------------------- <br/>";

        $query->debugDumpParams();

        return $query;
    }

    public function insert($bankAcctBO)
    {
        global $pdo;

        $sql = "INSERT INTO TblBankAcct ";

        $sqlInsertClause = $this->getSQLInsertData($bankAcctBO->dataArray);

        //echo "$sqlInsertClause :: <i>" . $sqlInsertClause . "</i><br/>";

        $sql .= $sqlInsertClause;

        //echo "sql query :: <i>" . $sql . "</i><br/><br/>";

        $query = $pdo->prepare($sql);

        $retVal = '-1';

        //$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $lDataArray = $bankAcctBO->dataArray;

        /*echo "<b>Initialy :: </b><br/> ";
        echo "<pre>" , print_r($lDataArray) , "</pre><br/>";*/

        unset($lDataArray['Id']);

        echo "<b>After removing Id from Array :: </b><br/> ";
        echo "<pre>" , print_r($lDataArray) , "</pre><br/>";
        echo "<br/>";

        $query = $this->bindParams($lDataArray, $query);

        try {
            //$retVal = $query->execute($lDataArray);
            $retVal = $query->execute();
        } catch (PDOException $e) {
            echo "Exception occurred : " . $e->getMessage() . "<br/>";
            throw new Exception($e);
        }

        /* To close the cursor for efficient resource management */
        $query->closeCursor();

        //echo "Return Value (after) ::: " . $retVal . "<br/>";

        $lastInsertedId = $pdo->lastInsertId();

        $bankAcctBO->Id = $lastInsertedId;
        $bankAcctBO->dataArray['Id'] = $lastInsertedId;

        return $bankAcctBO;
    }

    public function NOTUsedinsertDirectValues($bankAcctBO)
    {
        global $pdo;

        $sql = "INSERT INTO TblBankAcct ";

        $sqlInsertClause = $this->getSQLInsertData($bankAcctBO->dataArray);

        //echo "$sqlInsertClause :: <i>" . $sqlInsertClause . "</i><br/>";

        $sql .= $sqlInsertClause;

        echo "sql query :: <i>" . $sql . "</i><br/>";

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
        $i = 0;

        foreach ($dataArray as $key => $value) {
            //echo " .. <u>Key : </u> " . $key . ", <u>Value : </u> [" . $value . "]<br/>";

            if (strcmp($key, "Id") == 0) {
                continue;
            }

            $sqlInsertKeys .= $key;

            $sqlInsertValues .= ":" . $key; //$this->getDataValueForSqlDML($value, $dataType);

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

    public function NOTUsedgetSQLInsertDataDirectValues($dataArray)
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

    public function fetch($id)
    {
        $bankAcctBO = new BankAcctBO();

        global $pdo;

        $query = $pdo->prepare("SELECT * from TblBankAcct where id=?");

        $query->setFetchMode(PDO::FETCH_CLASS, "BankAcctBO");

        $query->bindValue(1, $id);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $retVal = '-1';
        $lDataObj = '';

        try {
            $query->execute();
            $lDataObj = $query->fetchObject();

            if (null == $lDataObj) {
                throw new Exception('No matching rows');
            }

        } catch (PDOException $e) {
            echo "Exception occurred : " . $e->getMessage();
            throw new Exception($e);
        }

        /*echo "<b>DAO ::: </b><br/>";
        echo "<pre>" , print_r($lDataObj) , "</pre>";
        echo "<hr/>";*/

        $bankAcctBO->setup($lDataObj);

        return $bankAcctBO;
    }

    public function deletePreCheck($bankAcctBO)
    {
        $bankAcctBOObj = null;

        try {
            $bankAcctBOObj = $this->fetch($bankAcctBO->Id);
        } catch (Exception $e) {
            throw new Exception("Looks like the row with Id # " . $bankAcctBO->Id . " is already deleted.");
        }
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

        $this->deletePreCheck($bankAcctBO);

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

}