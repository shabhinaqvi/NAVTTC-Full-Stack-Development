<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Include jQuery library -->

<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<?php
if(isset($_POST['addToCart'])){
	$product_id = $_POST['pid'];
	$requestQty = $_POST['num-product'];
	$query = $pdo->prepare("select quantity from products where id = :qid");
	$query->bindParam(':qid', $product_id);
	$query->execute();
	$qty = $query->fetch(PDO::FETCH_ASSOC);
	// print_r($qty);

	if($qty['quantity']>=$requestQty){

		if($_SESSION['cart']){

			$id= array_column($_SESSION['cart'],'id');
			$cartID = in_array($_POST['pid'],$id);
			if($cartID){
				echo "<script>alert('Cart is already added')</script>";
			}else{				
					$count = count($_SESSION['cart']);
					$_SESSION['cart'][$count]= array("id"=>$_POST['pid'], "name"=>$_POST['pName'], "qty"=>$_POST['num-product'], "description"=>$_POST['pDes'], "price"=>$_POST['pPrice'],"image"=>$_POST['pImage']);
					echo "<script>alert('Cart added')</script>";
				}
		}else{
			$_SESSION['cart'][0] = array("id"=>$_POST['pid'], "name"=>$_POST['pName'], "qty"=>$_POST['num-product'], "description"=>$_POST['pDes'], "price"=>$_POST['pPrice'],"image"=>$_POST['pImage']);
			echo "<script>alert('Cart added')</script>";
		}
	}else{
		echo "<script>alert('Selected item is out of stock');
		location.assign('product-detail?pid=".$product_id."')</script>";
	}
}

if(isset($_GET['unset'])){
	unset($_SESSION['cart']);
}

if(isset($_GET['checkout'])){						
			$uid = $_SESSION['userid'];
			$uEmail = $_SESSION['useremail'];
			$uName = $_SESSION['username'];
			// print_r($uName);
			if(isset($_SESSION['cart'])){
				if(count($_SESSION['cart'])>0){
			foreach($_SESSION['cart'] as $key=>$value){
				$pid = $value['id'];
				$pName = $value['name'];
				$pPrice = $value['price'];
				$pQty = $value['qty'];
				$query = $pdo -> prepare("insert into orders (p_id, p_name, p_qty,p_price, u_id, u_name, u_email) values (:pid,:pname,:pqty,:pprice,:uid,:uname,:uemail)");
			$query->bindParam(':pid',$pid);
			$query->bindParam(':pname',$pName);
			$query->bindParam(':pqty',$pQty);
			$query->bindParam(':pprice',$pPrice);
			$query->bindParam(':uid',$uid);
			$query->bindParam(':uname',$uName);
			$query->bindParam(':uemail',$uEmail);
			$query->execute();

			$update = $pdo->prepare("UPDATE products SET quantity = quantity - :orderedQty where id = :productId");
			$update->bindParam('orderedQty', $pQty);
			$update->bindParam('productId', $pid);
			$update->execute();
			echo "<script>alert('order placed successfully')</script>";
			}
		}

	}
	unset($_SESSION['cart']);

}

?>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							My Account
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							EN
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							USD
						</a>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu" id="activemenu">
							<li class="active-menu">
								<a href="index">Home</a>
								<!-- <ul class="sub-menu">
									<li><a href="index.php">Homepage 1</a></li>
									<li><a href="home-02.php">Homepage 2</a></li>
									<li><a href="home-03.php">Homepage 3</a></li>
								</ul> -->
							</li>

							<li>
								<a href="product">Shop</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="shoping-cart">Features</a>
							</li>

							<li>
								<a href="blog">Blog</a>
							</li>

							<li>
								<a href="about">About</a>
							</li>

							<li>
								<a href="contact">Contact</a>
							</li>
							<?php
							if(isset($_SESSION['useremail'])){
								
							?>	
								<li>
								<a href="logout">Logout</a>
								</li>
							<?php
							}else{
							?>
							<li>
								<a href="signup">Sign Up</a>
							</li>
							<li>
								<a href="login">Login</a>
							</li>
							<?php
							}
							?>
							
							
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>
						<?php
						$count = 0;
						if(isset($_SESSION['cart'])){
							$count = count($_SESSION['cart']);
							
						}
						?>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $count ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							My Account
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							EN
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							USD
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
					<ul class="sub-menu-m">
						<li><a href="index.php">Homepage 1</a></li>
						<li><a href="home-02.php">Homepage 2</a></li>
						<li><a href="home-03.php">Homepage 3</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="product.php">Shop</a>
				</li>

				<li>
					<a href="shoping-cart.php" class="label1 rs1" data-label1="hot">Features</a>
				</li>

				<li>
					<a href="blog.php">Blog</a>
				</li>

				<li>
					<a href="about.php">About</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
				
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
				<?php 
					if(isset($_SESSION['cart'])){
					foreach($_SESSION['cart'] as $value){
						$totalprice = $value['qty'] * $value['price'];
						echo $totalprice;
					?>	

				
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="<?php echo $value['image']?>"  alt="<?php echo $value['name']?>" >
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								
								<span class="header-cart-item-info">
								<?php echo $value['qty']?>
								1 x $19.00
							</span>
							</a>
							

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>
					<?php
					}}
					?>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$(document).ready(function() {
    // Get the current page URL
    let navbar = window.location.href;
    // console.log(navbar);

    // Split the URL to get the current file name
    let sp = navbar.split('/');
    let filename = sp[sp.length - 1].split('.')[0];
    // console.log(filename);

    // Find the matching menu item and add the "active-menu" class
    $('#activemenu li').each(function() {
        let menuItem = $(this).find('a').attr('href');
        if (menuItem === filename) {
            $(this).addClass('active-menu');
        } else {
            $(this).removeClass('active-menu');
        }
    });

    // Add click event listener to toggle the "active-menu" class
    $('#activemenu li a').on('click', function() {
        $('#activemenu li').removeClass('active-menu');
        $(this).parent().addClass('active-menu');
    });
});

</script>

