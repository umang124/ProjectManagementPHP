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
            $cartid = $row['CARTID'];

            $stid1 = oci_parse($conn, "DELETE FROM CART WHERE CARTID = '$cartid'");
            oci_execute($stid1);  // use OCI_DEFAULT for PHP <= 5.3.1
           
        }
        unset($_SESSION['approved']);
        ?>
        <script>
            window.location.href = 'http://localhost/ecommerce/viewCart.php';         
        </script>
    <?php
    }
    ?>
</body>
</html>