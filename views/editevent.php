<?php namespace views; ?>
<!---------------------------------------------------------------------------------------------------------------------->
<html>
<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link type="text/css" href="<?= URl ?>css/csslog.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body id="LoginForm">
<div class="container">
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h2>Editar Evento</h2>
                <p>Agrega datos para editar el evento</p>
            </div>
              <form id="Event" method="post" action="<?= URl?>event/edit" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" class="form-control" name="nombreevento" placeholder="<?= $product->getName(); ?>">
              </div>
              <div class="form-group">
                <input type="file" class="form-control-file" name="fotoevento">
              </div>
              <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="categoria">
                  <?php if ($list) { ?>
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
                  <input type="number" value="<?=$product->getID();?>" name="eventid" hidden>
              </div>
                <button type="submit" class="btn btn-primary">Editar</button>
            </form>
            <a class="btn btn-primary" href="<?= URl.'home' ?>">Home</a>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <!------ Include the above in your HEAD tag ---------->

</body>
</html>
