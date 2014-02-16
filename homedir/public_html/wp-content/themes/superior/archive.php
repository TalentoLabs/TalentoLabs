 <?php get_header(); ?>
    

 <div class="page-title">
  <div class="container ">
    <div class="row">
      <div class="col-sm-12">
        <div class="big-heading">

      <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
      <?php /* If this is a category archive */ if (is_category()) { ?>
        <h2><?php _e("Category:", "et"); ?> <span class="sepace"></span><?php single_cat_title(); ?><span class="heading-end-dot">.</span> </h2>
      <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
        <h2><?php _e("Tag:", "et"); ?> <span class="sepace"></span><?php single_tag_title(); ?><span class="heading-end-dot">.</span></h2>
      <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
        <h2><?php _e("Day:", "et"); ?> <span class="sepace"></span><?php the_time('F jS, Y'); ?><span class="heading-end-dot">.</span></h2> 
      <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <h2><?php _e("Month:", "et"); ?><span class="sepace"></span> <?php the_time('F, Y'); ?><span class="heading-end-dot">.</span></h2>
      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
        <h2><?php _e("Year:", "et"); ?> <span class="sepace"></span> <?php the_time('Y'); ?><span class="heading-end-dot">.</span></h2>
      <?php /* If this is an author archive */ } elseif (is_author()) { ?>
        <h2><?php _e("Author:", "et"); ?><span class="heading-end-dot">.</span> </h2>
      <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h2><?php _e("Blog Archives:", "et"); ?><span class="heading-end-dot">.</span></h2>
     <?php } ?> 
      <?php
            global $data; 
              $archive_desc = $data['archive_desc'];
              if ($archive_desc ) {   
              ?>
              <p><?php echo $archive_desc; ?> </p>
              <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="container ">
  <div class="row">
    <div class="col-sm-12">
  
   <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
    <div id="main-grid" role="main">
     <ul class="grid-blog"> 
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 

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
            <p><?php echo excerpt( 30 ) ; ?>.... <a href="<?php the_permalink(); ?>">Read more</a></p>
          </div>
        </li> 
       
      <?php endwhile; ?>
      </ul>
    </div>
  <div class="alignright"> <?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages);} ?></div> 
       <?php endif; ?>
   </article>
   </div>  
  </div>
   </div>
  <?php get_footer(); ?>