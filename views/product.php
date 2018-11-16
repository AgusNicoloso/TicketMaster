<?php namespace views; ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Eventos</title>
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
      <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
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
              <a href="<?= URl ?>" class="logo">
                 <h2>TicketMaster</h2>
              </a>
              <!-- Menu -->
  						<?php include("menu.php");
  						include("header.php"); ?>
           </div>
        </div>

      </header>
      <!-- Title Page -->
      <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/fondo.jpg);">
         <h2 class="l-text2 t-center">
            Compra de tickets
         </h2>
      </section>
      <!-- Content page -->
      <section class="bgwhite p-t-55 p-b-65">
         <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">

                <form method="post" action="calendar/filter">
                <div class="flex-sb-m flex-w p-b-35">
                  <div class="flex-w">
              <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                <input type="date" name="startdate" min="<?=date("Y-m-d"); ?>">
              </div>
              <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                <input type="date" name="enddate" min="<?=date("Y-m-d"); ?>">
              </div>
                </div>
                <button type="submit"class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" name="filter">
                        Filtrar
                      </button>
                </div>
              </form>


                <div class="leftbar p-r-20 p-r-0-sm">
                  <form action="Event/search" method="post">


                  <div class="search-product pos-relative bo4 of-hidden">
                    <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search_product" placeholder="Buscar evento...">
                       <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                        <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                       </button>
                   </div>

                   </form>
                  <h4 class="m-text14 p-b-7">
                    <br>Categorias
                  </h4>
                  <?php if($list){ ?>
                  <?php if(!is_array($list)){ ?>
                  <ul class="p-b-54">
                   <li class="p-t-4">
                      <a href="<?= URl ?>category/see/<?= $list->getID();?>" class="s-text13 active1">
                       <?php echo $list->getCategoryName(); ?>
                      </a>
                    </li>
                  </ul>
                  <?php } else { ?>
                    <ul class="p-b-54">
                      <?php foreach ($list as $key => $value) { ?>
                          <li class="p-t-4">
                            <a href="<?= URl ?>category/see/<?= $value->getID();?>" class="s-text13 active1">
                              <?php echo $value->getCategoryName(); ?>
                            </a>
                          </li>
                      <?php } ?>
                  </ul>
                <?php } ?>
                </div>
              <?php } ?>
              </div>
               <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                
                  <!-- Product -->
									<?php
                 if($listevent){
                    ?>

                  <div class="row">
                    <?php if(!is_array($listevent)){ ?>
                      <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <div class="block2">
                           <div class="block2-img wrap-pic-w of-hidden pos-relative">
                             <img
                              title="<?php $listevent->getName(); ?>"
                              alt="<?php $listevent->getName(); ?>"
                              src="<?php echo $listevent->getPhoto(); ?>"
                              height="320px"
                             >
                              <div class="block2-overlay trans-0-4">
                                 <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <a href="<?= URl ?>event/see/<?= $listevent->getID();?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Ver evento
                                  </a>
                                 </div>
                              </div>
                           </div>
                           <div class="block2-txt p-t-20">
                              <a href="<?= URl ?>event/see/<?= $listevent->getID();?>" class="block2-name dis-block m-text6 p-r-5">
                                <?php echo $listevent->getName(); ?>
                              </a>
                              <span class="block2-name dis-block s-text3 p-b-5">
                                <?php echo "Categoria : " . $listevent->getNameCategory(); ?>
                              </span>
                           </div>
                        </div>
                     </div>
                    <?php } else { ?>
										<?php foreach ($listevent as $key => $value) { ?>
                     <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <div class="block2">
                           <div class="block2-img wrap-pic-w of-hidden pos-relative">
                             <img
                              title="<?php $value->getName(); ?>"
                              alt="<?php $value->getName(); ?>"
                              src="<?php echo $value->getPhoto(); ?>"
                              height="320px"
                             >
                              <div class="block2-overlay trans-0-4">
                                 <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <a href="<?= URl ?>event/see/<?= $value->getID();?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Ver evento
                                  </a>
                                 </div>
                              </div>
                           </div>
                           <div class="block2-txt p-t-20">
                              <a href="<?= URl ?>event/see/<?= $value->getID();?>" class="block2-name dis-block m-text6 p-r-5">
																<?php echo $value->getName(); ?>
                              </a>
                              <span class="block2-name dis-block s-text3 p-b-5">
                                <?php echo "Categoria : " . $value->getNameCategory(); ?>
                              </span>
                           </div>
                        </div>
                     </div>
										 <?php } ?>
                     <?php } ?>
                  </div>
                  <div class="pagination flex-m flex-w p-t-26">
                    <?php if(!is_array($total)){ ?>
                      <a href="product?page=<?php echo 1; ?>" class="item-pagination flex-c-m trans-0-4 active-pagination"><?php echo 1; ?></a>
                    <?php } else { ?>
                  <?php for($a=1;$a<=ceil(count($total)/9);$a++){ ?>
                    <?php if($page==$a){ ?>
                      <a href="product?page=<?php echo $a; ?>" class="item-pagination flex-c-m trans-0-4 active-pagination"><?php echo $a; ?></a>
                    <?php } else{ ?>
                     <a href="product?page=<?php echo $a; ?>" class="item-pagination flex-c-m trans-0-4"><?php echo $a; ?></a>
                     <?php } ?>
                  <?php } }?>
                  </div>
								<?php } else { ?>
                  <h3 class="text-center">No hay eventos...</h3>
								<?php } ?>
                  <!-- Pagination -->

               </div>
            </div>
         </div>
      </section>
      <!-- Footer -->
			<?php include('footer.php');?>
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
				<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
				<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
			<!--===============================================================================================-->
				<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
				<script type="text/javascript" src="js/slick-custom.js"></script>
			<!--===============================================================================================-->
				<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
				<script type="text/javascript"></script>
			<!--===============================================================================================-->
			<script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>
			<script type="text/javascript">
			var filterBar = document.getElementById('filter-bar');
			noUiSlider.create(filterBar, {
				start: [50, 200],
				connect: true,
				range: {
					'min': 50,
					'max': 200
				}
			});
			var skipValues = [
				document.getElementById('value-lower'),
				document.getElementById('value-upper')
			];
			filterBar.noUiSlider.on('update', function (values, handle) {
				skipValues[handle].innerHTML = Math.round(values[handle]);
			});
			</script>
			<!--===============================================================================================-->
			<script src="js/main.js"></script>
		</body>
</html>
