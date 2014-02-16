<?php get_header(); ?>
    
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
<div class="pages-wapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-9">
        <div class="single-post">
        <?php     
          $thumb = get_post_thumbnail_id();
          $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
          $image = aq_resize( $img_url, 778, 392, true ); //resize & crop the image 
        ?>
          
          <div class="single-post-img">
            <img src="<?php echo $image ?>">
          </div>
          <div class="single-post-content">
          
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="post-content page-content">
              <article>
                <?php the_content(); ?>
              </article>
            </div>
            <?php comments_template( '', true ); ?> 
	        <?php endwhile; else: ?>

		        <p>Sorry, no posts matched your criteria.</p>	
	 
   	      <?php endif; ?>
          </div>
		    </div>
      </div> 
      <div class="col-sm-3">
        <div class="sidebar">
        <?php
         if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Sidebar')): 
         endif;
        ?>
        </div>  
      </div>  	
    </div>
  </div>
</div>
<?php get_footer(); ?>