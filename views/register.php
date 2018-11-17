<?php namespace views; ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<html>
<head>
    <title>Registro</title>
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
                <h2>Registro</h2>
                <p>Porfavor, complete todos los campos.</p>
            </div>

            <form id="User" method="post" action="logverify">

                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="inputEmail" placeholder="Nombre y Apellido" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="mail" id="inputEmail" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="pass" id="inputPassword" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary" >Registrarse</button>

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
