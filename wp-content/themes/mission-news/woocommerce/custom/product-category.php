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
  $category = get_queried_object();
  //$category = get_term_by( 'id', $category->term_id, 'product_cat' );
  //print_r($category);
  //echo '<br>catname: '.$category->slug;

  //echo '<br>Cate: '.$cate;
  if($product_category = get_term_by( 'id', $category->term_id, 'product_cat' )){ // Si existe la categoria
    $args = array(
      'posts_per_page' => 1,
      'tax_query' => array(
      'relation' => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'field' => 'slug',
          'terms' => $product_category->slug
        )
      ),
      'post_type' => 'product',
      'orderby' => 'date,',
      'order' => 'DESC'
    );
    $destargs = $args;
    $destargs['posts_per_page'] = 1;
    $products = new WP_Query( $destargs );
    $show_close_section = 0;

    if ( have_posts() ) :
      echo '<section>
                <header class="so__header">
                  <h2 class="so__heading">
                    ' . $product_category->name . '
                  </h2>
                </header>
                <div class="so items">
                ';
      while($products->have_posts()) {
        $products->the_post();
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
        include(get_template_directory()."/woocommerce/custom/archive-product-destaque.php");
      }
    endif;
    $show_close_section = 1;


    /* Follows the featured product */
    $destargs2 = $args;
    $destargs2['posts_per_page'] = 10;
    $destargs2['offset'] = 1;
    //print_r($destargs2);
    $products = new WP_Query( $destargs2 );

    if ( have_posts() ) :      
      while ( $products->have_posts() ) {
        $products->the_post();
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
          ?>
          <article class="so__item">
            <div class="so__container">
             <?php if($image != ''){?>
                <figure class="so__frame">
                  <a class="so__link" href="<?php the_permalink(); ?>">
                    <img alt="<?php the_title(); ?>" class="so__image" src="<?php echo $image;?>">
                  </a>
                </figure>
              <?php }?>
              <div class="so__main">
                <h1 class="so__title">
                  <a class="so__link" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h1>
                <h2 class="so__info">
                  <mark class="so__cost">
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
              </div>
            </div>
          </article>
         
      <?php } // end while
      
      echo '</div></section>';
    endif;

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
