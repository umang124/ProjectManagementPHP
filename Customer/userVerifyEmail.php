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
    if (isset($_GET['ukey'])) {
        $ukey = $_GET['ukey'];   
        $stid = oci_parse($conn, 'SELECT * FROM CUSTOMER');
        oci_execute($stid);

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        $ukeyCheck = $row['UVERIFYKEY'];
        
        if ($ukeyCheck === $ukey) {
            $cemailverify = 1;
            $stid1 = oci_parse($conn, "UPDATE CUSTOMER SET CEMAILVERIFY = :CEMAILVERIFY ");
            oci_bind_by_name($stid1, ':CEMAILVERIFY', $cemailverify);
            oci_execute($stid1, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
            oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
            oci_free_statement($stid1);
            echo "Your account has been registered successfully! ";
        }
      }
     
    }
?>
</body>
</html>