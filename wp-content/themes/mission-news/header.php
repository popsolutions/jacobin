<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ff0000">
	<meta name="apple-mobile-web-app-title" content="Jacobinlat">
	<meta name="application-name" content="Jacobinlat">
	<meta name="msapplication-TileColor" content="#ff0000">
	<meta name="theme-color" content="#ffffff">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140934936-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-140934936-1');
	</script>



	<!-- Matomo -->
	<script type="text/javascript">
		var _paq = window._paq = window._paq || [];
		/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
		_paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
		_paq.push(["setCookieDomain", "*.jacobin.com.br"]);
		_paq.push(["setDomains", ["*.jacobin.com.br","*.www.jacobin.com.br"]]);
		_paq.push(['trackPageView']);
		_paq.push(['enableLinkTracking']);
		(function() {
			var u="//analytics.popsolutions.co/";
			_paq.push(['setTrackerUrl', u+'matomo.php']);
			_paq.push(['setSiteId', '2']);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
		})();
	</script>
	<!-- End Matomo Code -->
	<meta name="author" content="Estudio Dos Rios + Dobke">
</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class(); ?>>
	<?php do_action( 'ct_mission_news_body_top' ); ?>
	<?php 
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	} ?>

	<?php
	if ( !is_user_logged_in() ) {
		if ( is_single() )  { 

			if (session_id() === "") {
										// echo do_shortcode( '[sg_popup id=534]' );
					//session_start();
			}  
		}  	
	}  
	?>
	<a class="skip-content" href="#main"><?php esc_html_e( 'Press "Enter" to skip to content', 'mission-news' ); ?></a>
	<div id="overflow-container" class="overflow-container">
		<div id="max-width" class="max-width">
			<?php do_action( 'ct_mission_news_before_header' ); ?>
			<?php
		// Elementor `header` location
			if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) :
				?>
			<header class="site-header" id="site-header" role="banner" style="-webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);">
				<div class="top-left">
					<button id="toggle-navigation" class="toggle-navigation" name="toggle-navigation" aria-expanded="false">
						<span class="screen-reader-text"><?php esc_html_e( 'open menu', 'mission-news' ); ?></span>
						<div style="width:24px;"><?php echo ct_mission_news_svg_output( 'toggle-navigation' ); ?></div>
					</button>

					<div id="menu-primary-container" class="menu-primary-container tier-1">
						<?php get_template_part( 'menu', 'primary' ); ?>
					</div>

					<?php get_template_part( 'content/search-bar' ); ?>
					<?php get_template_part( 'content/login-bar' ); ?>
					<?php ct_mission_news_social_icons_output( 'header' ); ?>
					
				</div>
				<div id="title-container" class="title-container">
					<?php 		echo "<a href='" . esc_url( home_url() ) . "' style='display:block;' >"; ?>


					<?php 		echo "<img src='" . esc_url( home_url() ) . "/wp-content/uploads/2021/09/jacobin-brasil4.png' style='width:300px;height:auto;' >"; ?>
					<?php 	echo "</a>"; ?>

				</div>
				
				<div class="jota" style="display:none;">

					<?php 		echo "<a href='" . esc_url( home_url() ) . "' style='display:block;' >"; ?>

					<svg style="fill:#fff;width:255px;"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 307.19 66.44"><title>Logo Jacobin</title>
						<path d="M25,51A10.3,10.3,0,0,0,35.53,61.46,10.28,10.28,0,0,0,45,55.73c1-2.53,1.1-4,1.1-9.15V22.08H24.33V17.17H51.51v30.1c0,5.8-.69,10.85-4.29,14.53-3,3.08-6.84,4.58-11.69,4.58-9.4,0-15.9-7-15.9-15.36Z" transform="translate(-19.63 -15.46)"/></svg>
						<?php 	echo "</a>"; ?>

					</div>

					<div class="top-right">
						<div id="menu-secondary-container" class="menu-secondary-container tier-1">
							<?php get_template_part( 'menu', 'secondary' ); ?>
						</div>
					</div>

				</header>
			<?php endif; ?><section class="bn-at prt-x"><div class="bn-at__container"><?php the_ad(17333); ?>
		</div></section>


		<?php do_action( 'ct_mission_news_after_header'
	); ?>
				<!--- if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
				} --->
				<?php get_sidebar( 'below-header' ); ?>
				<div class="content-container">
					<?php do_action( 'ct_mission_news_content_container_top' ); ?>
					<div class="layout-container">
			<?php //get_sidebar( 'left' ); 
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
				?>
				<aside class="sidebar sidebar-left" id="sidebar-left" role="complementary">
					<div class="inner">
						<section id="ct_mission_news_post_list-2" class="widget widget_ct_mission_news_post_list">
							<div class="style-1">
								<ul>
									<?php
									while ( $the_query->have_posts() ) {  
										$the_query->the_post();
										$publicados[] = $post->ID;
										?>
										<li class="post-item">
											<div class="top" style="uno">
												<div class="top-inner" style="uno">
													<?php ct_mission_news_post_byline( $author, $date ); ?>
													<a href="<?php echo esc_url( get_permalink() ); ?>" class="title"><?php the_title(); ?></a>
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
						</section>
					</div>
				</aside>
			<?php	}	?>

			<section id="main" class="main" role="main">
				<?php do_action( 'ct_mission_news_main_top' );
				get_sidebar( 'above-main' );
