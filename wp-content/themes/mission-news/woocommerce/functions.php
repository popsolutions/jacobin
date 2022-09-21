<?php
/* sdobke Agrega temporalmente un estilo css */
function wpdocs_theme_name_scripts() {
	wp_enqueue_style ('DosRiosDbk', get_template_directory_uri().'/woocommerce/style2.css', array());
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
/*
add_theme_support( 'woocommerce');
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 142,
		'single_image_width'    => 142,
		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 5,
		),
	) );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
*/
function wpse319485_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'wpse319485_add_woocommerce_support' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'after_setup_theme', 'my_remove_product_result_count', 99 );
function my_remove_product_result_count() { 
	remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
}
// QUITAR CAMPOS DEL CHECKOUT
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_phone']);
	unset($fields['shipping']['shipping_company']);
	return $fields;
}
// CAMBIO DE MONEDA
/*
function cambia_a_pesos( $currency_symbol ) {
	 $currency_symbol = 'AR$';
	 return $currency_symbol;
}
function cambia_a_dolares( $currency_symbol ) {
	 $currency_symbol = 'U$';
	 return $currency_symbol;
}
*/
// FIN CAMBIO SÍMBOLO MONEDA
// Agregado para modificar el total del pedido
/*
add_filter( 'woocommerce_calculated_total', 'change_calculated_total', 10, 2 );
function change_calculated_total( $total, $cart) {
	
	$valor_dolar = 1;
	cambiar_login();
	// sigue
	$cat_ids = array();
	foreach ( wc()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$cat_ids = array_merge(
			$cat_ids, $cart_item['data']->get_category_ids()
		);
	}
	global $WOOCS;
	$dolar_array = array(70,82,172);
	if ( array_intersect($dolar_array, $cat_ids) ){
		$WOOCS->set_currency('ARS');
	}else{
		$WOOCS->set_currency('USD');
	}
	return $total * $valor_dolar;
}
function cambiar_pesos(){
	global $WOOCS;
	$WOOCS->set_currency('ARS');
}
function cambiar_dolar(){
	$WOOCS->set_currency('USD');
}
*/
function my_login_url( $url, $redirect = null ) {
	if( is_admin() ) {
		return $url;
	}
	/*
	$r = "";
	if( $redirect ) {
		$r = "?redirect_to=".esc_attr($redirect);
	}
	*/
	return "login/?redirect_to=/mi-cuenta/orders";
}
function admin_default_page() {
	return '/mi-cuenta/orders/';
}
add_action( 'woocommerce_proceed_to_checkout', 'cambiar_login' );
function cambiar_login(){
	global $post;
	//echo '<br>Testing: '.$post->ID;
	if( $post->ID == 547) {
		//add_filter( 'login_redirect', 'admin_default_page' );
		add_filter( 'login_url', 'my_login_url', 10, 2 );
	}
}
// Set coupon code as custom data in cart session
add_action('wp_loaded', 'add_coupon_code_to_cart_session');
function add_coupon_code_to_cart_session() {
	// Exit if no code in URL or if the coupon code is already set cart session
	if( empty( $_GET["cupon"] ) || WC()->session->get( 'custom_discount' ) ) return;
	if( ! WC()->session->get( 'custom_discount' ) ) {
		$coupon_code = esc_attr($_GET["cupon"]);
		WC()->session->set( 'custom_discount', $coupon_code );
		// If there is an existing non empty cart active session we apply the coupon
		if( ! WC()->cart->is_empty() ){
			WC()->cart->add_discount( $coupon_code );
		}
	}
}
/*
// Add coupon code when a product is added to cart once
add_action('woocommerce_add_to_cart', 'add_coupon_code_to_cart', 10, 6 );
function add_coupon_code_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ){
	$coupon_code = WC()->session->get( 'custom_discount' );
	$applied_coupons = WC()->session->get('applied_coupons');
	if( empty($coupon_code) || in_array( $coupon_code, $applied_coupons ) ) return;
	WC()->cart->add_discount( $coupon_code );
}
// Remove coupon code when user empty his cart
add_action('woocommerce_cart_item_removed', 'check_coupon_code_cart_items_removed', 10, 6 );
function check_coupon_code_cart_items_removed( $cart_item_key, $cart ){
	$coupon_code = WC()->session->get( 'custom_discount' );
	if( $cart->has_discount( $coupon_code ) && $cart->is_empty() );
		$cart->remove_coupon( $coupon_code );
}
*/
/*
add_action('woocommerce_after_checkout_billing_form', 'custom_checkout_field');
function custom_checkout_field($checkout)
{
	echo '<div id="regalo">';
	woocommerce_form_field('regalo', array(
	'type' => 'checkbox',
	'required'    => false,
	'class' => array(
	'my-field-class regalo'
	) ,
	'label' => __('Es un regalo') ,
	) ,
	$checkout->get_value('regalo'));
	echo '</div>';
	echo '<div id="mail-remitente" style="display:none">';
	woocommerce_form_field('remitente', array(
	'type' => 'email',
	'required'    => false,
	'class' => array(
	'my-field-class remitente'
	) ,
	'label' => __('Email de remitente') ,
	) ,
	$checkout->get_value('remitente'));
	echo '</div>';
	?>
	<script>
	jQuery(function($){
		$('input[name="regalo"]:checkbox').on('change', function(){
		  this.value = this.checked ? 1 : 0;
		  if(this.value == 1){
			$('#mail-remitente').show();
		  }else{
			$('#mail-remitente').hide();
		  }
		}).change();
	});
	</script>
	<?PHP
}
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
	if ( ! empty( $_POST['regalo'] ) ) {
		update_post_meta( $order_id, 'regalo', sanitize_text_field( $_POST['regalo'] ) );
	}
	if ( ! empty( $_POST['remitente'] ) ) {
		update_post_meta( $order_id, 'remitente', sanitize_text_field( $_POST['remitente'] ) );
	}
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('regalo').':</strong> ' . get_post_meta( $order->get_id(), 'regalo', true ) . '</p>';
	echo '<p><strong>'.__('Remitente').':</strong> ' . get_post_meta( $order->get_id(), 'remitente', true ) . '</p>';
}
*/
add_filter( 'woocommerce_form_field' , 'elex_remove_checkout_optional_text', 10, 4 );
function elex_remove_checkout_optional_text( $field, $key, $args, $value ) {
	if( is_checkout() && ! is_wc_endpoint_url() ) {
		$optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
		$field = str_replace( $optional, '', $field );
	}
	return $field;
}
/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query( $q ) {
	$tax_query = (array) $q->get( 'tax_query' );
	$tax_query[] = array(
		'taxonomy' => 'product_cat',
		'field' => 'slug',
		   'terms' => array( 'planos' ), // Don't display products in the planos category on the shop page.
		   'operator' => 'NOT IN'
		 );
	$q->set( 'tax_query', $tax_query );
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );
//require_once( trailingslashit( get_template_directory() ) . 'woocommerce/loop_product_thumbnail.php' );
// code to add to posts// the content - Adiciona banner aos posts
function prefix_insert_post_ads( $content ) {
	if (function_exists ('the_ad_group')) {
		$ad_code = get_ad_group(1220);
	
		if ( is_single() && !is_admin() && !is_product()) {
			global $post;
			$hide = get_post_meta($post->ID, 'esconder_', true);
			if($hide == false){
				return prefix_insert_after_paragraph($ad_code, $content);
			}
		}
	}
	return $content;
}
// Add banner to content
add_filter( 'the_content', 'prefix_insert_post_ads' );
// Parent Function that makes the magic happen
function prefix_insert_after_paragraph( $insertion, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	
	// $idx = 0;
	// foreach ($insertion as $banner){
	foreach($paragraphs as $index => $paragraph) {
		if( trim ( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}
		
			// show only on big texts
		if ( $index == intval(count($paragraphs)/2 - 4)){ 
			if( intval(count($paragraphs)/2) - 4 > 0){
				$idx = $index + 3;
			}else{
				$idx = $index;
			}
			$paragraphs[$idx] .= $insertion;
		}
	}
	// }
	return implode( '', $paragraphs );
}


// New checkout field -> choose a book

add_action('woocommerce_after_order_notes', 'custom_checkout_field');

function custom_checkout_field($checkout){

	echo '<div id="prod_818" class="product_plano" style="display:none"><h2>' . __('livro de presente') . '</h2>';
	woocommerce_form_field('livro', array(
		'type' => 'select',
		'class' => array(
			'my-field-class form-row-wide'
		) ,
		'label' => __('Escolha um livro') ,
		'options' => array(
			'nenhum' => 'Nenhum',
			'abc_do_socialismo' => 'ABC do socialismo',
			'quatro_futuros' => 'Quatro futuros: a vida após o capitalismo',
			'construindo_a_comuna' => 'Construindo a Comuna: democracia radical na Venezuela',
			'um_planeta_a_conquistar' => 'Um planeta a conquistar: a urgência de um Green New Deal',
			'dando_uma_de-puta' => 'Dando uma de puta: a luta de classes das profissionais do sexo'
		)
	) ,
	$checkout->get_value('livro'));
	echo '</div>';
}

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
	if ( ! empty( $_POST['livro'] ) ) {
		//wc_add_notice( __( 'Livro is ok.' ), 'error' );
		update_post_meta( $order_id, 'livro', sanitize_text_field( $_POST['livro'] ) );
	}else{
		//wc_add_notice( __( 'Livro is not ok.' ), 'error' );
	}
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('Livro').': </strong> ' . get_post_meta( $order->get_id(), 'livro', true ) . '</p>';
}

/*
add_action( 'wp_footer', 'bbloomer_add_jscript_checkout', 9999 );


function bbloomer_add_jscript_checkout() {
	global $wp;
	if ( is_checkout() ) {
		echo "<script>function datos_suscrip(catid){
			$('.product_plano').hide();
			$('#prod_'+catid).show();
		}</script>";
	}
}
*/
function dcms_agregar_nueva_zona_widgets() {

	register_sidebar( array(
		'name'          => 'Pre Footer',
		'id'            => 'prefooter',
		'description'   => 'Zona antes del footer para donación',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'dcms_agregar_nueva_zona_widgets' );



// disable stylesheet (example)
/*
function shapeSpace_disable_scripts_styles() {
	wp_dequeue_style('ywcds_frontend');
}
add_action('wp_enqueue_scripts', 'shapeSpace_disable_scripts_styles', 100);
*/

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
  array_pop($excerpt);
  $excerpt = implode(" ",$excerpt).'...';
  } else {
  $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}