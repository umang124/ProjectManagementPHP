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
    $subject = "Your order has been received!";
    $headers = "From: CHFDigimart";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        include "./connection.php";
        if (isset($_SESSION['approved'])) {
            $customername = $_SESSION['cname'];
            $day = $_SESSION['day'];
            $time = $_SESSION['time'];
            $cid = $_SESSION['cid'];
            $stid = oci_parse($conn, "SELECT * FROM CART WHERE CID = '$cid'");
            oci_execute($stid);
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                $cartid = $row['CARTID'];
                $cartQuan = $row['CQUANTITY'];
                $pid = $row['PID'];

                $stid2 = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCTID = '$pid'");
                oci_execute($stid2);
                while (($row2 = oci_fetch_array($stid2, OCI_BOTH)) != false) {
                    $trader_id = $row2['TID'];
                }

                $stid1 = oci_parse($conn, "INSERT INTO ORDERS (PRODUCTQUANTITY, CID, PID, PLACEORDERDAY, PLACEORDERTIME, TID)
                 VALUES (:PRODUCTQUANTITY, :CID, :PID, :PLACEORDERDAY, :PLACEORDERTIME, :TID)");
                oci_bind_by_name($stid1, ':PRODUCTQUANTITY', $cartQuan);
                oci_bind_by_name($stid1, ':CID', $cid);
                oci_bind_by_name($stid1, ':PID', $pid);
                oci_bind_by_name($stid1, ':PLACEORDERDAY', $day);
                oci_bind_by_name($stid1, ':PLACEORDERTIME', $time);
                oci_bind_by_name($stid1, ':TID', $trader_id);
               
                oci_execute($stid1, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
                oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
                oci_free_statement($stid1);
            }

            $stidinvoice = oci_parse($conn, "SELECT * FROM CART WHERE CID = '$cid'");
            oci_execute($stidinvoice);
            $total = 0;

            $message = '

<html>




<body style="color: #000; font-size: 16px; text-decoration: none; font-family: , Helvetica, Arial, sans-serif; background-color: #efefef;">

<div id="wrapper" style="max-width: 1000px; margin: auto auto; padding: 20px;">
<div id="logo" style="">
				
			</div>

            <div id="content" style="font-size: 16px; padding: 25px; background-color: #fff;
				moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; -khtml-border-radius: 10px;
				border-color: #A3D0F8; border-width: 4px 1px; border-style: solid;">

                <div>
                    
                Bill From: <br>
                CHFDigiMart <br>

                Bill To: <br>
                ' . $customername .  '<br>

                <br>
                
                
                </div>

                <div style=" color:white; display:flex;
                justify-content:center;background-color:#898989;">Sales Invoice</div>


                <div style="float: right; ">   
                
                <P>Order Date: '.$day.'</P>
              
                </div>

		<table style=" width:100%; border-style:solid; border-width:1px; border-color:#000000; border-collapse: collapse;">
		<tr>
		  <th>Product ID</th>
		  <th>Product Name</th>
		  <th>Product Price</th>
		  <th>Product Quantity</th>
		  <th>Price by Quantity</th>
		</tr>';	
      while (($rowinvoice = oci_fetch_array($stidinvoice, OCI_BOTH)) != false) {
		
            $cartQuaninvoice = $rowinvoice['CQUANTITY'];
            $pidinvoice = $rowinvoice['PID'];

            $stid2invoice = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCTID = '$pidinvoice'");
            oci_execute($stid2invoice);
            while (($row2invoice = oci_fetch_array($stid2invoice, OCI_BOTH)) != false) {
                $productnameinvoice = $row2invoice['PRODUCTNAME'];
                $productpriceinvoice = $row2invoice['PRODUCTPRICE'];
                $producttotalprice = $productpriceinvoice * $cartQuaninvoice;
                $total = $total + $producttotalprice;			  
		
            }
            $message .='
            <tr>
            <td>'.$pidinvoice.'</td>
            <td>'.$productnameinvoice.'</td>
            <td>'.$productpriceinvoice.'</td>
            <td>'.$cartQuaninvoice.'</td>
            <td>'. 'Rs '.$producttotalprice.'</td>	  
            </tr>';
}


	  
$message .=' 

<tr>
<td  colspan="6" ></td>
<td   >Total Price: </td>
<td   >' . 'Rs '.$total.'</td>
  </tr>
</table>
</div>
</div>

</body>

</html>
';

$message .= 'Please shop again! ';


            $stidcustomer = oci_parse($conn, "SELECT * FROM CUSTOMER WHERE CID = '$cid'");
            oci_execute($stidcustomer);
            while (($row2customer = oci_fetch_array($stidcustomer, OCI_BOTH)) != false) {
                $cemail = $row2customer['CEMAILADDRESS'];
            }

if (mail($cemail, $subject, $message, $headers)) {
    ?> <script>alert("Please Check your email to receive invoice");</script> <?php
}
            ?>
            <script>
                window.location.href = 'http://localhost/ecommerce/updateCart.php';         
            </script>
        <?php
        }
    ?>
</body>
</html>