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
        if (isset($_GET['cid'])) {
           
            $cartid = $_GET['cid'];

            $stid1 = oci_parse($conn, "DELETE FROM CART WHERE CARTID = '$cartid'");
            oci_execute($stid1);  // use OCI_DEFAULT for PHP <= 5.3.1

    ?>
        <script>
            alert("Deleted From Cart!");
            window.location.href = 'http://localhost/ecommerce/viewCart.php';  
        </script>
    <?php

        }
    ?>
</body>
</html>