
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerTrader.css">
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
$tFirstNameErr = $tLastNameErr = $tPhoneNumberErr = $tEmailErr = $tGenderErr = $tAddressErr = $tPasswordErr = $tShopNameErr = $tCategoryError = "";
include "./connection.php";
$stid = oci_parse($conn, 'SELECT * FROM TRADER');
oci_execute($stid);
if (isset($_POST['t_submit'])) {
  $tfName = test_input($_POST['tfName']);
  $tlName = test_input($_POST['tlName']);
  $tPhonenumber = test_input($_POST['tphoneNo']);
  $tEmail = test_input($_POST['temail']);
  $tgender =$_POST['tgender'];
  $taddress = test_input($_POST['taddress']);
  $tpassword = test_input($_POST['t_password']);
  $tcpassword = test_input($_POST['tc_password']);

  $tcategory = test_input($_POST['tcategory']);
  $tshopname = test_input($_POST['tShopName']);
  $tdescription = test_input($_POST['tDescription']);
  $tkey = md5(time().$tPhonenumber);


    $Profile_Image = $_FILES['tImages'];
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
      if (empty($tfName)) {
        $tFirstNameErr = "First Name is Empty";
      }
      elseif (is_numeric($tfName)) {
        $tFirstNameErr = "Invalid First Name";
        $tfName = null;
      }
      // last Name
      if (empty($tlName)) {
        $tLastNameErr = "Last Name is Empty";
      }
      elseif (is_numeric($tlName)) {
        $tLastNameErr = "Invalid First Name";
        $tlName = null;
      }
      // phonenumber
      if (empty($tPhonenumber)) {
        $tPhoneNumberErr = "Phone Number is empty!";
      }
      elseif (!is_numeric($tPhonenumber)) {
        $tPhoneNumberErr = "Phone Number should always contains numberic values!";
        $tPhonenumber = null;
      }
      elseif (strlen($tPhonenumber) != 10) {
        $tPhoneNumberErr = "Phone Number must contains 10 digits number!";
        $tPhonenumber = null;
      }
      // email
      if (empty($tEmail)) {
        $tEmailErr = "Email is empty";
      }
      elseif (!filter_var($tEmail, FILTER_VALIDATE_EMAIL)) {
        $tEmailErr = "Invalid email provided!";
        $tEmail = null;
      }
      // gender
      if (empty($tgender)) {
        $tGenderErr = "Gender is empty";
      }
      // address
      if (empty($taddress)) {
        $tAddressErr = "Address is empty";
      }
      //category
      if (empty($tcategory)) {
        $tCategoryError = "Category is empty";
      }
      //shop
      if (empty($tshopname)) {
        $tShopNameErr = "Shopname is empty";
      }
      // password
      if (empty($tpassword) || empty($tcpassword)) {
        $tPasswordErr = "Password is empty!";
      }
      elseif ($tpassword !== $tcpassword) {
        $tPasswordErr = "Those passwords didn't match.Try again";
        $tcpassword = null;
      } 
      elseif(strlen($tpassword)  < 6)
      {
        $tPasswordErr =  "Password cannot be less than 6 character!";
        $tcpassword = null;
      }
      elseif(!preg_match("@[A-Z]@",$tpassword))
      {
        $tPasswordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        $tcpassword = null;           
      }
      elseif(!preg_match("@[a-z]@",$tpassword)) 
      {
        $cPasswordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        $ccpassword = null;
      }
      elseif(!preg_match("@[0-9]@", $tpassword))
      {
        $tPasswordErr = "Your Password Must Contains at least 1 number!";
        $tcpassword = null;    
      }

      while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        $phoneCheck = $row['TPHONENUMBER'];
        $emailCheck = $row['TEMAILADDRESS'];
      
        if ($tPhonenumber === $phoneCheck) {
          $tPhoneNumberErr = "Phone number has been registered";
          $tPhonenumber = null;
        }
        if ($tEmail === $emailCheck) {
          $tEmailErr = "Email has been registered";
          $tEmail = null;
        }

        }
    
        if (!empty($tfName) && !empty($tlName) && !empty($tPhonenumber) && !empty($tEmail) && !empty($tgender) && !empty($taddress) && !empty($tcpassword)
        && !empty($tcategory) && !empty($tshopname) && !empty($tkey)) {
          $stid1 = oci_parse($conn, "INSERT INTO TRADER (TFIRSTNAME, TLASTNAME, TPHONENUMBER, TEMAILADDRESS,
          TGENDER	, TADDRESS, TPASSWORD, TCATEGORY, TDESCRIPTION, TVERIFYKEY, TIMAGE) 
          VALUES (:TFIRSTNAME, :TLASTNAME, :TPHONENUMBER, :TEMAILADDRESS,
          :TGENDER	, :TADDRESS, :TPASSWORD, :TCATEGORY, :TDESCRIPTION, :TVERIFYKEY, :TIMAGE)");
          oci_bind_by_name($stid1, ':TFIRSTNAME', $tfName);
          oci_bind_by_name($stid1, ':TLASTNAME', $tlName);
          oci_bind_by_name($stid1, ':TPHONENUMBER', $tPhonenumber);
          oci_bind_by_name($stid1, ':TEMAILADDRESS', $tEmail);
          oci_bind_by_name($stid1, ':TGENDER', $tgender);
          oci_bind_by_name($stid1, ':TADDRESS', $taddress);
          oci_bind_by_name($stid1, ':TPASSWORD', $tpassword);

          oci_bind_by_name($stid1, ':TCATEGORY', $tcategory);
          //oci_bind_by_name($stid1, ':TSHOPNAME', $tshopname);
          oci_bind_by_name($stid1, ':TDESCRIPTION', $tdescription);
          oci_bind_by_name($stid1, ':TVERIFYKEY', $tkey);
          oci_bind_by_name($stid1, ':TIMAGE', $destinationfile);
          oci_execute($stid1, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
          oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
          oci_free_statement($stid1);
        
        if ($stid1) {

          $stid2 = oci_parse($conn, "SELECT * FROM TRADER WHERE TEMAILADDRESS = '$tEmail' ");
          oci_execute($stid2);
          if ($stid2) {
            while (($row2 = oci_fetch_array($stid2, OCI_BOTH)) != false) {
              $traderid = $row2['TID'];
              $traderCat = $row2['TCATEGORY'];
              
            }
          }

          $stid3 = oci_parse($conn, "INSERT INTO SHOP (SNAME1, SCATEGORY, TID) 
          VALUES (:SNAME1, :SCATEGORY, :TID)");

          oci_bind_by_name($stid3, ':SNAME1', $tshopname);
          oci_bind_by_name($stid3, ':SCATEGORY', $traderCat);
          oci_bind_by_name($stid3, ':TID', $traderid);
          oci_execute($stid3, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
          oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
          oci_free_statement($stid3);


          $to = $tEmail;
          $subject = "Verification Email";
          $message = "<a href='http://localhost/ecommerce/Trader/traderVerifyEmail.php?tkey=$tkey'>Register</a>";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
          if (mail($to, $subject, $message, $headers)) {
            header("location:traderMessageVerify.php?temail=$tEmail");
          } else {
              echo "Email not sent";
          }
        }    
    }
    
  }
?> 
 
  <!-- Javascript -->
<script>
  function showFunction()
  {
    const password = document.getElementById("t_password");
    const confirm_password = document.getElementById("tc_password");
    if (password.type === "password")
    {
        password.type = "text";
    } 
    else 
    {
        password.type = "password";
    }
    if (confirm_password.type === "password") 
    {
        confirm_password.type = "text";
    } 
    else 
    {
        confirm_password.type = "password";
    }   
      
  }

      
</script>

  <div class="register-form"> 
      <h4>Trader Registration Form</h4>
      <form action="" method="post" enctype="multipart/form-data">
          <div class="container">
            <div class="input-area">
                <div class="error"><?php  echo $tFirstNameErr;  ?></div>
                <input type="text" placeholder="First Name" name="tfName" value="<?php
                    if(isset($_POST['tfName'])){
                        echo $_POST['tfName'];
                    }?>" >
            </div>
            
            <div class="input-area">
              <div class="error"><?php  echo $tLastNameErr;  ?></div>
              <input type="text" placeholder="Last Name" name="tlName" value="<?php
                      if(isset($_POST['tlName'])){
                          echo $_POST['tlName'];
                      }
                  ?>" >
            </div>
          </div>

          <div class="container">
            <div class="input-area">
                <div class="error"><?php  echo $tPhoneNumberErr;  ?></div>
                <input type="text" placeholder="Phone Number" name="tphoneNo" value="<?php
                    if(isset($_POST['tphoneNo'])){
                        echo $_POST['tphoneNo'];
                    }
                ?>" >
            </div>
            <div class="input-area">
                <div class="error"><?php  echo $tEmailErr;  ?></div>
                <input type="text" placeholder="Email Address" name="temail" value="<?php
                    if(isset($_POST['temail'])){
                        echo $_POST['temail'];
                    }
                ?>" >
            </div>
          </div>

          <div class="container">
            <div class="input-area">
            <div class="error"><?php  echo $tGenderErr;  ?></div>
            <select name="tgender">
            <option value="">Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
            </select>   
            </div>
            <div class="input-area">
                <div class="error"><?php  echo $tAddressErr;  ?></div>
                <input type="text" placeholder="Address" name="taddress" value="<?php
                        if(isset($_POST['taddress'])){
                            echo $_POST['taddress'];
                        }
                    ?>" >
            </div>
          </div>

          <div class="container">
            <div class="input-area">
                <div class="error"><?php  echo $tPasswordErr;  ?></div>
                <input type="password" placeholder="Password" name="t_password" id="t_password" value="<?php
                    if(isset($_POST['t_password'])){
                        echo $_POST['t_password'];
                    }
                ?>" > 
            </div>
            <div class="input-area">
            <input type="password" placeholder="Confirm Password" name="tc_password" id="tc_password" value="<?php
                    if(isset($_POST['tc_password'])){
                        echo $_POST['tc_password'];
                    }
                ?>" >
            </div>
          </div>

          <div class="checkbox">
                    <input id="cb" type="checkbox" name="checkbox" onclick="showFunction()"><h3>Show Password</h3>
          </div>

          <div class="container">
            <div class="input-area">
            <div class="error"><?php  echo $tCategoryError;  ?></div>
            <select name="tcategory">
              <option value="">Category</option>
              <option value="butchers">butchers</option>
              <option value="greengrocer">greengrocer</option>
              <option value="fishmonger">fishmonger</option>
              <option value="bakery">bakery </option>
              <option value="delicatessen">delicatessen</option>
            </select>  
            </div>
            <div class="input-area">
                <div class="error"><?php  echo $tShopNameErr;  ?></div>
                <input type="text" placeholder="Shop Name" name="tShopName" value="<?php
                  if(isset($_POST['tShopName'])){
                    echo $_POST['tShopName'];
                  }
                    ?>" >
            </div>
          </div>

          <div class="container">
            <div class="input-area">
                <input type="text" placeholder="Trader's Description" name="tDescription" value="<?php
                  if(isset($_POST['tDescription'])){
                    echo $_POST['tDescription'];
                  }
                    ?>" >
            </div>
          </div>

          <div class="file-container">
            <div class="file-input">
               <label for=""><h3>Upload Image</h3></label>
            </div>
            <div class="file-input">
               <input id="choose-file" type="file" name="tImages" hidden/>
               <label for="choose-file" id="label-file">Choose File</label>
            </div>
          </div>


        

          <input type="submit" name="t_submit" class="t_submit" value="Register">
      </form>
  </div>


</body>
</html>