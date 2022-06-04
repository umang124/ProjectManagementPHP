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

            $stid1 = oci_parse($conn, "DELETE FROM WISHLIST WHERE PID = '$pid'");
            oci_execute($stid1);  // use OCI_DEFAULT for PHP <= 5.3.1

            ?>
        <script>
            alert("Deleted From WISHLIST!");
            window.location.href = 'http://localhost/ecommerce/viewWishList.php';  
        </script>
    <?php
        }
    ?>
</body>
</html>