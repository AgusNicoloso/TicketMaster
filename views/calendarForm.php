<?php namespace views;
use controllers\ArtistController;
use controllers\CategoryController;
use controllers\EventController;
use controllers\PlaceController;
use controllers\SeatController;
?>
<!---------------------------------------------------------------------------------------------------------------------->
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap-multiselect.css" type="text/css"/>
    <script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
    <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
    <link type="text/css" href="../css/csslog.css" rel="stylesheet" id="bootstrap-css">
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
            <?php
            if(isset($msg)){
                ?>
                <div class="alert alert-danger"><?php echo $msg;?></div>
                <?php
            }
            ?>
            <form id="Calendar" method="post" action="index2">
                <?php if(empty($msg)){ ?>
                <div class="form-group">

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
                    <label for="">Fecha Inicio</label> <input type="date" class="form-control" name="dateIn" min="<?=date("Y-m-d"); ?>">
                </div>
                <div class="form-group">
                    <label for="">Fecha Fin</label> <input type="date" class="form-control" name="dateOut" min="<?=date("Y-m-d"); ?>">
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
                <div class="container-fluid">
                    <select class="form-control" id="multiselectwithsearch" multiple="multiple" name="seats[]">
                        <?php
                        if(is_array($seatList)){?>
                            
                           <?php foreach ($seatList as $key => $value) { ?>

                                <option value="<?php echo $value->getId(); ?>"> <?php echo $value->getDescript(); ?> </option>
                            <?php }
                             } else{  ?>

                            <option value="<?php echo $seatList->getId(); ?>"> <?php echo $seatList->getDescript(); ?> </option>
                      <?php }  ?>
                    </select>
                    
                </div>
                <br>
                <button type="submit" class="btn btn-primary" >Siguiente</button>
                <?php }?>
                </form>
            <br>
            <a class="btn btn-primary" href="<?= URl.'home' ?>">Home</a>


        </div></div>
<script>
$(function() {  
 $('#multiselectwithsearch').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            nonSelectedText: 'Elige uno o mas tipos de plazas',
            nSelectedText: 'Seleccionados',
            allSelectedText: 'Todo seleccionado',
            filterPlaceholder: 'Buscar plaza'
        }); 
});
</script>
</body>
</html>