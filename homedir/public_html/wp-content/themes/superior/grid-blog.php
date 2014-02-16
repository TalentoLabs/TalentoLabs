<?php
// Template Name: Grid Blog
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
        <div class="col-sm-12"> 
        <div id="main-grid" role="main">
        	<ul class="grid-blog">
        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $ploop = new WP_Query(array( 'posts_per_page' => $data['grid_post_items'], 'paged' => $paged ) );
         ?>
          
			    <?php  if ($ploop->have_posts()) : while ($ploop->have_posts()) : $ploop->the_post(); 

           $thumb = get_post_thumbnail_id();
           $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
           $image = aq_resize( $img_url, 240, true ); //resize & crop the image
          ?>
           <li>
          <?php if($image): ?>
           <div class="grid-post-img"> 
            <a href="<?php echo $img_url ?>" class="colorlightbox"><img src="<?php echo $image ?>"></a>
           </div>
          <?php endif; ?>
          <div class="grid-post-dec">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="grid-post-info"> <?php echo get_the_date(); ?> by <?php the_author_link(); ?></div>
            <p><?php echo excerpt( 32 ) ; ?>.... <a href="<?php the_permalink(); ?>">Read more</a></p>
          </div>
          </li>  
              <?php  endwhile; else: ?>
              <div> no entries found.</div>
              <?php endif; ?>
            </ul>
          </div>
        <div class="alignright"> <?php if (function_exists("pagination")) { pagination($ploop->max_num_pages);} ?></div> 

    	</div>
  	</div>
</div>
<?php get_footer(); ?>