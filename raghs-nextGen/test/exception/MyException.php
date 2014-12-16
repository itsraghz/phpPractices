<?php

function testException($var)
{
    echo "testException() - \$var is : " . $var . "<br/>";

    if ($var % 2 == 0)
        throw new Exception("Exception is thrown intentionally.");
}

try {
    testException(1);
} catch (Exception $e) {
    echo "Error Occured : " . $e->getMessage() . "<br/>";;
}

echo "Last line of the PHP file..";

?>