<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Cart</title>
</head>
<body>
    <?php 
        include "./connection.php";

       

        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $cid = $_SESSION['cid'];
            $cartBool = false;

           
            //header("location:http://localhost/ecommerce/loginform.php");
            

            $stid = oci_parse($conn, 'SELECT * FROM WISHLIST');
            oci_execute($stid);
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                $pidcheck = $row['PID'];
                $cidcheck = $row['CID'];
               // $quantity = 1;

                if ($pid == $pidcheck && $cid == $cidcheck) {
                    $cartBool = true;
?>
                <script>
                    alert("Already added To WISHLIST");
                    window.location.href = 'http://localhost/ecommerce/home.php';
                </script>
<?php

                }
            }
            if (!$cartBool) {
                $stid1 = oci_parse($conn, "INSERT INTO WISHLIST (PID, CID) VALUES (:PID, :CID)");
                oci_bind_by_name($stid1, ':PID', $pid);
                oci_bind_by_name($stid1, ':CID', $cid);
               
                oci_execute($stid1, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
                oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
                oci_free_statement($stid1);
?>      
             <script>
                alert("Added To WISHLIST");
                window.location.href = 'http://localhost/ecommerce/home.php';
            </script>
<?php
            }
        }
    ?>
</body>
</html>