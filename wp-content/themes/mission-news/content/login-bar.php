<a href="#" id="login-toggle" class="login-toggle"><svg viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg" class="si-hr-nv__icon si-hr-nv__icon--login"><title>Login Icon</title> <line x1="2" x2="25" y1="20.5" y2="20.5"></line> <polyline points="17.41 12.48 25.36 20 17.41 27.52"></polyline> <path d="M7.73,26.24a14,14,0,1,0-.51-11.35"></path></svg>
<span><?PHP if ( is_user_logged_in() ) { echo esc_html__( 'PERFIL', 'mission-news' ); }else{  echo esc_html__( 'Logar', 'mission-news' ); } ?></span></a><a href="https://jacobin.com.br/assine/" class="botonAssinar" style="text-decoration: none;color:#fff;padding:10px 0px 10px 0px;font-family: 'Hurme-No3',sans-serif;display:none;">ASSINAR</a>					
<div id="login-form-popup" class="login-form-popup <?PHP if ( is_user_logged_in() ) { ?>logueado<?PHP } ?>">
	<div class="inner">
		<!-- div class="title"><?php echo esc_html__( 'login', 'mission-news' ) ?></div -->
		<?PHP
		if ( ! defined( 'ABSPATH' ) ) {
			exit; // Exit if accessed directly.
		}
		?>
		<a id="close-login" class="close" href="#" style="width:24px;"><?php echo ct_mission_news_svg_output( 'close' ); ?></a>
		<?PHP
		if ( is_user_logged_in() ) {
			//return;
			?>
			<div>
				<?php 
				wp_nav_menu( array ('menu' => "Cuenta") );
				 ?>
			</div>
		<?PHP
		}else{
			if(!isset($hidden)){$hidden = '';}
			if(!isset($message)){$message = '';}
		?>
			<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

				<p class="form-row form-row-first">
					<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="username" autocomplete="username" />
				</p>
				<p class="form-row form-row-last">
					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</p>
				<div class="clear"></div>

				<?php do_action( 'woocommerce_login_form' ); ?>
	<p class="lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>

				<p class="form-row boton">
					
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
				</p>
			
				<div class="clear"></div>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>
		<?PHP } // fin else ?>
	</div>
</div>
