<?php
// Template Name: Dynamic Grid Portfolio
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
    		<div class="dynamic-folio">
        		<ul id='dynamic-grid'>
				<?php
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$ploop = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => $data['dg_portfolio_items'], 'paged' => $paged ) );
			    ?>
			    <?php if ($ploop->have_posts()) : while ($ploop->have_posts()) : $ploop->the_post();  ?>

        			<li class="box"><a href="<?php the_permalink(); ?>" >
        				<?php
        				$thumb = get_post_thumbnail_id();
    					$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    					?>

        				<img src="<?php echo $img_url ?>" alt="<?php the_title(); ?>">
            			<h3><?php the_title(); ?></h3>
            			<span class="font-icon-circle"><i class="icon-long-arrow-right"></i> </span></a> 
            		</li>
            	<?php  endwhile; else: ?>
            	<div> no entries found.</div>
            	<?php endif; ?>


           		</ul>
      		</div>
    	</div>
  	</div>
</div>
 
<?php get_footer(); ?>