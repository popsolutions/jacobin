<?php do_action( 'ct_mission_news_main_bottom' ); ?>
</section> <!-- .main -->
<?php do_action( 'ct_mission_news_after_main' ); ?>
<?php get_sidebar( 'right' ); ?>
</div><!-- layout-container -->
</div><!-- content-container -->



<?php 
// Elementor `footer` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
	?>
<div id="Footer">
	<div class="widgets_wrapper">
		<div class="container">
			<div class="column one-fifth">
				<?php dynamic_sidebar( 'prefooter' );?>
			</div>
		</div>
	</div>
</div>
	<?php /*
	<section class="cierre-revista">

	<ul class="encabezado-revista">
	<li class="izq">Número 2</li>
	<li class="cen">Comprar</li>
	<li class="der"><a href="#">ASSINAR</a></li>
	 <div style="float: none;clear:both;"></div>
	</ul>
	<svg class="is38-fr__icon" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" style="width:200px;fill:#fff;margin: 30px auto;float: none;display: block;">
		<title>J</title>
		<path d="M193,310.74c0,33.91,25.43,61.76,61.76,61.76,25.43,0,45.62-13.72,55.31-33.9,5.65-14.94,6.45-23.82,6.45-54.1V139.58h-147l0-29.07H348v178c0,34.31-4,64.18-25,86-17.36,18.17-40,27.05-68.23,27.05-54.9,0-92.84-41.58-92.84-90.83Z"></path>
	</svg>

	<h1>“Cante comigo, cante</br>
	Irmão americano</br>
	Liberta tua esperança</br>
	Com um grito na voz!”.</h1>
	<h2>MERCEDES SOSA</h2>

	</section>
	*/?>
<footer class="site-footer" role="contentinfo">
	<div class="container">
		<div id="mc_embed_signup">
			<?php echo do_shortcode( '[mc4wp_form id="5884"]' ); ?>
		</div>
	</div>
<?php /*
	<section class="mailchimpform">

		<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/30e485d16a6e039b01e8dc470/bf2cde44c71fff181e9f0ac76.js");</script>



		<!-- Begin Mailchimp Signup Form -->
		<link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
		<style type="text/css">
		#mc_embed_signup{ clear:left; font:14px  }
			/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
			We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
		/*
		</style>
		<div id="mc_embed_signup">
			<form action="https://jacobinlat.us17.list-manage.com/subscribe/post?u=3a2a1f5bbde1942c6210a0d8f&amp;id=c1f7d0f688" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				<div id="mc_embed_signup_scroll">
					<p class="invitacion">DIGITE SEU E-MAIL PARA RECEBER NOSSA NEWSLETTER</p>
					<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="digite seu email" required style="min-width:250px;">
					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_3a2a1f5bbde1942c6210a0d8f_c1f7d0f688" tabindex="-1" value=""></div>
					<div class="clear"><input type="submit" value="ENVIAR" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
				</div>
			</form>
		</div>
	</section>
*/?>

<!--End mc_embed_signup-->
<!--
<div class="container">
	<section class="cierre">
		<?php //		echo "<img src='" . esc_url( home_url() ) . "/wp-content/uploads/2021/08/jacobinbrasil2.png' style='width:200px;height:auto;margin: 0px auto 0px auto;float: none;display: block;' >"; ?>
		<svg class="" viewBox="0 0 512 458" xmlns="http://www.w3.org/2000/svg" style="width:150px;fill:#fff;margin: 20px auto 0px auto;float: none;display: block;">
			<title>Cierre</title>
			<polygon points="0 444 512 0 512 14 0 458 0 444"></polygon>
		</svg> 
	</section>

</div>
-->

<div class="container">
	<?php do_action( 'ct_mission_news_footer_top' ); ?>
		
	<?php get_sidebar( 'site-footer' ); ?>
	
	<div id="menu-footer-container" class="menu-footer-container">
		<?php get_template_part( 'menu', 'footer' ); ?>
	</div>

	<div class="design-credit">
		<span>
			2019 © - JacobinBrasil. Desenvolvido por <a href="https://www.estudiodosrios.com.ar/" target="_blank">Estudio Dos Ríos</a> & <a href="https://dobke.com.ar" target="_blank">Dobke</a> | Mantido por <a href="https://popsolutions.co" target="_blank">PopSolutions.Co</a>
		</span>
	</div>
	<?php do_action( 'ct_mission_news_footer_bottom' ); ?>
</div>
</footer>
<?php endif; ?>
</div><!-- .max-width -->
</div><!-- .overflow-container -->

<?php do_action( 'ct_mission_news_body_bottom' ); ?>

<?php wp_footer(); ?>

</body>
</html>