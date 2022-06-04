<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trader Verification | CHF DigiMart</title>
</head>
<body>
<?php
include "./connection.php";
    if (isset($_GET['tkey'])) {
        $tkey = $_GET['tkey'];   
        $stid = oci_parse($conn, 'SELECT * FROM TRADER');
        oci_execute($stid);

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        $tkeyCheck = $row['TVERIFYKEY'];
        
        if ($tkeyCheck == $tkey) {
            $temailverify = 1;
            $stid1 = oci_parse($conn, "UPDATE TRADER SET TEMAILVERIFY = :TEMAILVERIFY ");
            oci_bind_by_name($stid1, ':TEMAILVERIFY', $temailverify);
            oci_execute($stid1, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
            oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
            oci_free_statement($stid1);
            echo "Your email verification has been done successfuly! ";
        }
      }
     
    }
?>
</body>
</html>