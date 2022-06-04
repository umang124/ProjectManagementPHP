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

        // $stid = oci_parse($conn, "INSERT INTO DEPT (DEPTNO, DNAME, LOC) VALUES (50, 'MYdEPT', 'Lalitpur')");

        // if (oci_execute($stid))  {
        //     echo "Data executed";
        // }
        // else {
        //     echo "Error!";
        // }
        // oci_free_statement($stid);
        // oci_close($conn);

        

        $deptno = 80;
        $dname = "being";
        $loc = "nepal";
        $stid = oci_parse($conn, "INSERT INTO DEPT (DEPTNO, DNAME, LOC) VALUES (:DEPTNO, :DNAME, :LOC)");
        oci_bind_by_name($stid, ':DEPTNO', $deptno);
        oci_bind_by_name($stid, ':DNAME', $dname);
        oci_bind_by_name($stid, ':LOC', $loc);
        oci_execute($stid, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
        oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
        oci_free_statement($stid);
        oci_close($conn);
    ?>
    
</body>
</html>