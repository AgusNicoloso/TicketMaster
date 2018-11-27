<?php namespace views;
if(isset($logued)){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Evento <?= $product->getName(); ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= URl ?>images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= URl ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= URl ?>css/main.css">
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
					<a href="<?= URl ?>" class="logo">
						 <h2>TicketMaster</h2>
					</a>
					<!-- Menu -->
					<?php include("menu.php");
					include("header.php"); ?>
			 </div>
		</div>
</header>
	
	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="slick3">
							<div class="wrap-pic-w">
								<img
                              title="<?php $product->getName(); ?>"
                              alt="<?php $product->getName(); ?>"
                              src="<?php echo URl . $product->getPhoto(); ?>"
                              height="501px"
                              width="668px"
                             >
							</div>
					</div>
				</div>
			</div>
			<?php if($_SESSION['logued']->getRol()!="admin") { ?>
			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?php echo $product->getName(); ?>
				</h4>
				<!--  -->
				<form action="<?= URl ?>EventPlace/ver" method="post">
					<input type="hidden" name="id" value="<?= $product->getID(); ?>">
				<div class="p-t-33 p-b-60">
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							<b>Tipo de plaza</b>
						</div>
						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="id_tipo_plaza">
								<option disabled selected>Seleccione sector</option>
								<?php if(is_array($info)){
									$list = $info[0]->getTypeplace();
									if(is_array($list)){
										foreach ($list as $key => $value) { ?>
								<option value="<?= $value->getID(); ?>"><?= $value->getSeatName() . " - $" . $value->getPrice();?></option>
																	<?php } ?>
									<?php } else {  ?>
										<option value="<?= $list->getID(); ?>"><?= $list->getSeatName() . " - $" . $list->getPrice();?></option>
								<?php } ?>
								<?php } else { 
								$list = $info->getTypeplace();
								if(is_array($list)){
								foreach ($list as $key => $value) { ?>
								  	<option value="<?= $value->getID(); ?>"><?= $value->getSeatName() . " - $" . $value->getPrice();?></option>
								  <?php }  ?>
							<?php } else { ?>
								<option value="<?= $info->getTypeplace()->getID(); ?>"><?= $info->getTypeplace()->getSeatName() . " - $" . $info->getTypeplace()->getPrice();?></option>
							<?php }}?>
							</select>
						</div>
					</div>
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="num_product" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
									Agregar al carrito
								</button>
							</div>
						</div>
					</div>
				</div>
				
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Seleccione en cual fecha desea ir / Artistas presentes
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?php if(is_array($info)) { ?>
							<?php $i=0; while($i < count($info)){ 
								$date = $info[$i]->getDate();
								if(isset($_SESSION['artists'])){
								    $artistlist=$_SESSION['artists'];
                                }else{
                                    $artistlist = $info[$i]->getArtist();
                                }

								if(is_array($artistlist)){
									foreach($artistlist as $artist){
									    $new_arr[] = $artist->getName();
									}
									$res_arr = implode(' - ',$new_arr);
								}else{
									$res_arr = $artistlist->getName();
								}
								?>
							<label><input type="checkbox" name="date[]" value="<?=$date; ?>"> <?= "<b>".$date."</b>"." / "."<b>".$res_arr."</b>"; ?></label><br>
						<?php $i++; unset($new_arr);} ?>
					<?php } else { ?>
						<label><input type="checkbox" name="date[]" value="<?=$info->getDate(); ?>"> <?= "<b>".$info->getDate()."</b>"." / "."<b>".$info->getArtist()->getName()."</b>"; ?></label><br>
						<?php } ?>
						</p>
					</div>
				</div>
				</form>
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Lugar
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>
					<?php if(is_array($info)) { ?>
					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?= "Nombre del lugar : " . "<b>".$info[0]->getPlace()->getPlace()."</b>" . " - Capacidad : " . "<b>".$info[0]->getPlace()->getCapacity()."</b>";?>
						</p>
					</div>
				<?php } else { ?>
					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?= "Nombre del lugar : " . "<b>".$info->getPlace()->getPlace()."</b>" . " - Capacidad : " . "<b>".$info->getPlace()->getCapacity()."</b>";?>
						</p>
					</div>
					<?php } ?>
				</div>
			</div>
		<?php } else { ?>
			<div class="w-size14 p-t-30 respon5">
				<form action="<?= URl ?>Event/deleteEvent/<?=$product->getID();?>"> 
					<button class='delete btn btn-danger'>Borrar evento</button>
				</form>
				<form action="<?= URl ?>Event/editEvent" method="post" >
                    <input type="number" value="<?=$product->getID();?>" name="eventid" hidden>
			    <button type="submit" class='edit btn btn-success'>Editar evento</button>
			</form>
			</div>
			<?php } ?>
		</div>
	</div>
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
	<script type="text/javascript" src="<?= URl ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= URl ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= URl ?>vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="<?= URl ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= URl ?>vendor/select2/select2.min.js"></script>
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
	<script type="text/javascript" src="<?= URl ?>vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="<?= URl ?>js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= URl ?>vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= URl ?>js/main.js"></script>
</body>
</html>
<?php } else {
 header("Location: ". URl. "login/index");
}
