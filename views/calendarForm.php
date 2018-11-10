<?php namespace views;
    use controllers\ArtistController;
use controllers\CategoryController;
use controllers\EventController;
use controllers\PlaceController;
use controllers\SeatController;

$c_event=new EventController();
$c_place=new PlaceController();
$c_category=new CategoryController();
$c_seat=new SeatController();




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
                <h2>Calendario</h2>
                <p>Porfavor, ingrese la informacion solicitada.</p>
            </div>

            <form id="Calendar" method="post" action="index2">

                <div class="form-group">
                    <?php
                    $categoryList=$c_category->getAll();
                    $eventList=$c_event->getAll();
                    $placeList=$c_place->allPlace();
                    ?>

                    <tile>Evento</tile>
                    <select class="form-control" name="event" id="">
                        <?php
                        if(is_array($eventList))
                        {
                            if(!empty($eventList)){
                                foreach ($eventList as $key=>$value){
                                    ?>
                                    <option value="<?= $value->getId(); ?>"><?= $value->getName(); ?></option>
                                    <?php
                                }
                            }
                        }
                        else{
                            ?>
                            <option value="<?=  $eventList->getId(); ?>"><?= $eventList->getName(); ?></option>
                        <?php
                        }

                        ?>

                    </select>
                </div>
                <tile>Categoria</tile>
                <div class="form-group">
                    <select class="form-control" name="category" id="">
                        <?php
                        if(is_array($categoryList))
                        {
                            if(!empty($categoryList)){
                                foreach ($categoryList as $key=>$value){
                                    ?>
                                    <option value="<?php echo $value->getID(); ?>"><?php echo $value->getCategoryName(); ?></option>
                                    <?php
                                }
                            }
                        }
                        else{
                            ?>
                            <option value="<?php echo $categoryList->getID(); ?>"><?php echo $categoryList->getCategoryName(); ?></option>
                            <?php
                        }

                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fecha Inicio</label> <input type="date" class="form-control" name="dateIn">
                </div>
                <div class="form-group">
                    <label for="">Fecha Fin</label> <input type="date" class="form-control" name="dateOut">
                </div>
                <tile>Lugar</tile>
                <div class="form-group">

                    <select class="form-control" name="place" id="">

                        <?php
                        if(is_array($placeList))
                        {
                            if(!empty($placeList)){
                                foreach ($placeList as $key=>$value){
                                    ?>
                                    <option value="<?php echo $value->getId(); ?>"><?php echo $value->getPlace(); ?></option>
                                    <?php
                                }
                            }
                        }
                        else{
                            ?>
                            <option value="<?php echo $placeList->getId(); ?>"><?php echo $placeList->getPlace(); ?></option>
                            <?php
                        }

                        ?>

                    </select>
                </div>
                <tile>Plaza</tile>
                <div class="form-group">
                    <select class="custom-select my-1 mr-sm-2" multiple name="seats[]">

                        <?php
                        $seatList=$c_seat->allSeat();
                        if(is_array($seatList)){?>
                            <option disabled selected>Elige uno o mas tipos de Plaza: </option>
                           <?php foreach ($seatList as $key => $value) { ?>

                                <option value="<?php echo $value->getId(); ?>"> <?php echo $value->getDescript(); ?> </option>
                            <?php }

                             } else{  ?>

                            <option value="<?php echo $seatList->getId(); ?>"> <?php echo $seatList->getDescript(); ?> </option>
                      <?php }  ?>
                    </select>
                </div>
                <div class="form-group">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Plaza</th>
                            <th scope="col">Campos</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(is_array($seatList)){

                                foreach ($seatList as $key => $value) { ?>

                                    <tr>
                                        <th scope="row"><?php echo $key+1;?></th>
                                        <td><?php echo $value->getDescript(); ?></td>
                                        <td><input type="text" class="form-control" placeholder="Precio" name="precios[]"><input type="text" class="form-control" placeholder="Cantidad" name="cantidad[]"></td>
                                    </tr>
                                <?php }
                             }else{?>
                            <?php ?>
                            <tr>
                                <th scope="row"><?php echo '1'?></th>
                                <td><?php echo $seatList->getDescript(); ?></td>
                                <td><input type="text" placeholder="Precio" class="form-control" name="precios[]"><input type="text" class="form-control" placeholder="Cantidad" name="cantidad[]"></td>

                            </tr>
                        <?php }  ?>


                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary" >Siguiente</button>

            </form>
            <?php
            if(isset($msg)){
                ?>
                <div class="alert alert-danger"><?php echo $msg;?></div>
                <?php
            }
            ?>
        </div></div>

</body>
</html>
