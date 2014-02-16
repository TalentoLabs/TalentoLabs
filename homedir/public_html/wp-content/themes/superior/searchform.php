 <form action="<?php echo home_url( '/' ); ?>" method="get" class="search-wrapper cf">
        <input type="text" name="s" id="search" placeholder="<?php _e('Search here...', 'theme_setup' ); ?>" value="<?php the_search_query(); ?>" />
        <button type="submit">Search</button>
    </form>