<?php get_header(); ?>
 
  <div class="page-title">
  <div class="container ">
    <div class="row">
      <div class="col-sm-12">
        <div class="big-heading">
          <h2 ><a href="" title="404 Error">404 Error<span class="heading-end-dot">.</span></a></h2>
         </div>
      </div>
    </div>
  </div>
</div>

  <div class="container ">
	 <div class="row">
    <div class="col-sm-12">
           <div class="page404">
				 <h1> 404 </h1>
                 <p> 404 error, The page you are looking for doesn't seem to exist. </p>
                 <p>Why not you try search  </p>
                    
				 <form action="<?php echo home_url( '/' ); ?>" method="get" class="search-wrapper cf">
        <input type="text" name="s" id="search" placeholder="<?php _e('Search here...', 'theme_setup' ); ?>" value="<?php the_search_query(); ?>" />
        <button type="submit">Search</button>
    </form>
            
	           <a  href="<?php echo home_url( '/' ); ?>" class="btn btn-danger" style="margin-top: 30px;"> Go Home</a>
                </div>  
            </div>
          </div>
     </div>
<?php get_footer(); ?>