
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerUser.css">
    <title>Registration Form</title>
</head>
<body> 
  
          <!-- PHP -->
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$cFirstNameErr = $cLastNameErr = $cPhoneNumberErr = $cEmailErr = $cGenderErr = $cAddressErr = $cPasswordErr ="";
include "./connection.php";
$stid = oci_parse($conn, 'SELECT * FROM CUSTOMER');
oci_execute($stid);
if (isset($_POST['c_submit'])) {
  $cfName = test_input($_POST['cfName']);
  $clName = test_input($_POST['clName']);
  $cPhonenumber = test_input($_POST['cphoneNo']);
  $cEmail = test_input($_POST['cemail']);
  $cgender =$_POST['cgender'];
  $caddress = test_input($_POST['caddress']);
  $cpassword = test_input($_POST['cu_password']);
  $ccpassword = test_input($_POST['cc_password']);
  $ukey = md5(time().$cPhonenumber);

  $Profile_Image = $_FILES['cImages'];
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
  
    // first Name
    if (empty($cfName)) {
      $cFirstNameErr = "First Name is Empty";
    }
    elseif (is_numeric($cfName)) {
      $cFirstNameErr = "Invalid First Name";
      $cfName = null;
    }
    // last Name
    if (empty($clName)) {
      $cLastNameErr = "Last Name is Empty";
    }
    elseif (is_numeric($clName)) {
      $cLastNameErr = "Invalid First Name";
      $clName = null;
    }
    // phonenumber
    if (empty($cPhonenumber)) {
      $cPhoneNumberErr = "Phone Number is empty!";
    }
    elseif (!is_numeric($cPhonenumber)) {
      $cPhoneNumberErr = "Phone Number should always contains numberic values!";
      $cPhonenumber = null;
    }
    elseif (strlen($cPhonenumber) != 10) {
      $cPhoneNumberErr = "Phone Number must contains 10 digits number!";
      $cPhonenumber = null;
    }
    // email
    if (empty($cEmail)) {
      $cEmailErr = "Email is empty";
    }
    elseif (!filter_var($cEmail, FILTER_VALIDATE_EMAIL)) {
      $cEmailErr = "Invalid email provided!";
      $cEmail = null;
    }
    // gender
    if (empty($cgender)) {
      $cGenderErr = "Gender is empty";
    }
    // address
    if (empty($caddress)) {
      $cAddressErr = "Address is empty";
    }
    // password
    if (empty($cpassword) || empty($ccpassword)) {
      $cPasswordErr = "Password is empty!";
    }
    elseif ($cpassword !== $ccpassword) {
      $cPasswordErr = "Those passwords didn't match.Try again";
      $ccpassword = null;
    } 
    elseif(strlen($cpassword)  < 6)
    {
      $cPasswordErr =  "Password cannot be less than 6 character!";
      $ccpassword = null;
    }
    elseif(!preg_match("@[A-Z]@",$cpassword))
    {
      $cPasswordErr = "Your Password Must Contain At Least 1 Capital Letter!";
      $ccpassword = null;           
    }
    elseif(!preg_match("@[a-z]@",$cpassword)) 
    {
      $cPasswordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
      $ccpassword = null;
    }
    elseif(!preg_match("@[0-9]@", $cpassword))
    {
      $cPasswordErr = "Your Password Must Contains at least 1 number!";
      $ccpassword = null;    
    }
    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
      $phoneCheck = $row['CPHONENUMBER'];
      $emailCheck = $row['CEMAILADDRESS'];
      if ($cPhonenumber === $phoneCheck) {
        $cPhoneNumberErr = "Phone number has been registered";
        $cPhonenumber = null;
      }
      if ($cEmail === $emailCheck) {
        $cEmailErr = "Email has been registered";
        $cEmail = null;
      }
    }
  
    if (!empty($cfName) && !empty($clName) && !empty($cPhonenumber) && !empty($cEmail) && !empty($cgender) 
    && !empty($caddress) && !empty($cpassword) && !empty($ukey)) {
      $stid1 = oci_parse($conn, "INSERT INTO CUSTOMER (CFIRSTNAME, CLASTNAME, CPHONENUMBER, CEMAILADDRESS,
      CGENDER, CADDRESS, CPASSWORD, UVERIFYKEY, CIMAGE ) VALUES (:CFIRSTNAME, :CLASTNAME, :CPHONENUMBER, :CEMAILADDRESS,
      :CGENDER, :CADDRESS, :CPASSWORD, :UVERIFYKEY, :CIMAGE)");
      oci_bind_by_name($stid1, ':CFIRSTNAME', $cfName);
      oci_bind_by_name($stid1, ':CLASTNAME', $clName);
      oci_bind_by_name($stid1, ':CPHONENUMBER', $cPhonenumber);
      oci_bind_by_name($stid1, ':CEMAILADDRESS', $cEmail);
      oci_bind_by_name($stid1, ':CGENDER', $cgender);
      oci_bind_by_name($stid1, ':CADDRESS', $caddress);
      oci_bind_by_name($stid1, ':CPASSWORD', $cpassword);
      oci_bind_by_name($stid1, ':UVERIFYKEY', $ukey);
      oci_bind_by_name($stid1, ':CIMAGE', $destinationfile);
    
      if ($stid) {
        $to = $cEmail;
        $subject = "Verification Email";
        $message = "<a href='http://localhost/ecommerce/Customer/userVerifyEmail.php?ukey=$ukey'>Register</a>";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        if (mail($to, $subject, $message, $headers)) {
          header("location:userMessageVerify.php?cemail=$cEmail");
        } else {
            echo "Email not sent";
        }
      }
      oci_execute($stid1, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
      oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
      oci_free_statement($stid1);
    }

}

?> 

<div class="register-form">
  <h4>Customer Registration Form</h4>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="container">
      <div class="input-area">
        <div class="error"><?php  echo $cFirstNameErr;  ?></div>
        <input type="text" placeholder="First Name" name="cfName" value="<?php
        if(isset($_POST['cfName'])){
          echo $_POST['cfName'];
        }
        ?>" >
      </div>
        <div class="input-area">
          <div class="error"><?php  echo $cLastNameErr;  ?></div>
          <input type="text" placeholder="Last Name" name="clName" value="<?php
                if(isset($_POST['clName'])){
                    echo $_POST['clName'];
                }
            ?>" >
        </div>
      </div>

      <div class="container">
        <div class="input-area">
          <div class="error"><?php  echo $cPhoneNumberErr;  ?></div>
          <input type="text" placeholder="Phone Number" name="cphoneNo" value="<?php
                if(isset($_POST['cphoneNo'])){
                    echo $_POST['cphoneNo'];
                }
            ?>" >
        </div>
        <div class="input-area">
          <div class="error"><?php  echo $cEmailErr;  ?></div>
          <input type="text" placeholder="Email Address" name="cemail" value="<?php
                if(isset($_POST['cemail'])){
                    echo $_POST['cemail'];
                }
            ?>" >
        </div>
      </div>


      <div class="container">
        <div class="input-area">
        <div class="error"><?php  echo $cGenderErr;  ?></div>
        <select name="cgender">
          <option value="">Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Others">Others</option>
        </select>   
        </div>
        <div class="input-area">
          <div class="error"><?php  echo $cAddressErr;  ?></div>
          <input type="text" placeholder="Address" name="caddress" value="<?php
                  if(isset($_POST['caddress'])){
                      echo $_POST['caddress'];
                  }
              ?>" >
        </div>
      </div>

      <div class="container">
        <div class="input-area">
          <div class="error"><?php  echo $cPasswordErr;  ?></div>
          <input type="password" placeholder="Password" name="cu_password" id="cu_password" value="<?php
                if(isset($_POST['cu_password'])){
                    echo $_POST['cu_password'];
                }
            ?>" > 
        </div>
        <div class="input-area">
          <input type="password" placeholder="Confirm Password" name="cc_password" id="cc_password" value="<?php
                if(isset($_POST['cc_password'])){
                    echo $_POST['cc_password'];
                }
            ?>" >
        </div>
        </div>

        <div class="checkbox">
            <input id="cb" type="checkbox" name="checkbox" onclick="showFunction()"><h3>Show Password</h3>  
        </div>

        <div class="file-container">
        <div class="file-input">
          <label for=""><h3>Upload Image</h3></label>
        </div>
        <div class="file-input">
          <input id="choose-file" type="file" name="cImages" hidden/>
          <label for="choose-file" id="label-file">Choose File</label>
        </div>
        </div>

      <input type="submit" name="c_submit" class="c_submit" value="Register">
    </form>
  </div>

  <!-- Javascript -->
      <script>
        function showFunction(){
          const password = document.getElementById("cu_password");
          const confirm_password = document.getElementById("cc_password");
          if (password.type === "password") {
            password.type = "text";
          } else {
            password.type = "password";
          }
          if (confirm_password.type === "password") {
            confirm_password.type = "text";
          } else {
            confirm_password.type = "password";
          }          
        }
      </script>
</body>
</html>
