<?php namespace views;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Compra</title>
    <link rel="icon" type="image/png" href="<?= URl ?>images/icons/favicon.png"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap-multiselect.css" type="text/css"/>
    <script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
    <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
    <link type="text/css" href="../css/csslog.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
	<div align="center">
			<?php if($compra){ //<?= "<img align=center src='$url$ruta'>"?>
			 <h4>compraste supuestamente...</h4>
			<?php } else {echo "Necesitas cargar algo al carrito antes de comprar";} ?>
			<br>
			<a class="btn btn-primary" href="<?= URl.'home' ?>">Home</a>
	</div>
	
</body>
</html>


