<?php namespace views;;
use controllers\PlaceController as PlaceController;
use controllers\SeatController;

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!---------------------------------------------------------------------------------------------------------------------->
<html>
<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link type="text/css" href="../css/csslog.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body id="LoginForm">
<div class="container">
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h2>Carga Final de Plaza</h2>
                <p>Porfavor, ingrese la informacion solicitada.</p>
            </div>
            <form id="Place" method="post" action="addEventPlace">

                <div class="form-group">
                    <input type="text" class="form-control" name="quantity" id="inputEmail" placeholder="Cantidad" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="price" id="inputEmail" placeholder="Precio" required>
                </div>
                <div class="form-group">
                    <select class="form-control" name="seat" required>
                       <?php if(is_array($listplace)){
                       foreach ($listplace as $key => $value) {?>
                           <option value="<?php echo $value->getId(); ?>"><?php echo $value->getDescript(); ?></option>
                       <?php } ?>
                           <?php
                       } else{ ?>
                        <option value="<?php echo $listplace->getId(); ?>"><?php echo $listplace->getDescript(); ?></option>
                        <?php
                        }
                       ?>
                    </select>
                    </div>
                <button type="submit" class="btn btn-primary" >Enviar</button>
            </form>
            </div>
            <?php
            if(empty($listplace)){
                ?>
                <div class="alert alert-danger">No hay Tipo de plaza cargados.</div>
                <?php
            }
            ?>

        </div></div>

</body>
</html>
