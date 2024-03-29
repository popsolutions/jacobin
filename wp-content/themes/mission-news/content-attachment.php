<div <?php post_class(); ?>>
	<?php do_action( 'ct_mission_news_attachment_before' ); ?>
	<article  class="content-archive-attachment">
		<div class='post-header'>
			<h1 class='post-title'><?php the_title(); ?></h1>
		</div>
		<div class="post-content">
			<?php the_content(); ?>
			<?php get_template_part( 'content/post-nav-attachment' ); ?>
		</div>
	</article>
	<?php do_action( 'ct_mission_news_attachment_after' ); ?>
	<?php comments_template(); ?>
</div>