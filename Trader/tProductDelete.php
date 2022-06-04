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
        if (isset($_GET['pid'])) {
            include "./connection.php";
            $pid = $_GET['pid'];
            $stid = oci_parse($conn, "DELETE FROM PRODUCT WHERE PRODUCTID = :PRODUCTID");
            oci_bind_by_name($stid, ':PRODUCTID', $pid);
            oci_execute($stid);
            if ($stid) {
                ?>
                <script>
                    alert("Product Deleted");
                    window.location.href = 'http://localhost/ecommerce/home.php';
                </script>
            <?php
            }
        }
    ?>
</body>
</html>