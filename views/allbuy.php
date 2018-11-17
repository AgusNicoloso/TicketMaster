<?php namespace views; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ventas</title>
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

    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?= URl ?>images/money.jpg);">
        <h2 class="l-text2 t-center">
            Ventas
        </h2>
    </section>
    <!-- Cart -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <!-- Cart item -->
        <?php if ($buys) { ?>
            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1">#</th>
                            <th class="column-2">Fecha</th>
                            <th class="column-3">Cliente</th>
                            <th class="column-4 text-center">QR</th>
                            <th class="column-5">Email</th>
                        </tr>
                            <?php if(is_array($buys)){ ?>
                            <?php foreach ($buys as $key => $value) { ?>
                            <tr class="table-row">
                                <td class="column-1"><?= $key+1; ?></td>
                                <td class="column-2"><?= $value->getDate();?></td>
                                <td class="column-3"><?= $value->getClient()->getName();?></td>
                                <td class="column-4 text-center">
                                        <img
                                         src="<?= URl.$value->getTicket()->getQR(); ?>"
                                         height="120px"
                                        >
                                </td>
                                <td class="column-5"><?= $value->getClient()->getMail(); ?></td>
                            </tr>
                            <?php } } else { ?>
                                <tr class="table-row">
                                <td class="column-1"><?= 1 ?></td>
                                <td class="column-2"><?= $buys->getDate();?></td>
                                <td class="column-3"><?= $buys->getClient()->getName();?></td>
                                <td class="column-4 text-center">
                                        <img
                                         src="<?= URl.$buys->getTicket()->getQR(); ?>"
                                         height="120px"
                                        >
                                </td>
                                <td class="column-5"><?= $buys->getClient()->getMail(); ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            <?php  }  else { ?>
                <h4 class="text-center">No hay ventas...</h4>
            <?php } ?>
            </div>
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
    <script src="<?= URl ?>js/main.js"></script>

</body>
</html>
