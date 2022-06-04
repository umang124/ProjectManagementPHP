<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Email | CHFDigiMart</title>
</head>
<body>
<?php
    if (isset($_GET['cemail'])) {
        $u_email = $_GET['cemail'];
        echo "Please Check your email to verify in " . $u_email;
    }
?>
</body>
</html>