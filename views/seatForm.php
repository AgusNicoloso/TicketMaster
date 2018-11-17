<?php namespace views; ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<html>
<head>
    <title>Alta tipo de plaza</title>
    <link rel="icon" type="image/png" href="<?= URl ?>images/icons/favicon.png"/>
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
                <h2>Tipo de Plaza</h2>
                <p>Porfavor, ingrese la informacion solicitada.</p>
            </div>

            <form id="Seat" method="post" action="addSeat">

                <div class="form-group">
                    <input type="text" class="form-control" name="seatName" id="inputEmail" placeholder="Tipo de Plaza" required>
                </div>


                <button type="submit" class="btn btn-primary" >Enviar</button>

            </form>
            <br>
            <a class="btn btn-primary" href="<?= URl.'home' ?>">Home</a>
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
