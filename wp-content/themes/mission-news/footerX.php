<?php do_action( 'ct_mission_news_main_bottom' ); ?>
</section> <!-- .main -->
<?php do_action( 'ct_mission_news_after_main' ); ?>
<?php get_sidebar( 'right' ); ?>
</div><!-- layout-container -->
</div><!-- content-container -->


<section class="banner-revista">
<div>
<img src="https://jacobinlat.com/wp-content/uploads/2020/09/tapaNueva1-2.jpg">
<span>N°1 | VENDIMIARIO | 2020</span>
<h1><a href="https://jacobinlat.com/revista/">Capitalismo en cuarentena</a></h1>
<a href="https://jacobinlat.com/revista/">Ver Adentro</a>
<div style="clear:both;float:none;"></div>
<div>

</section>
<section class="hm-sb">
  <div class="hm-sb__container">
    <header class="hm-sb__header">
      <h1 class="hm-sb__heading">
        <a class="hm-sb__link" href="/subscribe">Suscribirse</a>
      </h1>
	      
     
    </header>

    <dl class="hm-sb__medium">
      <dt class="hm-sb__price">
	<H5> Descuento lanzamiento: </H5><br>
        <a class="hm-sb__link" href="/tienda">
        
		  <span style="text-decoration:line-through;color:#fff;">$1250 PESOS ARGENTINOS </span><br>
		 <span> $950 PESOS ARGENTINOS  </span>
        </a>
      </dt>
      <dd class="hm-sb__desc">1 Año | 4 Números | Suscripción Impresa + Digital</dd>
      <dt class="hm-sb__price"><br>
        <a class="hm-sb__link" href="/tienda">
         <span style="text-decoration:line-through;color:#fff;"> U$S 12 </span><br>
		  <span>  U$S 10 </span>
        </a>
      </dt>
      <dd class="hm-sb__desc">1 Año | 4 Números digitales</dd>
    </dl>
	 <p class="hm-sb__dek">Con la publicación de una edición latinoamericana de la revista Jacobin se abre un nuevo espacio para la expresión de una cultura socialista, democrática y revolucionaria.<BR>-Michael Löwy</p>

    <!--ul class="hm-sb__options">
      <li class="hm-sb__item">
        <a class="hm-sb__link" href="/subscribe">Nueva suscripción</a>
      </li>
      <li class="hm-sb__item">
        <a class="hm-sb__link" href="/subscribe/renew">Renovar suscripción</a>
      </li>
    </ul -->
  </div>
</section>


<section class="mailchimpform">
<!-- Begin Mailchimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px  }
	/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://jacobinlat.us17.list-manage.com/subscribe/post?u=3a2a1f5bbde1942c6210a0d8f&amp;id=c1f7d0f688" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<p class="invitacion">Para recibir las últimas novedades y unos regalos Jacobin, subscribirse al boletín</p>
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="DIRECCION DE MAIL" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_3a2a1f5bbde1942c6210a0d8f_c1f7d0f688" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="ENVIAR" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->
</section>

<?php 
// Elementor `footer` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
?>
    <footer id="site-footer" class="site-footer" role="contentinfo">
	
        <?php do_action( 'ct_mission_news_footer_top' ); ?>
        <div class="footer-title-container">
            <?php get_template_part( 'logo' ) ?>
            <?php if ( get_bloginfo( 'description' ) && get_theme_mod( 'tagline_footer' ) != 'no' ) {
                echo '<p class="footer-tagline">' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
            } ?>
            <?php ct_mission_news_social_icons_output( 'footer' ); ?>
        </div>
        <div id="menu-footer-container" class="menu-footer-container">
            <?php get_template_part( 'menu', 'footer' ); ?>
        </div>
        <?php get_sidebar( 'site-footer' ); ?>
        <div class="design-credit">
            <span>
                <?php
                // Translators: %s is the URL of the theme
                $footer_text = sprintf( __( ' ', 'mission-news' ), 'https://www.competethemes.com/mission-news/' );
                $footer_text = apply_filters( 'ct_mission_news_footer_text', $footer_text );
                echo do_shortcode( wp_kses_post( $footer_text ) );
                ?>
            </span>
        </div>
        <?php do_action( 'ct_mission_news_footer_bottom' ); ?>
    </footer>
<?php endif; ?>
</div><!-- .max-width -->
</div><!-- .overflow-container -->

<?php do_action( 'ct_mission_news_body_bottom' ); ?>

<?php wp_footer(); ?>

</body>
</html>