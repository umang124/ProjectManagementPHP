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
        unset($_SESSION['cname']);
        unset($_SESSION['cid']);
        unset($_SESSION['cimage']);
    ?>
    
            <script>
            alert("Successfully Logged Out");
            window.location.href = 'http://localhost/ecommerce/loginForm.php';
            </script>
            

</body>
</html>