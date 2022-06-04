<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f34bf611b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
	<link rel="stylesheet" href="./homeStyle.css" type="text/css">
    <title>TraderHomePage | CHFDigiMart</title>
</head>
<body>

    <?php 
    include "./connection.php"; 
    $tid = $_SESSION['tid'];
    $stid2 = oci_parse($conn, "SELECT * FROM PRODUCT WHERE TID = '$tid' ");
    oci_execute($stid2);
    ?>

    <div class="container">
        <div class="box1">
            <div class="box1a">
                <h2>Welcome, <?php if (isset($_SESSION['tname'])) { echo $_SESSION['tname']; } ?>  </h2>
            </div>
        </div>

        <nav class="bg-dark text-white text-uppercase">
			<div class="container">
				<ul
					class="nav col-12 text-center col-lg-auto me-lg-auto mb-2 justify-content-between mb-md-0"
				>
					<li class="flex-fill">
						<a href="http://localhost/ecommerce/addProducts.php" target="_blank" class="nav-link px-2 text-white border-end">Add Product</a>
					</li>
					
					<li class="flex-fill">
						<a href="http://localhost/ecommerce/trader/tmanageProfileform.php" target="_blank" class="nav-link px-2 text-white border-end">Manage Profile</a>
					</li>
					<li class="flex-fill">
						<a href="http://localhost/ecommerce/viewreview.php" target="_blank" class="nav-link px-2 text-white border-end"
							>View Products Reviews</a
						>
					</li>
                    <li class="flex-fill">
						<a href="http://localhost/ecommerce/displaySoldProduct.php" target="_blank" class="nav-link px-2 text-white border-end"
							>View Sold Products</a
						>
					</li>
				</ul>
			</div>
		</nav>


        <div class="box2">
            <h1 class="bh">
                Recent Products
            </h1>

    <main class="main-part">

        <div class="main-content">
			<div class="container">
				<h2 class="my-3 text-secondary">Products</h2>
				<div class="row">
            <?php
                if ($stid2) {
                   //$cid = null;
                    while (($row = oci_fetch_array($stid2, OCI_BOTH)) != false) {
                        $pid = $row['PRODUCTID'];
                        
                        
            ?>
					<div class="col-md-4 mb-4">
						<div class="card" style="width: 18rem">
							<img src="<?php echo $row['PRODUCT_IMAGE']; ?>" class="card-img-top" alt="..." />
							<div class="card-body border-top">
								<h5 class="card-title"><?php echo $row['PRODUCTNAME']; ?></h5>
								<div class="d-flex justify-content-between align-items-center">
									<div>Rs <?php echo $row['PRODUCTPRICE']; ?></div>
                                    <div>| Quantity:  <?php echo $row['PRODUCTQUANTITY']; ?></div>
									<div>
										<a href="http://localhost/ecommerce/trader/tProductDelete.php?pid=<?php echo $pid; ?>" class="btn btn-primary"
											><em class="bi bi-trash"></em
										></a>
										<a href="http://localhost/ecommerce/trader/tProductUpdateform.php?pid=<?php echo $pid; ?>" class="btn btn-dark"
											><em class="bi bi-pen"></em
										></a>
									</div>
								</div>
							</div>
						</div>
					</div>
                <?php
                    }
                    ?>
				</div>
			</div>
		</div>
    <?php
                    }
    ?>
    </main>
	
</body>
</html>