<?php
include "query.php";
include "header.php";
?>

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
					echo "<script>alert('Cart added') location.assign('product-detail?pid=".$product_id."')</script>";
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
	<!-- breadcrumb -->
	<div class="container p-3 mt-5">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-5">Remove</th>
								</tr>
								<?php
								if(isset($_SESSION['cart'])){
									foreach($_SESSION['cart'] as $value){
										$totalprice = $value['qty'] * $value['price'];
								?>

								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="AdminPanel/img/<?php echo $value['image'] ?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?php echo $value['name'] ?></td>
									<td class="column-3"><?php echo $value['price'] ?></td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="<?php echo $value['qty'] ?>">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5"><?php echo $totalprice ?></td>
									<td class="column-5 "> <a class="btn btn-info bg-danger" href="?remove=<?php echo $value['id']?>" name="cartremovebtn"> Remove</a> </td>
								
								<?php
									}
								}
                                if(isset($_GET['remove'])){
                                    $removePid = $_GET['remove'];
									foreach($_SESSION['cart'] as $key=>$val){
										if($val['id'] == $removePid ){
											unset($_SESSION['cart'][$key]);
											$_SESSION['cart'] = array_values($_SESSION['cart']);
											echo "<script>alert('cart removed')
											location.assign('shoping-cart.php')</script>";
											
										}
									}
                                }
								?>								
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
							
							
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<?php
								if(isset($_SESSION['cart'])){
									$grandTotal = 0;
									foreach($_SESSION['cart'] as $sTotal){
										$subtotal = $sTotal['qty'] * $sTotal['price'];
										$grandTotal += $subtotal;
									}
									?>
									<span class="mtext-110 cl2">
									Rs. <?php echo $grandTotal?>/-
								</span>
								<?php
								}
								?>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									$79.65
								</span>
							</div>
						</div>
						<?php
						if(isset($_SESSION['useremail'])){
							if(isset($_SESSION['cart'])){
						?>
						<a href="?checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</a>

                        <?php
						}else{
						?>
						<a href="?checkout" style="pointer-events: none; cursor: default;" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</a>
						<?php
						}
						}
						else{
						?>
						<a href="login.php"  class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</a>
						<?php
						}
						?>
						<br>
						<a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" name="" href="?unset" >Clear Cart</a>
					</div>
				</div>
			</div>
		</div>
	</form>
		
	
		

<?php
include "footer.php";
?>