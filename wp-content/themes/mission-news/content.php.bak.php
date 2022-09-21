<?php
$author = get_theme_mod( 'post_author_posts' );
$date   = get_theme_mod( 'post_date_posts' );


?>
<div <?php post_class(); ?>>
	<?php do_action( 'ct_mission_news_post_before' ); ?>
	<!-- ul class="encabezado-post">
	<li class="fecha"--><!-- ?php ct_mission_news_post_byline( 'no', $date ); ? --><!-- /li>
							


	<li class="pais">Argentina</li>
	<li class="categoria">Politica</li>
	<li class="redes"><ul id="post-header-share" class="po-hr-fl__sharing sm"><li class="po-hr-fl__item sm__item"><a data-js="facebook-share" data-text="When Fascism Almost Came to Australia" data-url="https://jacobinmag.com/2020/08/fascism-australia-old-guard-anticommunism" role="button" tabindex="0" class="po-hr-fl__button sm__button"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="po-hr-fl__icon"><title>Facebook Icon</title> <path d="M63.7,87.5H36.3A23.75,23.75,0,0,1,12.6,63.8V36.4A23.75,23.75,0,0,1,36.3,12.7H63.6A23.75,23.75,0,0,1,87.3,36.4V63.7A23.69,23.69,0,0,1,63.7,87.5Z"></path> <path d="M40.2,87.5V61h-7V49.2h7V42c0-9.7,4-15.4,15.3-15.4h9.4V38.4H59c-4.5,0-4.7,1.6-4.7,4.7V49H64.9L63.6,60.8H54.2V87.4l-14,.1Z"></path></svg></a></li> <li class="po-hr-fl__item sm__item"><a data-js="twitter-share" data-text="When Fascism Almost Came to Australia" data-url="https://jacobinmag.com/2020/08/fascism-australia-old-guard-anticommunism" role="button" tabindex="0" class="po-hr-fl__button sm__button"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="po-hr-fl__icon"><title>Twitter Icon</title> <path d="M61.7,19.5a15.9,15.9,0,0,0-10.8,16l.2,2.7-2.8-.3A45.6,45.6,0,0,1,21.9,25l-3.7-3.6-.9,2.7a16,16,0,0,0,3.4,16.4c2.2,2.3,1.7,2.7-2.1,1.3a5.83,5.83,0,0,0-2.6-.6c-.4.4,1,5.4,2,7.4a18,18,0,0,0,7.6,7.1L28.3,57H25.1c-3.1,0-3.2.1-2.9,1.2,1.1,3.6,5.5,7.4,10.4,9.1L36,68.4l-3,1.8a30.84,30.84,0,0,1-14.9,4.1,17.91,17.91,0,0,0-4.6.4c0,.6,6.7,3.7,10.7,4.9a46.91,46.91,0,0,0,36.3-4.1C68,71.1,75.5,62.4,79,54c1.9-4.5,3.8-12.7,3.8-16.6,0-2.5.2-2.9,3.3-5.9A32.19,32.19,0,0,0,90,27.2c.6-1,.5-1-2.3-.1-4.7,1.7-5.4,1.4-3.1-1,1.7-1.8,3.8-5,3.8-5.9,0-.2-.8.1-1.8.6a29.21,29.21,0,0,1-4.9,1.9l-3,.9-2.6-1.9a20.84,20.84,0,0,0-4.7-2.4A18.78,18.78,0,0,0,61.7,19.5Z"></path></svg></a></li> <li class="po-hr-fl__item sm__item"><a href="mailto:?subject=When Fascism Almost Came to Australia&amp;body=https://jacobinmag.com/2020/08/fascism-australia-old-guard-anticommunism" class="po-hr-fl__button sm__button"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="po-hr-fl__icon"><title>Email Icon</title> <rect height="51" width="73" x="13.5" y="25.5"></rect> <polyline points="13.5 25.5 50 55.8 86.5 25.5"></polyline> <line x1="13.5" x2="38.6" y1="76.5" y2="46.3"></line> <line x1="86.5" x2="61.4" y1="76.5" y2="46.3"></line></svg></a></li> <li class="po-hr-fl__item"><a role="button" tabindex="0" class="po-hr-fl__button"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="po-hr-fl__icon"><title>Print Icon</title> <polyline points="32.2 41.2 32.2 23.4 67.8 23.4 67.8 41.2"></polyline> <rect height="26.8" width="35.7" x="32.2" y="54.6"></rect> <path d="M67.8,72.4H81.2A4.53,4.53,0,0,0,85.7,68V45.7a4.48,4.48,0,0,0-4.5-4.5H18.8a4.48,4.48,0,0,0-4.5,4.5V68a4.48,4.48,0,0,0,4.5,4.5H32.2"></path></svg></a></li></ul></li>
		</ul -->
	<article class"normal">
		<?php ct_mission_news_featured_image(); ?>
		<div class='post-header'  style="cinco" >
			<?php ct_mission_news_post_byline( $author, $date ); ?>
			<h1 class='post-title'><?php the_title(); ?></h1> 
			<p class='post-excerpt'><?php $value = get_field( "copete" );
			echo $value;?>
			</p>
		</div>
		<div style="float:none;clear:both;"></div>













		<?PHP if ( is_active_sidebar( 'nota-left' ) ) : ?>
    <aside class="sidebar sidebar-left" id="sidebar-nota-left" role="complementary">
        <div class="inner">
            <?php dynamic_sidebar( 'nota-left' ); ?>
        </div>
    </aside>
<?php endif;?>
<?PHP //if ( is_active_sidebar( 'nota-right' ) ) : ?>
    <aside class="sidebar sidebar-right" id="sidebar-nota-right" role="complementary">
        <div class="inner">



	<?php // Relacionadas
		$orig_post = $post;
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'posts_per_page'=>4, // Number of related posts that will be shown.
		'ignore_sticky_posts'=>1,
		'orderby'=>'date',
		'order'=>'DESC'
		);
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {

		//echo '<div id="relatedposts">';
		//echo '<h3>Notas Relacionadas</h3>';
		echo '<ul>';

		while( $my_query->have_posts() ) {
		$my_query->the_post(); ?>
		<?PHP add_image_size( 'single-feature', 300, 300, true );?>
		<li>
			<!--<div class="relatedthumb">-->
				<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
		<?php //the_post_thumbnail('single-feature'); ?>
				</a>
				<!--</div>-->
		<div class="relatedcontent">
		<h3><a href="<?php the_permalink()?>" class="rel-link" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<?php //the_time('M j, Y') ?>
		
		</a>
		<span class="autor">
			<?php the_author_posts_link();?>
		</span>
		</div>
		</li>
		<?php }
		echo '</ul></div>';
		}
		}
		$post = $orig_post;
		wp_reset_query();
		?>



            <?php dynamic_sidebar( 'nota-right' ); ?>
        </div>
    </aside>
<?php //endif;?>










		<div class="post-content">
		<?php ct_mission_news_output_last_updated_date(); ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array(
				'before' => '<p class="singular-pagination">' . esc_html__( 'Pages:', 'mission-news' ),
				'after'  => '</p>',
			) ); ?>
			<?php do_action( 'ct_mission_news_post_after' ); ?>
				<figure class="po-fr__endmark prt-x">
    
    <svg class="po-fr__image" viewBox="0 0 512 458" xmlns="http://www.w3.org/2000/svg">
  <title>Cierre</title>
  <polygon points="0 444 512 0 512 14 0 458 0 444"></polygon>
</svg>
  </figure>

		<section class="po-fr-sm prt-x">
    <iframe allowtransparency="true" class="po-fr-sm__likebox" frameborder="0" scrolling="no" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fjacobinlat&amp;width=250&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=107533262637761" style="border:none; overflow:hidden; width:250px; height:215px;">
    </iframe>

    <dl id="post-footer-share" class="po-fr-sm__sharing"><dt class="po-fr-sm__heading">Compartir este artículo</dt> <dd class="po-fr-sm__item"><a data-js="facebook-share" data-text="<?php the_title();?>" data-url="<?php esc_url( the_permalink() ); ?>" role="link" tabindex="0" class="po-fr-sm__button js-share"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="po-fr-sm__icon"><title>Compartir en Facebook</title> <path d="M63.9,14.5H36.1A21.85,21.85,0,0,0,14.3,36.3V64A21.85,21.85,0,0,0,36.1,85.8h4.6V60.5H34V49.2h6.7V42.4c0-9.2,3.8-14.7,14.6-14.7h8.9V39H58.6c-4.3,0-4.5,1.6-4.5,4.5v5.6H64.2L63,60.4H54V85.7h9.9A21.85,21.85,0,0,0,85.7,63.9V36.2A21.77,21.77,0,0,0,63.9,14.5Z"></path></svg> <span>Facebook</span></a></dd> <dd class="po-fr-sm__item"><a data-js="twitter-share" data-text="<?php the_title();?>" data-url="<?php esc_url( the_permalink() ); ?>" role="link" tabindex="0" class="po-fr-sm__button js-share"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="po-fr-sm__icon"><title>Compartir en Twitter</title> <path d="M61.7,19.5a15.9,15.9,0,0,0-10.8,16l.2,2.7-2.8-.3A45.6,45.6,0,0,1,21.9,25l-3.7-3.6-.9,2.7a16,16,0,0,0,3.4,16.4c2.2,2.3,1.7,2.7-2.1,1.3a5.83,5.83,0,0,0-2.6-.6c-.4.4,1,5.4,2,7.4a18,18,0,0,0,7.6,7.1L28.3,57H25.1c-3.1,0-3.2.1-2.9,1.2,1.1,3.6,5.5,7.4,10.4,9.1L36,68.4l-3,1.8a30.84,30.84,0,0,1-14.9,4.1,17.91,17.91,0,0,0-4.6.4c0,.6,6.7,3.7,10.7,4.9a46.91,46.91,0,0,0,36.3-4.1C68,71.1,75.5,62.4,79,54c1.9-4.5,3.8-12.7,3.8-16.6,0-2.5.2-2.9,3.3-5.9A32.19,32.19,0,0,0,90,27.2c.6-1,.5-1-2.3-.1-4.7,1.7-5.4,1.4-3.1-1,1.7-1.8,3.8-5,3.8-5.9,0-.2-.8.1-1.8.6a29.21,29.21,0,0,1-4.9,1.9l-3,.9-2.6-1.9a20.84,20.84,0,0,0-4.7-2.4A18.78,18.78,0,0,0,61.7,19.5Z"></path></svg> <span>Twitter</span></a></dd> <dd class="po-fr-sm__item"><a href="mailto:?subject=<?php the_title();?>&amp;body=Te ecomiendo esta nota de <a href='https://jacobinlat.com'>Jacobin</a> -> <?php esc_url( the_permalink() ); ?>" class="po-fr-sm__button"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="po-fr-sm__icon"><title>Compartir vía Email</title> <polygon points="50 52.9 15.7 24.3 84.3 24.3 50 52.9"></polygon> <polygon points="32.7 45.9 10.6 72.6 10.6 27.6 32.7 45.9"></polygon> <path d="M37.1,49.6l11,9.2a2.93,2.93,0,0,0,3.8,0l11-9.2L86.2,77.7H13.8Z"></path> <polygon points="67.3 45.9 89.4 27.6 89.4 72.6 67.3 45.9"></polygon></svg> <span>Email</span></a></dd></dl>

</section>



  		</div>
		  	<?php get_template_part( 'content/post-author' ); ?>
		<div class="post-meta">
			
			<?php get_template_part( 'content/more-from-category' ); ?>
			<?php get_template_part( 'content/post-tags' ); ?>
			<?php get_sidebar( 'after-post' ); ?>
			<?php get_template_part( 'content/post-author' ); ?>
		</div>
		
<?php get_template_part( 'content/post-categories' ); ?>
	
	</article>

	

	<?php comments_template(); ?> 
</div>