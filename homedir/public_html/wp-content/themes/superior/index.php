<?php get_header(); ?>
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
            <img src="<?php echo $image ?>">
          </div>
        <?php endif; ?>
          <div class="grid-post-dec">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="grid-post-info"> <?php the_date(); ?> by <?php the_author_link(); ?></div>
            <p><?php echo excerpt( 32 ) ; ?>.... </p>
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