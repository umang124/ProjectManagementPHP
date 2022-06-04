<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="updateProduct.css" />
    <title>Update Product</title>
</head>
<body>

    <?php
        if (isset($_GET['pid'])) {
            include "./connection.php";
            $pid = $_GET['pid'];
            $stid = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCTID = '$pid' ");
            oci_execute($stid);
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                $pprice = $row['PRODUCTPRICE'];
                $pquantity = $row['PRODUCTQUANTITY'];

    ?>

            <form action="tProductAmend.php" method="POST">
            <div class="hp">
                    <h4>Update Product</h4>
            </div>
              Price  <input type="text" name="uprice" value="<?php echo $pprice; ?>">
               Quantity <input type="text" name="uquant" value="<?php echo $pquantity; ?>">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" name="pUpdate" value="Update">
            </form>
    <?php
            }
        }
    ?>
</body>
</html>