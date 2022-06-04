<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHFDigiMart | Amend</title>
</head>
<body>
    <?php

    
        if (isset($_POST['uSubmit'])) {
            include "./connection.php";
            $cfname = $_POST['ucfName'];
            $clname = $_POST['uclName'];
            $caddress = $_POST['ucaddress'];
            
            $uoimage = $_POST['uoimage'];
           
            $Profile_Image = $_FILES['ucImage'];
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
            else
            {
                $destinationfile = $uoimage;
            }

            if ($_POST['ucpassword'] != null) {
                $cpassword = password_hash( $_POST['ucpassword'], PASSWORD_DEFAULT);
            }
            else {
                $cpassword = $_POST['uopassword'];
            }
            
            $ucid = $_POST['ucid'];
            $stid = oci_parse($conn, "UPDATE CUSTOMER SET CFIRSTNAME = :CFIRSTNAME, CLASTNAME = :CLASTNAME,
                CADDRESS = :CADDRESS, CPASSWORD = :CPASSWORD, CIMAGE = :CIMAGE WHERE CID = :CID  ");
            oci_bind_by_name($stid, ':CID', $ucid);
            oci_bind_by_name($stid, ':CFIRSTNAME', $cfname);
            oci_bind_by_name($stid, ':CLASTNAME', $clname);
            oci_bind_by_name($stid, ':CADDRESS', $caddress);
            oci_bind_by_name($stid, ':CPASSWORD', $cpassword);
            oci_bind_by_name($stid, ':CIMAGE', $destinationfile);
            oci_execute($stid, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
            oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
            oci_free_statement($stid);

            if ($stid) {
                echo "Updated";
            }
        }
    ?>
</body>
</html>