<?php namespace views;
$daocategory = new \daos\daoList\CategoryDao();
$controllercategory = new \controllers\categoryController();
if ($_POST) {
    $category = new \models\TipoCategoria($_POST['namecategory'], $_POST['photocategory']);
    $daocategory->add($category);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>TicketMaster</title>
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
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
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
			<div class="wrap_header">
				<!-- Logo -->
                <div class="topbar"></div>
				<a href="<?= URl ?>" class="logo">
					<h2>TicketMaster</h2>
				</a>
				<?php
				include("menu.php");
				include("header.php");
				?>
			</div>
    </header>
	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(images/c1.jpg);">
				</div>
				<div class="item-slick1 item2-slick1" style="background-image: url(images/c2.png);">
				</div>
				<div class="item-slick1 item3-slick1" style="background-image: url(images/c3.jpg);">
				</div>
			</div>
		</div>
	</section>

	<!-- Prueba -->

    <div class="container">
        <div class="divtx" align="center">
        <div class="row">
            <div class="col-sm-12 col-xs-12" align="center">
                <header>
                    <br>
                    <h2 class="textH">Novedades</h2>
                    <p class="subTex">Los eventos mas esperados!</p>
                </header>
            </div>
        </div>
         </div>
        </div>
    </div>
    <?php $array=$c_calendar->last();?>
    <section class="banner bgwhite p-t-40 p-b-40">
        <div class="container">
            <div class="row">
                    <?php
                    if(is_array($array)){
                        $i=1;foreach($array as $key=>$value){
                        ?>

                        <div id="cartel" class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                            <div align="center">
                            <label  align="center"><?php echo $value->getEvent()->getName();?></label>
                            </div>
                            <div class="block1 hov-img-zoom pos-relative m-b-30">

                                <img
                                        src="<?php echo $value->getEvent()->getPhoto();?>"
                                        height="478.94px"
                                        width="370px"
                                >
                                <div class="block1-wrapbtn w-size2">
                                    <!-- Button -->
                                    <a href="" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                        Ver Ficha
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php $i++;
                        if($i>='5'){
                            exit();
                        }
                    }}else{ ?>
                        <div id="cartel" class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                            <div align="center">
                                <label  align="center"><?php echo $array->getEvent()->getName();?></label>
                            </div>
                            <div class="block1 hov-img-zoom pos-relative m-b-30">

                                <img
                                        src="<?php echo $array->getEvent()->getPhoto();?>"
                                        height="478.94px"
                                        width="370px"
                                >
                                <div class="block1-wrapbtn w-size2">
                                    <!-- Button -->
                                    <a href="" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                        Ver Ficha
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


            </div>

        </div>
        </div>
    </section>
	<!-- Banner -->
	<section class="banner bgwhite p-t-40 p-b-40">
			<?php if ($controllercategory->getAll()) { $list = $controllercategory->getAll(); ?>
		<div class="container">
			<div class="row">
					<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<?php if(!is_array($list)){ ?>
						<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img
						 title="<?php $list->getCategoryName(); ?>"
						 alt="<?php $list->getCategoryName(); ?>"
						 src="images/asd.jpg"
							height="478.94px"
							width="370px"
						>
						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="<?= URl ?>category/see/<?= $list->getID();?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $list->getCategoryName(); ?>
							</a>
						</div>
					</div>
					<?php } else { ?>
					<?php if(count($list)>=1) {?>
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img
						 title="<?php $list[0]->getCategoryName(); ?>"
						 alt="<?php $list[0]->getCategoryName(); ?>"
						 src="images/asd.jpg"
							height="478.94px"
							width="370px"
						>
						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="<?= URl ?>category/see/<?= $list[0]->getID();?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $list[0]->getCategoryName(); ?>
							</a>
						</div>
					</div>
				<?php } ?>
					<!-- block1 -->
					<?php if(count($list)>=2) {?>
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img
						 title="<?php $list[1]->getCategoryName(); ?>"
						 alt="<?php $list[1]->getCategoryName(); ?>"
						 src="images/asd.jpg"
							height="339.16px"
							width="370px"
						>
						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="<?= URl ?>category/see/<?= $list[1]->getID();?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $list[1]->getCategoryName(); ?>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<?php if(count($list)>=3) {?>
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img
						 title="<?php $list[2]->getCategoryName(); ?>"
						 alt="<?php $list[2]->getCategoryName(); ?>"
						 src="images/asd.jpg"
							height="339.16px"
							width="370px"
						>
						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="<?= URl ?>category/see/<?= $list[2]->getID();?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $list[2]->getCategoryName(); ?>
							</a>
						</div>
					</div>
					<?php } ?>
					<!-- block1 -->
					<?php if(count($list)>=4) {?>
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img
						 title="<?php $list[3]->getCategoryName(); ?>"
						 alt="<?php $list[3]->getCategoryName(); ?>"
						 src="images/asd.jpg"
							height="478.94px"
							width="370px"
						>
						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="<?= URl ?>category/see/<?= $list[3]->getID();?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $list[3]->getCategoryName(); ?>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<?php if(count($list)>=5) {?>
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img
						 title="<?php $list[4]->getCategoryName(); ?>"
						 alt="<?php $list[4]->getCategoryName(); ?>"
						 src="images/asd.jpg"
							height="478.94px"
							width="370px"
						>
						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="<?= URl ?>category/see/<?= $list[4]->getID();?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $list[4]->getCategoryName(); ?>
							</a>
						</div>
					</div>
					<?php } ?>
					<!-- block2 -->

					<?php if(count($list)>=6) {?>
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img
						 title="<?php $list[5]->getCategoryName(); ?>"
						 alt="<?php $list[5]->getCategoryName(); ?>"
						 src="images/asd.jpg"
							height="339.16px"
							width="370px"
						>
						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="<?= URl ?>category/see/<?= $list[5]->getID();?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $list[5]->getCategoryName(); ?>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
	<?php } else { ?>
		<h3 class="text-center">No hay categorias...</h3>
	<?php } ?>
	</section>

	<!-- Footer -->
<?php include("footer.php"); ?>

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>



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
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
