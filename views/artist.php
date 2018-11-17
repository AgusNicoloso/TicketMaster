<?php namespace views; ?>
<html>

<head>
    <title>Alta artista</title>
    <link rel="icon" type="image/png" href="<?= URl ?>images/icons/favicon.png"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link type="text/css" href="css/csslog.css" rel="stylesheet" id="bootstrap-css">
</head>

<body id="LoginForm">
    <div class="container">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Alta Artista</h2>
                    <p>Agregar Datos de Artista</p>
                </div>
                <form id="Artist" method="post" action="Artist/addArtist">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="" placeholder="Nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="agregar">Agregar</button>
                </form>
                <form id="Artist" method="post" action="Artist/deleteArtist">
                    <button type="submit" class="btn btn-primary" name="borrar">Borrar</button>
                </form>
                <a class="btn btn-primary" href="<?= URl.'home' ?>">Home</a>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</body>

</html>
