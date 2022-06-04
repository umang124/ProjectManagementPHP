<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "./connection.php";
        if (isset($_SESSION['approved'])) {

            $cid = $_SESSION['cid'];
            $stid = oci_parse($conn, "SELECT * FROM CART WHERE CID = '$cid'");
            oci_execute($stid);

            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                $c_pid = $row['PID'];
                $cartQuant = $row['CQUANTITY'];

                $stid1 = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCTID = '$c_pid'");
                oci_execute($stid1);

                while (($row1 = oci_fetch_array($stid1, OCI_BOTH)) != false) {
                    $pid = $row1['PRODUCTID'];
                    $pquantity = $row1['PRODUCTQUANTITY'];
                    $finalQuantity = $pquantity - $cartQuant;
                    $pcount = $row1['PCOUNT'];
                    $updatePcount = $pcount + 1;

                    $stid2 = oci_parse($conn, "UPDATE PRODUCT SET PRODUCTQUANTITY = :PRODUCTQUANTITY, PCOUNT =:PCOUNT WHERE PRODUCTID = :PRODUCTID"); 
                    oci_bind_by_name($stid2, ':PRODUCTQUANTITY', $finalQuantity);
                    oci_bind_by_name($stid2, ':PCOUNT', $updatePcount);
                    oci_bind_by_name($stid2, ':PRODUCTID', $pid);
                    oci_execute($stid2, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
                    oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
                    oci_free_statement($stid2);
                }
            }

        ?>
            <script>
                window.location.href = 'http://localhost/ecommerce/insertOrderDetails.php';         
            </script>
        <?php

        }
    ?>
</body>
</html>