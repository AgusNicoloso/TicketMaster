<?php namespace views;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Compra</title>
</head>
<body>
	<?php if($compra){ ?>
<?= "<img align=center src='$url$ruta'>"; ?> 
<?php } else {echo "Necesitas cargar algo al carrito antes de comprar";} ?>
<a href="<?=URl ?>">Volver al inicio de la pagina</a>
</body>
</html>


