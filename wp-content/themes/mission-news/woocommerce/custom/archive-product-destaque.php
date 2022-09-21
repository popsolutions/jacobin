<div class="so items">
  <article class="so__item so-fe__item">
    <div class="so__container so-fe__container">
      <?php if($image != ''){?>
      <figure class="so__frame so-fe__frame">
        <a class="so__image-link so-fe__link" href="<?php the_permalink(); ?>">
          <img alt="<?php the_title(); ?>" class="so__image so-fe__image" src="<?php echo $image;?>">
        </a>
      </figure>
      <?php }?>
      <div class="so__main so-fe__main">
        <a name="18"></a>
        <h1 class="so__title so-fe__title">
          <a class="so__link so-fe__link" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h1>
        <h2 class="so__info so-fe__info">
          <mark class="so__cost so-fe__cost">
            <?php echo $product->get_price_html(); ?>
          </mark>
        </h2>
        <h4>
          <?php 
          $atc_args = array('class' => 'single_add_to_cart_button button alt');
          wc_get_template( 'loop/add-to-cart.php', $atc_args );
          ?>
        </h4>
        <?php if($texto != ''){?>
          <p class="so__desc so-fe__desc"><?php echo $texto;?></p>
        <?php }?>
      </div>
    </div>
  </article>
</div>