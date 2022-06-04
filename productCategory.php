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
    <link rel ="stylesheet" href="productCategory.css" />
    <title>Product Categories</title>
</head>
<body>
<?php 
include "./connection.php";
$stid = oci_parse($conn, 'SELECT * FROM PRODUCT');
oci_execute($stid);
?>
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

    <div class="main-content">
        <div class="container">
            <h2 class="my-3 text-secondary">Product Categories</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a href="http://localhost/ecommerce/displayProductCategory.php?cat=butchers" class="card bg-dark text-white">
                        <img src="./butcher.png" class="card-img" alt="..." />
                        <div class="card-img-overlay">
                            <h3 class="card-title text-center text-warning">Butchers</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="http://localhost/ecommerce/displayProductCategory.php?cat=greengrocer" class="card bg-dark text-white">
                        <img src="./green.png" class="card-img" alt="..." />
                        <div class="card-img-overlay">
                            <h3 class="card-title text-center text-warning">
                                Green Grocer
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="http://localhost/ecommerce/displayProductCategory.php?cat=fishmonger" class="card bg-dark text-white">
                        <img src="./fishmonger.png" class="card-img" alt="..." />
                        <div class="card-img-overlay">
                            <h3 class="card-title text-center text-warning">Fishmonger</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="http://localhost/ecommerce/displayProductCategory.php?cat=bakery" class="card bg-dark text-white">
                        <img src="./bakery.png" class="card-img" alt="..." />
                        <div class="card-img-overlay">
                            <h3 class="card-title text-center text-warning">Bakery</h3>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4">
                    <a href="http://localhost/ecommerce/displayProductCategory.php?cat=delicatessen" class="card bg-dark text-white">
                        <img src="./delicatessen.png" class="card-img" alt="..." />
                        <div class="card-img-overlay">
                            <h3 class="card-title text-center text-warning">
                                Delicatessen
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
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