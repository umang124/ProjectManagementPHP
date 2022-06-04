<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
	<link rel="stylesheet" href="./homeStyle1.css" type="text/css">
    <script src="https://kit.fontawesome.com/f34bf611b3.js" crossorigin="anonymous"></script>
    
    <title>CHFDigiMart | Profile</title>
</head>
<body>

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
		
		<nav class="bg-success text-white text-uppercase">
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
						<a href="#" target="_blank" class="nav-link px-2 text-white border-end">Contact</a>
					</li>
				</ul>
			</div>
		</nav>

<script>
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".menu");

    hamburger.addEventListener("click", mobileMenu);

    function mobileMenu() {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
    }
</script>

<!-- Update Customer Profile -->
<?php
    include "./connection.php";
    if (isset($_SESSION['cid'])) {
        $cid = $_SESSION['cid'];
        $stid = oci_parse($conn, "SELECT * FROM CUSTOMER WHERE CID = '$cid' ");
        oci_execute($stid);
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            $cfname = $row['CFIRSTNAME'];
            $clname = $row['CLASTNAME'];
            $caddress = $row['CADDRESS'];
            $cpassword = $row['CPASSWORD'];
            $cemail = $row['CEMAILADDRESS'];
            
            $ucid = $row['CID'];
            if ( isset($row['CIMAGE']) ) {
                $ucImage = $row['CIMAGE'];
            }
           
          }
?>


        <div class="main-content">
			<div class="container">
				<h2 class="my-3 text-secondary">Customer Profile</h2>
				<div class="row">
					<div class="col-md-3">
						<div class="list-group">
							<a
								href="http://localhost/ecommerce/viewCart.php"
								class="list-group-item list-group-item-action active"
								aria-current="true"
							>
								<em class="bi bi-cart me-2"></em> View Cart
							</a>
							<a href="http://localhost/ecommerce/displayOrderHistory.php" class="list-group-item list-group-item-action"
								><em class="bi bi-bag me-2"></em> Order History</a
							>
							<a href="http://localhost/ecommerce/customer/logoutCustomer.php" class="list-group-item list-group-item-action"
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
											src="<?php if(isset($ucImage)) { echo $ucImage; } ?>"
										/><span class="font-weight-bold"><?php if(isset($cfname)) { echo $cfname; } ?></span
										><span class="text-black-50"><?php if(isset($cemail)) { echo $cemail; } ?></span
										><span> </span>
									</div>
								</div>
                                
                                    <div class="col-md-9">
                                        <form action="userProfileAmend.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="First Name"
                                                            class="form-control"
                                                            name="ucfName"
                                                            value="<?php echo $cfname; ?>"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="last Name"
                                                            class="form-control"
                                                            name="uclName"
                                                            value="<?php echo $clname; ?>"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="Address"
                                                            class="form-control"
                                                            name="ucaddress"
                                                            value="<?php echo $caddress; ?>"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input
                                                            type="text"
                                                            placeholder="New Password"
                                                            name="ucpassword"
                                                            class="form-control"
                                                        />
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input type="file" name="ucImage">
                                                    </div>
                                                    <input type="hidden" name="ucid" value="<?php echo $ucid; ?>">
                                                    <input type="hidden" name="uopassword" value="<?php echo $cpassword; ?>">   
                                                    <input type="hidden" name="uoimage" value="<?php echo $ucImage; ?>">    

                                                    <div class="col-md-12 text-end">
                                                        <input type="submit" name="uSubmit" class="btn btn-primary" />
                                                    </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                
							</div>
						</div>
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
				<p class="col-md-4 mb-0 text-muted">© 2022 Company, Inc</p>

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


    
</body>
</html>



    


  