<?php namespace views; 
$controllercategory = new \controllers\categoryController();?>
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
	<div class="flex-w">
		<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
			<h4 class="s-text12 p-b-30">
				CONTACTO
			</h4>
			<div>
				<p class="s-text7 w-size27">
					¿Alguna pregunta? Avísenos en la Universidad Tecnológica Nacional Mar del Plata, Av. Dorrego 281 o llámanos al 0223 480-1220
				</p>
				<div class="flex-m p-t-30">
					<a href="http://www.twitter.com/utnmardelplata" class="fs-18 color1 p-r-20 fa fa-twitter" target="_blank"></a>
					<a href="http://www.instagram.com/utnmardelplata" class="fs-18 color1 p-r-20 fa fa-instagram" target="_blank"></a>
					<a href="http://www.facebook.com/utnmardelplata" class="fs-18 color1 p-r-20 fa fa-facebook" target="_blank"></a>
				</div>
			</div>
		</div>
		<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
			<h4 class="s-text12 p-b-30">
				Categorias
			</h4>
			<?php if ($controllercategory->getAll()) { $list = $controllercategory->getAll(); ?>
				<?php if(!is_array($list)){ ?>
					<ul>
						<li class="p-b-9">
						<a href="<?= URl ?>category/see/<?= $list->getID();?>" class="s-text7">
								<?php echo $list->getCategoryName(); ?> 
						</a>
						</li>
					</ul>
				<?php } else { ?>
				<ul>
						<?php if(count($list)>=1){ ?>
						<li class="p-b-9">
						<a href="<?= URl ?>category/see/<?= $list[0]->getID();?>" class="s-text7">
								 <?php echo $list[0]->getCategoryName(); ?>
						</a>
						</li>
						<?php } ?>
						<?php if(count($list)>=2){ ?>
						<li class="p-b-9">
						<a href="<?= URl ?>category/see/<?= $list[1]->getID();?>" class="s-text7">
								 <?php echo $list[1]->getCategoryName(); ?>
						</a>
						</li>
						<?php } ?>
						<?php if(count($list)>=3){ ?>
						<li class="p-b-9">
						<a href="<?= URl ?>category/see/<?= $list[2]->getID();?>" class="s-text7">
								 <?php echo $list[2]->getCategoryName(); ?>
						</a>
						</li>
						<?php } ?>
						<?php if(count($list)>=4){ ?>
						<li class="p-b-9">
						<a href="<?= URl ?>category/see/<?= $list[3]->getID();?>" class="s-text7">
								 <?php echo $list[3]->getCategoryName(); ?>
						</a>
						</li>
						<?php } ?>
						<?php if(count($list)>=5){ ?>
						<li class="p-b-9">
						<a href="<?= URl ?>category/see/<?= $list[4]->getID();?>" class="s-text7">
								 <?php echo $list[4]->getCategoryName(); ?>
						</a>
						</li>
						<?php } ?>
				</ul>
				<?php } ?>
			<?php } else { ?>
				<a class="s-text7">
					No hay categorias...
				</a>
			<?php } ?>
			</div>

	</div>
	<div class="t-center p-l-15 p-r-15">
		<a>
			<img class="h-size2" src="<?= URl ?>images/icons/paypal.png" alt="IMG-PAYPAL">
		</a>
		<a>
			<img class="h-size2" src="<?= URl ?>images/icons/visa.png" alt="IMG-VISA">
		</a>
		<a>
			<img class="h-size2" src="<?= URl ?>images/icons/mastercard.png" alt="IMG-MASTERCARD">
		</a>
		<a>
			<img class="h-size2" src="<?= URl ?>images/icons/express.png" alt="IMG-EXPRESS">
		</a>
		<a>
			<img class="h-size2" src="<?= URl ?>images/icons/discover.png" alt="IMG-DISCOVER">
		</a>

		<div class="t-center s-text8 p-t-20">
				Copyright © 2018 Todos los derechos reservados | UTN Universidad Tecnológica Nacional Mar del Plata | Sureda Manuel, Morales Maximiliano, Nicoloso Agustin
		</div>
	</div>
</footer>
