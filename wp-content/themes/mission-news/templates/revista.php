<div class="post-content">
  <ul class="encabezado-revista">
    <li class="izq">Número <?php the_field('numero_atual'); ?></li>
    <li class="cen"><a href="/loja/revista/<?php the_field('link_para_loja'); ?>">Comprar</a></li>
    <li class="der"><a href="assinar">Assinar</a></li>
  </ul>
  <h1 class="encabezado-revista"><?php the_field('titulo'); ?></h1>
  <?php
  $image = get_field('mockup');
  if (!empty($image)) {
  ?>
    <img class="aligncenter size-full" src="<?php echo esc_url($image); ?>" alt="<?php the_field('titulo'); ?>">
  <?php } ?>


  <p class="acapite"><?php the_field('frase'); ?></p>



  <section class="hm-sb2">
    <div class="hm-sb__container comprar-digital">
      <header class="hm-sb__header">
        <h2 class="hm-sb__heading"><a class="hm-sb__link" href="/loja/revista/<?php the_field('link_para_loja'); ?>">COMPRAR ESTA VERSÃO AVULSA</a></h2>
      </header>
    </div>
  </section>



  <section class="hm-sb2">
    <div class="hm-sb__container">
      <header class="hm-sb__header">
        <h1 class="hm-sb__heading"><a class="hm-sb__link" href="/assine">ASSINAR</a></h1>
        <p class="hm-sb__dek">Jacobin é uma voz proeminente na esquerda, oferecendo um ponto de vista socialista sobre política, economia e cultura.</p>

      </header>
      <h5>&nbsp;</h5>
      <dl class="hm-sb__medium">
        <dt class="hm-sb__price">
          <h4><a class="hm-sb__link" href="/assine">Plano Internacionalista</a></h4>
          <a class="hm-sb__link" href="/assine">
            R$ 25
          </a>
          <p class="hm-sb__desc">1 ANO : ASSINATURA DIGITAL (ACESSO A TODAS AS EDIÇÕES ANTERIORES)</p>
        </dt>
      </dl>
      <div style="clear: both; float: none;">&nbsp;</div>
      <dl class="hm-sb__medium">
        <dt class="hm-sb__price">
          <h4><a class="hm-sb__link" href="/assine">Plano Jacobino</a></h4>
          <a class="hm-sb__link" href="/assine">
            R$ 80
          </a>
          <p class="hm-sb__desc">1 ANO : 2 EDIÇÕES IMPRESSA + ASSINATURA DIGITAL</p>
        </dt>
      </dl>
      <div style="clear: both; float: none;">&nbsp;</div>
      <dl class="hm-sb__medium">
        <dt class="hm-sb__price">
          <h4><a class="hm-sb__link" href="/assine">Plano Bolchevique</a></h4>
          <a class="hm-sb__link" href="/assine">
            R$ 140
          </a>
          <p class="hm-sb__desc">1 ANO : 2 EDIÇÕES IMPRESSA + ASSINATURA DIGITAL + LIVRO DA COLEÇÃO JACOBINA</p>
        </dt>
      </dl>
      <div style="clear: both; float: none;">&nbsp;</div>
    </div>
  </section>

  <?php
  $revista_cat_id = the_field('revista_category_id');
  echo '<br>RevID:'.$revista_cat_id;
  wp_reset_query();
  $the_query = new WP_Query(
    array(
      'posts_per_page' => 3,
      'category__in' => array(1176, 1227),
      'order' => 'DESC',
      'limit' => 3
    )
  );
  if ($the_query->have_posts()) {
    $notas = array();
    $conta = 1;
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $notas[$conta]['title'] = get_the_title();
      $notas[$conta]['link'] =  get_permalink();
      if ($conta == 2) {
        $secimg = get_the_post_thumbnail(get_the_ID(), 'full');
      }
      $conta++;
    }
    print_r($notas);
  ?>
    <section class="revista-notas">
      <div class="seccion">
        <h2>Armas da crítica</h2>

        <h3>Texto debajo del título</h3>
      </div>
      <div class="columnas" style="margin: 0 auto; padding: 0px; width: 70%;">
        <div class="columna1 soloTexto" style="float: left; margin: 0px; padding: 0px; width: 47%; margin-right: 30px;">
          <?php if (isset($secimg) && $secimg != '') { ?>
            <ul class="lcp_catlist" id="lcp_instance_0">
              <li><a href="https://jacobinlat.com/2022/06/22/como-el-sol-cuando-amanece-yo-soy-libre/" title="Como el sol cuando amanece, yo soy libre"><img width="783" height="616" src="<?php echo $secimg; ?>" </a></li>
            </ul>
          <?php } ?>
        </div>
        <div class="columna2 soloimagen" style="float: left; margin: 0px; padding: 0px; width: 49%;">
          <ul class="lcp_catlist" id="lcp_instance_0">
            <li><a href="https://jacobinlat.com/2022/06/22/sintomas-morbidos/" class="soloTexto">Síntomas mórbidos</a><a href="https://jacobinlat.com/author/martin-mosquera/" title="Martín Mosquera">Martín Mosquera</a></li>
            <li><a href="https://jacobinlat.com/2022/06/22/como-el-sol-cuando-amanece-yo-soy-libre/" class="soloTexto">Como el sol cuando amanece, yo soy libre</a><a href="https://jacobinlat.com/author/pablo-stefanoni/" title="Pablo Stefanoni">Pablo Stefanoni</a></li>
            <li><a href="https://jacobinlat.com/2022/06/25/volver-peores/" class="soloTexto">Volver peores</a><a href="https://jacobinlat.com/author/rafael-khachaturian/" title="Rafael Khachaturian">Rafael Khachaturian</a></li>
          </ul>
        </div>
      </div>
    </section>
  <?php } ?>
</div>