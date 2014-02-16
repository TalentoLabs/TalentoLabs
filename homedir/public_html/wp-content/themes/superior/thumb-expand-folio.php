<?php
// Template Name: Thumb Expand Portfolio
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
        	<ul id="og-grid" class="og-grid"> 
				<?php
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$ploop = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => $data['te_portfolio_items'],  'paged' => $paged ) );
			    ?>
			    <?php if ($ploop->have_posts()) : while ($ploop->have_posts()) : $ploop->the_post();  ?>
        			<li>
        			<?php
        				$thumb = get_post_thumbnail_id();
    					$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    					$big_image = aq_resize( $img_url, 500, 400, true ); //resize & crop the image
    					$small_image = aq_resize( $img_url, 250, 250, true ); //resize & crop the image  
  					?>
            			<a href="<?php the_permalink(); ?>" data-largesrc="<?php echo $big_image ?>" data-title="<?php the_title(); ?>" data-description="<?php  echo excerpt( 38 ) ?>....">
							<img src="<?php echo $small_image ?>" alt="<?php the_title(); ?>"/>
                            <span class="font-icon-circle"><i class="icon-long-arrow-down"></i></span>
						</a>
            		</li>
            	<?php  endwhile; else: ?>
            	<div> no entries found.</div>
            	<?php endif; ?>
           	</ul>
            <div class="alignright"> <?php if (function_exists("pagination")) { pagination($ploop->max_num_pages);} ?></div> 

    	</div>
  	</div>
</div>
<?php get_footer(); ?>