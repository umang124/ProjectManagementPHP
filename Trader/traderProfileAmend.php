<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amend Profile</title>
</head>
<body>
<?php
     if (isset($_POST['t_submit'])) {
        include "./connection.php";
        $tfname = $_POST['tfname'];
        $tlname = $_POST['tlname'];
        $taddress = $_POST['taddress'];
        
        $toimage = $_POST['toimage'];
       
        $Profile_Image = $_FILES['tImage'];
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
            $destinationfile = $toimage;
        }

        if ($_POST['tpassword'] != null) {
            $tpassword = password_hash( $_POST['tpassword'], PASSWORD_DEFAULT);
        }
        else {
            $tpassword = $_POST['topassword'];
        }
        
        $tid = $_POST['tid'];
        $stid = oci_parse($conn, "UPDATE TRADER SET TFIRSTNAME = :TFIRSTNAME, TLASTNAME = :TLASTNAME,
            TADDRESS = :TADDRESS, TPASSWORD = :TPASSWORD, TIMAGE = :TIMAGE WHERE TID = :TID");
        oci_bind_by_name($stid, ':TID', $tid);
        oci_bind_by_name($stid, ':TFIRSTNAME', $tfname);
        oci_bind_by_name($stid, ':TLASTNAME', $tlname);
        oci_bind_by_name($stid, ':TADDRESS', $taddress);
        oci_bind_by_name($stid, ':TPASSWORD', $tpassword);
        oci_bind_by_name($stid, ':TIMAGE', $destinationfile);
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