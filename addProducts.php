<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addProducts.css">
    <title>CHFDigiMart | Add Products</title>
</head>
<body>
    <?php
        include "./connection.php";
        if (isset($_SESSION['tid'])) {
            $pNameErr = $pQuantityErr = $pDisErr = $ppriceErr = $shopNameErr ="";
            

            $tid = $_SESSION['tid'];
            //$tshop = $_SESSION['tshop'];
            // $stid = oci_parse($conn, 'SELECT * FROM TRADER');
            // oci_execute($stid);
    
            $stid1 = oci_parse($conn, 'SELECT * FROM PRODUCT');
            oci_execute($stid1);

            $shop1 = $shop2 = "";
            $stdshop = oci_parse($conn, "SELECT SID, SNAME1, SCATEGORY, SNAME2 FROM SHOP WHERE TID = '$tid'");
            oci_execute($stdshop);
            if ($stdshop) {
                while (($rowsh = oci_fetch_array($stdshop, OCI_BOTH)) != false) {
                    $shop1 = $rowsh['SNAME1'];
                    if (isset($rowsh['SNAME2'])) {
                        $shop2 = $rowsh['SNAME2'];  
                    }
                       
                    $shopid = $rowsh['SID']; 
                    $pCategory = $rowsh['SCATEGORY'];
                }
            }
           
    
            if (isset($_POST['psubmit'])) {
                $pname = $_POST['pName'];
                $pprice = $_POST['pPrice'];
                $pDis = $_POST['pDis'];
                
                $pallergy = $_POST['pAllergy'];
                
                
                $pQuantity = $_POST['pQuantity'];
                $pshopName = $_POST['sName'];
                
                $pdescript = $_POST['pDesc'];

                $Profile_Image = $_FILES['pImage'];
                $filename = $Profile_Image['name'];
                $fileerror = $Profile_Image['error'];
                $filetmp = $Profile_Image['tmp_name'];

                $imgext = explode('.', $filename);
                $filecheck = strtolower(end($imgext));

                $fileextstored = array('png', 'jpg', 'jpeg');

                if (in_array($filecheck, $fileextstored)) {
                    $destinationfile = 'images/' . $filename;
                    move_uploaded_file($filetmp, $destinationfile);
                }
    
                // validation
                
                if (!is_numeric($pprice)) {
                    $ppriceErr = "Price must be numeric!";
                    $pprice = null;
                }
                if (!is_numeric($pDis) || ($pDis < 0 || $pDis > 100)) {
                    $pDisErr = "Invalid Discount amount";
                    $pDis = null;
                }

                while (($row = oci_fetch_array($stid1, OCI_BOTH)) != false) {
                    $pnameCheck = $row['PRODUCTNAME'];
                    if ($pnameCheck == $pname) {
                        $pNameErr = "This product has already been added";
                        $pname = null;
                    }
                }

                if (!empty($pname) && !empty($pprice)) {
                    $stid = oci_parse($conn, "INSERT INTO PRODUCT (PRODUCTNAME, PRODUCTPRICE, PRODUCT_CATEGORY, PRODUCTQUANTITY,
                    PRODUCT_DESCRIPTION, DISCOUNT_PERCENT, ALLERGY_INFORMATION, PRODUCT_IMAGE, SHOPNAME,
                    SID, TID) VALUES (:PRODUCTNAME, :PRODUCTPRICE, :PRODUCT_CATEGORY, :PRODUCTQUANTITY,
                    :PRODUCT_DESCRIPTION, :DISCOUNT_PERCENT, :ALLERGY_INFORMATION, :PRODUCT_IMAGE, :SHOPNAME,
                    :SID, :TID)");
                    oci_bind_by_name($stid, ':PRODUCTNAME', $pname);
                    oci_bind_by_name($stid, ':PRODUCTPRICE', $pprice);
                    oci_bind_by_name($stid, ':PRODUCT_CATEGORY', $pCategory);
                    oci_bind_by_name($stid, ':PRODUCTQUANTITY', $pQuantity);
                    oci_bind_by_name($stid, ':PRODUCT_DESCRIPTION', $pdescript);
                    oci_bind_by_name($stid, ':DISCOUNT_PERCENT', $pDis);
                    oci_bind_by_name($stid, ':ALLERGY_INFORMATION', $pallergy);
                    oci_bind_by_name($stid, ':PRODUCT_IMAGE', $destinationfile);
                    oci_bind_by_name($stid, ':SHOPNAME', $pshopName);
                    oci_bind_by_name($stid, ':SID', $shopid);
                    oci_bind_by_name($stid, ':TID', $tid);

                    oci_execute($stid, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
                    oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
                    oci_free_statement($stid);
                    if ($stid) {
                        ?>
                        <script>alert("Product Added");</script>
                        <?php
                    }
                }                
            }
    ?>
            <div class="product-form">
                <div class="hp">
                    <h4>Add Products</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="container">
                    <div class="error"><?php echo $pNameErr; ?></div>
                    <div class="input-box">
                        <input type="text" placeholder="Product Name" name="pName" required>
                    </div>

                    <div class="input-box">
                        <div class="container">
                            <label for="choose-file"><h3>Product Image</h3></label>
                            <input id="choose-file" type="file" name="pImage" placeholder="Product Image" required/>
                        </div>
                    </div>
                    </div>

                    <div class="container">
                    <div class="error"><?php echo $ppriceErr; ?></div>
                    <div class="input-box">
                        <input type="text" placeholder="Product Price" name="pPrice" required>
                    </div>

                    <div class="error"><?php echo $shopNameErr; ?></div>
                    <div class="input-box">
                        <select name="sName" required>
                            <option value="" selected>Select Shop</option>
                            <option value="<?php echo $shop1 ?>"><?php echo $shop1 ?></option>
                            <option value="<?php echo $shop2 ?>"><?php if($shop2 != null) {echo $shop2;} else { echo "-------------------"; } ?></option>
                        </select>
                    </div>
                    </div>

                    <div class="container">
                    <div class="error"><?php echo $pDisErr; ?></div>
                    <div class="input-box">
                        <input type="text" placeholder="Discount Percent" name="pDis">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Allergy Information" name="pAllergy">
                    </div>
                    </div>

                    <div class="container">
                    <div class="input-box">
                        <input type="text" placeholder="Product Description" name="pDesc">
                    </div>

                    <div class="error"><?php echo $pQuantityErr; ?></div>
                    <div class="input-box">
                        <input type="text" name="pQuantity" placeholder="Quantity" required>
                    </div>
                    </div>

                    
                    
                    <div class="submit-box">
                        <input type="submit" name="psubmit" value="Add">
                    </div>
                </form>
            </div>
    <?php
        }
     
    ?>
</body>
</html>