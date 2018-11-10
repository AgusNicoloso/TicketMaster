<?php namespace views; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Carrito</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			 <div class="topbar"></div>
			 <div class="wrap_header">
					<!-- Logo -->
					<a href="" class="logo">
						 <h2>TicketMaster</h2>
					</a>
					<!-- Menu -->
					<?php include("menu.php");
					include("header.php"); ?>
			 </div>
		</div>
	</header>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/sillacart.jpg);">
		<h2 class="l-text2 t-center">
			Carrito
		</h2>
	</section>
	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
		<?php if (isset($_SESSION['CarritoList']) && count($_SESSION['CarritoList']) != 0) { $i=1; $total=0;?>
			
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Producto</th>
							<th class="column-3">Precio</th>
							<th class="column-4 text-center">Cantidad</th>
							<th class="column-5">Total</th>
						</tr>
							<?php foreach ($_SESSION['CarritoList'] as $key){ ?>
							<tr class="table-row">
								
								<td class="column-1">
									<div class="cart-img-product b-rad-4 o-f-hidden">
										<img
										 title="<?php $key['title_event']; ?>"
							 			 alt="<?php $key['title_event']; ?>"
							 			 src="<?= URl.$key['photo']; ?>"
							 			 height="120px"
										>
									</div>
								</td>
								<td class="column-2"><?= $key['title_event'];?><span class="header-cart-item-info">Tipo de plaza: <?= $key['name_place']?></span><span class="header-cart-item-info">Dia: <?= $key['date']?></span></td>
								<td class="column-3">$<?= $key['price'];?></td>
								<td class="column-4 text-center"><?=$key['quantity'];?></td>
								<td class="column-5">$<?=($key['price']*$key['quantity']);?></td>
							</tr>
							<?php $total = $total + ($key['price']*$key['quantity']);}	?>
						</table>
					</div>
				</div>
		
							<!-- Total -->
							<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
								<h5 class="m-text20 p-b-24">
									Total Carrito
								</h5>
								<div class="flex-w flex-sb-m p-t-26 p-b-30">
									<span class="m-text22 w-size19 w-full-sm">
										Total:
									</span>
									<span class="m-text21 w-size20 w-full-sm">
										$<?= $total;?>
									</span>
								</div>
								<div class="size15 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
										Confirmar Compra
									</button>
								</div>
							</div>
						<?php } else { ?>
							<h4 class="text-center">No agregaste nada...</h4>
						<?php } ?>
		</div>
	</section>



	<!-- Footer -->
	<?php include("footer.php"); ?>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
