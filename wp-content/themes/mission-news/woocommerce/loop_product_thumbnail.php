<?php
/**
 * Edit default Woocommerce product loop thumbnail template
 * As there is no dedicated Woocommerce template (eg wp-content/plugins/woocommerce/templates/loop/price.php)
 * because it's generated using filter, we must remove Woocommerce hook, and add our own "at the same place"
 * to edit the product loop thumbnail template
 * tested up to (12/10/2020) : 
 * Wordpress 5.7
 * Woocommerce 3.8.1
 * PHP 7.3.7
 * Sage 9.0.9
 * source: https://gist.github.com/krogsgard/3015581
 * HOW TO USE: add in active theme functions.php file
 */

/**
 * Remove woocommerce hooked action (method woocommerce_template_loop_product_thumbnail on woocommerce_before_shop_loop_item_title
 * hook
 */
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
/**
 * Add our own action to the woocommerce_before_shop_loop_item_title hook with the same priority that woocommerce used
 */
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 */
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    /**
     * echo thumbnail HTML
     */
    function woocommerce_template_loop_product_thumbnail()
    {
        echo woocommerce_get_product_thumbnail();
    }
}

/**
 * WooCommerce Product Thumbnail
 */
if (!function_exists('woocommerce_get_product_thumbnail')) {

    /**
     * @param string $size
     * @param int $placeholder_width
     * @param int $placeholder_height
     * @return string
     */
    function woocommerce_get_product_thumbnail($size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0)
    {
        global $post, $woocommerce;
        
        //NOTE: those are PHP 7 ternary operators. Change to classic if/else if you need PHP 5.x support.
        $placeholder_width = !$placeholder_width ?
            wc_get_image_size('shop_catalog_image_width')[ 'width' ] :
            $placeholder_width;

        $placeholder_height = !$placeholder_height ?
            wc_get_image_size('shop_catalog_image_height')[ 'height' ] :
            $placeholder_height;

        /**
         * EDITED HERE: here I added a div around the <img> that will be generated
         */
        $output = '<div class="shop-prod-img">';

        /**
         * This outputs the <img> or placeholder image. 
         * it's a lot better to use get_the_post_thumbnail() that hardcoding a text <img> tag
         * as wordpress wil add many classes, srcset and stuff.
         */
        $output .= has_post_thumbnail() ?
            get_the_post_thumbnail($post->ID, $size) :
            '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';

        /**
         * Close added div .my_new_wrapper
         */
        $output .= '</div>';

        return $output;
    }
}