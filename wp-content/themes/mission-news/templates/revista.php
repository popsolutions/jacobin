<?php
function revista_seccion_notas($secc_id, $rev_cat, $photonum,$imgleft = 1)
{
  $textsec = '';
  $ret = '';
  switch ($secc_id) {
    case 1176:
      //$nomsec = 'Armas da crítica';
      $textsec = 'NÃO HÁ MELHOR DEFESA DO QUE UM BOM ATAQUE';
      break;
    case 1177:
      //$nomsec = 'Capital Cultural';
      $textsec = 'ESPAÇO LIVRE DE TERRAPLANISMO';
      break;
    case 1178:
      //$nomsec = 'Casa Grande';
      $textsec = '';
      break;
    case 1180:
      //$nomsec = 'Linha de Frente';
      $textsec = 'BARRICADAS CORTAM RUAS, MAS ABRE CAMINOS';
      break;
  }
  $nomsec = get_cat_name($secc_id);
  wp_reset_query();
  $the_query = new WP_Query(
    array(
      'posts_per_page' => 3,
      'category__and' => array($secc_id, $rev_cat),
      'order' => 'DESC',
      'limit' => 3
    )
  );
  //print_r($the_query);
  if ($the_query->have_posts()) {
    $notas = array();
    $conta = 1;
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $notas[$conta]['title'] = get_the_title();
      $notas[$conta]['link'] =  get_permalink();
      //$notas[$conta]['author'] =  get_the_author();
      $notas[$conta]['author'] =  get_the_author_posts_link();
      if ($conta == $photonum) {
        $secimg = get_the_post_thumbnail(get_the_ID(), 'full');
      }
      $conta++;
    }
    //print_r($notas);
    $ret = '
  <div class="seccion">
    <h2>' . $nomsec . '</h2>
    <h3>' . $textsec . '</h3>
  </div>
  <div class="columnas" style="margin: 0 auto; padding: 0px; width: 70%">';
    $ret_image = '
    <div class="columna1 soloTexto" style="float: left; margin: 0px; padding: 0px; width: 47%; margin-right: 30px;">';
    if (isset($secimg) && $secimg != '') {
      $ret_image .= '<ul class="lcp_catlist" id="lcp_instance_0">
          <li><a href="' . $notas[$photonum]['link'] . '" title="' . $notas[$photonum]['title'] . '">' . $secimg . '</a></li>
        </ul>';
    }
    $ret_image .= '</div>';
    $ret_text = '
    <div class="columna2 soloimagen" style="float: left; margin: 0px; padding: 0px; width: 49%;">
      <ul class="lcp_catlist" id="lcp_instance_0">';

    foreach ($notas as $nota) {
      $ret_text .= '
          <li><a href="' . $nota['link'] . '" class="soloTexto">' . $nota['title'] . '</a>' . $nota['author'] . '</li>';
    }
    $ret_text .= '
        </ul>
    </div>
    ';
    $ret .= ($imgleft == 1) ? $ret_image . $ret_text : $ret_text . $ret_image;
    $ret .= '
  </div>
  <div style="float: none; clear: both;"></div>';
  }
  return $ret;
}
?>
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

  <section class="revista-notas">
    <?php
    $revista_cat_id = get_field('revista_category_id');
    echo revista_seccion_notas(1176, $revista_cat_id,2);
    ?>
    <div class="rev_amar">
      <?php echo revista_seccion_notas(1177, $revista_cat_id, 1, 0); ?>
    </div>
    <?php echo revista_seccion_notas(1178, $revista_cat_id,1); ?>
    <div class="rev_amar">
      <?php echo revista_seccion_notas(1180, $revista_cat_id, 1,0); ?>
    </div>
  </section>

</div>