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
        if (isset($_POST['shopsubmit'])) {

            $stidShop = false;
            $sname2 = $_POST['sname2'];
            // echo $sname2;
            $tid = $_SESSION['tid'];

        
            $stidShop = oci_parse($conn, "UPDATE SHOP SET SNAME2 = :SNAME2 WHERE TID = :TID "); 
            oci_bind_by_name($stidShop, ':SNAME2', $sname2);
            oci_bind_by_name($stidShop, ':TID', $tid);
            oci_execute($stidShop, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
            oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
            oci_free_statement($stidShop);
                    

            if ($stidShop) {
?>
            <script>
            alert("Shop Added");
            window.location.href = 'http://localhost/ecommerce/trader/tmanageProfileform.php';
            </script>
            
<?php
           
            }
        }
?>
            

</body>
</html>