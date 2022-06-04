<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <?php
        //to send the email we need to do the following tasks
        //php.ini
        //sendmail.ini
        //gmail security change
        $to = "umangstha124@gmail.com";
        $subject = "Test Email";
        $message = "This is test email";

        if (mail($to, $subject, $message)) {
            echo "Email sent";
        } else {
            echo "Email not sent";
        }
    ?>
</body>
</html>