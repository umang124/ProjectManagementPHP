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
        ?>
            <script>alert("Payment Successful");</script>
    <?php
        ?>
            <script>
                window.location.href = 'http://localhost/ecommerce/updateProducts.php';         
            </script>
        <?php
        }
    ?>
   
</body>
</html>