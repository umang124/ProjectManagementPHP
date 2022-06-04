<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <title>Manage Profile</title>
</head>
<body>
<?php
    include "./connection.php";
    if (isset($_SESSION['tid'])) {
        $tid = $_SESSION['tid'];
        
        $stid = oci_parse($conn, "SELECT * FROM TRADER WHERE TID = '$tid' ");
        oci_execute($stid);
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            $tfname = $row['TFIRSTNAME'];
            $tlname = $row['TLASTNAME'];
            $taddress = $row['TADDRESS'];
            $tpassword = $row['TPASSWORD'];
            $tid = $row['TID'];
            if ( isset($row['TIMAGE']) ) {
                $tImage = $row['TIMAGE'];
            }

            $temail = $row['TEMAILADDRESS'];
          }
?>  

<div class="main-content">
			<div class="container">
				<h2 class="my-3 text-secondary">Trader Profile</h2>
				<div class="row">
					<div class="col-md-3">
						<div class="list-group">
							<a href="http://localhost/ecommerce/trader/logoutTrader.php" class="list-group-item list-group-item-action"
								><em class="bi bi-box-arrow-left me-2"></em> Log Out</a
							>
						</div>
					</div>
					<!--column-->
					<div class="col-md-9">
						<div class="p-3 border">
							<h4>Edit Profile</h4>
							<hr />
							<div class="row">
								<div class="col-md-3">
									<div
										class="d-flex flex-column text-center align-items-center"
									>
										<img
											class="rounded-circle"
											width="120px"
											src="<?php if(isset($tImage)) { echo $tImage; } ?>"
										/><span class="font-weight-bold"><?php if(isset($tfname)) { echo $tfname; } ?></span
										><span class="text-black-50"><?php if(isset($temail)) { echo $temail; } ?></span
										><span> </span>
									</div>
								</div>
                                
                                    <div class="col-md-9">
                                        <form action="traderProfileAmend.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="First Name"
                                                            class="form-control"
                                                            name="tfname"
                                                            value="<?php echo $tfname; ?>"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="last Name"
                                                            class="form-control"
                                                            name="tlname"
                                                            value="<?php echo $tlname; ?>"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="Address"
                                                            class="form-control"
                                                            name="taddress"
                                                            value="<?php echo $taddress; ?>"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="New Password"
                                                            name="tpassword"
                                                            class="form-control"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input type="file" name="tImage">
                                                    </div>
                                                    <input type="hidden" name="tid" value="<?php echo $tid; ?>">
                                                    <input type="hidden" name="topassword" value="<?php echo $tpassword; ?>">   
                                                    <input type="hidden" name="toimage" value="<?php echo $toimage; ?>">    

                                                    <div class="col-md-12 text-end">
                                                        <input type="submit" name="t_submit" class="btn btn-primary" />
                                                    </div>
                                                
                                            </div>
                                        </form>
                                    </div>                                
							</div>
						</div>
                        <br>
                        <label for="">Add Shop</label>
                        <form class="d-flex" method="POST" action="addshop.php">
                            <input
                                class="form-control me-2"
                                type="search"
                                placeholder="Search"
                                aria-label="Search"
                                name="sname2"
                                required
                            />
                   
					        <button class="btn btn-primary" type="submit" name="shopsubmit" >Add</button>
                        </form>
					</div>
				</div>
			</div>
		</div>









    
<?php
    }
    else {
        header("location:http://localhost/ecommerce/loginForm.php");
    }
?>
</body>
</html>