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
        $stid = oci_parse($conn, 'SELECT * FROM DEPT');
        oci_execute($stid);
        
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            // Use the uppercase column names for the associative array indices
            echo $row['DEPTNO']."\t";
            echo $row['DNAME']."\t";
            echo $row['LOC']."<br>";
        }
        
        oci_free_statement($stid);
        oci_close($conn);


    ?>
</body>
</html>