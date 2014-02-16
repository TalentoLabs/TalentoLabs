<div class="container-before-footer">
  <div class="container ">
    <div class="row">
      <div class="col-sm-6">
        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Sidebar1') ) : else : ?>
          This text is here because you don't have add footer widgets.
        <?php endif; ?>
      </div>
      <div class="col-sm-6">
        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Sidebar2') ) : else : ?>
          This text is here because you don't have add footer widgets.
        <?php endif; ?>
      </div> 
    </div>
  </div>
</div>       

<footer class="footer-area">
  <div class="container ">
    <div class="row">
      <div class="col-sm-12">
        <p><?php 
		          global $data;
		          echo stripslashes($data['footer_text']); ?>
        </p>
        <?php wp_footer();
	       global $data;
	       echo $data['tracking_code'];
	       ?>
        </p>
      </div> 
    </div>
  </div>
</footer>
</div> 
</body>
</html> 