<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./searchedProduct.css" />
    <title>Display Searched Product</title>
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
                        <a  href="http://localhost/ecommerce/viewCart.php" target="_blank""><i class="icons fa-solid fa-cart-shopping fa-xl"></i></a>
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

    <?php
        if (isset($_POST['sSubmit'])) {
            include "./connection.php";
            $cid = null;
            if (isset($_SESSION['cid'])) { $cid = $_SESSION['cid']; }
            $pname = $_POST['sProduct'];
            $pname = strtolower($pname);

            $stid = oci_parse($conn, "SELECT * FROM PRODUCT WHERE LOWER(PRODUCTNAME) = '$pname' ");
            oci_execute($stid);
            
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
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
										<a href="<?php if($cid != null && $row['PRODUCTQUANTITY'] != 0 ) { echo "http://localhost/ecommerce/insertCart.php?pid=$pid"; } elseif($cid != null && $row['PRODUCTQUANTITY'] == 0) { echo "http://localhost/ecommerce/outOfStock.php"; } else { echo "http://localhost/ecommerce/loginform.php";  } ?>" class="btn btn-primary"
											><em class="bi bi-cart"></em
										></a>
										<a href="<?php if($cid != null) { echo "http://localhost/ecommerce/insertReview.php?pid=$pid"; } else { echo "http://localhost/ecommerce/loginform.php";  } ?>" class="btn btn-dark"
											><em class="bi bi-credit-card-2-front"></em
										></a>
                                        <a href="<?php if($cid != null) { echo "http://localhost/ecommerce/insertWishList.php?pid=$pid"; } else { echo "http://localhost/ecommerce/loginform.php";  } ?>" class="btn btn-dark"
											><em class="bi bi-heart"></em
										></a>
									</div>
								</div>
							</div>
						</div>
					</div>
    <?php
            }
        }
    ?>
    <!--footer-->
	<footer>
          <div class="footer-container">
            <div class="end-text">
                <p class="explore">Explore more:</p>
                <p class="footer-nav"><a href="#">Home</a>  |   <a href="#about-us">About</a> |   <a href="services.html">Categories</a>  |   <a href="package.css">Offers</a>  |   <a href="gallery.html">Order History</a>   |   <a href="contact.html">Contact</a></p>
            </div>
          </div>
          <div>
            <p class="end-info"><img src="images/logo2.png" class="footer-logo"><br>CleckHuddersFax, Leeds, UK<br>Contact No.: +977 9842725371<br>Email: chfdigimart@gmail.com</p>
          </div>
          <div class="footer-contact">
            <p><br>Know More About Us:<br></p>
            <a href="#"><img src="images/facebook.png" alt="facebook-icon"></a>
            <a href="#"><img src="images/instagram.png" alt="instagram-icon"></a>
            <a href="#"><img src="images/twitter.png" alt="twitter-icon"></a>
            <a href="#"><img src="images/linkedin.png" alt="linkedin-icon"></a>
          </div>
          <div class="copyright">
            <p>copyright 2022 &copy;CHF DigiMart. All Rights Reserved.</p>
          </div>
        </footer>
</body>
</html>