<?php namespace views; ?>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link type="text/css" href="../css/csslog.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body id="LoginForm">
<div class="container">
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h2>Alta Categoria</h2>
                <p>Agregar Datos de Categoria</p>
            </div>
            <form id="category" method="post" action="addCategory">
              <div class="form-group">
                <input type="text" class="form-control" name="category_name" placeholder="Nombre Categoria" required>
              </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
            <form action="Home">
                <a href="home.php"><button type="" class="btn btn-primary">Volver al menú principal</button></a>
            </form>
            <?php
            if(isset($msg)){
                ?>
                <div class="alert alert-danger"><?php echo $msg;?></div>
                <?php
            }
            ?>

</body>
</html>
