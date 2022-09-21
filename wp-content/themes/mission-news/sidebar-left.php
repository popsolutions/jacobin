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
$publicados = array();

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
    (is_singular('post') && ($layout_post == 'right-sidebar' || $layout_post == 'right-sidebar-wide' || $layout_post == 'no-sidebar' || $layout_post == 'no-sidebar-wide' || $layout_post == 'no-sidebar-full-width') && !is_bbpress())
    // Pages
    || (is_singular('page') && ($layout_page == 'right-sidebar' || $layout_page == 'right-sidebar-wide' || $layout_page == 'no-sidebar' || $layout_page == 'no-sidebar-wide' || $layout_page == 'no-sidebar-full-width') && !is_bbpress())
    // Archives
    || (is_archive() && ($layout_archives == 'right-sidebar' || $layout_archives == 'right-sidebar-wide' || $layout_archives == 'no-sidebar' || $layout_archives == 'no-sidebar-wide' || $layout_archives == 'no-sidebar-full-width') && !is_bbpress() && !is_product_category() && !is_shop() )
    // Blog
    || (is_home() && ($layout_blog == 'right-sidebar' || $layout_blog == 'right-sidebar-wide' || $layout_blog == 'no-sidebar' || $layout_blog == 'no-sidebar-wide' || $layout_blog == 'no-sidebar-full-width'))
    // Search Results
    || (is_search() && ($layout_search == 'right-sidebar' || $layout_search == 'right-sidebar-wide' || $layout_search == 'no-sidebar' || $layout_search == 'no-sidebar-wide' || $layout_search == 'no-sidebar-full-width'))
    // bbPress
    || (is_bbpress() && ($layout_bbpress == 'right-sidebar' || $layout_bbpress == 'right-sidebar-wide' || $layout_bbpress == 'no-sidebar' || $layout_bbpress == 'no-sidebar-wide' || $layout_bbpress == 'no-sidebar-full-width'))
    // WooCommerce - Product
    || (is_product() && ($layout_woocommerce == 'right-sidebar' || $layout_woocommerce == 'right-sidebar-wide' || $layout_woocommerce == 'no-sidebar' || $layout_woocommerce == 'no-sidebar-wide' || $layout_woocommerce == 'no-sidebar-full-width'))
    // WooCommerce - Category
    || ( ( is_product_category() || is_shop() ) && ($layout_woocommerce_cat == 'right-sidebar' || $layout_woocommerce_cat == 'right-sidebar-wide' || $layout_woocommerce_cat == 'no-sidebar' || $layout_woocommerce_cat == 'no-sidebar-wide' || $layout_woocommerce_cat == 'no-sidebar-full-width'))
    ) {
        return;
}
if ( function_exists( 'is_woocommerce' ) ) {
    if ( is_cart() || is_checkout() || is_account_page() ) {
        return;
    }
}
if ( is_active_sidebar( 'left' ) ) : ?>
    <aside class="sidebar sidebar-left" id="sidebar-left" role="complementary">
        <div class="inner">

 <section id="ct_mission_news_post_list-2" class="widget widget_ct_mission_news_post_list">
 <div class="style-1">
 <ul>
 
 <?php 
// The Query
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 8,
    'category__not_in' => array( 1186 ),
	'offset' => 5,
	'order' => 'DESC'
); 
$the_query = new WP_Query( $args );
/*
echo '<div class="testing" style="display:none"><pre>';
    print_r($args);
echo '</pre></div>';
*/
// The Loop
if ( $the_query->have_posts() ) {
	
	while ( $the_query->have_posts() ) {
		echo ' <li class="post-item"> <div class="top"  style="uno" >';
		$the_query->the_post();
		$publicados[] = $post->ID;
		$content = get_the_content();
		?>
		 <div class="top-inner" style="uno" >
		 <div class="post-byline"><?php ct_mission_news_post_byline( $author, $date ); ?></div>

		      <a href="<?php echo esc_url( get_permalink() ); ?>" class="title"><?php the_title();?></a>
			</div>
		 </div></li>  

	<?php 
} /* Restore original Post Data   */
wp_reset_postdata();
}
?>  
 
 </ul></div></section>

        </div>
    </aside>
<?php endif;