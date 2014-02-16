<?php
get_header();
?>

<div class="single-folio-wapper">
  <div class="container ">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="row">
      <div class="col-sm-8">
       <?php 
       $thumb = get_post_thumbnail_id();
       $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
       $image = aq_resize( $img_url, 690, 450, true ); //resize & crop the image
      ?> 
       <?php if($image): ?>   
       <div class="single-folio-img"> 
          <a href="<?php echo $img_url ?>" class="colorlightbox"><img src="<?php echo $image ?>"> </div></a>
       <?php endif; ?>
        <div class="single-folio-info"> 
         <div class="row">
          <div class="col-sm-6">
          <h1 class="big-h visible-xs"><?php the_title(); ?><span class="heading-end-dot">.</span></h1>
            <h3>Challenge.</h3>
            <?php if(get_post_meta($post->ID, 'challenge', true)): ?>
                <p> <?php echo get_post_meta( get_the_ID(), 'challenge', true ) ?></p>
              <?php endif; ?>   </div> 
          <div class="col-sm-6">

            <h3>Solution.</h3>
             <?php if(get_post_meta($post->ID, 'solution', true)): ?>
                <p> <?php echo get_post_meta( get_the_ID(), 'solution', true ) ?></p>
              <?php endif; ?>   
          </div>
        </div>
      </div>
    </div>  
    <div class="col-sm-4">
      <h1 class="big-h hidden-xs"><?php the_title(); ?><span class="heading-end-dot">.</span></h1>
      <div class="single-folio-details"><?php the_content(); ?>
      <?php if(get_post_meta($post->ID, 'project_site_link', true)): ?>
        <p><a href="<?php echo get_post_meta( get_the_ID(), 'project_site_link', true ) ?>" class="met-button"><i class="icon-long-arrow-right"></i> VISIT WEBSITE</a></p>
      <?php endif; ?>  
       
      <?php $item_categories = get_the_term_list( $post->ID, 'Categories', '<li><i class="icon-ok"></i> ', '</li><li><i class="icon-ok"></i> ', '</li>' ); ?>
      
      <ul class="single-folio-cat"> 
       <?php echo $item_categories ?>
       </ul>
      </div>
      </div>
      </div>
       
      </div> 
                    <?php endwhile; else: ?>
		            <p>Sorry, no posts matched your criteria.</p>
	                <?php endif; ?>	
                 </article>  
              </div>
   
 <?php get_footer(); ?>