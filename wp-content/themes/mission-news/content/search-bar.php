<?php
if ( get_theme_mod( 'search' ) == 'no' ) {
	return;
}
?>
<button id="search-toggle" class="search-toggle"><svg viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg" class="si-hr-nv__icon si-hr-nv__icon--archive"><title>Search Icon</title> <circle cx="24.79" cy="15.21" r="9.3"></circle> <line x1="18.28" x2="5.4" y1="21.72" y2="34.6"></line></svg><span><?php echo esc_html__( 'Buscar', 'mission-news' );?></span></button>
<div id="search-form-popup" class="search-form-popup">
	<div class="inner">
		<div class="title"><?php echo esc_html__( 'Buscar', 'mission-news' ) . ' ' . esc_html( get_bloginfo('name') ); ?></div>
		<?php get_search_form(); ?>
		<a id="close-search" class="close" href="#" style="width:24px;"><?php echo ct_mission_news_svg_output( 'close' ); ?></a>

			<?php dynamic_sidebar( 'buscador' ); ?>

	
	</div>
</div>
