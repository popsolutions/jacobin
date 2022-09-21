	<?php get_header();

	get_template_part( 'content/archive-header' ); 
	$publicados = array();

	?>
	<?php
	if ( is_front_page() ) { ?>

		<div id="loop-container" class="loop-container">

<?php 		// The Query 
wp_reset_query();
$the_query = new WP_Query( 
	array( 
		'posts_per_page' => 1,
		'category__in' => array(57),
		'order' => 'DESC')
); 

// The Loop

$date = 'yes';
if ( $the_query->have_posts() ) {
	echo '<div id="primer-post" class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry">';
	while ( $the_query->have_posts() ) {  
		$the_query->the_post();
		$publicados[] = $post->ID;
		$content = get_the_content();
		echo '<article class="content-archive uno">'; ?> 
		<?php ct_mission_news_featured_image(); ?>
		<div class="post-content"><?php echo ct_mission_news_excerpt(); ?></div>
		<div class="post-header">
			<?php ct_mission_news_post_byline( $author, $date ); ?>
			<h2 class='post-title'>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			</h2> 
			<div class="post-content2"><?php echo ct_mission_news_excerpt(); ?></div>

		</div>
		

		<div style="clear:both;float:none;"></div> 
	</article> 
<?php  }  
wp_reset_postdata();
?> 

</div>
<?php } ?> 

<?php 
// The Query
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 4,
	'post__not_in' => $publicados,
	'order' => 'DESC'
);
echo '<br><pre>';
print_r($args);
echo '</pre>';
$the_query = new WP_Query( $args );
echo $GLOBALS['wp_query']->request;
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
				<div class="post-content"><?php echo ct_mission_news_excerpt(); ?></div>
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

<section class="aviso-revista">
	<div class="revista" style="">
		<div class="numerorevista" style=""><span class="numero" style="">EDIÇÃO ESPECIAL </span><span class="temporada" style="">VERÃO DE 2020</span><div style="clear:both;float:none;"></div> </div>
		<div class="titulorevista" style="">
			<h1 class=""><a href="http://jacobinbr.estudiodosrios.com.ar/revista/"  style="">Derrubem este muro!</a></h1></div> 
			<a href="http://jacobinbr.estudiodosrios.com.ar/revista/"><img src="http://jacobinbr.estudiodosrios.com.ar/wp-content/uploads/2021/06/revistahome2.jpg"></a>
		</div>
		<div class="notarevista" style="">
			<a href="2020/12/todo-poderoso-demais/"><img src="http://jacobinbr.estudiodosrios.com.ar/wp-content/uploads/2021/06/imagen-nota.jpg"></a>
			<div class="notarevista-contenido"  style="">
				<span class="subtitulo"  style="">NESSA EDIÇÃO</span>
				<h2 class="aviso-revista"><a href="2020/12/todo-poderoso-demais/"  style="">Todo Poderoso (demais)</a></h2><br>
				<span class="fecha" style="">22 Dez</span><br><br>
				<span class="autor"><a href="2020/12/todo-poderoso-demais/" style="">Andre Pagliarini</a></span><br><br>
				<p style="">Silas Malafaia, pioneiro no televangelismo e um dos pastores mais rico do Brasil, encontrou no casamento entre moralismo religioso, autoritarismo e liberalismo econômico a agenda política ideal para o neopentecostalismo de sua igreja.</p>
			</div>
			<div class="cierre" style=""><span class="temporada" style=""><a href="http://jacobinbr.estudiodosrios.com.ar/suscribirse/" style="">ASSINAR</a></span>
				<div style="clear:both;float:none;"></div>
			</div>
		</div>
	</section>
	<div style="clear:both;float:none;"></div> 

<!-- section class="banner-revista">
<div>
<img src="http://jacobinbr.estudiodosrios.com.ar/wp-content/uploads/2020/09/tapaNueva2.jpg">
<span>N°1 | PRIMAVERA AUSTRAL | 2020</span>
<h1><a href="http://jacobinbr.estudiodosrios.com.ar/revista/">Capitalismo en cuarentena</a></h1>
<a href="http://jacobinbr.estudiodosrios.com.ar/revista/">Ver Adentro</a>
<div style="clear:both;float:none;"></div>
</div>

</section>
<div style="clear:both;float:none;"></div --> 

<section class="hm-sb">
	<div class="hm-sb__container">

		<header class="hm-sb__header">
			<h1 class="hm-sb__heading">
				       <a class="hm-sb__link" href="/assine">ASSINAR</a>
			</h1> 
			<p class="hm-sb__dek">Jacobino é uma voz proeminente na esquerda, oferecendo um ponto de vista socialista sobre política, economia e cultura.</p>
		</header>


		<dl class="hm-sb__medium">

			<H5> </H5><br>
			<dt class="hm-sb__price">

				<H4>Plano Internacionalista</H4>
				<a class="hm-sb__link" href="/assine">
					<span> R$ 25 </span><br>
					<span style="text-decoration:line-through;font-size:17px;"> </span>

				</a>
				<P class="hm-sb__desc">1 ANO  : 4 edições <br>impressa + ASSINATURA DIGITAL</P>
			</dt>

			<div style="clear:both;float:none;"></div>

			<dt class="hm-sb__price">

				<H4>Plano Jacobino</H4>
				<a class="hm-sb__link" href="/assine">
					<span> R$ 70 </span><br>
					<span style="text-decoration:line-through;font-size:17px;"> </span>

				</a>
				<P class="hm-sb__desc">1 ANO  : 4 edições <br>impressa + ASSINATURA DIGITAL</P>
			</dt>

			<div style="clear:both;float:none;"></div>

			<dt class="hm-sb__price">

				<H4>Plano Bolchevique</H4>
				<a class="hm-sb__link" href="/assine">
					<span> R$ 130 </span><br>
					<span style="text-decoration:line-through;font-size:17px;"> </span>

				</a>
				<P class="hm-sb__desc">1 ANO  : 4 edições <br>impressa + ASSINATURA DIGITAL + livro</P>
			</dt>

			<div style="clear:both;float:none;"></div>



		</dl>

	</div>
</section>

<section id="main2" class="main" role="main">
	<div id="loop-container2" class="loop-container">


		<section class="po-fr-sm prt-x">
			<iframe allowtransparency="true" class="po-fr-sm__likebox" frameborder="0" scrolling="no" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fjacobinbrasil&amp;width=350&amp;height=175&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=107533262637761" style="border:none; overflow:hidden; width:350px; height:175px;">
			</iframe>

			<div id="post-footer-share" class="">
				<H1 class="po-fr-sm__heading">Siga-nos</H1>
				<div class="po-fr-sm__item">
					<a class="po-fr-sm__button js-share js-social-share" href="https://www.instagram.com/jacobinbrasil/" target="_blank">
						<img style="width:32px;"  src="https://jacobin.com.br/wp-content/uploads/2019/02/instagram-2.png" width="32" height="32" > <span>Instagram</span>
					</a>
				</div>
				<div class="po-fr-sm__item">
					<a class="po-fr-sm__button js-share js-social-share" href="https://www.youtube.com/playlist?list=PLDJJqMdisvOGY3cgma80fyPGDUYL5Di1a" target="_blank">
						<img style="width:32px;"  src="https://jacobin.com.br/wp-content/uploads/2019/02/youtube-2.png" width="32" height="32" ><span>Youtube</span>
					</a>
				</div>
				<div class="po-fr-sm__item">
					<a target="_blank" href="https://twitter.com/jacobinbrasil" class="po-fr-sm__button">
						<img style="width:32px;"  src="https://jacobin.com.br/wp-content/uploads/2019/02/twitter-2.png" width="32" height="32" >
						<span>Twitter</span>
					</a>
				</div>
				<div class="po-fr-sm__item">
					<a target="_blank" href="https://open.spotify.com/show/197oyT28JwRSOqFgwXe2Ml" class="po-fr-sm__button">
						<img style="width:32px;" src="https://jacobin.com.br/wp-content/uploads/2019/02/poadcast.png" width="32" height="32" >
						<span>Podcast</span>
					</a>
				</div>

			</div>
		</section>



		<?php


		
// The Query
		$the_query = new WP_Query( array( 'posts_per_page' => 1, 'post__not_in' => array($publicados), 'order'   => 'DESC') );
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
					<div class="post-content"><?php echo ct_mission_news_excerpt(); ?></div>

				</div>
				<div class="bloque-imagen">
					<?php ct_mission_news_featured_image(); ?>
				</div>
			</article>   </div>
		<?php } 
		wp_reset_postdata();?> 

	<?php }?> 


	<?php
 // The Query
	$the_query = new WP_Query( array( 'posts_per_page' => 1, 'post__not_in' => array($publicados), 'order' => 'DESC') );
// The Loop
	if ( $the_query->have_posts() ) {

		while ( $the_query->have_posts() ) {
			echo '<div class="post type-post status-publish format-standard has-post-thumbnail hentry membership-content access-restricted entry">';
			$the_query->the_post();
			$publicados[] = $post->ID;
			$content = get_the_content();
			echo '<article class="content-archive cuatro">';?>

			<div class="post-header">

				<h2 class='post-title'>
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h2>
				<?php ct_mission_news_post_byline( $author, $date ); ?>
				<div class="post-content"><?php echo ct_mission_news_excerpt(); ?></div>

			</div>
			<?php ct_mission_news_featured_image(); ?>
		</article>  </div>
		<?php 	

	} 
	/* Restore original Post Data   */
	wp_reset_postdata();?> 


<?php } ?> 




<div id="loop-container3" class="loop-container"> 



	<?php
 // The Query
	$the_query = new WP_Query( array( 'posts_per_page' => 8, 'post__not_in' => array($publicados), 'order'   => 'DESC') );
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


	<section class="bloque-separador">
		<p>"O surgimento da revista Jacobin tem sido uma luz em tempos obscuros. Uma contribuição
			realmente impressionante à sanidade -- e à esperança." NOAM CHOMSKY, UM CARA MUITO INTELIGENTE. <a href="/suscribirse">APOIE-NOS TAMBÉM</a></p>
		</section>


		<?php
 // The Query
		$the_query = new WP_Query( array( 'posts_per_page' => 4, 'post__not_in' => array($publicados), 'order'   => 'DESC') );
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
					<div class="post-content"><?php echo ct_mission_news_excerpt(); ?></div>

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


	<div id="loop-container3" class="loop-container">
		<?php 	
	// The Query 
		$the_query = new WP_Query( array( 'posts_per_page' => 1, 'post__not_in' => array($publicados), 'order'   => 'DESC') );

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
				<div class="post-content"><?php echo ct_mission_news_excerpt(); ?></div>
				<div style="clear:both;float:none;"></div> 
				<?php ct_mission_news_featured_image(); ?>


			</article> 

			<?php }
			wp_reset_postdata();
			 }  ?> 


		</div>




		<?php

 // The Query
		$the_query = new WP_Query( array( 'posts_per_page' => 8, 'post__not_in' => array($publicados), 'order'   => 'DESC') );
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

		<div id="loop-container" class="loop-container mil">

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