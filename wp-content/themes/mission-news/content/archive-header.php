<?php

/* if ( is_page(4919) ) {
	echo 'chau';
}*/ 



if ( is_home() ) {
	echo '<h1 class="screen-reader-text">' . esc_html( get_bloginfo( "name" ) ) . '</h1>';
}

// if not archive or title & description hidden via Customizer
if ( ! is_archive() || ( get_theme_mod( 'archive_title' ) == 'no' ) && get_theme_mod( 'archive_description' ) == 'no' ) {
	return;
}

$icon_class = 'folder-open';
$prefix = esc_html_x( 'Posts published in', 'Posts published in CATEGORY', 'mission-news' );

if ( is_tag() ) {
	$icon_class = 'tag';
	$prefix = esc_html__( 'Artículos etiquetados como', 'mission-news' );
} elseif ( is_author() ) {
	$icon_class = 'user';
	$prefix = esc_html_x( 'Artículos publicados por:', 'Posts published by AUTHOR', 'mission-news' );
} elseif ( is_date() ) {
	$icon_class = 'calendar';
	// Repeating default value to add new translator note - context may change word choice
	$prefix = esc_html_x( 'Artículos publicados en', 'Posts published in MONTH', 'mission-news' );
}
?>

<div class='archive-header'>
	<?php if ( get_theme_mod( 'archive_title' ) != 'no' ) : ?>
		<?php if ( is_author() ) {
			echo '<div class="avatar-container">'. get_avatar( get_the_author_meta('ID'), 48 ) .'</div>';
		} ?>
		<h1>
			<!-- i class="fas fa-<?php echo esc_attr( $icon_class ); ?>"></i -->
			<?php
			echo esc_html( $prefix ) . ' ';
			the_archive_title( '', '' );
			?>
		</h1><p>
		<?php 
		if ( get_the_archive_description() != '' && get_theme_mod( 'archive_description' ) != 'no' ) {
			the_archive_description();
		} 
	endif; ?>
	</p>

</div>