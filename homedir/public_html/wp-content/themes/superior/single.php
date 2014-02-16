<?php get_header();  ?>
	    

<div class="pages-wapper">
  <div class="container ">
    <div class="row">
      <div class="col-sm-9">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">   
          <div class="single-post">
            <?php
              $thumb = get_post_thumbnail_id();
              $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
              $image = aq_resize( $img_url, 778, 392, true ); //resize & crop the image
            ?>
            <?php if($image): ?> 
              <div class="single-post-img"> 
                <img src="<?php echo $image ?>">
              </div>
            <?php endif; ?>
            <div class="single-post-content">
              <div class="single-post-title">
                <h1 class="big-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to<?php the_title_attribute(); ?>"><?php the_title(); ?><span class="heading-end-dot">.</span></a></h1>
              </div>
              <div class="single-post-info">
                <span><i class="icon-time"></i> <?php echo get_the_time('d M Y') ; ?> </span> <span><i class="icon-user"></i> <?php the_author_posts_link(); ?></span> <span><i class="icon-comment"></i> <?php comments_popup_link( __( '0 ', 'theme_setup'  ), __( '1 ', 'theme_setup' ), __( '% Comments', 'theme_setup' ) ); ?> </span>  <span><i class="icon-tag"></i> <?php the_category(', ') ?></span><span><i class="icon-tags"></i> <?php the_tags(); ?> </span>  
              </div>
              <div class="post-content">
                <?php the_content(); ?>  
              </div>
	             <?php comments_template( '', true ); ?> 
            </div>
          </div>
        </article>
        <?php endwhile; else: ?>
	       <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
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