<div class='search-form-container'>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">
        <input id="search-field" type="search" class="search-field" value="" name="s"
               title="<?php esc_attr_e( 'Buscar', 'mission-news' ); ?>" placeholder="<?php esc_attr_e( 'Busque a palavra e pressione o enter', 'mission-news' ); ?>" />
        <input type="submit" class="search-submit" value='<?php esc_attr_e( 'Buscar', 'mission-news' ); ?>'/>
    </form>
</div>