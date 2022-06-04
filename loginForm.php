<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | CHFDigiMart</title>
  <link rel="stylesheet" href="./loginStyle.css">
  <script src="https://kit.fontawesome.com/1084bd2d44.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<?php
include "./connection.php";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  $ctErr = "";
  if (isset($_POST['ct_submit'])) {
    $ct_email = test_input($_POST['ctEmail']);
    $ct_password = test_input($_POST['ctPassword']);
    $ct_role = $_POST['ctRole'];
    //$ct_password = password_hash($ct_password, PASSWORD_DEFAULT);

    if ($ct_role == "customer") {
      $stid = oci_parse($conn, 'SELECT * FROM CUSTOMER');
      oci_execute($stid);
      while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        if ($row['CEMAILADDRESS'] == $ct_email &&  $row['CPASSWORD'] == $ct_password && $row['CEMAILVERIFY'] == "1") {
         // $_SESSION['cemail'] = $ct_email;
          // $_SESSION['cpassword'] = $ct_password;
          // $_SESSION['crole'] = $ct_role;
          $_SESSION['cname'] = $row['CFIRSTNAME'];
          $_SESSION['cid'] = $row['CID'];
          $_SESSION['cimage'] = $row1['CIMAGE'];  
          header("location:http://localhost/ecommerce/home.php");
        }
        else {
          $ctErr = "Invalid Login Credentials";
        }
      }
    } 
    elseif ($ct_role == "trader") {
      $stid1 = oci_parse($conn, 'SELECT * FROM TRADER');
      oci_execute($stid1);
      while (($row1 = oci_fetch_array($stid1, OCI_BOTH)) != false) {
        if ($row1['TEMAILADDRESS'] == $ct_email && $row1['TPASSWORD'] == $ct_password 
                          && $row1['TEMAILVERIFY'] == "1" && $row1['TADMINVERIFY'] == "1") {
          
         // $_SESSION['temail'] = $ct_email;
          //$_SESSION['tpassword'] = $ct_password;
         // $_SESSION['trole'] = $ct_role;
          $_SESSION['tname'] = $row1['TFIRSTNAME'];
          $_SESSION['timage'] = $row1['TIMAGE'];  
          $_SESSION['tid'] = $row1['TID'];  
          $_SESSION['tcat'] = $row1['TCATEGORY'];
          header("location:http://localhost/ecommerce/traderDashboard.php");
        }
        else {
          $ctErr = "Invalid Login Credentials";
        }
      }
    }
  }
?>

  <div class="wrapper">
    <header>Login Form</header>
    <span class="error"><?php  echo $ctErr;  ?></span>
    <form action="" method="post" >
      <div class="field email">
        <div class="input-area">
          <input type="text" name="ctEmail" placeholder="Email Address" required="required">
          <i id="ic"  class="icon fas fa-envelope"></i>      
        </div>     
      </div>
      <div class="field password">
        <div class="input-area">    
          <input type="password" name="ctPassword" id="u_password" placeholder="Password" required="required"" >
          <i id="ic"  class="icon fas fa-lock"></i>     
        </div>
        <div class="cbox">
        <input id="checkbox" type="checkbox"  onclick="showFunction()"><h4>Show Password</h4> 
        </div>
        
      </div>     
      <div class="field checkbox">
        <div class="input-area">        
          <select name="ctRole" required="required">
            <option value="">Role</option>
            <option value="customer">Customer</option>
            <option value="trader">Trader</option>
          </select>    
          <i id="ic" class="fa-solid fa-user"></i>
        </div>
      </div>    
      <input type="submit" value="Login" name="ct_submit">
    </form>
    <div class="signup">
      <p>Not yet member ?</p>
      <a href="http://localhost/ecommerce/Trader/registerTrader.php">signup as trader</a>
      <a href="http://localhost/ecommerce/Customer/registerUser.php">signup as customer</a>  
    </div>
    
  </div>

       <!-- Javascript -->
       <script>
        function showFunction() {
            const password = document.getElementById("u_password");
            
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }    
        }
      </script>

</body>
</html>