<?php namespace views;
$daocarrito = new \daos\daoList\daoCarrito();
?>
<div class="header-wrapicon2">
	<img src="<?= URl ?>images/icons/shop.png" class="header-icon1 js-show-header-dropdown" alt="ICON" height="40px" width="40px">
	<span class="header-icons-noti"><?php
		if (isset($_SESSION['CarritoList'])) {
		echo count($_SESSION['CarritoList']); } else {
			echo "0";}
			?></span>
	<!-- Header cart noti -->
	<div class="header-cart header-dropdown">
		<?php if (isset($_SESSION['CarritoList']) && count($_SESSION['CarritoList']) != 0) { $i=1; $total=0;?>
			<ul class="header-cart-wrapitem">
			<?php foreach ($_SESSION['CarritoList'] as $key){ ?>
					<li class="header-cart-item">
						<a class="header-cart-item-img" href="<?= URl ?>event/deleteEvent/<?= 1; ?>">
							<img
							 title="<?php $key['title_event']; ?>"
							 alt="<?php $key['title_event']; ?>"
							 src="<?= URl.$key['photo']; ?>"
							 height="320px"
							>
						</a>
						<div class="header-cart-item-txt">
							<a href="<?= URl ?>event/see/<?= $key['id_event'];?>" class="header-cart-item-name">
								<?= $key['title_event']; ?>
							</a>
							<span class="header-cart-item-info"><?= $key['name_place'] . " - " . $key['quantity'] . " x $" . $key['price'];?></span>
						</div>
					</li>
		<?php $i++; $total = $total + ($key['price']*$key['quantity']);} ?> 
		</ul>
		<div class="header-cart-total">
			Total: $<?= $total;?>
		</div>
	<?php } else { 
			echo "No agregaste nada...";
		} ?>
		<div class="header-cart-buttons">
			<div class="header-cart-wrapbtn">
				<!-- Button -->
				<a href="<?= URl ?>cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
					Ver carrito
				</a>
			</div>
			<div class="header-cart-wrapbtn">
				<!-- Button -->
				<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
					Comprar
				</a>
			</div>
		</div>
	</div>
</div>
