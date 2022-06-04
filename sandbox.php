<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="buyCredits" name="buyCredits">
        <input type="hidden" name="business" value="sb-lwfk4714614863@business.example.com">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="amount" value=3>
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="return" value="localhost/ecommerce/paymentsuccess.php">
    </form>

    <script>
        document.getElementById("buyCredits").submit();
    </script>
</body>
</html>