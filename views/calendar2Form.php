<?php namespace views;?>
<html>
<head>
    <title>Alta calendario</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="icon" type="image/png" href="<?= URl ?>images/icons/favicon.png"/>
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
            <form id="Calendar" method="post" action="oktoadd">
                    <div class="form-group">
                        <div class="alert alert-danger">Capacidad maxima: <?php  $place;echo $place->getCapacity()?></div>
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
                                        <td><input type="text" class="form-control" placeholder="Precio" name="precios[]" required><input type="text" class="form-control" placeholder="Cantidad" name="cantidad[]" required></td>
                                    </tr>
                                <?php }
                            }else{?>
                                <?php ?>
                                <tr>
                                    <th scope="row"><?php echo '1'?></th>
                                    <td><?php echo $seatList->getDescript(); ?></td>
                                    <td><input type="text" placeholder="Precio" class="form-control" name="precios[]" required><input type="text" class="form-control" placeholder="Cantidad" name="cantidad[]" required></td>

                                </tr>
                            <?php }  ?>


                            </tbody>
                        </table>
                    </div>
                      <input type="text" value="<?=$_POST['event']?>" name="event" hidden>
            <input type="text" value="<?=$_POST['dateIn']?>" name="dateIn" hidden>
            <input type="text" value="<?=$_POST['dateOut']?>" name="dateOut" hidden>
            <input type="text" value="<?=$_POST['place']?>" name="place" hidden>
            <input type="text" value="<?=$dayCounter+1?>" name="days" hidden>
            <?php foreach($_POST['seats'] as $key=>$value){?>
            <input multiple="multiple" value="<?=$value?>" name="seats[]" hidden>
        <?php } ?>
                <?php
                if($_POST) {
                    $contador = 1;
                    $arreglo[]=null;
                    while($contador <= $dayCounter+1) {
                    if (($dateStart <= $dateFinish)) {
                        $aux = $dateStart;
                    //array_push( $arreglo, $aux->format('Y-m-d'));
                        ?>

                <input type="date" name="dates[]" value="<?= $aux->format('Y-m-d') ?>" hidden>
                   <?php     $dateStart->modify('+1 day');
                    }
                ?>
                    <h2><?php echo "Día " . $contador ?></h2>
                    <select id="multiselectwithsearch<?=$contador?>" multiple="multiple" name="dia<?php echo $contador?>[]" required>
                        <?php
                        if(!empty($lista)){
                          if(!is_array($lista)){ ?>
                            <option value="<?php echo $lista->getId(); ?>" required> <?php echo $lista->getName(); ?> </option>
                        <?php  } else {
                            foreach ($lista as $key => $value) { ?>

                                <option value="<?php echo $value->getId(); ?>" required> <?php echo $value->getName(); ?> </option>
                            <?php } }
                        } ?>
                    </select>
                    <script>
                    $(function() {  
                     $('#multiselectwithsearch<?=$contador?>').multiselect({
                                enableFiltering: true,
                                enableCaseInsensitiveFiltering: true,
                                nonSelectedText: 'Elige uno o mas Artistas',
                                nSelectedText: 'Seleccionados',
                                allSelectedText: 'Todo seleccionado',
                                filterPlaceholder: 'Buscar plaza'
                            }); 
                    });
                    </script>
                    <?php $contador++; }
                    ?>
                    <?php foreach($arreglo as $key=>$value){?>
                <input type="date" name="dates[]" value="<?= $value ?>" hidden>
                <?php } ?>
            <?php
            } ?>

            
            <br><br>
                 <button type="submit" class="btn btn-primary" >Siguiente</button>
            </form>
            <?php 
            if(isset($msg)){
                ?>
                <div class="alert alert-danger"><?php echo $msg;?></div>
                <?php
            }
            ?>
        </div>
    </div>
</div>        
</body>
</html>
