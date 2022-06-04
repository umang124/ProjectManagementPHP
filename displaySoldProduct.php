<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <title>Total Sold Product</title>
</head>
<body>

<h2 class="my-3 text-secondary">Your Sold Products</h2>

<?php
        include "./connection.php";
        if (isset($_SESSION['tid'])) {
            $tid = $_SESSION['tid'];

            $stid = oci_parse($conn, "SELECT * FROM ORDERS WHERE TID = '$tid'");
            oci_execute($stid);

            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                $pid = $row['PID'];
                $cid = $row['CID'];
                $pquantity = $row['PRODUCTQUANTITY'];
                $buyedtime = $row['ADD_TIME'];
                $time = $row['PLACEORDERTIME'];
                $day = $row['PLACEORDERDAY'];

                $stid2 = oci_parse($conn, "SELECT * FROM CUSTOMER WHERE CID = '$cid'");
                oci_execute($stid2);

                while (($row2 = oci_fetch_array($stid2, OCI_BOTH)) != false) {
                    $cfname = $row2['CFIRSTNAME'];
                    $clname = $row2['CLASTNAME'];
                }


                $stid1 = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCTID = '$pid'");
                oci_execute($stid1);

                while (($row1 = oci_fetch_array($stid1, OCI_BOTH)) != false) {
                    $pname = $row1['PRODUCTNAME'];
                    $pimage = $row1['PRODUCT_IMAGE'];
                    $pprice = $row1['PRODUCTPRICE'];
                }

                ?>               

                <div class="main-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="p-2 mb-4 bg-light border rounded shadow-sm">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <a href="#">
                                            <img src="<?php echo $pimage;?>" class="card-img-top" alt="..." /></a>
                                        </div>
                                        <div class="col-md-5">
                                            <h4><?php echo $pname; ?></h4>
                                            <h6 class="text-muted">Product Quantity: <?php echo $pquantity; ?></h6>
                                            <h6 class="text-muted">Price: Rs <?php echo $pprice; ?></h6>
                                            <h6 class="text-muted">Purchased By: <?php echo $cfname . " " . $clname; ?></h6>
                                            <h6 class="text-muted">Buyed at: <?php echo $buyedtime; ?></h6>
                                            <h6 class="text-muted">Collection Slot:  <?php echo $day . " at " . $time . " am"; ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <!--item-->
                            </div>
                            
                        </div>
                    </div>
                </div>

                
                <?php
               

            }
        }
    ?>
</body>
</html>