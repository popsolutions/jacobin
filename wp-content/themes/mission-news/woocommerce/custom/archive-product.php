<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
get_header( 'shop' );

?>
<main id="loja-produtos">
<?php
$cates=array("destaque@1","livro@5","revista@5","poster@5","resto@5");
foreach($cates as $catcan){
  $cat_can = explode("@",$catcan);
  $cate = $cat_can[0];
  $cant = $cat_can[1];
//echo '<br>Cate: '.$cate;
  if($product_category = get_term_by( 'slug', $cate, 'product_cat' )){ // Si existe la categoria
    $args = array(
      'posts_per_page' => $cant,
      'tax_query' => array(
      'relation' => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'field' => 'slug',
          // 'terms' => 'white-wines'
          'terms' => $product_category->slug
        )
      ),
      'post_type' => 'product',
      'orderby' => 'date,',
      'order' => 'DESC,'
    );
    $products = new WP_Query( $args );
    if ( have_posts() ) :
      if($product_category->slug != 'destaque'){
        echo '<section class="so-cy">
                <header class="so-cy__header">
                  <h2 class="so-cy__heading">
                    ' . $product_category->name . '
                  </h2>
                  <p class="so-cy__view">
                    <a href="' . get_term_link( $product_category ) . '">Ver todos</a>
                  </p>
                </header>
                <div class="so-cy__items">
                ';
      }
      $contador = 1;
      $cierre = 0;
      while ( $products->have_posts() ) {
        $products->the_post();
        $producto = wc_get_product( $products->post->ID );
        $precio = $producto->get_price_html();
        $image = '';
        if ( has_post_thumbnail() ) { 
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $products->post->ID ), 'single-post-thumbnail' );
          $image = $image[0];
        }
        //print_r($products);
        if($products->post->post_excerpt != ''){
          $texto = $products->post->post_excerpt;
        }elseif($products->post->post_content){
          $texto = wp_trim_words( $products->post->post_content, 50, '...' );
        }else{
          $texto = '';
        }
        if($product_category->slug == 'destaque'){
          include(get_template_directory()."/woocommerce/custom/archive-product-destaque.php");
        }else{
        
          $artclass = 'py';
          $itemclass = '';
          if($contador > 1){
            $artclass = 'sy';
            $itemclass = '__item';
          }
          if($contador == 2){
            echo '<div class="so-sy">';
            $cierre = 1;
          }
          ?>
          <article class="so-<?php echo $artclass.$itemclass;?>">
            <div class="so-<?php echo $artclass;?>__container">
             <?php if($image != ''){?>
                <figure class="so-<?php echo $artclass;?>__frame">
                  <a class="so-<?php echo $artclass;?>__image-link" href="<?php the_permalink(); ?>">
                    <img alt="<?php the_title(); ?>" class="so-<?php echo $artclass;?>__image" src="<?php echo $image;?>">
                  </a>
                </figure>
              <?php }?>
              <div class="so-<?php echo $artclass;?>__main">
                <h1 class="so-<?php echo $artclass;?>__title">
                  <a class="so-<?php echo $artclass;?>__link" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h1>
                <h2 class="so-<?php echo $artclass;?>__info">
                  <mark class="so-<?php echo $artclass;?>__cost">
                    <?php //echo $products->get_price();?>
                    <?php echo $product->get_price_html(); ?>
                  </mark>
                </h2>
                <h4>
                <?php 
                  $atc_args = array('class' => 'single_add_to_cart_button button alt');
                  wc_get_template( 'loop/add-to-cart.php', $atc_args );
                  ?>
                </h4>
                <?php if($texto != '' && $contador == 1){?>
                  <p class="so-<?php echo $artclass;?>__desc"><?php echo $texto;?></p>
                <?php }?>
              </div>
            </div>
          </article>
        <?php }?>
      <?php
      $contador++;
      }
      if($cierre == 1){echo '</div>';}
      if($product_category->slug != 'destaque'){echo "</section>";}
    endif;
  }
}
?>
</main>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
