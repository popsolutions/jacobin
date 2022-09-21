<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<div class="producto-full">
		<div class="row align-items-center">
			<?php	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );?>
			<div class="col-12 col-md-6">
				<div class="shop-prod-img">
					<a href="<?php echo esc_url( $link );?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
						<?php
						if ( $product->is_on_sale() ) :

							echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product );
						endif;
						echo woocommerce_get_product_thumbnail('medium');
						?>
					</a>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="shop-prod-text">
					<a href="<?php echo esc_url( $link );?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
						<h2 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) );?>">
							<?php echo get_the_title();?>
						</h2>
						<?php
						wc_get_template( 'loop/rating.php' );
						wc_get_template( 'loop/price.php' );
						?>
					</a>
					<?php
					if ( $product ) {
						$defaults = array(
							'quantity'   => 1,
							'class'      => implode(
								' ',
								array_filter(
									array(
										'button',
										'product_type_' . $product->get_type(),
										$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
										$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
									)
								)
							),
							'attributes' => array(
								'data-product_id'  => $product->get_id(),
								'data-product_sku' => $product->get_sku(),
								'aria-label'       => $product->add_to_cart_description(),
								'rel'              => 'nofollow',
							),
						);

						$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

						if ( isset( $args['attributes']['aria-label'] ) ) {
							$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
						}

						wc_get_template( 'loop/add-to-cart.php', $args );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</li>
