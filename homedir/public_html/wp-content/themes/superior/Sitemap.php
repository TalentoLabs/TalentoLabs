<?php
/**
 * Template Name: Sitemap page
 */
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
          <div class="sitemaphpage">
    
    <div class="col-sm-4">
                            <h3 id="titles"><span>Feeds</span></h3>
                            <ul>
                                <li><a title="Full content" href="<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>
                                <li><a title="Comment Feed" href="<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>
                            </ul>
                            
                            <h3 id="titles"><span>Pages</span></h3>
                            <ul><?php wp_list_pages("title_li=" ); ?></ul>
     </div>
     <div class="col-sm-4">     
                          <h3 id="titles"><span>Posts</span></h3>                            
                            <ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8');
                                    while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> 
                                        
                                        </li>
                                 <?php endwhile; ?>
                           </ul>
      
                        <h3 id="titles"><span>Categories</span></h3>
                            <ul><?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&feed=RSS'); ?></ul>
                                               
                        <h3 id="titles"><span>Archives</span></h3>                            
                            <ul>
                                <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
                            </ul>		
       </div>         
       <div class="col-sm-4">  
                         <h3 id="titles"><span>Portfolio</span></h3>
                         <ul><?php   query_posts (array ('post_type' => 'portfolio'));
                                     while ( have_posts() ) : the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>  
                                        </li>
                                    <?php endwhile; ?>
                          </ul>
                          
      </div> 
      
   </div>   </div>   
 </div> 
 <?php get_footer(); ?>