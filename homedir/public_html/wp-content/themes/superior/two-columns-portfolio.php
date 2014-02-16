<?php
// Template Name: Two Columns Portfolio 
get_header(); 
?>
<?php if(get_post_meta($post->ID, 'page_title', true) == 'hide'): ?>
    <div class="clear"></div>
<?php else: ?> 
  <div class="page-title">
    <div class="container ">
      <div class="row">
        <div class="col-sm-12">
          <div class="big-heading">
            <h2 ><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to<?php the_title_attribute(); ?>"><?php the_title(); ?><span class="heading-end-dot">.</span></a></h2>
              <?php if(get_post_meta($post->ID, 'heading_dec', true)): ?>
                <p> <?php echo get_post_meta( get_the_ID(), 'heading_dec', true ) ?></p>
              <?php endif; ?>   
          </div>
        </div>
      </div>
    </div>
  </div> 
<?php endif; ?>
<div class="container">
  <div class="row">
    <div class="span12">
      <div class="filter-tabs">
        <ul class="filter">
        <li><a href="#" data-filter="*" class="active">All</a></li>
      
        <?php 
          $terms = get_terms('Categories', $args); 
            $count = count($terms);  
            $i=0; 
            if ($count > 0) { 
              foreach ($terms as $term) { 
                $i++; 
                $term_list .= '<li><a href="#" data-filter=".'. $term->slug .'" >' . $term->name . '</a></li>'; 
                if ($count != $i)
                { $term_list .= ''; }
                else 
                { $term_list .= ''; } } 
              echo $term_list; }
          ?>
        </ul>
        </div>
    </div>
  </div>
  <div class="row">
        <div class="col-sm-12"> 
          <div class="portfolio-contener"> 
        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $ploop = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => $data['te_portfolio_items'],  'paged' => $paged ) );
          ?>
          <?php if ($ploop->have_posts()) : while ($ploop->have_posts()) : $ploop->the_post();

                $terms = get_the_terms( get_the_ID(), 'Categories' );  
          ?>
            <div class="portfolio-item portfolio-2col <?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>">
              <?php
              $thumb = get_post_thumbnail_id();
              $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
              $image = aq_resize( $img_url, 540, 475, true ); //resize & crop the image  
            ?>
              <div class="item-dec">    
                <div class="item-img">
                  <a href="<?php echo $img_url ?>" class="colorlightbox"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>"/></a>
                </div>
                <div class="item-info">
                  <h5><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h5>
                  <div class="item-date"> <?php echo get_the_date(); ?></div>
                </div>
              </div>

            </div>
              <?php  endwhile; else: ?>
              <div> no entries found.</div>
              <?php endif; ?>
            </div>
            <div class="alignright"> <?php if (function_exists("pagination")) { pagination($ploop->max_num_pages);} ?></div> 

      </div>
    </div>
</div>
<?php get_footer(); ?>