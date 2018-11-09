<?php
namespace views;
use controllers\ArtistController;
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

            <form id="Calendar" method="post" action="addCalendar">
                <div class="form-group">

                <?php

                if($_POST) {
                     $dateStart = new \DateTime($_POST['dateIn']);
                     $dateFinish = new \DateTime($_POST['dateOut']);

                    $dayCounter = $dateStart->diff($dateFinish);
                    $dayCounter = $dayCounter->format('%a');
                    $_SESSION['dates']=array();
                $lista= new ArtistController();
                $lista= $lista->showArtist();
                $contador = 1;
                while($contador <= $dayCounter+1) {

                    if (($dateStart <= $dateFinish)) {
                        $aux = $dateStart;
                        array_push( $_SESSION['dates'], $aux->format('Y-m-d'));
                        $dateStart->modify('+1 day');
                    }
                ?>
                    <h2><?php echo "Día " . $contador ?></h2>
                    <select class="custom-select my-1 mr-sm-2" multiple name="dia<?php echo $contador?>[]">
                        <option disabled selected>Elige uno o mas artistas: </option>
                        <?php

                        if(!empty($lista)){
                          if(!is_array($lista)){ ?>
                            <option value="<?php echo $lista->getId(); ?>"> <?php echo $lista->getName(); ?> </option>

                        <?php  } else {
                            foreach ($lista as $key => $value) { ?>

                                <option value="<?php echo $value->getId(); ?>"> <?php echo $value->getName(); ?> </option>
                            <?php } }
                        } ?>
                    </select>
                    <?php $contador++; }
                    ?>

                </div>
                <button type="submit" class="btn btn-primary" >Enviar</button>
                </div>




            </form>
            <?php
            $_SESSION['data']=$_POST;
            $_SESSION['data']['days']=$dayCounter+1;
            }
            if(isset($msg)){
                ?>
                <div class="alert alert-danger"><?php echo $msg;?></div>
                <?php
            }
            ?>
        </div></div>

</body>
</html>
