<?php namespace views; 
$controllercategory = new \controllers\categoryController();?>
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
                <h2>Alta Evento</h2>
                <p>Agregar Datos de Evento</p>
            </div>
              <form id="Event" method="post" action="insert" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" class="form-control" name="nombreevento" placeholder="Nombre Evento" required>
              </div>
              <div class="form-group">
                <input type="file" class="form-control-file" name="fotoevento" required>
              </div>
              <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="categoria" required>
                  <?php if ($controllercategory->getAll()) { $list = $controllercategory->getAll(); ?>
                  <option selected disabled>Elige una categoría</option>
                  <?php if(!is_array($list)){ ?>
                      <option value="<?php echo $list->getID(); ?>"><?php echo $list->getCategoryName(); ?></option>
                  <?php } else { ?>
                    <?php foreach ($list as $key => $value) { ?>
                       <option value="<?php echo $value->getID(); ?>"><?php echo $value->getCategoryName(); ?></option>
                      <?php } 
                    } ?>
                   <?php } else { ?>
                      <option selected disabled>No hay categorias</option> 
                      <?php } ?>
                  </select>
              </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
            <form action="<?= URl ?>Calendar/index">
                <button type="" class="btn btn-primary">Omitir</button>
            </form>
            <form action="Home">
                <button type="" class="btn btn-primary">Volver al menú principal</button>
            </form>
            <?php
            if(isset($this->msg)){
                ?>
                <div class="alert alert-danger"><?php echo $this->msg;?></div>
                <?php
            }
            ?>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <!------ Include the above in your HEAD tag ---------->

</body>
</html>
