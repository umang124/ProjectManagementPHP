<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> 
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="insertReview.css" />
    <title>Write Review</title>
</head>
<body>


    <!-- Navbar -->
    <nav class="navbar ">
    <div class="container">
            <div class="nav-1">
                <div class="logo">
                    <img src="images/logo2.png" alt="logo">
                </div>
                <div class="search">
				<form class="d-flex" method="POST" action="http://localhost/ecommerce/searchedProduct.php">
						<input
							class="form-control me-2"
							type="search"
							placeholder="Search"
							aria-label="Search"
							name="sProduct"
							required
						/>
					
						<button class="btn btn-primary" type="submit" name="sSubmit" >Search</button>
					</form>
                </div>
                <ul class="menu">
                <li class="menuItem cart ">
                    <a  href="http://localhost/ecommerce/viewCart.php" target="_blank" "><i class="icons fa-solid fa-cart-shopping fa-xl"></i></a>
					<a href="http://localhost/ecommerce/viewWishList.php" target="_blank" class="btn btn-dark"><em class="bi bi-heart"></em></a>
                </li>
                <li class="menuItem login">
                    <a class="bg-success" target="_blank" href="http://localhost/ecommerce/loginform.php">Login</a>
                </li>
                <li class="menuItem profile">
                    <a target="_blank" href="http://localhost/ecommerce/Customer/userUpdateProfileForm.php"><i class="icons fa-solid fa-user fa-2xl"></i></a>
                </li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>            
    </div>
</nav>
		<div class="col-md-12" style="position: fixed; top: 90px; z-index: 999;">
			<nav class="bg-success text-white text-uppercase ">
				<div class="container">
					<ul
						class="nav col-12 text-center col-lg-auto me-lg-auto mb-2 justify-content-between mb-md-0"
					>
						<li class="flex-fill">
							<a href="http://localhost/ecommerce/home.php" class="nav-link px-2 text-white border-end">Home</a>
						</li>
						
						<li class="flex-fill">
							<a href="http://localhost/ecommerce/ProductCategory.php" target="_blank" class="nav-link px-2 text-white border-end">Product Categories</a>
						</li>
						<li class="flex-fill">
							<a href="http://localhost/ecommerce/displayorderhistory.php" target="_blank" class="nav-link px-2 text-white border-end"
								>Order History</a
							>
						</li>
						<li class="flex-fill">
							<a href="Contact.html" target="_blank" class="nav-link px-2 text-white border-end">Contact</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>

<script>
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".menu");

    hamburger.addEventListener("click", mobileMenu);

    function mobileMenu() {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
    }
</script>

<h2 class="my-3 text-secondary">Write A Review</h2>
    <?php
        include "./connection.php";
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $cid = $_SESSION['cid'];

            $reviewBool = false;

            $stid = oci_parse($conn, 'SELECT * FROM REVIEW');
            oci_execute($stid);
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                $pidcheck = $row['PID'];
                $cidcheck = $row['CID'];
               // $quantity = 1;

                if ($pid == $pidcheck && $cid == $cidcheck) {
                    $cartBool = true;
?>
                <script>
                    alert("Already reviewed about this product");
                    window.location.href = 'http://localhost/ecommerce/home.php';
                </script>
<?php

                }
            }




        ?>
        <div class="review">
            <form action="" method="POST">
                <input type="text" name="c_review" required>
                <input type="submit" name="r_submit" value="Submit">
            </form>
        </div>
        <?php

        if (isset($_POST['r_submit'])) {

            if (!$reviewBool) {
                $c_review = $_POST['c_review'];

                $stidproduct = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCTID = '$pid'");
                oci_execute($stidproduct);
                while (($rowp1 = oci_fetch_array($stidproduct, OCI_BOTH)) != false) {
                    $t_id = $rowp1['TID'];
                }

                $stid = oci_parse($conn, "INSERT INTO REVIEW (PID, CID, CREVIEW, TID) VALUES (:PID, :CID, :CREVIEW, :TID)");
                
               

                oci_bind_by_name($stid, ':PID', $pid);
                oci_bind_by_name($stid, ':CID', $cid);
                oci_bind_by_name($stid, ':CREVIEW', $c_review);
                oci_bind_by_name($stid, ':TID', $t_id);

                oci_execute($stid, OCI_NO_AUTO_COMMIT);  // use OCI_DEFAULT for PHP <= 5.3.1
                oci_commit($conn);  // commits all new values: 1, 2, 3, 4, 5
                oci_free_statement($stid);

                if ($stid) {
            ?>
                    <script>
                        alert("Product has been reviewed");
                        window.location.href = 'http://localhost/ecommerce/home.php';
                    </script>
            <?php
                }
            }
        }

    }
    ?>

<!--footer-->
<footer>
          <div class="footer-container">
            <div class="end-text">
                <p class="explore">Explore more:</p>
                <p class="footer-nav"><a href="home.php">Home</a>  |   <a href="home.php #about-us">About</a> |   <a href="ProductCategory.php">Categories</a>  |  <a href="displayorderhistory.php">Order History</a>   |   <a href="contact.html">Contact</a></p>
            </div>
          </div>
          <div>
            <p class="end-info"><img src="images/logo2.png" class="footer-logo"><br>CleckHuddersFax, Leeds, UK<br>Contact No.: +977 9842725371<br>Email: chfdigimart@gmail.com</p>
          </div>
          <div class="footer-contact">
            <p><br>Know More About Us:<br></p>
            <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="facebook-icon"></a>
            <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="instagram-icon"></a>
            <a href="https://www.twitter.com/"><img src="images/twitter.png" alt="twitter-icon"></a>
            <a href="https://www.linkedin.com/"><img src="images/linkedin.png" alt="linkedin-icon"></a>
          </div>
          <div class="copyright">
            <p>copyright 2022 &copy;CHF DigiMart. All Rights Reserved.</p>
          </div>
        </footer>
</body>
</html>