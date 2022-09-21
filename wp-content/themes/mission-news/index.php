<?php get_header();


get_template_part( 'content/archive-header' );
if ( is_front_page() ) { 
?>

<div id="loop-container" class="loop-container"> 

<?php // The Query | 8 in the left sidebar (sidebar-left.php) just to save published in "publicados" and avoid repetitions

wp_reset_query();
$the_query = new WP_Query( 
	array( 
		'post_type' => 'post',
		'posts_per_page' => 8,
		'category__not_in' => array( 1175 ),
		'offset' => 5,
		'order' => 'DESC')
);
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {  
		$the_query->the_post();
		$publicados[] = $post->ID;
	}
}
/*
echo '<div class="testing" style="display:none"><pre> ';
print_r($publicados);
echo '</pre></div>';
*/
// The Query | Main
wp_reset_query();
$the_query = new WP_Query( 
	array( 
		'posts_per_page' => 1,
		'category__in' => array(57),
		'category__not_in' => array( 1175 ),
		'post__not_in' => $publicados,
		'order' => 'DESC')
);

// The Loop | Main

if ( $the_query->have_posts() ) {
	echo '<div id="primer-post" class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry">';
	while ( $the_query->have_posts() ) {  
		$the_query->the_post();
		$publicados[] = $post->ID;
		$content = get_the_content();
		echo '<article class="content-archive uno">'; ?> 
		<?php ct_mission_news_featured_image(); ?>
		<div class="post-content"><?php echo excerpt(50); ?></div>
		<div class="post-header">
			<?php ct_mission_news_post_byline( $author, $date ); ?>
			<h2 class='post-title'>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			</h2> 
			<div class="post-content2"><?php echo excerpt(50); ?></div>

		</div>
		

		<div style="clear:both;float:none;"></div> 
	</article> 
<?php  }  
wp_reset_postdata();
wp_reset_query();
?> 

</div>
<?php } ?> 

<?php 
// 4 following main
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 4,
	'post__not_in' => $publicados,
	'category__not_in' => array( 1175 ),
	'order' => 'DESC'
);
/*
echo '<br><pre>';
print_r($args);
echo '</pre>';
*/
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	
	while ( $the_query->have_posts() ) {
		echo '<div class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry">';
		$the_query->the_post();
		$publicados[] = $post->ID;
		$content = get_the_content();
		?>
		<article class="content-archive dos">
			<?php ct_mission_news_featured_image(); ?>
			<div class="post-header">
				<h2 class='post-title'>
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h2>
				<?php ct_mission_news_post_byline( $author, $date ); ?>
				<div class="post-content"><?php echo excerpt(40); ?></div>
			</div>
		</article>  
	</div>
	<?php 
} /* Restore original Post Data   */
wp_reset_postdata();
}
?> 

</div> 
</section> 
<div style="clear:both;float:none;"></div> 

<?php //if(function_exists('get_ad')) echo get_ad(15571); // Banner Revista ?>

<?php $other_page = 17626;

// TEST PARA COMENZAR A TRAER LOS DATOS DE LA NOTA PPAL
/*
$the_slug = the_field('link_para_a_nota_principal', $other_page);
$args = array(
  'name'        => $the_slug,
  'post_type'   => 'post',
  'post_status' => 'publish',
  'numberposts' => 1
);
$revi_post = new WP_Query( $args );
while ( $revi_post->have_posts() ) {
    $revi_post->the_post();
   	$revi_tit = get_the_title();
}
wp_reset_postdata();
*/
?>

<section class="aviso-revista">
	<div class="revista" style="">
		<div class="numerorevista" style=""><span class="numero" style="text-transform: uppercase;">Nova edição!</span><span class="temporada" style=""><?php the_field('nome_da_edicao', $other_page); ?></span><div style="clear:both;float:none;"></div> </div>
		<div class="titulorevista" style="">
			<h1 class=""><a href="/revista/"  style=""><?php the_field('titulo_da_revista', $other_page); ?></a></h1></div> 
			<a href="/revista/"><img src="/wp-content/uploads/<?php the_field('foto_mockup_revista', $other_page); ?>"></a>
		</div>
		<div class="notarevista" style="">
			<a href="<?php the_field('link_para_a_nota_principal', $other_page); ?>" style="width: 96%;
max-width: 960px;
margin: 0 auto;"><img src="/wp-content/uploads/<?php the_field('foto_da_nota_principal', $other_page); ?>" style="width: 100%;
height: auto;"></a>
			<div class="notarevista-contenido"  style="">
				<span class="subtitulo"  style="">NESSA EDIÇÃO</span>
				<h2 class="aviso-revista"><a href="<?php the_field('link_para_a_nota_principal', $other_page); ?>"><?php the_field('titulo_da_nota_principal', $other_page); ?></a></h2><br>
				<span class="fecha"><?php the_field('fecha_da_nota_principal', $other_page); ?></span><br><br>
				<span class="autor"><a href="<?php the_field('link_para_a_nota_principal', $other_page); ?>" style=""><?php the_field('autor_da_nota_principal', $other_page); ?></a></span><br><br>
				<p style=""><?php the_field('linha_fina_da_nota_principal', $other_page); ?></p>
			</div>
			<div class="cierre" style=""><span class="temporada" style=""><a href="/assine/" style="">ASSINAR</a></span><span class="temporada" style="float:left;"><a href="/<?php the_field('link_revista_na_loja', $other_page); ?>" style="">COMPRAR</a></span>
				<div style="clear:both;float:none;"></div>
			</div>
		</div>
	</section>
	<div style="clear:both;float:none;"></div> 



<?php if(function_exists('get_ad')) echo get_ad(15573); // Planos?>

<section id="main2" class="main" role="main">
	<div id="loop-container2" class="loop-container">


		
		<?php if(function_exists('get_ad')) echo get_ad(15572); // Social Networks ?>


		<?php


		wp_reset_postdata();
		wp_reset_query();
// The Query
		$args = array( 
		'posts_per_page' => 1,
		'category__not_in' => array( 1175 ),
		'post__not_in' => $publicados,
		'order' => 'DESC',
		'category__in' => array(273)
	);
		$the_query = new WP_Query( $args );
		//echo $the_query->request;
// The Loop
		if ( $the_query->have_posts() ) {
			echo '<div id="destacada-footer" class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$publicados[] = $post->ID;
				$content = get_the_content();
				echo '<article class="content-archive tres">';?>

				<div class="post-header">

					<h2 class='post-title'>
						<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
					</h2>
					<?php ct_mission_news_post_byline( $author, $date ); ?>
					<div class="post-content"><?php echo excerpt(260); ?></div>

				</div>
				<div class="bloque-imagen">
					<?php ct_mission_news_featured_image(); ?>
				</div>
			<?php echo '</article>';?>
		</div>
		<?php } 
		wp_reset_postdata();?> 

	<?php }?> 


	<?php
 // The Query
	$the_query = new WP_Query( array( 
		'posts_per_page' => 4,
		'category__not_in' => array( 1175,1170 ),
		'post__not_in' => $publicados,
		'order' => 'DESC') 
	);
// The Loop
	if ( $the_query->have_posts() ) {

		while ( $the_query->have_posts() ) {
			echo '<div class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry cuatro">';
			$the_query->the_post();
			$publicados[] = $post->ID;
			$content = get_the_content();
			echo '<article class="content-archive cuatro">';?>

			<div class="post-header">

				<h2 class='post-title'>
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h2>
				<?php ct_mission_news_post_byline( $author, $date ); ?>
				<div class="post-content"><?php echo excerpt(40); ?></div>

			</div>
			<?php ct_mission_news_featured_image(); ?>
		<?php echo '</article>
		</div>
		';
	} 
	/* Restore original Post Data   */
	wp_reset_postdata();?> 


<?php } ?> 




<div id="loop-container3" class="loop-container"> 



	<?php
 // The Query
	$the_query = new WP_Query( array( 'posts_per_page' => 8, 'category__not_in' => array( 1175 ), 'post__not_in' => $publicados, 'order'   => 'DESC') );
// The Loop
	if ( $the_query->have_posts() ) {

		while ( $the_query->have_posts() ) {
			echo '<div class="post post-item type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry ">';
			$the_query->the_post();
			$publicados[] = $post->ID;
			$content = get_the_content();
			echo '<article class="content-archive cinco">';?>
			<div class="post-header">
				<?php ct_mission_news_post_byline( 'no', $date ); ?>
				<h2 class='post-title'>
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h2> </div>
			</article>  </div>
			<?php 	
		} 
		wp_reset_postdata();?> 


	<?php } ?> 
	<div style="clear:both;float:none;"></div> 


	<?php if(function_exists('get_ad')) echo get_ad(15574); // apoie-nos assine?>


	<?php
 // The Query
	$the_query = new WP_Query( array( 'posts_per_page' => 4, 'category__not_in' => array( 1175 ), 'post__not_in' => $publicados, 'order'   => 'DESC') );
// The Loop
	if ( $the_query->have_posts() ) {
		$contador = 0;
		while ( $the_query->have_posts() ) {
			echo '<div class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry">';
			$the_query->the_post();
			$publicados[] = $post->ID;
			$content = get_the_content();
			echo '<article class="content-archive seis">';?>
			<?php if ($contador%2==0) {  ct_mission_news_featured_image(); } ?>
			<div class="post-header">

				<h2 class='post-title'>
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h2>
				<?php ct_mission_news_post_byline( $author, $date ); ?>
				<div class="post-content"><?php echo excerpt(35); ?></div>

			</div>
			<?php if ($contador%2!=0) {  ct_mission_news_featured_image(); } ?>

		</article> 		<div style="clear:both;float:none;"></div> </div>
		<?php 	
		$contador++;
	} 
	/* Restore original Post Data   */
	wp_reset_postdata();
	?> 


<?php } ?> 


<div style="clear:both;float:none;"></div> 


<div id="loop-container4" class="loop-container">
	<?php 	
	// The Query 
	$the_query = new WP_Query( array( 'posts_per_page' => 1, 'category__not_in' => array( 1175 ), 'post__not_in' => $publicados, 'order'   => 'DESC') );

// The Loop

	if ( $the_query->have_posts() ) {
		echo '<div id="primer-post3" class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry">'; 
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$publicados[] = $post->ID; 
			$content = get_the_content();
			echo '<article class="content-archive siete">'; ?> 
			<div class="post-header">
				<?php ct_mission_news_post_byline( $author, $date ); ?>
				<h2 class='post-title'>
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h2> 


			</div>
			<div class="post-content"><?php echo excerpt(120); ?></div>
			<div style="clear:both;float:none;"></div> 
			<?php ct_mission_news_featured_image(); ?>


		</article> 

	<?php }
	wp_reset_postdata();
}  ?> 


</div>




<?php

 // The Query
$the_query = new WP_Query( array( 'posts_per_page' => 8, 'category__not_in' => array( 1175 ), 'post__not_in' => $publicados, 'order'   => 'DESC') );
// The Loop
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
		echo '<div class="post post-item type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry ">';
		$the_query->the_post();
		$publicados[] = $post->ID;
		$content = get_the_content();
		echo '<article class="content-archive ocho">';?>
		<div class="post-header">
			<?php ct_mission_news_post_byline( 'no', $date ); ?>
			<h2 class='post-title'>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			</h2> </div>
		</article>  </div>
		<?php 	
	} 
	wp_reset_postdata();?> 


<?php } ?> 
<div style="clear:both;float:none;"></div> 
<!-- /div --> 




<?php
} else { ?>

	<div id="loop-container5" class="loop-container mil">

		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				ct_mission_news_get_content_template();
			endwhile;
		endif;
		wp_reset_query(); 
		?>

		<?php the_posts_pagination();

// No need to output two search forms if no results
		if ( isset($total_results) ) { ?>
	<!--- div class="search-box bottom">
		<p><?php esc_html_e( "Can't find what you're looking for?  Try refining your search:", "mission-news" ); ?></p>
		<?php get_search_form(); ?>
	</div -->
<?php }  ?>


</div> 

<?php

}


?>

<?php // Output pagination if Jetpack not installed, otherwise check if infinite scroll is active before outputting
/* if ( !class_exists( 'Jetpack' ) ) {
	the_posts_pagination( array(
		'mid_size' => 1
	) );
} elseif ( !Jetpack::is_module_active( 'infinite-scroll' ) ) {
	the_posts_pagination( array(
		'mid_size' => 1
	) );
} */
get_footer();