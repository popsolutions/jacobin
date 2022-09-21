<?php get_header(); ?>
	<?php
	if(is_shop()){
		$is_prod_cat = 0;
		include("woocommerce/custom/archive-product.php");
	}elseif(is_product_category()){
		$is_prod_cat = 1;
		include("woocommerce/custom/product-category.php");
	}else{
		?>
		<div id="loop-container" class="loop-container">
			<?php woocommerce_content(); ?>
		</div>
<?php }?>
<?php get_footer();