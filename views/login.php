<?php namespace views; ?>
<html>
<head>
    <title>Login</title>
    <link rel="icon" type="image/png" href="<?= URl ?>images/icons/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link type="text/css" href="../css/csslog.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body id="LoginForm">
<div class="container">
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h2>Login</h2>
                <p>Por favor ingresa tu email y contraseña</p>
            </div>

            <form id="User" method="post" action="../User/searchUser">

                <div class="form-group">


                    <input type="email" class="form-control" name="mail" id="inputEmail" placeholder="Email">

                </div>

                <div class="form-group">

                    <input type="password" class="form-control" name="pass" id="inputPassword" placeholder="Contraseña">

                </div>

                <button type="submit" class="btn btn-primary">Iniciar sesion</button>

            </form>

            <a class="btn btn-primary" href="<?= URl ?>User/index">Registrate</a>
            <br><br>
            <a class="btn btn-primary" href="<?= URl.'home' ?>">Home</a>

            <?php
            if(isset($msg)){
                ?>
                <div class="alert alert-danger"><?php echo $msg;?></div>
                <?php
            }
            ?>
       </div></div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <div id="fb-root"></div>
</body>
</html>
