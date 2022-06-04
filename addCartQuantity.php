<?php
    if (isset($_POST['addquan'])) {
        include "./connection.php";
        $cartid = $_GET['cartid'];
        $updatequantity = $_POST['cquant'];
        $oldquan = $_POST['oldquan'];
        $quantity = $updatequantity + $oldquan;
       

        $stidcart = oci_parse($conn, "UPDATE CART SET CQUANTITY = :CQUANTITY WHERE CARTID = :CARTID "); 
        oci_bind_by_name($stidcart, ':CQUANTITY', $quantity);
        oci_bind_by_name($stidcart, ':CARTID', $cartid);
        oci_execute($stidcart, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
        oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
        oci_free_statement($stidcart);

        if ($stidcart) {
            ?>
                <script>
                    alert("Cart Updated");
                    window.location.href = 'http://localhost/ecommerce/viewCart.php';
                </script>
            <?php
        }


    }
?>