

<?php
// Get layout set in Customizer and override if post has its own layout selected via meta box
$layout_post = apply_filters( 'ct_mission_news_layout_filter', get_theme_mod( 'layout_posts' ) );
$layout_page = apply_filters( 'ct_mission_news_layout_filter', get_theme_mod( 'layout_pages' ) );
$layout_archives = get_theme_mod( 'layout_archives' );
$layout_blog = get_theme_mod( 'layout_blog' );
$layout_search = get_theme_mod( 'layout_search' );
$layout_bbpress = get_theme_mod( 'layout_bbpress' );
$layout_woocommerce = get_theme_mod( 'layout_woocommerce' );
$layout_woocommerce_cat = get_theme_mod( 'layout_woocommerce_cat' );

if ( !function_exists('is_bbpress') ) {
	function is_bbpress() {
			return false;
	}
}
if ( !function_exists('is_product') ) {
	function is_product() {
			return false;
	}
	function is_product_category() {
		return false;
	}
	function is_shop() {
		return false;
	}
}
if (
	// Posts 
	(is_singular('post') && ($layout_post == 'left-sidebar' || $layout_post == 'left-sidebar-wide' || $layout_post == 'no-sidebar' || $layout_post == 'no-sidebar-wide' || $layout_post == 'no-sidebar-full-width') && !is_bbpress())
	// Pages
	|| (is_singular('page') && ($layout_page == 'left-sidebar' || $layout_page == 'left-sidebar-wide' || $layout_page == 'no-sidebar' || $layout_page == 'no-sidebar-wide' || $layout_page == 'no-sidebar-full-width') && !is_bbpress())
	// Archives
	|| (is_archive() && ($layout_archives == 'left-sidebar' || $layout_archives == 'left-sidebar-wide' || $layout_archives == 'no-sidebar' || $layout_archives == 'no-sidebar-wide' || $layout_archives == 'no-sidebar-full-width') && !is_bbpress() && !is_product_category() && !is_shop() )
	
	// Blog
	|| (is_home() && ($layout_blog == 'left-sidebar' || $layout_blog == 'left-sidebar-wide' || $layout_blog == 'no-sidebar' || $layout_blog == 'no-sidebar-wide' || $layout_blog == 'no-sidebar-full-width'))
	// Search Results
	|| (is_search() && ($layout_search == 'left-sidebar' || $layout_search == 'left-sidebar-wide' || $layout_search == 'no-sidebar' || $layout_search == 'no-sidebar-wide' || $layout_search == 'no-sidebar-full-width'))
	// bbPress
	|| (is_bbpress() && ($layout_bbpress == 'left-sidebar' || $layout_bbpress == 'left-sidebar-wide' || $layout_bbpress == 'no-sidebar' || $layout_bbpress == 'no-sidebar-wide' || $layout_bbpress == 'no-sidebar-full-width'))
	// WooCommerce - Product
	|| (is_product() && ($layout_woocommerce == 'left-sidebar' || $layout_woocommerce == 'left-sidebar-wide' || $layout_woocommerce == 'no-sidebar' || $layout_woocommerce == 'no-sidebar-wide' || $layout_woocommerce == 'no-sidebar-full-width'))
	// WooCommerce - Category
	|| ( ( is_product_category() || is_shop() ) && ($layout_woocommerce_cat == 'left-sidebar' || $layout_woocommerce_cat == 'left-sidebar-wide' || $layout_woocommerce_cat == 'no-sidebar' || $layout_woocommerce_cat == 'no-sidebar-wide' || $layout_woocommerce_cat == 'no-sidebar-full-width'))
	) {
			return;
}
if ( function_exists( 'is_woocommerce' ) ) {
	if ( is_cart() || is_checkout() || is_account_page() ) {
			return;
	}
}
if ( is_active_sidebar( 'right' ) ) : ?>
	<aside class="sidebar sidebar-right" id="sidebar-right" role="complementary">
	        <!-- ?php get_search_form(); ? -->
		<div class="inner">
			<?php dynamic_sidebar( 'right' ); ?>
		</div>
	</aside>
<?php endif;