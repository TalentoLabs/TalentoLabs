<?php
// Template Name: Full Width  Blog
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
        <ul class="full-blog-wapper">
        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $ploop = new WP_Query(array( 'posts_per_page' => $data['fw_post_items'], 'paged' => $paged ) );
         ?>
          
			    <?php  if ($ploop->have_posts()) : while ($ploop->have_posts()) : $ploop->the_post(); 

           $thumb = get_post_thumbnail_id();
           $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
           $image = aq_resize( $img_url, 510, 329, true ); //resize & crop the image  
          ?>
           <li> 
          <?php if($img_url): ?>
             <div class="container">
              <div class="row">
                <div class="col-sm-6 full-blog-img">
                  <div class="full-img"><a href="<?php echo $img_url ?>" class="colorlightbox"><img src="<?php echo $image ?>"></a></div>
                </div>
                <div class="col-sm-6 full-blog-details">
                  <div class="post-title">
                    <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?><span class="heading-end-dot">.</span></h1></a>
                  </div>
                <div class="post-details">
                  <p><?php echo excerpt( 42 ) ; ?>.... </p>
                  <p><a href="<?php the_permalink(); ?>" class="met-button"><i class="icon-long-arrow-right"></i> Read More</a></p>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
        <div class="container">
          <div class="row"> 
            <div class="col-sm-12 full-blog-details">
              <div class="post-title">
                <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?><span class="heading-end-dot">.</span></h1></a>
              </div>
              <div class="post-details">
                <p><?php echo excerpt( 42 ) ; ?>.... </p>
                <p><a href="<?php the_permalink(); ?>" class="met-button"><i class="icon-long-arrow-right"></i> Read More</a></p>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>  
                </li>
              <?php  endwhile; else: ?>
              <div> no entries found.</div>
              <?php endif; ?>
        <li style="padding: 0;">
          <div class="container">
            <div class="row"> 
              <div class="col-sm-12">
                <div class="alignright"> <?php if (function_exists("pagination")) { pagination($ploop->max_num_pages);} ?></div> 
              </div>
            </div>
          </div
        </li>
</ul>
<?php get_footer(); ?>