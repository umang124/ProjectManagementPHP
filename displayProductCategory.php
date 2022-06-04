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
	<link rel="stylesheet" href="./homeStyle.css" type="text/css">
    <title>CHF DigiMart</title>
    
</head>

    
<body>
<?php 
	if (isset($_GET['cat'])) {
			include "./connection.php";
			$cat = $_GET['cat'];
			$stid = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCT_CATEGORY = '$cat'");
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

				<!-- <select name="" id=""></select> -->
				<!-- Main Area -->
				<main class="main-part">

					<div class="main-content">
						<div class="container">
							<h2 class="my-5 text-secondary">Products</h2>
							<div class="row">
						<?php
							if ($stid) {
							$cid = null;
								while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
									$pid = $row['PRODUCTID'];
									if (isset($_SESSION['cid'])) { $cid = $_SESSION['cid']; }
									
						?>
								<div class="col-md-4 mb-4">
									<div class="card" style="width: 18rem">
										<img src="<?php echo $row['PRODUCT_IMAGE']; ?>" class="card-img-top" alt="..." />
										<div class="card-body border-top">
											<h5 class="card-title"><?php echo $row['PRODUCTNAME']; ?></h5>
											<div class="d-flex justify-content-between align-items-center">
												<div>Rs <?php echo $row['PRODUCTPRICE']; ?> | Quantity:  <?php echo $row['PRODUCTQUANTITY']; ?></div>
											
											</div>
											<div class="d-flex justify-content-between align-items-center">
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
							<?php
								}
								?>
							</div>
						</div>
					</div>
				<?php
							}
								}
    ?>



		<div class="p-4 my-4 bg-light text-center border">
			<div class="container">
				<h4>About Us</h4>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus
					sed porro illum officiis quidem iusto dicta unde fuga ipsam, autem
					delectus laudantium soluta, nihil nobis iure explicabo, molestias ea.
					Laborum saepe facilis iure ipsum, labore corrupti, tempora maiores
					temporibus quo id fugit cumque minus quos expedita, voluptas pariatur
					numquam. Atque odit repellendus nisi? Necessitatibus voluptatibus vero
					nulla exercitationem tempora beatae omnis architecto, cupiditate
					dolores quibusdam ex dolorum sed ab facere? Similique, id cupiditate!
					Beatae neque dolor ipsum laborum quibusdam quasi labore deleniti non,
					facere dolores doloribus ex quo recusandae doloremque!
				</p>
			</div>
		</div>
		<div class="bg-dark">
			<div
				class="d-flex container flex-wrap justify-content-between align-items-center py-3 my-4 border-top"
			>
				<p class="col-md-4 mb-0 text-muted">Â© 2022 Company, Inc</p>

				<a
					href="/"
					class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none"
				>
					<svg class="bi me-2" width="40" height="32">
						<use xlink:href="#bootstrap"></use>
					</svg>
				</a>

				<ul class="nav col-md-4 justify-content-end">
					<li class="nav-item">
						<a href="#" class="nav-link px-2 text-muted">Home</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link px-2 text-muted">Shop</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link px-2 text-muted">Offers</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link px-2 text-muted">Order History</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link px-2 text-muted">Contact</a>
					</li>
				</ul>
			</div>
		</div>

    <!-- JavaScript -->
    <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        //window.onsroll = function() {scrollFunction()};

/*         function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        } */

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
        }
    </script>

    
</body>
</html>