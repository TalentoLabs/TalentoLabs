<?php
/*
Template Name: Full Width
*/
?>
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
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article>
   <?php the_content(); ?> 
  </article>
	<?php endwhile; else: ?>
		<!-- The very first "if" tested to see if there were any Posts to -->
		<!-- display.  This "else" part tells what do if there weren't any. -->
		<p>Sorry, no posts matched your criteria.</p>
	<!--End the loop -->
	<?php endif; ?> 
 <?php get_footer(); ?>