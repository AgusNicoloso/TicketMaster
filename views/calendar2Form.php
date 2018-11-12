<?php
namespace views;
use controllers\ArtistController;
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
            <form id="Calendar" method="post" action="addCalendar">
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
                    <select id="multiselectwithsearch<?=$contador?>" multiple="multiple" name="dia<?php echo $contador?>[]">
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
                    <script>
                    $(function() {  
                     $('#multiselectwithsearch<?=$contador?>').multiselect({
                                enableFiltering: true,
                                enableCaseInsensitiveFiltering: true,
                                nonSelectedText: 'Elige uno o mas tipos de plazas',
                                nSelectedText: 'Seleccionados',
                                allSelectedText: 'Todo seleccionado',
                                filterPlaceholder: 'Buscar plaza'
                            }); 
                    });
                    </script>
                    <?php $contador++; }
                    ?>
            <?php
            $_SESSION['data']=$_POST;
            $_SESSION['data']['days']=$dayCounter+1;
            } ?>
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
