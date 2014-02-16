<?php
/** Notifications block **/

if(!class_exists('Heading_Block')) {
	class Heading_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Heading Style 2',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('heading_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'type' => 'h3',
				'talign' => 'left',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$type_options = array(
				'h1' => 'H1',
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6'
			);
			
		   $type_talign = array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right' 
			);
			
			
			?>
				
			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Heading size<br/>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
				</label>
			</p>
            
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Heading <br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
            
            <div class="description">
				<label for="<?php echo $this->get_field_id('talign') ?>">
					Heading Align<br/>
					<?php echo aq_field_select('talign', $block_id, $type_talign, $talign) ?>
				</label>
			</div>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo '<'. $type .' id="titles" style="text-align:'.$talign.';"><span>' . $title . '</span></'. $type .'>';
			
		}
		
	}
}

//Fact box
if(!class_exists('fact_box')) {
	class fact_box extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Fact box',
				'size' => 'span3',
			);
			
			//create the block
			parent::__construct('fact_box', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'score' => '690',
				'color' => '#ffd600',
				'title' => 'Awards Have Won',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 $color = isset($color) ? $color : '#ffd600';
			?> 
            
			<p class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Heading <br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
            
            <p class="description half last">
				<label for="<?php echo $this->get_field_id('score') ?>">
					score <br/>
					<?php echo aq_field_input('score', $block_id, $score) ?>
				</label>
			</p>

			<p class="description half">
  
			<div class="description ">
			<label for="<?php echo $this->get_field_id('color') ?>">
				Circle Color 
                <div class="aqpb-color-picker">
                <input type="text" id="<?php echo $this->get_field_id('color') ?>" class="input-color-picker" value="<?php echo $color ?>" name="<?php echo $this->get_field_name('color') ?>" data-default-color="<?php echo $color ?>"/>
                 </div>
			</label>
		</div> 
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			$result = '<style type="text/css">.facts-count{color:'.$color.';} .brand-facts .facts-dec {border-top: solid 12px '.$color.';} .brand-facts .facts-dec:after { border: 15px solid '.$color.';} </style><div class="brand-facts">';
    		$result .= '<div class="facts-count">'.$score.' </div>';
			$result .= '<div class="facts-dec"> '.$title.'</div>';
			$result .= '</div>';

			echo $result;
		}
		
	}
}


/* skill_circle */
if(!class_exists('skill_circle')) {
	class skill_circle extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Skill circle',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('skill_circle', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_skillcircle_add_new', array($this, 'add_skillcircle'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'barcolor' => '#ffde00',
				'skill_circles' => array(
					1 => array( 
					'persent' => '78',
					'title' => 'Skill Circle',
					'description' => 'description', 
						
					)
				),
				'type'	=> 'skillcircle',
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$skillcircle_types = array(
				'skillcircle' => 'skill_circles', 
			);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$skill_circles = is_array($skill_circles) ? $skill_circles : $defaults['skill_circles'];
					$count = 1;
					foreach($skill_circles as $skillcircle) {	
						$this->skillcircle($skillcircle, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="skillcircle" class="aq-sortable-add-new button">Add New</a>
				<p></p>


		    <div class="description ">
			<label for="<?php echo $this->get_field_id('barcolor') ?>">
				Circle Color 
                <div class="aqpb-color-picker">
                <input type="text" id="<?php echo $this->get_field_id('barcolor') ?>" class="input-color-picker" value="<?php echo $barcolor ?>" name="<?php echo $this->get_field_name('barcolor') ?>" data-default-color="<?php echo $barcolor ?>"/>
                 </div>
			</label>
			</div>  
			</div>
			 
			<?php
		}
		
		function skillcircle($skillcircle = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('skill_circles') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $skillcircle['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
            
    			 <p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('skill_circles') ?>-<?php echo $count ?>-title">
							Title <br/>
							<input type="text" id="<?php echo $this->get_field_id('skill_circles') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('skill_circles') ?>[<?php echo $count ?>][title]" value="<?php echo $skillcircle['title'] ?>" />
						</label>
					</p>        
                             
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('skill_circles') ?>-<?php echo $count ?>-persent">
							Circle fill Percentage<br/>
							<input type="text" id="<?php echo $this->get_field_id('skill_circles') ?>-<?php echo $count ?>-persent" class="input-full" name="<?php echo $this->get_field_name('skill_circles') ?>[<?php echo $count ?>][persent]" value="<?php echo $skillcircle['persent'] ?>" />
						</label>
					</p> 

					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('skill_circles') ?>-<?php echo $count ?>-description">
							Circle description<br/>
							<input type="text" id="<?php echo $this->get_field_id('skill_circles') ?>-<?php echo $count ?>-description" class="input-full" name="<?php echo $this->get_field_name('skill_circles') ?>[<?php echo $count ?>][description]" value="<?php echo $skillcircle['description'] ?>" />
						</label>
					</p> 

					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			 
			
			$output = ''; 
					$result .= '<style>.skill-circle .objct-title {border-top: solid 10px '.$barcolor.';} .skill-circle .objct-title:before {border: 15px solid '.$barcolor.';}  </style>';
					
					$i = 1;
					foreach( $skill_circles as $skillcircle ){
						 
						$result .= '<div class="col-md-3"> <div class="skill-circle">';
   						$result .= '<span class="chart" data-percent="'. $skillcircle['persent'] .'">';
   						$result .= '<span class="percent">'. $skillcircle['persent'] .'</span>';
    					$result .= '<canvas height="250" width="250"></canvas></span>'; 
    					$result .= '<div class="objct-title">'. $skillcircle['title'] .'</div>'; 
						$result .= '<p>'. $skillcircle['description'] .'</p>';
						$result .= '</div></div>';

						$i++;
					}
				$result .= '<script> 
	$(function() { 
		$(".chart").easyPieChart({
			easing: "easeOutBounce",
			size: 250,
		  lineWidth: 40,
			lineCap: "butt",
			scaleColor: "#f4f4f4",
			barColor: "'.$barcolor.'",
			
			onStep: function(from, to, percent) {
				$(this.el).find(".percent").text(Math.round(percent));
			}
		});
		 
	});
	</script>';
				 
			
			echo $result;
			
		}
		
		/* AJAX add skillcircle */
		function add_skillcircle() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the skillcircle
			$skillcircle = array(
			 	'persent' => '78',
				'title' => 'Skill Circle',
				'description' => 'description',
				
			);
			
			if($count) {
				$this->skillcircle($skillcircle, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}

// big title
if(!class_exists('Big_title')) {
	class Big_title extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Big title',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('Big_title', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'fontsize' => '55',
				'talign' => 'left',
				'textcolor' => '#000',
				'make_underline' => 'yes',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
		 $textcolor = isset($textcolor) ? $textcolor : '#333333';
			
		   $type_talign = array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right' 
			);
			
		   $type_make_underline = array(
				'yes' => 'yes',
				'no' => 'no',
			);
			?>
            
			<p class="description  half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Heading <br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
            
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('fontsize') ?>">
				Font Size <br/>
					<?php echo aq_field_input('fontsize', $block_id, $fontsize) ?>
				</label>
			</p>
            <div class="description half ">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Pick a text color<br/>
				<?php echo aq_field_color_picker('textcolor', $block_id, $line_color, $defaults['textcolor']) ?>
			</label>
		    </div>            
            <div class="description half last">
				<label for="<?php echo $this->get_field_id('talign') ?>">
					Heading Align<br/>
					<?php echo aq_field_select('talign', $block_id, $type_talign, $talign) ?>
				</label>
			</div>

            <div class="description half ">
				<label for="<?php echo $this->get_field_id('make_underline') ?>">
					Make underline to heading<br/>
					<?php echo aq_field_select('make_underline', $block_id, $type_make_underline, $make_underline) ?>
				</label>
			</div>

			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo '<h1 class="big-title '.$make_underline.'" style="text-align:'.$talign.'; font-size:'.$fontsize.'px; color:'.$textcolor.'; border-bottom-color:'.$textcolor.';"> ' . $title . '<span class="heading-end-dot">.</span></h1>';
			
		}
		
	}
}


/** Heading_Style3_Block **/

if(!class_exists('HeadingStyle3_Block')) {
	class HeadingStyle3_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Heading Style',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('HeadingStyle3_Block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array( 
				'headingcolor' => '#000000',
				'textcolor' => '#333333',
				'title' => '',
				'content' => '', 
				'font_size' => '80',
				'link' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			  
			$headingcolor = isset($headingcolor) ? $headingcolor : '#000000'; 
			$textcolor = isset($textcolor) ? $textcolor : '#333333';
			
			?>
		  
          <div class="description half ">
			<label for="<?php echo $this->get_field_id('headingcolor') ?>">
				Pick a Heading color<br/>
				<?php echo aq_field_color_picker('headingcolor', $block_id, $line_color, $defaults['headingcolor']) ?>
			</label>
		    </div>
            
            <div class="description half last">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Pick a text color<br/>
				<?php echo aq_field_color_picker('textcolor', $block_id, $line_color, $defaults['textcolor']) ?>
			</label>
		    </div>
             
                        
			<div class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Heading <br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</div>
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('link') ?>">
					link <br/>
					<?php echo aq_field_input('link', $block_id, $link) ?>
				</label>
			</div>
			<div class="description half">
				<label for="<?php echo $this->get_field_id('font_size') ?>">
					Title font size <br/>
					<?php echo aq_field_input('font_size', $block_id, $font_size) ?>
				</label>
			</div> 
            <p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					 Heading description <br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>
            
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			$output = ' <div class="clear"></div>';
			$output .= ' <div class="big-heading">';
			$output .= '<h2 style="color:'. $headingcolor .'; font-size:'. $font_size .'px;"><a style="color:'. $headingcolor .'; font-size:'. $font_size .'px;" href="'. $link .'"title="'. $title . '">' . $title . '<span class="heading-end-dot">.</span></a></h2>';
			$output .= '<p> '. $content .'</p>';
			$output .= ' <div class="heading-bottom"></div>';
			$output .= '</div>';
			
			echo $output;
			
		}
		
	}
}


/** big_tagline_Block **/

if(!class_exists('big_tagline_Block')) {
	class big_tagline_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Big tag line',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('big_tagline_Block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'title' => 'Your title',
				'dec' => 'Your goes here', 
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
		  
			?> 
			<div class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</div> 
            
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('dec') ?>">
					Heading <br/>
					<?php echo aq_field_textarea ('dec', $block_id, $dec) ?>
				</label>
			</div> 
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo ' <div class="tagline-heading">
          <h1> '. $title .'</h1>
          '. wpautop(do_shortcode(htmlspecialchars_decode($dec))) .'
        </div>';
			
		}
		
	}
}

/** Progress_Bars_Block **/

if(!class_exists('Progress_Bars_Block')) {
	class Progress_Bars_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Progress Bars',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('progress_bars_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
		        'title' =>'Web Design 90%',
				'bg' => '#95c53d',
				'type' => 'No radius',
				'percent' => '50'
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$type_options = array(
				'noradius' => 'No radius',
				'radius' => 'Radius',
				'round' => 'Round'
				
			);
			$bg = isset($bg) ? $bg : '#95c53d';
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Style<br/>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
				</label>
			</div>
         
			<div class="description half last">
			<label for="<?php echo $this->get_field_id('bg') ?>">
				Circle Color 
                <div class="aqpb-color-picker">
                <input type="text" id="<?php echo $this->get_field_id('bg') ?>" class="input-color-picker" value="<?php echo $bg ?>" name="<?php echo $this->get_field_name('bg') ?>" data-default-color="<?php echo $bg ?>"/>
                 </div>
			</label>
			</div>   

			<div class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Heading <br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</div>
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('percent') ?>">
					Percent<br/>
					<?php echo aq_field_input('percent', $block_id, $percent) ?>
				</label>
			</div>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			$output  = '<div class="'. $type .' progress" ><span class="meter" style=" background:'. $bg .';  width:'. $percent .'%;">';
			$output  .= '<span>'. $title .'</span>';
			$output  .= '</div>';
			
			echo $output;
		}
		
	}
}
 
/* Client_Logo */
if(!class_exists('Client_Logo')) {
	class Client_Logo extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Client Logo',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('Client_Logo', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_logo_add_new', array($this, 'add_logo'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'logos' => array(
					1 => array( 
					    'title' => 'Client Name', 
						'clientlogo' => 'Client Logo Icon', 
						'clienturl' => 'Client Logo URL', 
						
					)
				),
				'type'	=> 'logo',
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$logo_types = array(
				'logo' => 'logos', 
			);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$logos = is_array($logos) ? $logos : $defaults['logos'];
					$count = 1;
					foreach($logos as $logo) {	
						$this->logo($logo, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="logo" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			 
			<?php
		}
		
		function logo($logo = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('logos') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $logo['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
           

                    
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('logos') ?>-<?php echo $count ?>-clientlogo">
							Upload an image for logo<br/> 
							<input type="text" id="<?php echo $this->get_field_id('logos') ?>-<?php echo $count ?>-clientlogo" class="input-full" name="<?php echo $this->get_field_name('logos') ?>[<?php echo $count ?>][clientlogo]" value="<?php echo $logo['clientlogo'] ?>" />
                             <a href="#" class="aq_upload_button button" rel="<?php echo $media_type  ?>">Upload</a> <p></p>
						</label>
					</p>
     <p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('logos') ?>-<?php echo $count ?>-title">
							Client name <br/>
							<input type="text" id="<?php echo $this->get_field_id('logos') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('logos') ?>[<?php echo $count ?>][title]" value="<?php echo $logo['title'] ?>" />
						</label>
					</p>        
                             
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('logos') ?>-<?php echo $count ?>-clienturl">
							logo clienturl<br/>
							<input type="text" id="<?php echo $this->get_field_id('logos') ?>-<?php echo $count ?>-clienturl" class="input-full" name="<?php echo $this->get_field_name('logos') ?>[<?php echo $count ?>][clienturl]" value="<?php echo $logo['clienturl'] ?>" />
						</label>
					</p> 
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			 
			
			$output = ''; 
					$output .= '<div class="client-logo-list">';
					
					$i = 1;
					foreach( $logos as $logo ){
						 
						$output .= '<a href="' . $logo['clienturl'] .'"><img src="' . $logo['clientlogo'].'" alt="' . $logo['title'].'" /></a>';
						$i++;
					}
				$output .= '</div>';
				 
			
			echo $output;
			
		}
		
		/* AJAX add logo */
		function add_logo() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the logo
			$logo = array(
			  'clientlogo' => 'Client Logo',
			   'title' => 'Client Name',
				'clienturl' => 'Client Logo URL'
				
			);
			
			if($count) {
				$this->logo($logo, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}





/* flexslider */
if(!class_exists('flexslider')) {
	class flexslider extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'flex slider',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('flexslider', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_fxslide_add_new', array($this, 'add_fxslide'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'fxslides' => array(
					1 => array( 
			 			'slideimage' => 'Slide image',
			  			'title' => 'Slide Name',
			  			'flexsliderurl' => 'slide URL',
						
					)
				),
				'type'	=> 'fxslide',
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$fxslide_types = array(
				'fxslide' => 'fxslides', 
			);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$fxslides = is_array($fxslides) ? $fxslides : $defaults['fxslides'];
					$count = 1;
					foreach($fxslides as $fxslide) {	
						$this->fxslide($fxslide, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="fxslide" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			 
			<?php
		}
		
		function fxslide($fxslide = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('fxslides') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $fxslide['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
           

                    
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('fxslides') ?>-<?php echo $count ?>-slideimage">
							Upload an image for fxslide<br/> 
							<input type="text" id="<?php echo $this->get_field_id('fxslides') ?>-<?php echo $count ?>-slideimage" class="input-full" name="<?php echo $this->get_field_name('fxslides') ?>[<?php echo $count ?>][slideimage]" value="<?php echo $fxslide['slideimage'] ?>" />
                             <a href="#" class="aq_upload_button button" rel="<?php echo $media_type  ?>">Upload</a> <p></p>
						</label>
					</p>
     <p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('fxslides') ?>-<?php echo $count ?>-title">
							Client name <br/>
							<input type="text" id="<?php echo $this->get_field_id('fxslides') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('fxslides') ?>[<?php echo $count ?>][title]" value="<?php echo $fxslide['title'] ?>" />
						</label>
					</p>        
                             
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('fxslides') ?>-<?php echo $count ?>-clienturl">
							fxslide clienturl<br/>
							<input type="text" id="<?php echo $this->get_field_id('fxslides') ?>-<?php echo $count ?>-clienturl" class="input-full" name="<?php echo $this->get_field_name('fxslides') ?>[<?php echo $count ?>][clienturl]" value="<?php echo $fxslide['clienturl'] ?>" />
						</label>
					</p> 
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance); 
			
			$output = ''; 
					$output .= '<section class="flx2slider"><div class="flexslider"><ul class="slides" >';
					
					$i = 1;
					foreach( $fxslides as $fxslide ){
						 
						$output .= '<li><div class="work-slider" ><a href="' . $fxslide['flexsliderurl'] .'"><img src="' . $fxslide['slideimage'].'" alt="' . $fxslide['title'].'" /></a></div></li>';
						$i++;
					}
				$output .= '</ul></div></section>';
				 
			
			echo $output;
			
		}
		
		/* AJAX add fxslide */
		function add_fxslide() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the fxslide
			$fxslide = array(
			 		'slide image' => 'Slide image',
			  		'title' => 'Slide Name',
			  		'flexsliderurl' => 'slide URL',
				
			);
			
			if($count) {
				$this->fxslide($fxslide, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}



/** Recentpost_Slide **/

if(!class_exists('Recentpost_Slide')) {
	class Recentpost_Slide extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Recent post Slide',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('recentpost_slide', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'category' => '',
				'limit' => '5'
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('category') ?>">
					Category<br/>
					<?php echo aq_field_input('category', $block_id, $category) ?>
				</label>
			</div>
         
	
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('limit') ?>">
					Limit<br/>
					<?php echo aq_field_input('limit', $block_id, $limit) ?>
				</label>
			</div>
			<?php

		}
		
		function block($instance) {
			extract($instance);
		
		$args = array(
    	'posts_per_page' => $limit,
    	'category_name' => $category,
        );
	  $loop = new WP_Query( $args );
      $list = '<div class="clear"></div><section class="recent-post-slider"><div class="flexslider-loding"><ul class="slides" > ';
      while ( $loop->have_posts() ) {
	  $loop->the_post();
	  $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image = aq_resize( $img_url, 350, 220, true ); //resize & crop the image
	  $category = get_the_category(); 
	  $list .= '<li><div class="recent-slide">';
	  $list .= '<div class="recent-slide-img"><img src="' . $image . '"  alt="'. get_the_title() . '" /> <a href="'.$img_url.'" class="colorlightbox" ><span class="font-icon-circle img-icon-circle"><i class="icon-picture"></i></span></a><a href="'.get_permalink($post->ID).'"><span class="font-icon-circle"><i class="icon-long-arrow-right"></i></span></a></div>';
      $list .= '<div class="slide-content">';
      $list .=  '</div>';     
	  $list .= '<div class="slide-des"><h5><a href="'. get_permalink().'" >'. get_the_title() .'</a></h5>';
	  $list .=  '<p>' . excerpt( 20 ) .'...</p>';    
	  $list .= '</div></div></li> ';
	  }
      wp_reset_query();
	
			echo $list . '</ul></div></section> ';
			
		}
		
	}
}

/** Grid blog **/

if(!class_exists('Grid_blog')) {
	class Grid_blog extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Grid blog',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('grid_blog', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'category' => '',
				'limit' => '5'
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('category') ?>">
					Category<br/>
					<?php echo aq_field_input('category', $block_id, $category) ?>
				</label>
			</div>
         
	
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('limit') ?>">
					Limit<br/>
					<?php echo aq_field_input('limit', $block_id, $limit) ?>
				</label>
			</div>
			<?php

		}
		
		function block($instance) {
			extract($instance);
		
     	$args = array(
    	'posts_per_page' => $limit,
    	'category_name' => $category,
    );	
	
	  $loop = new WP_Query( $args );
      $list = '<div id="main-grid" role="main"><ul class="grid-blog">';
      while ( $loop->have_posts() ) {
	  $loop->the_post();
	  $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image = aq_resize( $img_url, 240, true ); //resize & crop the image

	  $list .= '<li>';
	  if($image) {
	  $list .= '<div class="grid-post-img">';
	  $list .= '<a href="' . $img_url . '" class="colorlightbox"><img src="' . $image . '"  alt="'. get_the_title() . '" /></a>';
      $list .= '</div>';
      }
	  $list .= '<div class="grid-post-dec"><h3><a href="'. get_permalink().'" >'. get_the_title() .'</a></h3>';
	  $list .= '<div class="grid-post-info">'. get_the_date() .' by '. get_the_author_link().'</div>'; 
	  $list .=  '<p>' . excerpt( 30 ) .'....<a href="'. get_permalink().'">Read more</a></p>';    
	  $list .= '</div> ';
	  $list .= '</li>';
	  }
      wp_reset_query();
	
			echo $list . '</ul></div>';
		}
		
	}
}
/** Recentwork_Slide **/

if(!class_exists('Recentwork_Slide')) {
	class Recentwork_Slide extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Recent Work Slide',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('recentwork_slide', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'category' => '',
				'limit' => '5'
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('category') ?>">
					Category<br/>
					<?php echo aq_field_input('category', $block_id, $category) ?>
				</label>
			</div>
         
	
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('limit') ?>">
					Limit<br/>
					<?php echo aq_field_input('limit', $block_id, $limit) ?>
				</label>
			</div>
			<?php

		}
		
		function block($instance) {
			extract($instance);
		
     	$args = array(
    	'posts_per_page' => $limit,
    	'post_type' => array('portfolio'),
    	'category_name' => $category,
    );	
	
	  $loop = new WP_Query( $args );
      $list = '<div class="clear"></div><section class="recent-post-slider"><div class="flexslider-loding"><ul class="slides" > ';
      while ( $loop->have_posts() ) {
	  $loop->the_post();
	  $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image = aq_resize( $img_url, 350, 220, true ); //resize & crop the image
	  $category = get_the_category(); 
	  $list .= '<li><div class="recent-slide">';
	  $list .= '<div class="recent-slide-img"><img src="' . $image . '"  alt="'. get_the_title() . '" /> <a href="'.$img_url.'" class="colorlightbox" ><span class="font-icon-circle img-icon-circle"><i class="icon-picture"></i></span></a><a href="'.get_permalink($post->ID).'"><span class="font-icon-circle"><i class="icon-long-arrow-right"></i></span></a></div>';
      $list .= '<div class="slide-content">';
      $list .=  '</div>';     
	  $list .= '<div class="slide-des"><h5><a href="'. get_permalink().'" >'. get_the_title() .'</a></h5>';
	  $list .=  '<p>' . excerpt( 20 ) .'...</p>';    
	  $list .= '</div></div></li> ';
	  }
      wp_reset_query();
	
			echo $list . '</ul></div></section> ';
		}
		
	}
}

/** Work Slider **/

if(!class_exists('Recentwork_Slider')) {
	class Recentwork_Slider extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Work Slider',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('recentwork_slider', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'category' => '',
				'limit' => '5'
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('category') ?>">
					Category<br/>
					<?php echo aq_field_input('category', $block_id, $category) ?>
				</label>
			</div>
         
	
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('limit') ?>">
					Limit<br/>
					<?php echo aq_field_input('limit', $block_id, $limit) ?>
				</label>
			</div>
			<?php

		}
		
		function block($instance) {
			extract($instance);
		
     	$args = array(
    	'posts_per_page' => $limit,
    	'post_type' => array('portfolio'),
    	'category_name' => $category,
    );	
	
	  $loop = new WP_Query( $args );
      $list = '<section class="flx2slider"><div class="flexslider fe-work"><ul class="slides">';
      while ( $loop->have_posts() ) {
	  $loop->the_post();
	  
	  $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image = aq_resize( $img_url, 700, 400, true ); //resize & crop the image

	  $category = get_the_category(); 
	  $list .= '<li>';
	  $list .= '<div class="work-slider"><a href="'. get_permalink().'" ><img src="'. $image. '"  alt="'. get_the_title() . '" /></a> ';
	  $list .=  '</div>';
      $list .= '<div class="ws-content">';
	  $list .= '<div class="ws-titile"><h2><a href="'. get_permalink().'" >'. get_the_title() .'</a></h2>';
	  $list .=  '<p> ' . excerpt( 38 ) .'.... <a href="'. get_permalink().'" >Read more</a></p>';
	  $list .=  '</div>';
	  $list .= '</div></li> ';
	  }
      wp_reset_query();
	
			echo $list . '</ul></div></section>';
			
		}
		
	}

}


/** Dynamic grid portfolio **/

if(!class_exists('dynamic_grid_portfolio')) {
	class dynamic_grid_portfolio extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => ' Dynamic portfolio',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('dynamic_grid_portfolio', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'category' => '',
				'limit' => '5'
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('category') ?>">
					Category<br/>
					<?php echo aq_field_input('category', $block_id, $category) ?>
				</label>
			</div>
         
	
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('limit') ?>">
					Limit<br/>
					<?php echo aq_field_input('limit', $block_id, $limit) ?>
				</label>
			</div>
			<?php

		}
		
		function block($instance) {
			extract($instance);
		
     	$args = array(
    	'posts_per_page' => $limit,
    	'post_type' => array('portfolio'),
    	'category_name' => $category,
        );	
	
	  $loop = new WP_Query( $args );
      $list = '<div class="dynamic-folio"><ul id="dynamic-grid">';
      while ( $loop->have_posts() ) {
	  $loop->the_post();
	  
	  $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
	  $list .= '<li class="box">';
	  $list .= '<a href="'. get_permalink().'" ><img src="'. $img_url. '"  alt="'. get_the_title() . '" /> ';
	  $list .=  '<h3>'. get_the_title() . '</h3>';
      $list .= '<span class="font-icon-circle"><i class="icon-long-arrow-right"></i> </span>';
	  $list .= '</a>'; 
	  $list .= '</li> ';
	  }
      wp_reset_query();
	
			echo $list . '</ul></div>';
			
		}
		
	}
}

/** Recentwork thumb Expanding **/

if(!class_exists('Thumb_Expanding_work')) {
	class Thumb_Expanding_work extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Thumb expand work',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('thumb_expanding_work', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'category' => '',
				'limit' => '5'
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('category') ?>">
					Category<br/>
					<?php echo aq_field_input('category', $block_id, $category) ?>
				</label>
			</div>
         
	
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('limit') ?>">
					Limit<br/>
					<?php echo aq_field_input('limit', $block_id, $limit) ?>
				</label>
			</div>
			<?php

		}
		
		function block($instance) {
			extract($instance);
		
     	$args = array(
    	'posts_per_page' => $limit,
    	'post_type' => array('portfolio'),
    	'category_name' => $category,
    );	
	
	  $loop = new WP_Query( $args );
      $list = '<ul id="og-grid" class="og-grid"> ';
      while ( $loop->have_posts() ) {
	  $loop->the_post();
	  
	  $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $big_image = aq_resize( $img_url, 500, 400, true ); //resize & crop the image
      $small_image = aq_resize( $img_url, 250, 250, true ); //resize & crop the image

	  $category = get_the_category(); 
	  $list .= '<li>';
	  $list .= '<a href="'. get_permalink().'" data-largesrc="'.$big_image.'" data-title="'. get_the_title() .'" data-description="' . excerpt( 38 ) .'....">';
	  $list .=  '<img src="'.$small_image.'" alt="'. get_the_title() .'"/><span class="font-icon-circle"><i class="icon-long-arrow-down"></i> </span>';
      $list .= '</a>';
	  $list .= '</li> ';
	  }
      wp_reset_query();
	
			echo $list . '</ul>';
			
		}
		
	}
}

/** Recent_post**/

if(!class_exists('Recent_post')) {
	class Recent_post extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Recent Post',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('recent_post', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'category' => '',
				'orderby' => 'DESC',
				'words' => '20',
				'limit' => '5',
				'offset' => '0',
				'width' => '370',
				'height' => '220',
				'align' => 'none',
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			 
		 $type_options = array(
		 
			    'DESC' => 'DESC' ,
				'ASC' => 'ASC',
				'ID' =>'ID',
				'author' => 'author' ,
				'title' => 'title',
				'name' => 'name',
				'date' => 'date',
				'modified' => 'modified',
				'parent' => 'parent',
				'rand' => 'rand',
				'comment_count' => 'comment_count',
				'post__in' => 'post__in'
				
				);
				
				$imagealign = array(
		 
			    'right' => 'Right' ,
				'left' => 'Left',
				'none' => 'Center'
				
				);
			
			?>
				
			<div class="description half">
				<label for="<?php echo $this->get_field_id('category') ?>">
					Category<br/>
					<?php echo aq_field_input('category', $block_id, $category) ?>
				</label>
			</div>
         
	
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('limit') ?>">
					Limit<br/>
					<?php echo aq_field_input('limit', $block_id, $limit) ?>
				</label>
			</div>
            	<p class="description half ">
				<label for="<?php echo $this->get_field_id('orderby') ?>">
					Order & Orderby Parameters<br/>
					<?php echo aq_field_select('orderby', $block_id, $type_options, $orderby) ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('words') ?>">
					limit of words show in description.<br/>
					<?php echo aq_field_input('words', $block_id, $words) ?>
				</label>
			</p>   
            
			<p class="description half">
				<label for="<?php echo $this->get_field_id('offset') ?>">
					Excluding latest posts from the loop<br/>
					<?php echo aq_field_input('offset', $block_id, $offset) ?>
				</label>
			</p>            
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('align') ?>">
					Image align <br/>
					<?php echo aq_field_select('align', $block_id, $imagealign, $align) ?>
				</label>
			</p>
 
			<p class="description half">
				<label for="<?php echo $this->get_field_id('width') ?>">
					Image width<br/>
					<?php echo aq_field_input('width', $block_id, $width) ?>
				</label>
			</p>            
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Image height<br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>               
			<?php

		}
		
		function block($instance) {
			extract($instance);
		
      $args = array(
	    'orderby' => $orderby,
    	'posts_per_page' => $limit,
    	'category_name' => $category,
		'offset' => $offset,
      );
	
	  $loop = new WP_Query( $args );
	  $list = '<ul class="recent-small-posts">';
	  while ( $loop->have_posts() ) { $loop->the_post();
	  
	  $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image = aq_resize( $img_url, $width, $height, true ); //resize & crop the image

        if ($align == 'left'){
	 		$img_margin = '0 12px 0 0' ;
	 		}  

			elseif ($align == 'right')
			{
            $img_margin = '0 0 0 12px';
			}   
			else {
            $img_margin = '0 0 10px 0' ;
			} 

      $list .= '<li style="min-height:'. $height .'px;">'; 
      $list .= '<div class="recent-thumb" style="width:'. $width .'px; height:'. $height .'px; margin:'.$img_margin.'; float:'. $align .';">';
 	  $list .= '<a href="'. $img_url .'" class="colorlightbox"><img src="'. $image .'"  alt="'. get_the_title() . '"/ ></a>';
 	  $list .= '</div>';
 	  $list .= '<div class="recent-meta"><h6><a href="'.get_permalink($post->ID). '">' . get_the_title() . '</a></h6>';
 	  $list .= '<em> '. get_the_date() .' by '. get_the_author_link().' </em>';
 	  if ($words){ $list .=  '<p> ' . excerpt( $words ) .'....</p>'; }
 	  $list .= '</div>';  
	  $list .= '</li>';
	}
	wp_reset_query();
	
			echo $list. '</ul>';
			
		}
		
	}
} 
 
/* Service_box */  

if(!class_exists('Service_box')) {
	class Service_box extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Service box',
				'size' => 'span3',
			);
			
			//create the block
			parent::__construct('Service_box', $block_options);
		}
		function form($instance) {
			$defaults = array(
				'title' => __( 'Service name' ),
				'icon' => 'css3',
				'icon_color' => '#ffd600',  
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$icon_color = isset($icon_color) ? $icon_color : '#ffd600';

			 $type_options = array(
		    'glass' =>'glass',
			'music'=>'music',
			'search'=>'search',
			'envelope-alt' =>'envelope-alt',
			'heart' =>'heart',
			'star'=>'star',
			'star-empty'=>'star-empty',
			'user'=>'user',
			
			'tablet'=>'tablet',
		'film'	=>'film',
		'th-large'	=>'th-large',
		'th'	=>'th',
		'th-list'	=>'th-list',
		'ok'	=>'ok',
		'remove'	=>'remove',
		'zoom-in'	=>'zoom-in',
		'zoom-out'	=>'zoom-out',
		'power-off'	=>'power-off',
		'off'	=>'off',
		'signal'	=>'signal',
		'cog'	=>'cog',
		'trash'	=>'trash',
		'home'	=>'home',
		'file-alt'	=>'file-alt',
		'time'	=>'time',
		'road'	=>'road',
		'download-alt'	=>'download-alt',
		'download'	=>'download',
		'upload'	=>'upload',
		'inbox'	=>'inbox',
		'play-circle'	=>'play-circle',
		'rotate-right'	=>'rotate-right',
		'repeat'	=>'repeat',
		'refresh'	=>'refresh',
		'list-alt'	=>'list-alt',
		'lock'	=>'lock',
		'flag'	=>'flag',
		'headphones'	=>'headphones',
		'volume-off'	=>'volume-off',
		'volume-down'	=>'volume-down',
		'volume-up'	=>'volume-up',
		'qrcode'	=>'qrcode',
		'barcode'	=>'barcode',
		'tag'	=>'tag',
		'tags'	=>'tags',
		'book'	=>'book',
		'bookmark'	=>'bookmark',
		'print'	=>'print',
		'camera'	=>'camera',
		'font'	=>'font',
		'bold'	=>'bold',
		'italic'	=>'italic',
		'text-height'	=>'text-height',
		'text-width'	=>'text-width',
		'align-left'	=>'align-left',
		'align-center'	=>'align-center',
		'align-right'	=>'align-right',
		'align-justify'	=>'align-justify',
		'list'	=>'list',
		'indent-left'	=>'indent-left',
		'indent-right'	=>'indent-right',
		'facetime-video'	=>'facetime-video',
		'picture'	=>'picture',
		'pencil'	=>'pencil',
		'map-marker'	=>'map-marker',
		'adjust'	=>'adjust',
		'tint'	=>'tint',
		'edit'	=>'edit',
		'share'	=>'share',
		'check'	=>'check',
		'move'	=>'move',
		'step-backward'	=>'step-backward',
		'fast-backward'	=>'fast-backward',
		'backward'	=>'backward',
		'play'	=>'play',
		'pause'	=>'pause',
		'stop'	=>'stop',
		'forward'	=>'forward',
		'fast-forward'	=>'fast-forward',
		'step-forward'	=>'step-forward',
		'eject'	=>'eject',
		'chevron-left'	=>'chevron-left',
		'chevron-right'	=>'chevron-right',
		'plus-sign'	=>'plus-sign',
		'minus-sign'	=>'minus-sign',
		'remove-sign'	=>'remove-sign',
		'ok-sign'	=>'ok-sign',
		'question-sign'	=>'question-sign',
		'info-sign'	=>'info-sign',
		'screenshot'	=>'screenshot',
		'remove-circle'	=>'remove-circle',
		'ok-circle'	=>'ok-circle',
		'ban-circle'	=>'ban-circle',
		'arrow-left'	=>'arrow-left',
		'arrow-right'	=>'arrow-right',
		'arrow-up'	=>'arrow-up',
		'arrow-down'	=>'arrow-down',
		'mail-forward'    =>'mail-forward',
		'share-alt'	=>'share-alt',
		'resize-full'	=>'resize-full',
		'resize-small'    => 'resize-small',
		'plus'	=> 'plus',
		'minus'    => 'minus',
		'asterisk'	 => 'asterisk',
		'exclamation-sign'	 => 'exclamation-sign',
		'gift'	 => 'gift',
		'leaf'	 => 'leaf',
	 'fire'		 => 'fire',
		'eye-open'	 => 'eye-open',
		'eye-close'	 => 'eye-close',
		'warning-sign'	 => 'warning-sign',
		'plane'	 => 'plane',
		'calendar'	=> 'calendar',
		'random'	=> 'random',
		'comment'	=> 'comment',
		'magnet'	=> 'magnet',
		'chevron-up'	=> 'chevron-up',
		'chevron-down'	=> 'chevron-down',
		'retweet'	=> 'retweet',
		'shopping-cart'	=> 'shopping-cart',
		'folder-close'	=> 'folder-close',
		'folder-open'	=> 'folder-open',
		'resize-vertical'	=> 'resize-vertical',
		'resize-horizontal'	=> 'resize-horizontal',
		'bar-chart'	=> 'bar-chart',
		'twitter-sign'	=> 'twitter-sign',
		'facebook-sign'	=> 'facebook-sign',
		'camera-retro'	=> 'camera-retro',
		'key'	=> 'key',
		'cogs'	=> 'cogs',
		'comments'	=> 'comments',
		'thumbs-up-alt'	=> 'thumbs-up-alt',
		'thumbs-down-alt'	=> 'thumbs-down-alt',
		'star-half'	=> 'star-half',
		'heart-empty'	=> 'heart-empty',
		'signout'	=> 'signout',
		'linkedin-sign'	=> 'linkedin-sign',
		'pushpin'	=> 'pushpin',
		'external-link'	=> 'external-link',
		'signin'	=> 'signin',
		'trophy'	=> 'trophy',
		'github-sign'	=> 'github-sign',
		'upload-alt'	=> 'upload-alt',
		'lemon'	=> 'lemon',
		 'phone'	=> 'phone',
		'unchecked'	=> 'unchecked',
		'check-empty'	=> 'check-empty',
		'bookmark-empty'	=> 'bookmark-empty',
		'phone-sign'	=> 'phone-sign',
		'twitter'	=> 'twitter',
		'facebook'	=> 'facebook',
		'github'	=> 'github',
		'unlock'	=> 'unlock',
		'credit-card'	=> 'credit-card',
		'rss'	=> 'rss',
		'hdd'	=> 'hdd',
		'bullhorn'	=> 'bullhorn',
		'bell'	=> 'bell',
		 'certificate'	=> 'certificate',
		'hand-right'	=> 'hand-right',
		'hand-left'	=> 'hand-left',
		'hand-up'	=> 'hand-up',
		'hand-down'	=> 'hand-down',
		'circle-arrow-left'	=> 'circle-arrow-left',
		'circle-arrow-right'	=> 'circle-arrow-right',
		'circle-arrow-up'	=> 'circle-arrow-up',
		'circle-arrow-down'	=> 'circle-arrow-down',
		'globe'	=> 'globe',
		 'wrench'	=> 'wrench',
		'tasks'	=> 'tasks',
		'filter'	=> 'filter',
		'briefcase'	=> 'briefcase',
		'fullscreen'	=> 'fullscreen',
		'group'	=> 'group',
		'link'	=> 'link',
		'cloud'	=> 'cloud',
		'beaker'	=> 'beaker',
		'cut'	=> 'cut',
		'copy'	=> 'copy',
		'paperclip'	=> 'paperclip',
		'paper-clip'	=> 'paper-clip',
		'save'	=> 'save',
		'sign-blank'	=> 'sign-blank',
		'reorder'	=> 'reorder',
		'list-ul'	=> 'list-ul',
		'list-ol'	=> 'list-ol',
		'strikethrough'	=> 'strikethrough',
		'underline'	=> 'underline',
		'table'	=> 'table',
		'magic'	=> 'magic',
		'truck'	=> 'truck',
		'pinterest'	=> 'pinterest',
		'pinterest-sign'	=> 'pinterest-sign',
		'google-plus-sign'	=> 'google-plus-sign',
		'google-plus'	=> 'google-plus',
		'money'	=> 'money',
		'caret-down'	=> 'caret-down',
		'caret-up'	=> 'caret-up',
		 'caret-left'	=> 'caret-left',
		'caret-right'	=> 'caret-right',
			'columns' => 'columns',
		'sort'	=> 'sort',
		'sort-down'	=> 'sort-down',
		'sort-up'	=> 'sort-up',
		'envelope'	=> 'envelope',
	 'linkedin'		=> 'linkedin',
		'rotate-left'	=> 'rotate-left',
		'undo'	=> 'undo',
		'legal'	=> 'legal',
		'dashboard'	=> 'dashboard',
		'comment-alt'	=> 'comment-alt',
		'comments-alt'	=> 'comments-alt',
		'bolt'	=> 'bolt',
		'sitemap'	=> 'sitemap',
		'umbrella'	=> 'umbrella',
		'paste'	=> 'paste',
		'lightbulb'	=> 'lightbulb',
		'exchange'	=> 'exchange',
		 'cloud-download'	=> 'cloud-download',
		'cloud-upload'	=> 'cloud-upload',
		'user-md'	=> 'user-md',
		'stethoscope'	=> 'stethoscope',
		'suitcase'	=> 'suitcase',
		'bell-alt'	=> 'bell-alt',
		'coffee'	=> 'coffee',
		'food'	=> 'food',
		'file-text-alt'	=> 'file-text-alt',
		'building'	=> 'building',
		'hospital'	=> 'hospital',
		'ambulance'	=> 'ambulance',
		'medkit'	=> 'medkit',
		'fighter-jet'	=> 'fighter-jet',
		'beer'	=> 'beer',
		'h-sign'	=> 'h-sign',
		'plus-sign-alt'	=> 'plus-sign-alt',
		'double-angle-left'	=> 'double-angle-left',
		'double-angle-right'	=> 'double-angle-right',
		'double-angle-up'	=> 'double-angle-up',
		'double-angle-down'	=> 'double-angle-down',
		'angle-left'	=> 'angle-left',
		'angle-right'	=> 'angle-right',
		'angle-up'	=> 'angle-up',
		'angle-down'	=> 'angle-down',
		'desktop'	=> 'desktop',
		'laptop'	=> 'laptop',
		'tablet'	=> 'tablet',
		'mobile-phone'	=> 'mobile-phone',
		'circle-blank'	=> 'circle-blank',
		'quote-left'	=> 'quote-left',
		'quote-right'	=> 'quote-right',
		'spinner'	=> 'spinner',
		'circle'	=> 'circle',
		'mail-reply'	=> 'mail-reply',
		'reply'	=> 'reply',
		'github-alt'	=> 'github-alt',
		 'folder-close-alt'	=> 'folder-close-alt',
		'folder-open-alt'	=> 'folder-open-alt',
		'expand-alt'	=> 'expand-alt',
		'collapse-alt'	=> 'collapse-alt',
		'smile'	=> 'smile',
		'frown'	=> 'frown',
		'meh'	=> 'meh',
		'gamepad' => 'gamepad',
		'keyboard'	=> 'keyboard',
		'flag-alt'	=> 'flag-alt',
		'flag-checkered'	=> 'flag-checkered',
		'terminal'	=> 'terminal',
		'code'	=> 'code',
		'reply-all'	=> 'reply-all',
		'mail-reply-all'	=> 'mail-reply-all',
		'star-half-full'	=> 'star-half-full',
		'star-half-empty'	=> 'star-half-empty',
		'location-arrow'	=> 'location-arrow',
		'crop'	=> 'crop',
		'code-fork'	=> 'code-fork',
		'unlink'	=> 'unlink',
		'question'	=> 'question',
		'info'	=> 'info',
		'exclamation'	=> 'exclamation',
		'superscript'	=> 'superscript',
		'subscript'	=> 'subscript',
		'eraser'	=> 'eraser',
		'puzzle-piece'	=> 'puzzle-piece',
		'microphone'	=> 'microphone',
		'microphone-off'	=> 'microphone-off',
		'shield'	=> 'shield',
		'calendar-empty'	=> 'calendar-empty',
		'fire-extinguisher'	=> 'fire-extinguisher',
		'rocket'	=> 'rocket',
		'maxcdn'	=> 'maxcdn',
		'chevron-sign-left'	=> 'chevron-sign-left',
		'chevron-sign-right'	=> 'chevron-sign-right',
		'chevron-sign-up'	=> 'chevron-sign-up',
		'chevron-sign-down'	=> 'chevron-sign-down',
		'html5'	=> 'html5',
		'css3'	=> 'css3',
		'anchor'	=> 'anchor',
		'unlock-alt'	=> 'unlock-alt',
		'bullseye'	=> 'bullseye',
		'ellipsis-horizontal'	=> 'ellipsis-horizontal',
		'ellipsis-vertical'	=> 'ellipsis-vertical',
		'rss-sign'	=> 'rss-sign',
		'play-sign'	=> 'play-sign',
		'ticket'	=> 'ticket',
		'minus-sign-alt'	=> 'minus-sign-alt',
		'check-minus'	=> 'check-minus',
		'level-up'	=> 'level-up',
		'level-down'	=> 'level-down',
		'check-sign'	=> 'check-sign',
		'edit-sign'	=> 'edit-sign',
		'external-link-sign'	=> 'external-link-sign',
		'share-sign'	=> 'share-sign',
		'compass'	=> 'compass',
		'collapse'	=> 'collapse',
		'collapse-top'	=> 'collapse-top',
		'expand'	=> 'expand',
		'euro'	=> 'euro',
		'eur'	=> 'eur',
		'gbp'	=> 'gbp',
		'dollar'	=> 'dollar',
		'usd'	=> 'usd',
		'rupee'	=> 'rupee',
		'inr'	=> 'inr',
		'yen'	=> 'yen',
		'jpy'	=> 'jpy',
		'renminbi'	=> 'renminbi',
		'cny'	=> 'cny',
		'won'	=> 'won',
		'krw'	=> 'krw',
		'bitcoin'	=> 'bitcoin',
		'btc'	=> 'btc',
		'file'	=> 'file',
		'file-text'	=> 'file-text',
		'sort-by-alphabet'	=> 'sort-by-alphabet',
		'sort-by-alphabet-alt'	=> 'sort-by-alphabet-alt',
		'sort-by-attributes'	=> 'sort-by-attributes',
		'sort-by-attributes-alt'	=> 'sort-by-attributes-alt',
		'sort-by-order'	=> 'sort-by-order',
		'sort-by-order-alt'	=> 'sort-by-order-alt',
		'thumbs-up'	=> 'thumbs-up',
		'thumbs-down'	=> 'thumbs-down',
		'youtube-sign'	=> 'youtube-sign',
		'youtube'	=> 'youtube',
		'xing'	=> 'xing',
		'xing-sign'	=> 'xing-sign',
		'youtube-play'	=> 'youtube-play',
		'dropbox'	=> 'dropbox',
		 'stackexchange'	=> 'stackexchange',
		'instagram'	=> 'instagram',
		'flickr'	=> 'flickr',
		'adn'	=> 'adn',
		'bitbucket'	=> 'bitbucket',
		'bitbucket-sign'	=> 'bitbucket-sign',
		'tumblr'	=> 'tumblr',
		'tumblr-sign'	=> 'tumblr-sign',
		'long-arrow-down'	=> 'long-arrow-down',
		'long-arrow-up'	=> 'long-arrow-up',
		'long-arrow-left'	=> 'long-arrow-left',
		'long-arrow-right'	=> 'long-arrow-right',
		'apple'	=> 'apple',
		'windows'	=> 'windows',
		'android'	=> 'android',
		'linux'	=> 'linux',
		'dribble'	=> 'dribble',
		'skype'	=> 'skype',
		'foursquare'	=> 'foursquare',
		'trello'	=> 'trello',
		'female'	=> 'female',
		'male'	=> 'male',
		'gittip'	=> 'gittip',
		'sun'	=> 'sun',
		'moon'	=> 'moon',
		'archive'	=> 'archive',
		'bug'	=> 'bug',
		 'vk'	=> 'vk',
		'weibo'	=> 'weibo',
		'renren'	=> 'renren'
			);
	 
			?> 
        <p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title<br/>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
        
            <div class="description">
	        <label for="<?php echo $this->get_field_id('icon') ?>">
	        Upload an icon<br/> 
            <?php echo aq_field_select('icon', $block_id, $type_options, $icon) ?>
	        </label> 
	        </div> 
        <div class="description ">
			<label for="<?php echo $this->get_field_id('icon_color') ?>">
				Circle Color 
                <div class="aqpb-color-picker">
                <input type="text" id="<?php echo $this->get_field_id('icon_color') ?>" class="input-color-picker" value="<?php echo $icon_color ?>" name="<?php echo $this->get_field_name('icon_color') ?>" data-default-color="<?php echo $icon_color ?>"/>
                 </div>
			</label>
		</div> 
          
            
			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					Your Quote here <br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>

			<?php
		}
		function block($instance) {
			extract($instance);
	 $output  = ' <div class="service-box">';
	 $output  .= ' <div class="title"><h3> ' . $title . '</h3></div>';
	 $output  .= '<div class="sb-icon" style="background:'. $icon_color.';box-shadow: 0px 0px 0px 3px '. $icon_color.';">';
	 $output  .= '<i class="sb-icon-font  icon-'. $icon .'"></i>';
	 $output  .= '</div>';
	 $output  .= ' <div class="service-dec">';
	 $output  .='<p>' .$content. '</p>'; 
	 $output  .= '</div>';
	 $output  .= '</div>';
			
		echo $output;	
		}
		
	}
}




/* Service_box_style2 */  

if(!class_exists('Service_box_style2')) {
	class Service_box_style2 extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Service box style 2',
				'size' => 'span4',
			);
			
			//create the block
			parent::__construct('Service_box_style2', $block_options);
		}
		function form($instance) {
			$defaults = array(
				'title' => __( 'Service name' ),
				'icon' => 'css3',
				'icon_color' => '#ffd600',  
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$icon_color = isset($icon_color) ? $icon_color : '#ffd600';

			 $type_options = array(
		    'glass' =>'glass',
			'music'=>'music',
			'search'=>'search',
			'envelope-alt' =>'envelope-alt',
			'heart' =>'heart',
			'star'=>'star',
			'star-empty'=>'star-empty',
			'user'=>'user',
			
			'tablet'=>'tablet',
		'film'	=>'film',
		'th-large'	=>'th-large',
		'th'	=>'th',
		'th-list'	=>'th-list',
		'ok'	=>'ok',
		'remove'	=>'remove',
		'zoom-in'	=>'zoom-in',
		'zoom-out'	=>'zoom-out',
		'power-off'	=>'power-off',
		'off'	=>'off',
		'signal'	=>'signal',
		'cog'	=>'cog',
		'trash'	=>'trash',
		'home'	=>'home',
		'file-alt'	=>'file-alt',
		'time'	=>'time',
		'road'	=>'road',
		'download-alt'	=>'download-alt',
		'download'	=>'download',
		'upload'	=>'upload',
		'inbox'	=>'inbox',
		'play-circle'	=>'play-circle',
		'rotate-right'	=>'rotate-right',
		'repeat'	=>'repeat',
		'refresh'	=>'refresh',
		'list-alt'	=>'list-alt',
		'lock'	=>'lock',
		'flag'	=>'flag',
		'headphones'	=>'headphones',
		'volume-off'	=>'volume-off',
		'volume-down'	=>'volume-down',
		'volume-up'	=>'volume-up',
		'qrcode'	=>'qrcode',
		'barcode'	=>'barcode',
		'tag'	=>'tag',
		'tags'	=>'tags',
		'book'	=>'book',
		'bookmark'	=>'bookmark',
		'print'	=>'print',
		'camera'	=>'camera',
		'font'	=>'font',
		'bold'	=>'bold',
		'italic'	=>'italic',
		'text-height'	=>'text-height',
		'text-width'	=>'text-width',
		'align-left'	=>'align-left',
		'align-center'	=>'align-center',
		'align-right'	=>'align-right',
		'align-justify'	=>'align-justify',
		'list'	=>'list',
		'indent-left'	=>'indent-left',
		'indent-right'	=>'indent-right',
		'facetime-video'	=>'facetime-video',
		'picture'	=>'picture',
		'pencil'	=>'pencil',
		'map-marker'	=>'map-marker',
		'adjust'	=>'adjust',
		'tint'	=>'tint',
		'edit'	=>'edit',
		'share'	=>'share',
		'check'	=>'check',
		'move'	=>'move',
		'step-backward'	=>'step-backward',
		'fast-backward'	=>'fast-backward',
		'backward'	=>'backward',
		'play'	=>'play',
		'pause'	=>'pause',
		'stop'	=>'stop',
		'forward'	=>'forward',
		'fast-forward'	=>'fast-forward',
		'step-forward'	=>'step-forward',
		'eject'	=>'eject',
		'chevron-left'	=>'chevron-left',
		'chevron-right'	=>'chevron-right',
		'plus-sign'	=>'plus-sign',
		'minus-sign'	=>'minus-sign',
		'remove-sign'	=>'remove-sign',
		'ok-sign'	=>'ok-sign',
		'question-sign'	=>'question-sign',
		'info-sign'	=>'info-sign',
		'screenshot'	=>'screenshot',
		'remove-circle'	=>'remove-circle',
		'ok-circle'	=>'ok-circle',
		'ban-circle'	=>'ban-circle',
		'arrow-left'	=>'arrow-left',
		'arrow-right'	=>'arrow-right',
		'arrow-up'	=>'arrow-up',
		'arrow-down'	=>'arrow-down',
		'mail-forward'    =>'mail-forward',
		'share-alt'	=>'share-alt',
		'resize-full'	=>'resize-full',
		'resize-small'    => 'resize-small',
		'plus'	=> 'plus',
		'minus'    => 'minus',
		'asterisk'	 => 'asterisk',
		'exclamation-sign'	 => 'exclamation-sign',
		'gift'	 => 'gift',
		'leaf'	 => 'leaf',
	 'fire'		 => 'fire',
		'eye-open'	 => 'eye-open',
		'eye-close'	 => 'eye-close',
		'warning-sign'	 => 'warning-sign',
		'plane'	 => 'plane',
		'calendar'	=> 'calendar',
		'random'	=> 'random',
		'comment'	=> 'comment',
		'magnet'	=> 'magnet',
		'chevron-up'	=> 'chevron-up',
		'chevron-down'	=> 'chevron-down',
		'retweet'	=> 'retweet',
		'shopping-cart'	=> 'shopping-cart',
		'folder-close'	=> 'folder-close',
		'folder-open'	=> 'folder-open',
		'resize-vertical'	=> 'resize-vertical',
		'resize-horizontal'	=> 'resize-horizontal',
		'bar-chart'	=> 'bar-chart',
		'twitter-sign'	=> 'twitter-sign',
		'facebook-sign'	=> 'facebook-sign',
		'camera-retro'	=> 'camera-retro',
		'key'	=> 'key',
		'cogs'	=> 'cogs',
		'comments'	=> 'comments',
		'thumbs-up-alt'	=> 'thumbs-up-alt',
		'thumbs-down-alt'	=> 'thumbs-down-alt',
		'star-half'	=> 'star-half',
		'heart-empty'	=> 'heart-empty',
		'signout'	=> 'signout',
		'linkedin-sign'	=> 'linkedin-sign',
		'pushpin'	=> 'pushpin',
		'external-link'	=> 'external-link',
		'signin'	=> 'signin',
		'trophy'	=> 'trophy',
		'github-sign'	=> 'github-sign',
		'upload-alt'	=> 'upload-alt',
		'lemon'	=> 'lemon',
		 'phone'	=> 'phone',
		'unchecked'	=> 'unchecked',
		'check-empty'	=> 'check-empty',
		'bookmark-empty'	=> 'bookmark-empty',
		'phone-sign'	=> 'phone-sign',
		'twitter'	=> 'twitter',
		'facebook'	=> 'facebook',
		'github'	=> 'github',
		'unlock'	=> 'unlock',
		'credit-card'	=> 'credit-card',
		'rss'	=> 'rss',
		'hdd'	=> 'hdd',
		'bullhorn'	=> 'bullhorn',
		'bell'	=> 'bell',
		 'certificate'	=> 'certificate',
		'hand-right'	=> 'hand-right',
		'hand-left'	=> 'hand-left',
		'hand-up'	=> 'hand-up',
		'hand-down'	=> 'hand-down',
		'circle-arrow-left'	=> 'circle-arrow-left',
		'circle-arrow-right'	=> 'circle-arrow-right',
		'circle-arrow-up'	=> 'circle-arrow-up',
		'circle-arrow-down'	=> 'circle-arrow-down',
		'globe'	=> 'globe',
		 'wrench'	=> 'wrench',
		'tasks'	=> 'tasks',
		'filter'	=> 'filter',
		'briefcase'	=> 'briefcase',
		'fullscreen'	=> 'fullscreen',
		'group'	=> 'group',
		'link'	=> 'link',
		'cloud'	=> 'cloud',
		'beaker'	=> 'beaker',
		'cut'	=> 'cut',
		'copy'	=> 'copy',
		'paperclip'	=> 'paperclip',
		'paper-clip'	=> 'paper-clip',
		'save'	=> 'save',
		'sign-blank'	=> 'sign-blank',
		'reorder'	=> 'reorder',
		'list-ul'	=> 'list-ul',
		'list-ol'	=> 'list-ol',
		'strikethrough'	=> 'strikethrough',
		'underline'	=> 'underline',
		'table'	=> 'table',
		'magic'	=> 'magic',
		'truck'	=> 'truck',
		'pinterest'	=> 'pinterest',
		'pinterest-sign'	=> 'pinterest-sign',
		'google-plus-sign'	=> 'google-plus-sign',
		'google-plus'	=> 'google-plus',
		'money'	=> 'money',
		'caret-down'	=> 'caret-down',
		'caret-up'	=> 'caret-up',
		 'caret-left'	=> 'caret-left',
		'caret-right'	=> 'caret-right',
			'columns' => 'columns',
		'sort'	=> 'sort',
		'sort-down'	=> 'sort-down',
		'sort-up'	=> 'sort-up',
		'envelope'	=> 'envelope',
	 'linkedin'		=> 'linkedin',
		'rotate-left'	=> 'rotate-left',
		'undo'	=> 'undo',
		'legal'	=> 'legal',
		'dashboard'	=> 'dashboard',
		'comment-alt'	=> 'comment-alt',
		'comments-alt'	=> 'comments-alt',
		'bolt'	=> 'bolt',
		'sitemap'	=> 'sitemap',
		'umbrella'	=> 'umbrella',
		'paste'	=> 'paste',
		'lightbulb'	=> 'lightbulb',
		'exchange'	=> 'exchange',
		 'cloud-download'	=> 'cloud-download',
		'cloud-upload'	=> 'cloud-upload',
		'user-md'	=> 'user-md',
		'stethoscope'	=> 'stethoscope',
		'suitcase'	=> 'suitcase',
		'bell-alt'	=> 'bell-alt',
		'coffee'	=> 'coffee',
		'food'	=> 'food',
		'file-text-alt'	=> 'file-text-alt',
		'building'	=> 'building',
		'hospital'	=> 'hospital',
		'ambulance'	=> 'ambulance',
		'medkit'	=> 'medkit',
		'fighter-jet'	=> 'fighter-jet',
		'beer'	=> 'beer',
		'h-sign'	=> 'h-sign',
		'plus-sign-alt'	=> 'plus-sign-alt',
		'double-angle-left'	=> 'double-angle-left',
		'double-angle-right'	=> 'double-angle-right',
		'double-angle-up'	=> 'double-angle-up',
		'double-angle-down'	=> 'double-angle-down',
		'angle-left'	=> 'angle-left',
		'angle-right'	=> 'angle-right',
		'angle-up'	=> 'angle-up',
		'angle-down'	=> 'angle-down',
		'desktop'	=> 'desktop',
		'laptop'	=> 'laptop',
		'tablet'	=> 'tablet',
		'mobile-phone'	=> 'mobile-phone',
		'circle-blank'	=> 'circle-blank',
		'quote-left'	=> 'quote-left',
		'quote-right'	=> 'quote-right',
		'spinner'	=> 'spinner',
		'circle'	=> 'circle',
		'mail-reply'	=> 'mail-reply',
		'reply'	=> 'reply',
		'github-alt'	=> 'github-alt',
		 'folder-close-alt'	=> 'folder-close-alt',
		'folder-open-alt'	=> 'folder-open-alt',
		'expand-alt'	=> 'expand-alt',
		'collapse-alt'	=> 'collapse-alt',
		'smile'	=> 'smile',
		'frown'	=> 'frown',
		'meh'	=> 'meh',
		'gamepad' => 'gamepad',
		'keyboard'	=> 'keyboard',
		'flag-alt'	=> 'flag-alt',
		'flag-checkered'	=> 'flag-checkered',
		'terminal'	=> 'terminal',
		'code'	=> 'code',
		'reply-all'	=> 'reply-all',
		'mail-reply-all'	=> 'mail-reply-all',
		'star-half-full'	=> 'star-half-full',
		'star-half-empty'	=> 'star-half-empty',
		'location-arrow'	=> 'location-arrow',
		'crop'	=> 'crop',
		'code-fork'	=> 'code-fork',
		'unlink'	=> 'unlink',
		'question'	=> 'question',
		'info'	=> 'info',
		'exclamation'	=> 'exclamation',
		'superscript'	=> 'superscript',
		'subscript'	=> 'subscript',
		'eraser'	=> 'eraser',
		'puzzle-piece'	=> 'puzzle-piece',
		'microphone'	=> 'microphone',
		'microphone-off'	=> 'microphone-off',
		'shield'	=> 'shield',
		'calendar-empty'	=> 'calendar-empty',
		'fire-extinguisher'	=> 'fire-extinguisher',
		'rocket'	=> 'rocket',
		'maxcdn'	=> 'maxcdn',
		'chevron-sign-left'	=> 'chevron-sign-left',
		'chevron-sign-right'	=> 'chevron-sign-right',
		'chevron-sign-up'	=> 'chevron-sign-up',
		'chevron-sign-down'	=> 'chevron-sign-down',
		'html5'	=> 'html5',
		'css3'	=> 'css3',
		'anchor'	=> 'anchor',
		'unlock-alt'	=> 'unlock-alt',
		'bullseye'	=> 'bullseye',
		'ellipsis-horizontal'	=> 'ellipsis-horizontal',
		'ellipsis-vertical'	=> 'ellipsis-vertical',
		'rss-sign'	=> 'rss-sign',
		'play-sign'	=> 'play-sign',
		'ticket'	=> 'ticket',
		'minus-sign-alt'	=> 'minus-sign-alt',
		'check-minus'	=> 'check-minus',
		'level-up'	=> 'level-up',
		'level-down'	=> 'level-down',
		'check-sign'	=> 'check-sign',
		'edit-sign'	=> 'edit-sign',
		'external-link-sign'	=> 'external-link-sign',
		'share-sign'	=> 'share-sign',
		'compass'	=> 'compass',
		'collapse'	=> 'collapse',
		'collapse-top'	=> 'collapse-top',
		'expand'	=> 'expand',
		'euro'	=> 'euro',
		'eur'	=> 'eur',
		'gbp'	=> 'gbp',
		'dollar'	=> 'dollar',
		'usd'	=> 'usd',
		'rupee'	=> 'rupee',
		'inr'	=> 'inr',
		'yen'	=> 'yen',
		'jpy'	=> 'jpy',
		'renminbi'	=> 'renminbi',
		'cny'	=> 'cny',
		'won'	=> 'won',
		'krw'	=> 'krw',
		'bitcoin'	=> 'bitcoin',
		'btc'	=> 'btc',
		'file'	=> 'file',
		'file-text'	=> 'file-text',
		'sort-by-alphabet'	=> 'sort-by-alphabet',
		'sort-by-alphabet-alt'	=> 'sort-by-alphabet-alt',
		'sort-by-attributes'	=> 'sort-by-attributes',
		'sort-by-attributes-alt'	=> 'sort-by-attributes-alt',
		'sort-by-order'	=> 'sort-by-order',
		'sort-by-order-alt'	=> 'sort-by-order-alt',
		'thumbs-up'	=> 'thumbs-up',
		'thumbs-down'	=> 'thumbs-down',
		'youtube-sign'	=> 'youtube-sign',
		'youtube'	=> 'youtube',
		'xing'	=> 'xing',
		'xing-sign'	=> 'xing-sign',
		'youtube-play'	=> 'youtube-play',
		'dropbox'	=> 'dropbox',
		 'stackexchange'	=> 'stackexchange',
		'instagram'	=> 'instagram',
		'flickr'	=> 'flickr',
		'adn'	=> 'adn',
		'bitbucket'	=> 'bitbucket',
		'bitbucket-sign'	=> 'bitbucket-sign',
		'tumblr'	=> 'tumblr',
		'tumblr-sign'	=> 'tumblr-sign',
		'long-arrow-down'	=> 'long-arrow-down',
		'long-arrow-up'	=> 'long-arrow-up',
		'long-arrow-left'	=> 'long-arrow-left',
		'long-arrow-right'	=> 'long-arrow-right',
		'apple'	=> 'apple',
		'windows'	=> 'windows',
		'android'	=> 'android',
		'linux'	=> 'linux',
		'dribble'	=> 'dribble',
		'skype'	=> 'skype',
		'foursquare'	=> 'foursquare',
		'trello'	=> 'trello',
		'female'	=> 'female',
		'male'	=> 'male',
		'gittip'	=> 'gittip',
		'sun'	=> 'sun',
		'moon'	=> 'moon',
		'archive'	=> 'archive',
		'bug'	=> 'bug',
		 'vk'	=> 'vk',
		'weibo'	=> 'weibo',
		'renren'	=> 'renren'
			);
	 
			?> 
        <p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title<br/>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
        
            <div class="description">
	        <label for="<?php echo $this->get_field_id('icon') ?>">
	        Upload an icon<br/> 
            <?php echo aq_field_select('icon', $block_id, $type_options, $icon) ?>
	        </label> 
	        </div> 
        <div class="description ">
			<label for="<?php echo $this->get_field_id('icon_color') ?>">
				Circle Color 
                <div class="aqpb-color-picker">
                <input type="text" id="<?php echo $this->get_field_id('icon_color') ?>" class="input-color-picker" value="<?php echo $icon_color ?>" name="<?php echo $this->get_field_name('icon_color') ?>" data-default-color="<?php echo $icon_color ?>"/>
                 </div>
			</label>
		</div> 
          
            
			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					Your Quote here <br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>

			<?php
		}
		function block($instance) {
			extract($instance);
	 $output  = '<div class="service-box-style2"> <div class="service-box">';
	 $output  .= '<div class="sb-icon" style="background:'. $icon_color.';box-shadow: 0px 0px 0px 2px '. $icon_color.';">';
	 $output  .= '<i class="sb-icon-font  icon-'. $icon .'"></i>';
	 $output  .= '</div>';
	 $output  .= ' <div class="service-dec">';
	 $output  .= ' <div class="title"><h3> ' . $title . '</h3></div>';
	 $output  .='<p>' .$content. '</p>'; 
	 $output  .= '</div>';
	 $output  .= '</div></div>';
			
		echo $output;	
		}
		
	}
}
/* Aqua slides Block */  
if(!class_exists('team_person')) {
	class team_person extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Team Person',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('team_person', $block_options);
		}
		function form($instance) {
			$defaults = array(
				'img' => '',
				'person_name' => 'Name',
				'title' => 'Title',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis, neque sed rutrum mollis, augue leo suscipit lectus.'
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
				
			?> 
        
		<p class="description">
			<label for="<?php echo $this->get_field_id('person_name') ?>">
				Name<br/>
				<?php echo aq_field_input('person_name', $block_id, $person_name, $size = 'full') ?>
			</label>
		</p>
        
        <p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Job Title<br/>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
        
            <div class="description">
	        <label for="<?php echo $this->get_field_id('img') ?>">
	        Upload an image<br/>
		    <?php echo aq_field_upload('img', $block_id, $img ) ?>
	        </label>
	        <?php if($img) { ?>
	        <div class="screenshot">
	        <img src="<?php echo $img ?>" />
	        </div> 
	        <?php } ?>
	        </div>  
		<p class="description">
			<label for="<?php echo $this->get_field_id('description') ?>">
				Content
				<?php echo aq_field_textarea('description', $block_id, $description, $size = 'full') ?>
			</label>

		<p class="description">
			<label for="<?php echo $this->get_field_id('sec_dec') ?>">
			After line text (insert social icon here)
				<?php echo aq_field_textarea('sec_dec', $block_id, $sec_dec, $size = 'full') ?>
			</label>

		</p>
        
			<?php
		}
		function block($instance) {
			extract($instance);
	 
	 $output  = '<div class="team-person">';
	 $output  .= '<div class="team-person-img img-hover"><img src="' . $img . '" alt="' . $name. '">';
	 $output  .= '</div>';
	 $output  .= '<div class="team-person-info">';
	 $output  .= '<div class="team-person-name">' . $person_name. '</div>';
	 $output  .= '<div class="team-person-title">' . $title. '</div>';
	 $output  .= '<div class="team-person-dec">';
	 $output  .= '<p>' . do_shortcode(htmlspecialchars_decode($description)).'</p>';
	 $output  .= '</div>';
	 $output  .= '<p>' . do_shortcode(htmlspecialchars_decode($sec_dec)).'</p>';
	 $output  .= '</div>';
	 $output  .= '</div>';
			
		echo $output;	
		}

	}
}

 if(!class_exists('contactform')) {
	class contactform extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Contact form',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('contactform', $block_options);
		}
		function form($instance) {
			$defaults = array(
		"email" => get_bloginfo('admin_email'),
		"subject" => '',
		"type" => '',
		"label_name" => 'Your name',
		"label_email" => 'Your e-mail address',
		"label_subject" => 'Subject',
		"label_message" => 'Your message',
		"label_submit" => 'Submit',
		"error_empty" => 'Please fill in all the required fields.',
		"error_noemail" => 'Please enter a valid e-mail address.',
		"success" => 'Thanks for your e-mail! We\'ll get back to you as soon as we can.'
		
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
		 	
		 	$type_options = array(
				'simple-filde' => 'Dark',
				'c-filde' => 'Light'
			);
				
			?> 
 
        <p class="description">
			<label for="<?php echo $this->get_field_id('email') ?>">
				Your eamil id<br/>
				<?php echo aq_field_input('email', $block_id, $email, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Style<br/>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
				</label>
		</p>
			<?php
		}
		function block($instance) {
			extract($instance);
	 
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$error = false;
		$required_fields = array("your_name", "email", "message", "subject");

		foreach ($_POST as $field => $value) {
			if (get_magic_quotes_gpc()) {
				$value = stripslashes($value);
			}
			$form_data[$field] = strip_tags($value);
		}

		foreach ($required_fields as $required_field) {
			$value = trim($form_data[$required_field]);
			if(empty($value)) {
				$error = true;
				$result = $error_empty;
			}
		}

		if(!is_email($form_data['email'])) {
			$error = true;
			$result = $error_noemail;
		}

		if ($error == false) {
			$email_subject = "[" . get_bloginfo('name') . "] " . $form_data['subject'];
			$email_message = $form_data['message'] . "\n\nIP: " . wptuts_get_the_ip();
			$headers  = "From: ".$form_data['your_name']." <".$form_data['email'].">\n";
			$headers .= "Content-Type: text/plain; charset=UTF-8\n";
			$headers .= "Content-Transfer-Encoding: 8bit\n";
			wp_mail($email, $email_subject, $email_message, $headers);
			$result = $success;
			$sent = true;
		}
	}

	if($result != "") {
		$info = '<div class="info">'.$result.'</div>';
	}
	$email_form = ' <div class="mainc-form '.$type.'"> <form class="contact-form" method="post" action="'.get_permalink().'"><div class="mainc-form-top"><input class="field name"  placeholder="Your Name…" type="text" name="your_name" id="cf_name" size="50" maxlength="50" value="'.$form_data['your_name'].'" /><input class="field email" type="text"  placeholder="Your eMail…" name="email" id="cf_email" size="50" maxlength="50" value="'.$form_data['email'].'" /> <input class="field web last"  type="text" name="subject"  placeholder="Subject..." id="cf_subject" size="50" maxlength="50" value="'.$subject.$form_data['subject'].'" /></div><div class="mainc-form-bottom"><textarea name="message" id="cf_message" placeholder="Your Comment Here…" " cols="50" rows="10">'.$form_data['message'].'</textarea></div><div><input type="submit" class="btn btn-danger pull-right btn-lg" value="Submit" name="send" id="cf_send" /></div></form></div>';
	
	if($sent == true) {
		echo $info;
	} else {
		echo $info.$email_form;
	}
	  	
		}
		
	}
}
  
 

/************* gmap *********************/

  if(!class_exists('gmap')) {
	class gmap extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'gmap',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('gmap', $block_options);
		}
		function form($instance) {
			$defaults = array(  
				'width' => '1080',
				'height' => '400',
				'border' => 'g-map',

				'lat' => '40.714353',
				'lng' => '-74.005973',
				'zoom' => '13',
				'title' => 'Your title',
				'dec' => 'Some text on click'

				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			

			$type_options = array(
				'g-map' => 'Yes',
				'no-g-map' => 'NO',
			);
			?>
		<p class="description half">
			<label for="<?php echo $this->get_field_id('width') ?>">
				Width <br/>
				<?php echo aq_field_input('width', $block_id, $width, $size = 'full') ?>
			</label>
		</p>
        <p class="description half last">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Height <br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
	   </p>
       <p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					title<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
	   </p>

       <p class="description">
				<label for="<?php echo $this->get_field_id('dec') ?>">
					Some on click<br/>
					<?php echo aq_field_textarea('dec', $block_id, $dec) ?>
				</label>
	   </p>

	    <p class="description half">
				<label for="<?php echo $this->get_field_id('lat') ?>">
					lat<br/>
					<?php echo aq_field_input('lat', $block_id, $lat) ?>
				</label>
	   </p>


	    <p class="description half last">
				<label for="<?php echo $this->get_field_id('lng') ?>">
					lng<br/>
					<?php echo aq_field_input('lng', $block_id, $lng) ?>
				</label>
	   </p>

	    <p class="description half">
				<label for="<?php echo $this->get_field_id('zoom') ?>">
					Map zoom level<br/>
					<?php echo aq_field_input('zoom', $block_id, $zoom) ?>
				</label>
	   </p>

	    <p class="description half last">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Map border<br/>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
				</label>
	   </p>

			<?php
		}
		function block($instance) {
			extract($instance);

		      
	echo  '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
		   <script type="text/javascript">
    var map;
    $(document).ready(function(){
      map = new GMaps({
        el: "#map",
        lat: '.$lat.',
        lng: '.$lng.',
		zoom: '.$zoom.'
      });
      map.addMarker({
        lat: '.$lat.',
        lng: '.$lng.',
        title: "'.$title.'",
        details: {
          database_id: 42,
          author: "HPNeo"
        },
        click: function(e){
          if(console.log)
            console.log(e);
          alert("'.$dec.'");
        },
        mouseover: function(e){
          if(console.log)
            console.log(e);
        }
      });
     
    }); 
  </script><script type="text/javascript" src="'. get_bloginfo('template_directory').'/js/gmaps.js"></script>'; 
 
			echo '<div class="'.$type.'" style="width:'.$width.'; height:'.$height.';"><div id="map"></div></div>';
			
		}
		
	}
}
 
 
 
/* slider Block */
if(!class_exists('slides')) {
	class slides extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Sildes',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('slides', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_slide_add_new', array($this, 'add_slide'));
			add_action('wp_ajax_aq_block_slidecap_add_new', array($this, 'add_slidecap'));
		}
		
		function form($instance) {
		
			$defaults = array(
				'slides' => array(
					1 => array( 
					    'capimage' => ' ',
						'title' => 'Slide caption animation', 
						'datay' => '240',
						'datax' => '200',
						'datain' => 'left',
						'dataout' => 'right',
						'datadelay' => '4000',  
						      )
				),
		       'bgimage'	=> ' ', 
					 
			);
			
	 
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$slide_types = array(
				'slide' => 'slides', 
			); 

         $datainout_options = array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
				'bottom' => 'Bottom',
				'fade' => 'Fade',
				'scrollLeft' => 'Scroll Left',
				'scrollRight' => 'Scroll Right',
				'scrollTop' => 'Scroll Top',
				'scrollBottom' => 'Scroll Bottom',
				'none' => 'None',
				
			);
			
			 ?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$slides = is_array($slides) ? $slides : $defaults['slides'];
					$count = 1;
					foreach($slides as $slide) {	
						$this->slide($slide, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="slide" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
        
        
         <div class="description">
	        <label for="<?php echo $this->get_field_id('bgimage') ?>">
	        Upload an Slide Background image<br/>
		    <?php echo aq_field_upload('bgimage', $block_id, $bgimage) ?>
	        </label>
	        <?php if($bgimage) { ?>
	        <div class="screenshot">
	        <img src="<?php echo $bgimage ?>" />
	        </div> 
	        <?php } ?>
	        </div> 
			<?php
		} 
		
		 
	
	
	function slide($slide = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('slides') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $slide['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">


					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-capimage">
							Upload an image for slide<br/> 
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-capimage" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][capimage]" value="<?php echo $slide['capimage'] ?>" />
                             <a href="#" class="aq_upload_button button" rel="<?php echo $media_type  ?>">Upload</a> <p></p>
						</label>
					</p>
                    
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title">
							slide Title<br/>
							 <textarea id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title" class="textarea-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][title]" rows="5"><?php echo $slide['title'] ?></textarea>
						</label>
					</p>
                    
                    
                    					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datay">
							Image or text from top (y axis)<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datay" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][datay]" value="<?php echo $slide['datay'] ?>" />
						</label>
					</p>
                    
                    					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datax">
							Image or text from left (x axis) <br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datax" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][datax]" value="<?php echo $slide['datax'] ?>" />
						</label>
					</p>
                    
                    					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datadelay">
							Image or text delay before coming <br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datadelay" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][datadelay]" value="<?php echo $slide['datadelay'] ?>" />
						</label>
					</p>
                  
                    
                    <p class="tab-desc description">
                    <label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datain">
                   Image or text come from<br/> 
                    <select id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-datain" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][datain]">
                    <option value="top">Top</option>
                    <option value="left">Left</option>
                    <option value="center">Center</option>
                    <option value="right">Right</option>
                    <option value="bottom">Bottom</option>
                    <option value="scrollleft">Scroll Left</option>
                    <option value="scrollcenter">Scroll Center</option>
                    <option value="scrollright">Scroll Right</option>
                    <option value="scrollbottom">Scroll Bottom</option>
                    <option value="fade">Fade</option>
                    <option value="none">None</option> 
                    <option value="<?php echo  $slide['datain'] ?>" selected="selected"><?php echo  $slide['datain'] ?> &#10003 </option> 
                    </select> 

                    </label>
                    </p> 
				  
                  <p class="tab-desc description">
                    <label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-dataout">
                   Image or text out from<br/> 
                    <select id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-dataout" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][dataout]">
                    <option value="top">Top</option>
                    <option value="left">Left</option>
                    <option value="center">Center</option>
                    <option value="right">Right</option>
                    <option value="bottom">Bottom</option>
                    <option value="scrollleft">Scroll Left</option>
                    <option value="scrollcenter">Scroll Center</option>
                    <option value="scrollright">Scroll Right</option>
                    <option value="scrollbottom">Scroll Bottom</option>
                    <option value="fade">Fade</option>
                    <option value="none">None</option> 
                    
                    <option value="<?php echo  $slide['dataout'] ?>" selected="selected"><?php echo  $slide['dataout'] ?> &#10003 </option> 
                    </select> 

                    </label>
                    </p>
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		 
    
		function block($instance) {
			extract($instance);
			 
			 	
					$i = 1;
					$output = '<div class="slide" >';
					foreach( $slides as $slide ){
						  
						
						if($slide['capimage']) {
						$output .= '<img src="' . $slide['capimage'] . '" data-position="' . $slide['datay'] . ',' . $slide['datax'] . '" data-step="2" data-delay="' . $slide['datadelay'] . '" data-out="' . $slide['dataout'] . '" data-in="' . $slide['datain'] . '"  >';
						} else {
						$output .= '<p data-position="' . $slide['datay'] . ',' . $slide['datax'] . '" data-step="2" data-delay="' . $slide['datadelay'] . '" data-in="' . $slide['datain'] . '" data-out="' . $slide['dataout'] . '">'. do_shortcode(htmlspecialchars_decode($slide['title'])).'</p>';
						} 
						$i++;
					} 
					$output .= '<img data-fixed src="'. $bgimage .'" data-in="top" data-out="top" width="1920" height="750">';
			echo $output . '</div> ';
			
		}
		
		/* AJAX add slide */
		function add_slide() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the slide
			$slide = array(
				'title' => 'Slide caption animation',
				'content' => ''
			);
			
			if($count) {
				$this->slide($slide, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		} 
 
	}
}



 
/** Slider block **/
class slider extends AQ_Block {
	
	/* PHP5 constructor */
	function __construct() {
		
		$block_options = array(
			'name' => 'Slides holder',
			'size' => 'span12',
		);
		
		//create the widget
		parent::__construct('slider', $block_options);
		
	}
	
	//form header
	function before_form($instance) {
		extract($instance);

		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';

		echo '<li id="template-block-'.$number.'" class="block block-container block-'.$id_base.' '. $size .' '.$resizable.'">',
				'<dl class="block-bar">',
					'<dt class="block-handle">',
						'<div class="block-title">',
							$name , $title, 
						'</div>',
						'<span class="block-controls">',
							'<a class="block-edit" id="edit-'.$number.'" title="Edit Block" href="#block-settings-'.$number.'">Edit Block</a>',
						'</span>',
					'</dt>',
				'</dl>',
				'<div class="block-settings cf" id="block-settings-'.$number.'">';
	}

	function form($instance) {
		 
		echo '<p class="empty-column">',
		__('Drag only slides into this column box', 'framework'),
		'</p>';
		 
		echo '<ul class="blocks column-blocks cf"></ul>';
		
		
		
	
	}
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';
		
		extract($instance);
		
		$col_order = $order;
		 
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block  slider-holder block-container block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">',
						 
						'<p class="empty-column"> ',
						
							__('Drag only Slides into this column box.', 'framework'),
						'</p>',
						 
						'<ul class="blocks column-blocks cf">';
					
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);  
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks[$id_base];
					
					if($parent == $col_order) {
						$block->form_callback($child);
					}
				}
			} 
			echo 		'</ul>';
			
		} else {
			$this->before_form($instance);
			$this->form($instance);
		}
				
		//form footer
		$this->after_form($instance);
		
		
	}
	
	//form footer
	function after_form($instance) {
		 
		$defaults = array(
			 
			'columnbgimg' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		 
		?>
		   
		<?php 
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
			echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
			'</li>';
	}
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		
		echo '<div class="slider-wrapper">
  <div class="responisve-container">
    <div class="slider">
      <div class="fs_loader"></div>
					';
		
		//column block header
		if(isset($template_id)) {
			$this->before_block($instance);
			
			//define vars
			$overgrid = 0; $span = 0; $first = false;
			
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					if(class_exists($id_base)) {
						//get the block object
						$block = $aq_registered_blocks[$id_base];
						
						//insert template_id into $child
						$child['template_id'] = $template_id;
						
						//display the block
						if($parent == $col_order) {
							
							$child_col_size = absint(preg_replace("/[^0-9]/", '', $size));
							
							$overgrid = $span + $child_col_size;
							
							if($overgrid > $col_size || $span == $col_size || $span == 0) {
								$span = 0;
								$first = true;
							}
							
							if($first == true) {
								$child['first'] = true;
							}
							
							$block->block_callback($child);
							
							$span = $span + $child_col_size;
							
							$overgrid = 0; //reset $overgrid
							$first = false; //reset $first
						}
					}
				}
					
			} 
			echo ' </div></div></div> ';
			$this->after_block($instance);
			
		} else {
			//show nothing
		}
	}
	
}