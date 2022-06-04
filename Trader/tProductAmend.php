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
        if (isset($_POST['pUpdate'])) {
            include "./connection.php";
            $pprice = $_POST['uprice'];
            $pquantity = $_POST['uquant'];
            $pid = $_POST['pid'];

            $stid = oci_parse($conn, "UPDATE PRODUCT SET PRODUCTPRICE = :PRODUCTPRICE, PRODUCTQUANTITY = :PRODUCTQUANTITY 
            WHERE PRODUCTID = :PRODUCTID");
            oci_bind_by_name($stid, ':PRODUCTID', $pid);
            oci_bind_by_name($stid, ':PRODUCTPRICE', $pprice);    
            oci_bind_by_name($stid, ':PRODUCTQUANTITY', $pquantity);
            oci_execute($stid, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
            oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
            oci_free_statement($stid);

            if ($stid) {
                ?>
                <script>
                    alert("Product Updated");
                    window.location.href = 'http://localhost/ecommerce/traderDashboard.php';
                </script>
            <?php
            }
        }
    ?>
</body>
</html>