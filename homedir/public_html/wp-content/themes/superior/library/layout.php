<?php


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?>>
	<article id="comment-<?php comment_ID(); ?>" class="clearfix">
        <div class="user"><?php echo get_avatar($comment,$size='70',$default='<path_to_url>' ); ?></div>
        <div class="message">
            <div class="arrow-box"> 
                <div class="info">
                    <?php printf(__('<h2>%s</h2>', 'theme_setup'), get_comment_author_link()) ?>
                    	<div class="meta">
                    		<div class="date"><?php echo comment_time('Y-d-j'); ?></div>
                    		<span class="sep">/</span>
	                     	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                   		</div>
                	</div>
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','bonestheme') ?></p>
          				</div>
					<?php endif; ?>
                     
                    <?php comment_text() ?>
                </div>
            </div>
	</article> 
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 

}

// Only display comments in comment count (which isn't currently displayed in wp-bootstrap, but i'm putting this in now so i don't forget to later)
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
	    $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
	    return count($comments_by_type['comment']);
	} else {
	    return $count;
	}
}

 
  
/************* excerpt  *********************/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
/************* Enqueue css files *********************/  

function theme_css() {
  if ( !is_admin() ) {
    
     wp_register_style( 'style',get_template_directory_uri() . '/css/style.css', false );
     wp_enqueue_style( 'style' );
	 
	 wp_register_style( 'googlefont_lato', "http://fonts.googleapis.com/css?family=Lato:300,400,700", false );
     wp_enqueue_style( 'googlefont_lato' );   
	 
	 wp_register_style( 'googlefont_montserrat', "http://fonts.googleapis.com/css?family=Montserrat:400,700", false );
     wp_enqueue_style( 'googlefont_montserrat' ); 	 
  }
}  
add_action( 'init', 'theme_css' );


/************* Enqueue js files *********************/   
function ework_scripts() {

global $is_IE;

  if ( !is_admin() ) {
  
  // Enqueue to header
     wp_deregister_script('jquery');
     wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null);
     wp_enqueue_script('jquery');
	 
	 wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ) );
     wp_enqueue_script( 'superfish' );     
	 
	 wp_register_script( 'fractionslider', get_template_directory_uri() . '/js/jquery.fractionslider.min.js', array( 'jquery' ) );
     wp_enqueue_script( 'fractionslider' );
	 
	 wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ) );
     wp_enqueue_script( 'flexslider' );  

	 wp_register_script( 'colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array( 'jquery' ) );
     wp_enqueue_script( 'colorbox' );      
	 
  // Enqueue to footer  
  
  wp_register_script( 'app', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'app' );
  
  wp_register_script( 'nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'nicescroll' );


  wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'easing' );  
  
  wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'isotope' );

  wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'modernizr' ); 

  wp_register_script( 'grid', get_template_directory_uri() . '/js/grid.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'grid' ); 

  wp_register_script( 'mason', get_template_directory_uri() . '/js/mason.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'mason' ); 

  wp_register_script( 'wookmark', get_template_directory_uri() . '/js/jquery.wookmark.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'wookmark' ); 
  
  wp_register_script( 'easypiechart', get_template_directory_uri() . '/js/easypiechart.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'easypiechart' );   
  
  wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'main' );
 
     // Enable threaded comments 
     if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
		wp_enqueue_script('comment-reply');
  }
}
add_action( 'init', 'ework_scripts' );
 
/************* loding google font *********************/
$googlefont_body = $data['googlefont_body'];
if ($googlefont_body) {
     wp_register_style( 'googlefont_body',"http://fonts.googleapis.com/css?family=$googlefont_body:400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese", false );
     wp_enqueue_style( 'googlefont_body' );
}

$googlefont_nav = $data['googlefont_nav'];
if ($googlefont_nav) {
     wp_register_style( 'googlefont_nav',"http://fonts.googleapis.com/css?family=$googlefont_nav:400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese", false );
     wp_enqueue_style( 'googlefont_nav' );
}

$googlefont_headings = $data['googlefont_headings'];
if ($googlefont_headings) {
     wp_register_style( 'googlefont_headings',"http://fonts.googleapis.com/css?family=$googlefont_headings:400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese", false );
     wp_enqueue_style( 'googlefont_headings' );
}

// Get theme options
function get_wpbs_theme_options(){
	global $data;
  $theme_options_styles = '';
    
	$color_scheme = $data['color_scheme'];
      if ($color_scheme) {
		  
        $theme_options_styles .= ' 
        .sf-menu li.current:after {background: '.$data['color_scheme'].';} 
        .heading-end-dot { color: '.$data['color_scheme'].';}
        .search-wrapper button {background: '.$data['color_scheme'].';}
        .search-wrapper button:before { border-color: transparent '.$data['color_scheme'].' transparent;}
        .mainc-form .btn-danger { background-color: '.$data['color_scheme'].' !important; border-color: '.$data['color_scheme'].' !important; }

	';
      } 
	   
	  if ($data['background_pattern']) { 
        $theme_options_styles .= ' 
	    body { background-image:url('. $data['background_pattern'] . ') ; 
		background-color:'. $data['bg_color']. '; 
		background-repeat:'. $data['bg_repeat'].'; }  
	     ';
	  }
	 
	  if ($data['background_image']) { 
        $theme_options_styles .= ' 
	    body { background-image:url('. $data['background_image']. ') ; 
		background-color:'. $data['bg_color']. '; 
		background-repeat:'. $data['bg_repeat'].'; }  
	     ';
	  }
	  	  
	  if ($data['pagebg_pattern']) { 
        $theme_options_styles .= ' 
	  #titles span, .pages-wapper .single-post { background-image:url('. $data['pagebg_pattern'] . '); 
		 background-color:'. $data['pagebg_color']. '; 
		 background-repeat:'. $data['pagebg_repeat'].'; }  
		   ';
	  }	

	  if ($data['pagebg_image']) { 
        $theme_options_styles .= ' 
	  #titles span, .pages-wapper .single-post { background-image:url('. $data['pagebg_image'] . '); 
		 background-color:'. $data['pagebg_color']. '; 
		 background-repeat:'. $data['pagebg_repeat'].'; } 
		 '; }	
	  	   
	 if ($data['bfbg_image']) {
        $theme_options_styles .= ' 
	    .container-before-footer { background-image:url('. $data['bfbg_image']. '); background-repeat:'. $data['bfbgbg_repeat'] .'; }'; 	 
	 }	
      if ($data['bfbg_color']) {  
	   $theme_options_styles .= '  
		.container-before-footer { background-color:'. $data['bfbg_color'] . ';    }'; 
	 }
	 if ($data['bffte_color']) {  
	   $theme_options_styles .= '  
		.container-before-footer { color: '. $data['bffte_color'] . '; }'; 
	 }
	 if ($data['bfft_color']) {  
	   $theme_options_styles .= '  
		.container-before-footer { color: '. $data['bfft_color'] . '; }'; 
	 }	
	
	 if ($data['bottom_link_colorpicker']) {  
	   $theme_options_styles .= '  
		.container-before-footer a { color: '. $data['bottom_link_colorpicker'] . '; }'; 
	 }		 
 
	 if ($data['bottom_hover_colorpicker']) {  
	   $theme_options_styles .= '  
		.container-before-footer a { color: '. $data['bottom_hover_colorpicker'] . '; }'; 
	 }	
 
      if ($data['fbg_color']) {  
	   $theme_options_styles .= '  
		 .footer-area { background-color:'. $data['fbg_color'] . ';    }'; 
	 }
	 
	 if ($data['ft_color']) {  
	   $theme_options_styles .= '  
		.footer-area { color: '. $data['ft_color'] . '; }'; 
	 }	
	
	 if ($data['footer_link']) {  
	   $theme_options_styles .= '  
		.footer-area a { color: '. $data['footer_link'] . '; }'; 
	 }		 
 
	 if ($data['footer_linkhover']) {  
	   $theme_options_styles .= '  
		.footer-area a:hover { color: '. $data['footer_linkhover'] . '; }'; 
	 }	
  
     if ($data['standardfont_body']) {
        $theme_options_styles .= '
       body {  font-family:' . $data['standardfont_body'] . '; }';  }	
   
     if ($data['standardfont_headings']) {
        $theme_options_styles .= '
      h1, h2, h3, h4, h5, h6 {font-family:' . $data['standardfont_headings'] . '; }';  }

      if ($data['standardfont_nav']) {
        $theme_options_styles .= '
		 .sf-menu li a { font-family:' . $data['standardfont_nav'] . '; } '; }	
	
	 if ($data['bfft_color']) {  
	   $theme_options_styles .= '  
		.container-before-footer .widget-box-title h3 { color:' . $data['bfft_color'] . '; }'; 
	 }	

	 if ($data['bffte_color']) {  
	   $theme_options_styles .= '  
		.container-before-footer, .container-before-footer p { color:' . $data['bffte_color'] . '; }'; 
	 }	
	
	 if ($data['bottom_link_colorpicker']) {  
	   $theme_options_styles .= '  
		.container-before-footer a{ color:' . $data['bottom_link_colorpicker'] . '; }'; 
	 }	
	
	 if ($data['bottom_hover_colorpicker']) {  
	   $theme_options_styles .= '  
		.container-before-footer a:hover{ color:' . $data['bottom_hover_colorpicker'] . '; }'; 
	 }	 	 	 

    if ($data['googlefont_body']) {
        $theme_options_styles .= '
       body {  font-family:' . $data['googlefont_body'] . '; }';  }	
   
     if ($data['googlefont_headings']) {
        $theme_options_styles .= '
      h1, h2, h3, h4, h5, h6 {font-family:' . $data['googlefont_headings'] . '; }';  }
    
	 if ($data['pageheading_color']) {
        $theme_options_styles .= '
      h1, h2, h3, h4, h5, h6 {color:' . $data['pageheading_color'] . '; }';  }
	
	 if ($data['pageheadingl_color']) {
        $theme_options_styles .= '
      h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{color:' . $data['pageheadingl_color'] . '; }';  }  

	 if ($data['pageheadinglh_color']) {
        $theme_options_styles .= '
      h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover{color:' . $data['pageheadinglh_color'] . '; }';  }
	  
      if ($data['googlefont_nav']) {
        $theme_options_styles .= '
		 .sf-menu li a { font-family:' . $data['googlefont_nav'] . '; }'; 
		}
	 
     if ($data['bodyfont_size']) {
        $theme_options_styles .= '
       body {  font-size:' . $data['bodyfont_size'] . 'px; }';  }	
  
     if ($data['btext_color']) {
        $theme_options_styles .= '
       body { color:' . $data['btext_color'] . '; }';  }
     
	 if ($data['btextl_color']) {
        $theme_options_styles .= '
       body a { color:' . $data['btextl_color'] . '; }';  }

	 if ($data['btextlh_color']) {
        $theme_options_styles .= '
       body a:hover { color:' . $data['btextlh_color'] . '; }';  }
	   	   	    
	 if ($data['mnavfont_size']) {
        $theme_options_styles .= '
       .sf-menu li a { font-size:' . $data['mnavfont_size'] . 'px; }';  }
	 	
	 if ($data['bffont_size']) {  
	   $theme_options_styles .= '  
		.container-before-footer h4 { font-size:' . $data['bffont_size'] . 'px; }'; 
	 }	  
	
	 if ($data['cfont_size']) {  
	   $theme_options_styles .= '  
		.footer-area, .footer-area a { font-size:' . $data['cfont_size'] . 'px; }'; 
	 }
	  
	 if ($data['ft_color']) {  
	   $theme_options_styles .= '  
		.footer-area { color:' . $data['ft_color'] . '; }'; 
	 }
	 if ($data['footer_link']) {  
	   $theme_options_styles .= '  
		 .footer-area a { color:' . $data['footer_link'] . '; }'; 
	 }
	 
	 if ($data['footer_linkhover']) {  
	   $theme_options_styles .= '  
		.footer-area a:hover { color:' . $data['footer_linkhover'] . '; }'; 
	 }
	  
	 if ($data['h1font_size']) {  
	   $theme_options_styles .= '  
		h1 { font-size:' . $data['h1font_size'] . 'px; }'; 
	 }
	 if ($data['h2font_size']) {  
	   $theme_options_styles .= '  
		h2 { font-size:' . $data['h2font_size'] . 'px; }'; 
	 }
	 if ($data['h3font_size']) {  
	   $theme_options_styles .= '  
		h3 { font-size:' . $data['h3font_size'] . 'px; }'; 
	 }
	 if ($data['h4font_size']) {  
	   $theme_options_styles .= '  
		h4 { font-size:' . $data['h4font_size'] . 'px; }'; 
	 }
	 if ($data['h5font_size']) {  
	   $theme_options_styles .= '  
		h5 { font-size:' . $data['h5font_size'] . 'px; }'; 
	 }
	 if ($data['h6font_size']) {  
	   $theme_options_styles .= '  
		h6 { font-size:' . $data['h6font_size'] . 'px; }'; 
	 } 
	 
	$nav_linkhover_colorpicker = of_get_option('nav_linkhover_colorpicker');
      if ($nav_linkhover_colorpicker) {
        $theme_options_styles .= '
		
		.navbar .nav > li > a:focus, .navbar .nav > li > a:hover {color:' . $nav_linkhover_colorpicker . '; }
		.dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a {color:' . $nav_linkhover_colorpicker . '; }';
	  
      } 

      $custom_css = $data['custom_css'];
      if( $custom_css ){
        $theme_options_styles .= $custom_css;
      }
          
      if($theme_options_styles){
        echo '<style>' 
        . $theme_options_styles . '
        </style>';
      }
}