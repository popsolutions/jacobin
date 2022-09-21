<div <?php post_class(); ?>>
	<?php do_action( 'ct_mission_news_page_before' ); ?>
	<?php if ( is_page( 15595 ) ) {  ?>
		<div class="header-checkout"> 
			<h1>Assine</h1>
			<p>Assine a Jacobin Brasil hoje, receba duas lindas edições por ano e ajude-nos a construir uma verdadeira alternativa socialista aos magnatas da mídia capitalista.</p>
			<div style="float:none;clear:both;"></div>
		</div>
		<div id="derecha">
			<div id="parallax">
				<h1>O que eu ganho com esta assinatura?</h1>
				<br><br>
				<div id="suscrpcion-contenidos">
					<?php 
					
					$args_sus = array(
						'post_type'   => array('product','wc_membership_plan'),
						'post_status' => 'publish',
						'posts_per_page' => 50,
						'fields'      => array('ids','post_content'),
						'tax_query'   => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => array(60),
							)
						),

					);
					$products_sus = new WP_Query($args_sus);
					foreach($products_sus->posts as $prodsus){
						
						//echo "<!--<pre>";
						//print_r($prodsus);
						//echo "</pre>-->";
						
						
						echo '<div id="prod_'.$prodsus->ID.'" class="prod_det" style="display:none">
						'.$prodsus->post_content.'
						</div>';
						
					}
					?>
					<!--<div class="prod_det">Clique em uma assinatura para conhecer os benefícios.</div>-->
					<div class="prod_det">Duas edições impressas por ano com conteúdo original. Acesso a todo o nossos artigos e todas nossas edições anteriores em formato PDF para download. Um livro da coleção jacobina se assinar o plano Bolchevique.</div>
				</div>
			</div>
		</div>
	<?php } else { ?> 
	<?php } ?>

	<article class="content-page">
		<?php ct_mission_news_featured_image(); ?>
		<div class='post-header'>
			<h1 class='post-title'><?php the_title(); ?></h1>
		</div>
		<div class="post-content">
			<?php if ( is_page( 15595 ) ) {  ?>
				<p class="pre-tab">Tipo de assinatura</p>
				<p class="pre-tab"> </p>


			<?php } ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array(
				'before' => '<p class="singular-pagination">' . esc_html__( 'Pages:', 'mission-news' ),
				'after'  => '</p>',
			) ); ?>
			<?php do_action( 'ct_mission_news_page_after' ); ?>
			<?php get_sidebar( 'after-page' ); ?>
		</div>
	</article>
	<?php comments_template(); ?>
</div> 