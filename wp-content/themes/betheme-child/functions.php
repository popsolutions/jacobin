<?php

function my_theme_enqueue_styles() {
    wp_enqueue_style('betheme-style');
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/*  Mudar Logo da página inicial
 * -----------------------------------------------------------------------
 */
function wppop_login_logo() { 
	$dir = wp_get_upload_dir(); ?>
    <style type="text/css">
		body.login div#login h1 a,
        .login h1 a {
            background-image: url(../wp-content/uploads/2019/01/jacobinbrasillogo-fundotransparante.png) !important;
			height:65px;
			width:320px;
			background-size: 320px 65px;
			background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
		body.login{
			background: red;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wppop_login_logo' );


/*  Adicionar css e js do tema filho
 * -----------------------------------------------------------------------
 */
function wppop_jacobin_theme_enqueue_scripts() {
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri().'/css/bootstrap.min.css', array(), 20141119 );
    wp_enqueue_style( 'custom', get_stylesheet_directory_uri().'/css/custom-style.css', array(), 6.5 );
    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20120206', true );
}
add_action( 'wp_enqueue_scripts', 'wppop_jacobin_theme_enqueue_scripts' );


/* Recuperando As Imagens De Um Post Do Wordpress
 * ------------------------------------------------------------------------------------------------------
 */

function post_get_images($ind=NULL){
	global $post;
	$list = array();
	$args = array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image/jpeg',
		'numberposts' => -1,
		'post_status' => null,
		'orderby' => 'menu_order',
		'post_parent' => $post->ID
	);
	$attachments = get_posts($args);

	//jpg
	foreach($attachments as $at){
		$list[$at->ID] = $at->guid;
	}
	//bmp
	$args['post_mime_type'] = 'image/bmp';
	$attachments = get_posts($args);
	foreach($attachments as $at){
		$list[$at->ID] = $at->guid;
	}
	//png
	$args['post_mime_type'] = 'image/png';
	$attachments = get_posts($args);
	foreach($attachments as $at){
		$list[$at->ID] = $at->guid;
	}
	//gif
	$args['post_mime_type'] = 'image/gif';
	$attachments = get_posts($args);
	foreach($attachments as $at){
		$list[$at->ID] = $at->guid;
	}

	if(sizeof($list)){
		$a = 0;
		$images = array();
		foreach($list as $k => $v){
			$images[$a]	= $v;
			$a++;
		}
		unset($list);

		if(!is_null($ind)){
			if(is_null($images[$ind])){
				return false;
			}else{
				return $images[$ind];
			}
		}else{
			return $images;
		}

	}else{
		return false;
	}
}

/* Pegar o diretório raiz do Wordpress
 * ------------------------------------------------------------------------------------------------------
 */

function p_wproot($mod = 'e'){
	if ($mod == 'e') { //echo
		// imprime direto no local da inserção
		bloginfo('template_directory');
	}
	if ($mod == 'v') { //value 
		// retorna como valor o diretório raiz do wp (usar dentro de outras funções)
		$value = get_bloginfo('template_directory');
		return $value;
	}
}


/* Pegar o diretório raiz do tema
 * ------------------------------------------------------------------------------------------------------
 */

function p_wpurl($mod = 'e'){
	if ($mod == 'e') { //echo
		// imprime direto no local da inserção
		bloginfo('url');
	}
	if ($mod == 'v') { //value 
		// retorna como valor o diretório raiz do wp (usar dentro de outras funções)
		$value = get_bloginfo('url');
		return $value;
	}
}


/* Pegar o Diretório de Imagem
 * ------------------------------------------------------------------------------------------------------
 */

function p_img($subfolder = '',$mod = 'e'){ 
	// se vazio entende-se que é a raiz da pasta
	if (!$subfolder) { $subfolder = '';} else { $subfolder = $subfolder.'/'; }
	if ($mod == 'e') { //echo
		echo get_stylesheet_directory_uri().'/images/'.$subfolder;
	}
	if ($mod == 'v') { //value 
		// retorna como valor o diretório raiz do wp (usar dentro de outras funções)
		$value = get_bloginfo('template_directory').'/images/'.$subfolder;
		return $value;
	}
}

/* Chamar o Timthumb e aplicar as configurações
 * -----------------------------------------------------------------------
 */

function p_timthumb($w = 147, $h = 104, $a = 't', $q = 100, $modo = 't', $view = 'i',$images = null,$title = null,$this_ID = null,$html_begin = '',$html_end = '',$html_cond = null,$cond = null,$class = null) {
		/*--> Início Timthumb 
		$w => '260', //width
		$h => '137', //height
		$a => 't', //align (t)op (c)enter (b)ottom (r)ight (l)eft, tr tl br bl
		$q => '85'   //quality
		$modo => 't' //(t)thumb (g)gallery
		$view => 'i' //(i)img (l)link (v)value
		$images => null //post_get_images()
		$title => título do post
		$this_ID => id do post
		$html_begin => html inicial
		$html_end => html final
		$html_cond => html condicional (entra no lugar do html inicial)
		$cond => condição para a $html_cond aparcer (int)
		$class => Foi adicionado esse parametro devido as especificidades do banner
		*/
		// tamanho ampliado padrão para o template
		
		$apl_w = 934;
		//$apl_h = 660;
		$timthumb_ampliado = '&amp;w='.$apl_w.'&amp;q='.$q.'&amp;a='.$a;
		
		$timthumb_src = '/timthumb.php?src=';
		$timthumb_config = '&amp;h='.$h.'&amp;w='.$w.'&amp;q='.$q.'&amp;a='.$a.'"';
		
		if($this_ID == null){
		    $this_ID = get_post_thumbnail_id();
		}
		
		if($modo == 'v'){
		    $thumb_id = get_post_thumbnail_id($this_ID); 
			$url = wp_get_attachment_image_src($thumb_id, 'full');
			$value .= get_stylesheet_directory_uri().$timthumb_src.$url[0].$timthumb_config;
			return $value;
		}
		if ($modo == 't') { // thumb
			// Pegar a url da img original do thumbnail e alterar seu tamanho
			$thumb_id = get_post_thumbnail_id($this_ID); 
			$url = wp_get_attachment_image_src($thumb_id, 'full');
			// verifica a $cond se existe e aplica o html
			if ($cond != null) {echo $html_cond;}
			else {echo $html_begin;}
			echo '<img src="'.
				 get_stylesheet_directory_uri().
				 $timthumb_src.$url[0].$timthumb_config.
				 ' class="attachment-post wp-post-image '.
				 $class.'" alt="';
			echo $title;
			echo '" id="'.$this_ID.'"/>'."\n";
			echo $html_end;
		}
		if ($modo == 'g') { // gallery
			// Pegando as Imagens do post
			$images = post_get_images();
			$n = 1; // Contador de imagens
			// mostrar os links das imagens
			if ($view == 'l') {
				if($images){
					//echo count($images);
					foreach ($images as $url) {
						//if($n != 1) {//pular a primeira imagem (thumbnail)
						$img[$n] = $url;
						// verifica a $cond se existe e aplica o html
						if ($cond != null and $cond == $n) {echo $html_cond;}
						else {
							if($n == 1){
								echo $html_begin;
							}
						}
						echo p_wproot('v').$timthumb_src.$img[$n].$timthumb_config;
						$n++;
					}
				}
			}
			if ($view == 'i') {
				if($images){
					foreach ($images as $url) {
						if($n != 1) {//pular a primeira imagem (thumbnail)
							$img[$n] = $url;
							//verifica a $cond se existe e aplica o html rel="Gallery['.$this_ID.']"
							if ($cond != null and $cond == $n) {echo $html_cond;}
							else {echo $html_begin;}
							echo '<img src="'.
								 p_wproot('v').
								 $timthumb_src.$url.$timthumb_config.
								 ' class="attachment-post wp-post-image" alt="';
							echo $title;
							echo '" />'."\n";
							echo $html_end;
						}
						$n++;
					}
				}
			}
		}
}//--> fim Timhumb


// Get featured image
function wppop_ST4_get_FB_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'fb-preview');
        return $post_thumbnail_img[0];
    }
}
 
// Get post excerpt
function wppop_ST4_get_FB_description($post) {
    if ($post->post_excerpt) {
        return $post->post_excerpt;
    }
    else {
        // Post excerpt is not set, so we take first 55 words from post content
        $excerpt_length = 55;
        // Clean post content
        $text = str_replace("\r\n"," ", strip_tags(strip_shortcodes($post->post_content)));
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            $excerpt = implode(' ', $words);
            return $excerpt;
        }
    }
}

//Exclude pages from WordPress Search
if (!is_admin()) {
    function wpb_search_filter($query) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
            return $query;
    }
    add_filter('pre_get_posts','wpb_search_filter');
}


function wppop_ST4FB_header() {
    global $post;
    $post_description = wppop_ST4_get_FB_description($post);
    $post_featured_image = wppop_ST4_get_FB_image($post->ID);
    if ( (is_single()) AND ($post_featured_image) AND ($post_description) ) { ?>
        <meta name="title" content="<?php echo $post->post_title; ?>" />
        <meta name="description" content="<?php echo $post_description; ?>" />
        <link rel="image_src" href="<?php echo $post_featured_image; ?>" />
    <?php
    }
}

add_action('wp_head', 'wppop_ST4FB_header');

/*  Shortcode para mostrar 4 notícias na Home - Abaixo do Banner
 * -----------------------------------------------------------------------
 */
function wppop_jacobin_news_4_columns($atts){
    $a = shortcode_atts(array('page'=>'front'),$atts);
	$args = array(
		'numberposts' => 4,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'category__not_in' => array(57)
	);

	$recent_posts = get_posts($args);
	$output = '<div class="noticias-jacobin row">';
	
	foreach($recent_posts as $post){
		$html_title = get_post_meta($post->ID, "HTML_title", true);
		$output .= '<div class="post-front-jacobin col-lg-3 col-md-12 col-sm-12 d-flex align-items-stretch flex-column">';
    	$output .= '<div class="col-md-12 text-news-front order-sm-2">';
		$link = get_permalink($post->ID);
		if($html_title){ 
		   $output .= '<a href="'.$link.'"><h1>'.$html_title.'</h1></a>';
		}else{ 
		  $output .= '<a href="'.$link.'"><h1>'.get_the_title($post->ID).'</h1></a>';
		}
    
    // if ( function_exists(get_the_molongui_author_posts_link) ){
    //   $byline = get_the_molongui_author_posts_link();
    // }else{
    //   $byline = 'Não encontrou';
    // }
    	
    if(function_exists(get_the_molongui_author)){
      // $author = get_the_molongui_author();
      // $author_url = '';
      // $author_class = '';

      $author = get_the_author_meta( 'display_name', $post->post_author);
      $author_url = get_author_posts_url($post->post_author);
    }else{
			$author = get_the_author_meta( 'display_name', $post->post_author);
			$author_url = get_author_posts_url($post->post_author);
      // $author_class = '';
    }
    
		$date = get_the_time('d / F', $post->ID);
		
		$output .= '<div class="flex-jac"><p class="jac-author '.$author_class.'">'.$date.'</p>';
    $output .= '<p class="jac-author"><a href="'.$author_url.'">'.$author.'</a></p>';
    $output .= '</div>';
		$output .= '<p>'.get_the_excerpt($post->ID).'</p></div>';
		$output .= '<div class="col-md-12 img-news-bottom order-sm-1 order-md-first order-lg-last"><a class="img-overlay" href="'.$link.'">';
    $output .= '<img src="'.p_timthumb(300, 214, 'c', 100, 'v', null, null, null, $post->ID).'/><div class="overlay"></div></a>';
		$output .= '</div></div>';
	}
	
	$output .= '</div>';
	return $output;
}
add_shortcode('jacobinnews','wppop_jacobin_news_4_columns');

/*  Banner Home
 * -----------------------------------------------------------------------
 */
 
function wppop_jacobin_home_banner($atts){
  $a = shortcode_atts(array('page'=>'front'),$atts);
  $args = array(
    'numberposts' => 1,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'category' => 57
  );

  $recent_posts = get_posts($args);
  $output = '<div class="banner-jacobin row"><div class="logo-home col-lg-2 col-md-2 col-sm-12 order-lg-1 order-md-1 order-sm-3 order-xs-3"><img class="scale-with-grid" src="https://jacobin.com.br/wp-content/uploads/2019/01/plano-3.png" alt="plano-3" width="1476" height="1476" scale="0"></div>';
	
	foreach($recent_posts as $post){
		$html_title = get_post_meta($post->ID, "HTML_title", true);
		$output .= '<div class="banner-jacobin-content col-lg-5 col-md-5 col-sm-12 order-lg-2 order-md-2 order-sm-2 order-xs-2 order-sm-last">';
		if($html_title){ 
		   $output .= '<a href="'.get_permalink($post->ID).'"><h1>'.$html_title.'</h1></a>';
		}else{ 
		  $output .= '<a href="'.get_permalink($post->ID).'"><h1>'.get_the_title($post->ID).'</h1></a>';
		}
    
    // if(function_exists(get_the_molongui_author)){
    //   $author = get_the_molongui_author();
    //   $author_url = '';
    // }
        
		$author_name = get_the_author_meta( 'display_name', $post->post_author);
		$author_url = get_author_posts_url($post->post_author);
		$date = get_the_time('d / F', $post->ID);
		$output .= '<p class="jac-author">'.$date.' </p> <p class="jac-author"><a href="'.$author_url.'">'.$author_name.'</a></p>';
		$output .= '<div class="excerpt"><p>'.get_the_excerpt($post->ID).'</p></div>';
		$output .= '</div>';
		$output .= '<div class="banner-jacobin-picture col-lg-5 col-md-5 col-sm-12 order-lg-3 order-md-3 order-sm-1 order-xs-1 order-sm-first">';
		$output .= '<a class="img-overlay" href="'.get_permalink($post->ID).'" style="background: url('.get_the_post_thumbnail_url($post->ID, 'full').'); background-size: cover;background-position: center;"><div class="overlay"></div></a>';
		$output .= '</div>';
	}
	
	$output .= '</div>';
	
	return $output;
    

}
add_shortcode('jacobin-home-banner','wppop_jacobin_home_banner');

/*  Notícias da Home - Manchetes e 1 imagem
 * -----------------------------------------------------------------------
 */
function wppop_jacobin_home_blog_news($atts){
  $a = shortcode_atts(array('page'=>'front'),$atts);
	$args = array(
		'numberposts' => 11,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'category__not_in' => array(57),
		'offset' => 12
	);

	$recent_posts = get_posts($args);
	
	$output = '<div class="blog-home-jacobin row">';
	
	$n = 0;
	
	foreach($recent_posts as $post){
		$html_title = get_post_meta($post->ID, "HTML_title", true);
		$author_name = get_the_author_meta( 'display_name', $post->post_author);
		$author_url = get_author_posts_url($post->post_author);
		$date = get_the_time('d / F', $post->ID);
		$excerpt = get_the_excerpt($post->ID);
		$link = get_permalink($post->ID);
		$image = get_the_post_thumbnail_url($post->ID, 'full');
		
		if($n == 0){
    		$output .= '<div class="news-jacobin-picture-area col-lg-6 col-md-12 col-sm-12"><div class="col-lg-6 col-md-6 col-sm-12"><div class="news-content">';
    		if($html_title){ 
    		   $output .= '<a href="'.$link.'"><h2>'.$html_title.'</h2></a>';
    		}else{ 
    		  $output .= '<a href="'.$link.'"><h2>'.get_the_title($post->ID).'</h2></a>';
    		}
    		$output .= '<p class="jac-author">'.$date.' </p> <p class="jac-author"><a href="'.$author_url.'">'.$author_name.'</a></p>';
    		$output .= '<div class="excerpt"><p>'.$excerpt.'</p></div></div></div>';
		    $output .= '<a class="news-jacobin-picture col-lg-6 col-md-6 col-sm-12" style="background-image: url('."'".$image."'".')" href="'.$link.'"></a></div>';
		}else{
    		if($n == 1){
    		    $output .= '<div class="col-lg-6 col-md-12 col-sm-12 news-jacobin-area"><div class="news-jacobin col-md-12 col-lg-12">';
    		}
    // 		if($n == 5){
    // 		    $output .= '</div><div class="news-jacobin col-md-12 col-lg-6 col-sm-12">';
    // 		}
    		
    		$output .= '<div class="news-link"><hr></hr>';
            
            if($html_title){ 
    		   $output .= '<a href="'.$link.'"><h2>'.$html_title.'</h2></a>';
    		}else{ 
    		  $output .= '<a href="'.$link.'"><h2>'.get_the_title($post->ID).'</h2></a>';
    		}
    		
    		$output .= '</div>';
    		
    		if($n == count($recent_posts) - 1){
    		    $output .= '</div>'; // </div>
    		}
		}
		$n++;
	}
	
	$output .= '</div>';
	
	return $output;
}
add_shortcode('jacobin-home-blog-news','wppop_jacobin_home_blog_news');

/* --------------------------------------------------
* Script do Facebook
* --------------------------------------------------- */

add_action('wp_head', 'wppop_facebook_script');
function wppop_facebook_script(){ ?>
    <div id="fb-root"></div>
    <script async defer src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2"></script>
<?php  
}

/* --------------------------------------------------
* Documentação
* --------------------------------------------------- */

add_action( 'admin_menu', 'wppop_manual_link' );
function wppop_manual_link() {
    add_menu_page( 'Manual', 'Manual Jacobin', 'read', 'manual-jacobin', 'wppop_manual_func', 'dashicons-layout', 1);
}

function wppop_manual_func(){ 
	include('manual/manual.html');
}

/* --------------------------------------------------
* Barra Lateral
* --------------------------------------------------- */

function wppop_add_javascript() {
    if(is_page('home')){
        ?>
        <script type="text/javascript">
            var j = jQuery.noConflict();
            
            j(document).ready(function(){
                j(".podcasts .photo_wrapper a, #podcasts").on('click', function(e){
                	e.preventDefault();
                	console.log('click');
                	j("#podcasts-div").toggleClass('hidden');
                });
            });
            
        </script>
    <?php
    }
    if (is_single()) { 
    ?>
        <script type="text/javascript">
          var j = jQuery.noConflict();
          
          j(window).on('scroll', function(){
            j(".single_content .sidebar-right").each(function(){
              if(j(document).scrollTop() > j(this).offset().top + 20) {
                j(this).addClass("fixado");
                j('.single_content .post_content').css('margin-left','0');
              }
              else if(j(document).scrollTop() < j(".the_content_wrapper").offset().top + 30){
                j(this).removeClass("fixado");
              }
            });
          });
        </script>
    <?php
    }
    ?>
    <link type="application/rss+xml" rel="alternate" title=”Podcast” href="http://nowanddan.libsyn.com/rss"/>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140934936-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-140934936-1');
    </script>
    
    <?php
}
add_action('wp_head', 'wppop_add_javascript');

/* --------------------------------------------------
* Remover zoom das imagens do woocommerce
* --------------------------------------------------- */
/*
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'wp', 'remove_image_zoom_support', 20 );
*/

function wppop_add_facebook_image_to_home(){
    if(is_home()){
        $image = 'https://jacobin.com.br/wp-content/uploads/2019/05/Captura-de-Tela-2019-05-28-às-19.03.03.png' ; ?>
        <meta property="og:image" content="<?php echo $image; ?>" />
        <meta name="twitter:image" content="<?php echo $image; ?>" />
    <?php   
    }
}
add_action('wp_head', 'wppop_add_facebook_image_to_home');


/* --------------------------------------------------
* Adicionar notícias na Home
* --------------------------------------------------- */
function wppop_jacobin_news_4_bottom($atts){
    $a = shortcode_atts(array('page'=>'front'),$atts);
	$args = array(
		'numberposts' => 4,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'offset' => 23,
		'category__not_in' => array(57)
	);

	$recent_posts = get_posts($args);
	$output = '<div class="noticias-jacobin row bottom">';
	
	$order = 2;
	$order_md = 1;
	
	foreach($recent_posts as $post){
		$html_title = get_post_meta($post->ID, "HTML_title", true);
		$output .= '<div class="post-front-jacobin col-lg-3 col-md-12 col-sm-12 d-flex align-items-stretch flex-column">';
    $output .= '<div class="col-md-12 text-news-front order-sm-1 order-md-'.$order.'">';
    $link = get_permalink($post->ID);
    
		if($html_title){ 
		   $output .= '<a href="'.$link.'"><h1>'.$html_title.'</h1></a>';
		}else{ 
		  $output .= '<a href="'.$link.'"><h1>'.get_the_title($post->ID).'</h1></a>';
		}
		$author = get_the_author_meta( 'display_name', $post->post_author);
		$author_url = get_author_posts_url($post->post_author);
		$date = get_the_time('d / F', $post->ID);
		
		$output .= '<div class="flex-jac"><p class="jac-author">'.$date.'</p><p class="jac-author"><a href="'.$author_url.'">'.$author.'</a></p></div>';
		$output .= '<p>'.get_the_excerpt($post->ID).'</p></div>';
		$output .= '<div class="col-md-12 img-news-bottom order-sm-1 order-md-'.$order_md.' order-lg-'.$order_md.'"><a class="img-overlay" href="'.$link.'"><img src="'.p_timthumb(300, 214, 'c', 100, 'v', null, null, null, $post->ID).'/><div class="overlay"></div></a>';
		$output .= '</div></div>';
		if($order == 1){
		    $order = 2;
		    $order_md = 1;
		}else{
		    $order = 1;   
		    $order_md = 2;
		}
		
	}
	
	$output .= '</div>';
	return $output;
}
add_shortcode('jacobinnews_bottom','wppop_jacobin_news_4_bottom');

/********************
 *  Mostrar títulos de notícias
 *
 ********************/

function popsol_show_manchetes_only($atts){
    $a = shortcode_atts(array('page'=>'front'),$atts);
    $args = array(
		'numberposts' => 8,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'offset' => 4,
		'category__not_in' => array(57)
	);

	$recent_posts = get_posts($args);
	
	$output = '<div class="row">';
	
	$n = 0;
	foreach($recent_posts as $post){
	    $link = get_permalink($post->ID);
	    if($n == 0){
    		$output .= '<div class="col-lg-12 col-md-12 col-sm-12"><div class="manchetes-jacobin col-md-12 col-lg-12">';
    	}
        $output .= '<div class="manchete"><hr></hr>';
                
    	$output .= '<a href="'.$link.'"><h2>'.get_the_title($post->ID).'</h2></a></div>';
    	$n++;
	}
	
	$output .= '</div></div></div>';
	return $output;
}
add_shortcode('jacobin-manchetes','popsol_show_manchetes_only');



/*-------------- Metaboxes ----------------------------*/


 /**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function custom_fields_metabox() {
	$prefix = '';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => 'Campos Especiais',
		'title'         => esc_html__( 'Campos especiais', 'cmb2' ),
		'object_types'  => array( 'post', ), // Post type
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Tradutor', 'cmb2' ),
		'id'   => 'tradutor',
		'type' => 'text',
	) );
}

add_action( 'cmb2_admin_init', 'custom_fields_metabox' );


/* --------------------------------------------------
* Adicionar notícias na Home
* --------------------------------------------------- */
function wppop_jacobin_fixo($atts){
    $a = shortcode_atts(array('page'=>'front'),$atts);
	$args = array(
		'numberposts' => 1,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'category__in' => array(273)
	);

	$recent_posts = get_posts($args);
	$output = '<div class="noticias-jacobin row bottom fixo"><div class="col-md-6" style="border-right: 1px solid black;">';
	
	foreach($recent_posts as $post){
		$html_title = get_post_meta($post->ID, "HTML_title", true);
		$output .= '<div class="col-lg-12 col-md-12 col-sm-12 d-flex align-items-stretch flex-row links"><div class="row fixo-img"><hr/><div class="col-md-6 order-sm-1 order-md-1" style="flex: 0 0 50%; border-right: 1px solid black;">';
		$link = get_permalink($post->ID);
		$author = get_the_author_meta( 'display_name', $post->post_author);
		$author_url = get_author_posts_url($post->post_author);
		$date = get_the_time('d/m', $post->ID);
		$img_url = get_the_post_thumbnail_url($post->ID, 'full');
		
		$output .= '<div class="flex-jac"><p class="jac-author">'.$date.'</p><p class="jac-author"><a href="'.$author_url.'">'.$author.'</a></p></div>';
		
		if($html_title){ 
		   $output .= '<a href="'.$link.'"><h1>'.$html_title.'</h1></a>';
		}else{ 
		  $output .= '<a href="'.$link.'"><h1>'.get_the_title($post->ID).'</h1></a>';
		}
		
		
		$output .= '</div>';
		$output .= '<div class="col-md-6 order-md-2 fixo-excerpt"><p>'.get_the_excerpt($post->ID).'</p></div></div></div>';
		$output .= '<div class="col-md-12 fixo-img-area"><a class="img-overlay" href="'.$link.'"><img src="'.$img_url.'"/><div class="overlay"></div></a>';
		$output .= '</div></div>';
	}
	
	$args = array(
		'numberposts' => 8,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'offset' => 27,
		'category__not_in' => array(273, 57)
	);

	$recent_posts = get_posts($args);
	
	$output .= '<div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch flex-row"><div class="row news-jacobin">';
	
	foreach($recent_posts as $post){
		$html_title = get_post_meta($post->ID, "HTML_title", true);
		$output .= '<div class="news-link">';
		$link = get_permalink($post->ID);
		$date = get_the_time('d/m', $post->ID);
		
		$output .= '<div class="flex-jac"><p class="jac-author">'.$date.'</p></div>';
		if($html_title){ 
		   $output .= '<a href="'.$link.'"><h3>'.$html_title.'</h3></a>';
		}else{ 
		  $output .= '<a href="'.$link.'"><h3>'.get_the_title($post->ID).'</h3></a>';
		}
		
		$output .= '</div>';
	}
	
	$output .= '</div></div></div>';
	
	return $output;
}
add_shortcode('jacobin_fixo','wppop_jacobin_fixo');

/*
 * Woocommerce Remove excerpt from single product
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'the_content', 20 );


/********************
 *  Mostrar post da revista
 *
 ********************/

function popsol_show_post_revista($atts){
  $a = shortcode_atts(array('page'=>'front'),$atts);
  $post = get_post($atts['post']);
  $link = get_permalink($post->ID);

  $img = $atts['img'];
  // $link = $atts['link'];
  // $title = $atts['title'];

	$out = '<div class="mag"><div class="column-st">';
  $out .= '<div class="revista"><div class="title-issue">';
  $out .= '<ul><li>edição especial</li><li>verão de 2020</li></ul>';
  $out .= '<h1>Derrubem este muro!</h1></div>';
  $out .= '<a href="/loja/revista/jacobin-brasil-2-derrubem-este-muro/">';
  $out .= '<img class="scale-with-grid" src="'.$img.'" ';
  $out .= 'atl="Capa da Revista Jacobin Brasil - Edição Especial de verão" /></a></div>';
	$out .= '</div>';
	$out .= '<div class="column-nd">';
  $out .= '<a href="'.$link.'"><img src="'.p_timthumb(600, 600, 'c', 100, 'v', null, null, null, $post->ID).'/></a>';
	$out .= '<div class="issue">';
	$out .= '<p>NESSA EDIÇÃO</p>';
	$out .= '<a href="'.$link.'"><h2>'.$post->post_title.'</h2></a>';
	$out .= '<div class="meta">';
	$out .= '<p class="jac-author date">'.get_the_time('d M',$post->ID).'</p>';
	$out .= '<p class="jac-author"><a href="'.get_author_posts_url($post->post_author).'">'.get_the_author_meta( 'display_name', $post->post_author).'</a></p>';
	$out .= '</div>';
	$out .= '<p>'.$post->post_excerpt.'</p></div>';
  $out .= '<ul><li><a href="/#Assinar">ASSINAR</a></li>';
  // $out .= '</div><ul><li><a href="/#Assinar">ASSINAR</a></li>';
  $out .= '<li><a href="/loja/revista/jacobin-brasil-2-derrubem-este-muro/">COMPRAR</li></ul>';
	$out .= '</div></div>';
	
	return $out;
}
add_shortcode('revista','popsol_show_post_revista');

/********************
 *  Mostrar post da revista
 *
 ********************/

function popsol_olho_de_gato($atts){
    $a = shortcode_atts(array('page'=>'front'),$atts);
    $t = $atts['texto'];
    $o = $atts['olho'];
    
	$out = '<div class="cat-eye">';
	$out.= "<p>".$t;
	$out.= '</p><p class="olho">'.$o.'</p>';
	$out.= '</div>';
	
	return $out;
}
add_shortcode('olho-de-gato','popsol_olho_de_gato');

function action_woocommerce_order_status_changed($order_id, $old_status, $new_status) { 
    //$itens = array();
    // $order = wc_get_order($order_id);
    // foreach ($order->get_items() as $item){
    //     $itens[] = $item['product_id'];
    // }
    //wp_mail('jaqueline.pnascimento@gmail.com', 'JACOBIN STATUS', $order_id.' - old_status: '.$old_status.' - new_status: '.$new_status);
    // if(in_array(816, $itens)){
    //     $product = wc_get_product(816);
    //     $permission = wc_get_customer_download_permissions($order->get_customer_id());
        
    //     if(count($permission) == 0){
    //         $existing_download_ids = $product->get_downloads();
    //         foreach($existing_download_ids as $d){
    //             $perm = wc_downloadable_file_permission($d['id'], $product, $order);
    //         }
    //     }
    // }else{
    //     if(!empty(array_intersect(array(817, 818, 819), $itens))){
    //         foreach ($itens as $i){
    //             $product = wc_get_product($i);
    //             $existing_download_ids = $product->get_downloads();
    //             foreach($existing_download_ids as $d){
    //                 $perm = wc_downloadable_file_permission($d['id'], $product, $order);
    //             }
    //         }
    //     }
    // }
}; 
         
// add the action 
//add_action( 'woocommerce_order_status_changed', 'action_woocommerce_order_status_changed', 10, 3 ); 

function add_notes_compra(){
    echo '<p style="width: 100%;">Prazo de ENVIO 2 a 6 semanas a partir do pagamento</p><br/>';
}

add_action('woocommerce_review_order_before_submit', 'add_notes_compra', 10, 0);

// renae order status
add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );
function wc_renaming_order_status( $order_statuses ) {
  foreach ( $order_statuses as $key => $status ) {
    if ( 'wc-processing' === $key ){
      $order_statuses['wc-processing'] = _x( 'Pagamento Aprovado', 'Order status', 'woocommerce' );
    }
  }
  return $order_statuses;
}

// Adicionar campo número obrigatório ao formulário de checkout do Woocommerce

add_filter( 'woocommerce_checkout_fields' , 'bbloomer_add_field_and_reorder_fields' );
   
function bbloomer_add_field_and_reorder_fields( $fields ) {
    // Add New Fields
        
    $fields['billing']['billing_houseno'] = array(
    'label'     => 'Número',
    'placeholder'   => '',
    'priority' => 51,
    'required'  => true,
    'clear'     => true
     );
   
    $fields['shipping']['shipping_houseno'] = array(
    'label'     => 'Número',
    'placeholder'   => '',
    'priority' => 51,
    'required'  => true,
    'clear'     => true
     );     
      
    return $fields;
}
  
// ------------------------------------
// Add Billing House # to Address Fields
  
add_filter( 'woocommerce_order_formatted_billing_address' , 'bbloomer_default_billing_address_fields', 10, 2 );
  
function bbloomer_default_billing_address_fields( $fields, $order ) {
    $fields['billing_houseno'] = get_post_meta( $order->get_id(), '_billing_houseno', true );
    return $fields;
}
  
// ------------------------------------
// Add Shipping House # to Address Fields
  
add_filter( 'woocommerce_order_formatted_shipping_address' , 'bbloomer_default_shipping_address_fields', 10, 2 );
  
function bbloomer_default_shipping_address_fields( $fields, $order ) {
    $fields['shipping_houseno'] = get_post_meta( $order->get_id(), '_shipping_houseno', true );
    return $fields;
}
  
// ------------------------------------
// Create 'replacements' for new Address Fields
  
add_filter( 'woocommerce_formatted_address_replacements', 'add_new_replacement_fields',10,2 );
  
function add_new_replacement_fields( $replacements, $address ) {
    $replacements['{billing_houseno}'] = isset($address['billing_houseno']) ? $address['billing_houseno'] : '';
    $replacements['{shipping_houseno}'] = isset($address['shipping_houseno']) ? $address['shipping_houseno'] : '';
    return $replacements;
}


/* Show custom fields on Account details page */
// add_action( 'woocommerce_edit_account_form', 'my_woocommerce_edit_account_form' );
function my_woocommerce_edit_account_form() {
    $user_id = get_current_user_id();
    $user    = get_userdata( $user_id );

    if ( !$user ) return;

    $billing_hn = get_user_meta( $user_id, 'billing_houseno', true );
?>
    <fieldset>
        <legend>Custom information</legend>

        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
            <label for="billing_houseno">Billing VAT</label>
            <input type="text" name="billing_houseno" id="billing_houseno" value="<?php echo esc_attr( $billing_hn ); ?>" class="input-text" required="true" />
        </p>
        <div class="clearfix"></div>

    </fieldset>
   <?php
}

/* Below code save extra fields when account details page form submitted */
// add_action( 'woocommerce_save_account_details', 'my_woocommerce_save_account_details' );
function my_woocommerce_save_account_details( $user_id ) {

    if ( isset( $_POST['billing_houseno'] ) ) {
        update_user_meta( $user_id, 'billing_houseno', sanitize_text_field( $_POST['billing_houseno'] ) );
    }

}

add_filter( 'woocommerce_default_address_fields', 'misha_add_field' );
 
function misha_add_field( $fields ) {
 
	$fields['houseno']   = array(
		'label'        => 'Número',
		'required'     => true,
		'class'        => array( 'form-row-wide'),
		'priority'     => 59,
		'placeholder'  => '',
	);
 
	return $fields;
 
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Número').':</strong> <br/>' . get_user_meta( $order->user_id, 'billing_houseno', true ) . '</p>';
}

// code to add to posts// the content - Adiciona banner aos posts
function prefix_insert_post_ads( $content ) {
    //$banner_url = 'https://veneta.com.br/produto/pre-venda-delivery-fight-a-luta-contra-os-patroes-sem-rosto/';
    //$banner_img = 'https://jacobin.com.br/wp-content/uploads/2020/10/banner_jacobin_brasil.jpeg';
	
	$banner_url = 'https://www.amazon.com.br/gp/product/6586460301';
    $banner_img = 'https://jacobin.com.br/wp-content/uploads/2021/10/algoritmos-da-opressao.jpg';

    $ad_code = '<div class="cupom"><a href="'.$banner_url.'" target="_blank"><img src="'.$banner_img.'"/></a></div>';
    
    //$ad_code2 = '<div class="cupom"><a href="https://autonomialiteraria.com.br/loja/teoria-politica/antifa-o-manual-antifascista/" target="_blank"><img src="https://jacobin.com.br/wp-content/uploads/2020/06/DECONTO_AUTONOMIA_JACOBINO.jpeg"/></a></div>';
 
    if ( is_single() && !is_admin() && !is_product()) {
        global $post;
        $hide = get_post_meta($post->ID, 'esconder_', true);
        if($hide == false){
            return prefix_insert_after_paragraph($ad_code, $content);
        }
    }
    return $content;
}

// Add banner to content
add_filter( 'the_content', 'prefix_insert_post_ads' );
  
// Parent Function that makes the magic happen
function prefix_insert_after_paragraph( $insertion, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    
    // $idx = 0;
    // foreach ($insertion as $banner){
        foreach($paragraphs as $index => $paragraph) {
            if( trim ( $paragraph ) ) {
                $paragraphs[$index] .= $closing_p;
            }
     
            // show only on big texts
            if ( $index == intval(count($paragraphs)/2 - 4)){ 
                if( intval(count($paragraphs)/2) - 4 > 0){
                    $idx = $index + 3;
                }else{
                    $idx = $index;
                }
                $paragraphs[$idx] .= $insertion;
            }
        }
    // }
    return implode( '', $paragraphs );
}


/**
 * Links previous orders to a new customer upon registration.
 *
 * @param int $user_id the ID for the new user
 */
function sv_link_orders_at_registration( $user_id ) {
    $count = wc_update_new_customer_past_orders( $user_id );
    update_user_meta( $user_id, '_wc_linked_order_count', $count );
}
add_action( 'woocommerce_created_customer', 'sv_link_orders_at_registration' );

/**
 * Shows the "orders linked" notice upon first account visit if any were linked at registration.
 *
 * USES WOOCOMMERCE 2.6+ -- update the action name for older versions
 */
// function maybe_show_linked_order_count() {

//     $user_id = get_current_user_id();

//     if ( ! $user_id ) {
//         return;
//     }

//     // check if we've linked orders for this user at registration
//     $count = get_user_meta( $user_id, '_wc_linked_order_count', true );

//     if ( $count && $count > 0 ) {
    
//         $name = get_user_by( 'id', $user_id )->display_name;

//         $message  = $name ? sprintf( __( 'Welcome, %s!', 'text' ), $name ) : __( 'Welcome!', 'text' );
//         $message .= ' ' . sprintf( _n( 'Your previous order has been linked to this account.', 'Your previous %s orders have been linked to this account.', $count, 'text' ), $count );
//         $message .= ' <a class="button" href="' . esc_url( wc_get_endpoint_url( 'orders' ) ) . '">' . esc_html__( 'View Orders', 'text' ) . '</a>';

//         // add a notice with our message and delete our linked order flag
//         wc_print_notice( $message, 'notice' );
//         delete_user_meta( $user_id, '_wc_linked_order_count' );
//     }
// }
// add_action( 'woocommerce_account_dashboard', 'maybe_show_linked_order_count', 1 );
