<?php
class ET_TinyMCE_Buttons {
	function __construct() {
    	add_action( 'init', array(&$this,'init') );
    }
    function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		
		if ( get_user_option('rich_editing') == 'true' ) {  
			add_filter( 'mce_external_plugins', array(&$this, 'add_tm_button') );  
			add_filter( 'mce_buttons', array(&$this,'register_button') ); 
		}  
    }  
	function add_tm_button($tm_button_js) {  
	   $tm_button_js['et_shortcodes'] = get_template_directory_uri() .'/library/shortcodes/js/shortcodes-tm-button.js';
	   return $tm_button_js; 
	}
	function register_button($buttons) {  
	   array_push($buttons, "et_shortcodes_button");
	   return $buttons; 
	} 	
}
$sympleshortcode = new ET_TinyMCE_Buttons;

 

function et_buttons($atts, $content = null){
	extract(shortcode_atts(array(
		'font_size' => '15',
		'btn_color' => '#444',
		'text_color' => '#fff', 
		'url' => "#"
	), $atts));

 return '<a href="'.$url.'" class="he-button " style="color:'. $text_color .'; background-color:'. $btn_color .'; font-size:'.$font_size.'px;">'. $content .'</a>  ';
}
add_shortcode('et_button', 'et_buttons');
  
/**
 * Row
 */
function et_row($atts, $content = null){
	extract(shortcode_atts(array(
		'class' => 'row-fluid'
	), $atts));
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = '<div class="'.$class.'">';
	$result .= do_shortcode($content );
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('row', 'et_row');
 
/**
 * Col span
 */
function et_col($atts,$content=null){
	extract(shortcode_atts(array(
		'class' => 'span1'
		), $atts));

	$result = '<div class="'.$class.'">';
	$result .= do_shortcode($content );
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('col', 'et_col');


/**
 * number list holder
 */
function et_no_list_holder($atts, $content = null){
	extract(shortcode_atts(array(
		'class' => 'row-fluid'
	), $atts));
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = '<ul class="circle-ch dark-cir ">';   
	$result .= do_shortcode($content );
	$result .= '</ul>'; 
	return force_balance_tags( $result );
}
add_shortcode('no_list_holder', 'et_no_list_holder');

/**
 * number list
 */
function et_no_list($atts,$content=null){
	extract(shortcode_atts(array(
		'number' => '1'
		), $atts));
  
	$result = '<li><div class="circle-ch-n">'. $number.'</div><div class="circle-ch-d">';
	$result .= do_shortcode($content );
	$result .= '</div></li>'; 
	return force_balance_tags( $result );
}
add_shortcode('no_list', 'et_no_list');

/**
 * Service box
 */ 
function et_service_box($atts, $content=null){
	extract(shortcode_atts(array(
		'title' => 'Your title',
		'icon' => 'rocket', 
		'icon_color' => '#ffd600', 
		), $atts)); 

	$result = '<div class="service-box">';
    $result .= '<div class="title">';
    $result .= '<h3>'.$title.'</h3>';
    $result .= '</div>';
    $result .= '<div class="sb-icon" style="background:'. $icon_color.';box-shadow: 0px 0px 0px 3px '. $icon_color.';"><i class="sb-icon-font icon-'.$icon.'"></i></div>'; 
    $result .= '<div class="service-dec">';  
	$result .='<p>'.do_shortcode($content ).'</p>';
	$result .= '</div>'; 
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('et_service_box', 'et_service_box'); 

/**
 * Alert Box
 */ 
function et_notification($atts, $content=null){
	extract(shortcode_atts(array(
		'type' => 'Your title', 

		), $atts));  

	$result = '<div class="alert alert-'.$type.' fade in">';
    $result .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'; 
	$result .=  do_shortcode($content )  ;
	$result .= '</div>';  
	return force_balance_tags( $result );
}
add_shortcode('et_notification', 'et_notification'); 



/**
 * Team Person box
 */ 
function et_team_person($atts, $content=null){
	extract(shortcode_atts(array(
		'img' => ' ',
		'url' => ' ',
		'name' => ' ',
		'jobtitle' => ' ',  
		), $atts));  

	$result = '<div class="team-person">';
    $result .= ' <div class="team-person-img img-hover">';
    $result .= '<img src="'.$img.'"> <a href="'.$url.'"><span class="font-icon-circle"><i class="icon-long-arrow-right"></i></span></a> ';
    $result .= '</div>'; 
    $result .= '<div class="team-person-name">'.$name.'</div>'; 
    $result .= '<div class="team-person-title">'.$jobtitle.'</div>'; 
    $result .= '<div class="team-person-dec">'; 
	$result .='<p>'.do_shortcode($content ).'</p>';
	$result .= '</div>';  
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('et_team_person', 'et_team_person'); 

/**
 * skill-circle
 */ 
function et_skill_circle($atts, $content=null){
	extract(shortcode_atts(array(
		'persent' => ' ',
		'title' => ' ',  
		), $atts));  

	$result = '<div class="skill-circle">';
    $result .= '<span class="chart" data-percent="'.$persent.'" data-color="#634673">';
    $result .= '<span class="percent">'.$persent.'</span>';
    $result .= '<canvas height="250" width="250"></canvas></span>'; 
    $result .= '<div class="objct-title">'.$title.'</div>'; 
	$result .= '<p>'.do_shortcode($content ).'</p>';
	$result .= '</div>';
	return force_balance_tags( $result );
}
add_shortcode('et_skill_circle', 'et_skill_circle'); 

/**
 * Brand Facts
 */ 
function et_brand_fact($atts, $content=null){
	extract(shortcode_atts(array(
		'score' => '690',
		'color' => '#ffd600',

		), $atts));    

	$result = '<style type="text/css">.facts-count{color:'.$color.';} .brand-facts .facts-dec {border-top: solid 12px '.$color.';} .brand-facts .facts-dec:after { border: 15px solid '.$color.';} </style><div class="brand-facts">';
    $result .= '<div class="facts-count">'.$score.' </div>';
	$result .= '<div class="facts-dec"> '.do_shortcode($content ).'</div>';
	$result .= '</div>';
	return force_balance_tags( $result );
}
add_shortcode('et_brand_fact', 'et_brand_fact'); 

/**
 * heading_style
 */ 
function et_heading_style($atts, $content=null){
	extract(shortcode_atts(array(
		'fontsize' => '55', 
		'color' => '#333',
		'link' => '', 
		'heading' => '',   
		), $atts));    

	$result = '<div class="big-heading">';
    $result .= '<h2 style="font-size:'.$fontsize.'px; color:'.$color.';"><a style="font-size:'.$fontsize.'px; color:'.$color.';" href="'.$link.'" title="'.$heading.'">'.$heading.'<span class="heading-end-dot">.</span></a></h2>';
	$result .= '<p>'.do_shortcode($content ).'</p>';
	$result .= '</div>';
	return force_balance_tags( $result );
}
add_shortcode('et_heading_style', 'et_heading_style'); 
  
/**
 * heading_style2
 */ 
function et_heading_style2($atts, $content=null){
	extract(shortcode_atts(array(
		'type' => 'h3', 
		'color' => '#333',
		'align' => 'left', 
		'bg_color' => '#fff',   
		), $atts));    

	$result = '<'. $type .' id="titles" style="text-align:'.$align.';"><span style="background-color: '.$bg_color.'">'.do_shortcode($content ).'</span></'. $type .'>';
   
	return force_balance_tags( $result );
}
add_shortcode('et_heading_style2', 'et_heading_style2'); 

/**
 * icons
 */ 
function et_icon($atts,$content=null){
	extract(shortcode_atts(array(
		'icon_size' => '14', 
		'font_size' => '14',
		'color' => '#333',
		'link' => '#',
		'icon_show_inline' => 'span',
		'icon' => '',    
		), $atts));    
 

	$result = '<a href="'.$link.'"><span class="simple-list" style="font-size:'.$font_size.'px; color:'.$color.';"><i class="'.$icon.'" style="font-size:'.$icon_size.'px; color:'.$color.';"></i> ';
	$result .= do_shortcode($content );
	$result .= '</span></a>'; 
	return force_balance_tags( $result );
}
add_shortcode('et_icon', 'et_icon'); 


/**
 *DesignWall shortcodes tabs
 *@package DesignWall Shorcodes
 *@since 1.0
*/

/**
 * Tabs
 */
//-------------- 
//	[tabs]
//		[thead]
//			[tab href="#link" title="title"]
//			[dropdown title="title"]
//				[tab href="#link" title="title"]
//			[/dropdown]
//		[/thead]
//		[tcontents]
//			[tcontent id="link"]
//			[/tcontent]
//		[/tcontents]
//	[/tabs]
//	---------------
//	

function et_tabs($params, $content = null){
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = '<div class="tab_wrap">';
	$result .= do_shortcode($content );
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('tabs', 'et_tabs');

function et_thead($params, $content = null){
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = '<ul class="nav nav-tabs">';
	$result .= do_shortcode($content );
	$result .= '</ul>'; 
	return force_balance_tags( $result );
}
add_shortcode('thead', 'et_thead');

function et_tab($params, $content = null){
	extract(shortcode_atts(array(
		'href' => '#',
		'title' => '',
		'class' => ''
 		), $params));
	$content = preg_replace('/<br class="nc".\/>/', '', $content);

	$result = '<li class="'.$class.'">';
	$result .= '<a data-toggle="tab" href="'.$href.'">'.$title.'</a>';
	$result .= '</li>'; 
	return force_balance_tags( $result );
}
add_shortcode('tab', 'et_tab');

function et_dropdown($params, $content = null){
	global $et_timestamp;
	extract(shortcode_atts(array(
		'title' => '',
		'id' => '',
		'class' => '',
		), $params));
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = '<li class="dropdown">';
	$result .= '<a class="'.$class.'" id="'.$id.'" class="dropdown-toggle" data-toggle="dropdown">'.$title.'<b class="caret"></b></a>';
	$result .='<ul class="dropdown-menu">';
	$result .= do_shortcode($content);
	$result .= '</ul></li>'; 
	return force_balance_tags( $result );
}
add_shortcode('dropdown', 'et_dropdown');

function et_tcontents($params, $content = null){
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = '<div class="tab-content">';
	$result .= do_shortcode($content );
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('tcontents', 'et_tcontents');

function et_tcontent($params, $content = null){
	extract(shortcode_atts(array(
		'id' => '',
		'class'=>'',
		), $params));
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$class= ($class=='active')?'active in':'';
	$result = '<div class="tab-pane fade '.$class.'" id='.$id.'>';
	$result .= do_shortcode($content );
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('tcontent', 'et_tcontent');


/**
 * Collapse
 */

function et_collapse($params, $content = null){
	extract(shortcode_atts(array(
		'id'=>''
 		), $params));
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = '<div class="panel-group" id="accordion">';
	$result .= do_shortcode($content );
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('collapse', 'et_collapse');


function et_citem($params, $content = null){
	extract(shortcode_atts(array(
		'id'=>'',
		'title'=>'Collapse title',
		'parent' => '',
		'citem_open' => 'in'

 		), $params));
	$content = preg_replace('/<br class="nc".\/>/', '', $content);
	$result = ' <div class="panel panel-default ">';
	$result .= ' <div class="panel-heading">';
	$result .= '<h4 class="panel-title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#'.$parent.'" href="#'.$id.'">';
	$result .= $title;
	$result .= '</a></h4>';
	$result .= '</div>';
	$result .= '<div id="'.$id.'" class="panel-collapse collapse '.$citem_open.'">';
	$result .= '<div class="panel-body">';
	$result .= do_shortcode($content );
	$result .= '</div>'; 
	$result .= '</div>'; 
	$result .= '</div>'; 
	return force_balance_tags( $result );
}
add_shortcode('citem', 'et_citem');


/*
 * Divider
 */
 
	function et_divider( $atts ) {
		extract( shortcode_atts( array(
			'style'			=> 'fadeout',
			'margin_top'	=> '20px',
			'margin_bottom'	=> '20px',
			'class'			=> '',
		  ),
		  $atts ) );
		$style_attr = '';
		if ( $margin_top && $margin_bottom ) {  
			$style_attr = 'style="margin-top: '. $margin_top .';margin-bottom: '. $margin_bottom .';"';
		} elseif( $margin_bottom ) {
			$style_attr = 'style="margin-bottom: '. $margin_bottom .';"';
		} elseif ( $margin_top ) {
			$style_attr = 'style="margin-top: '. $margin_top .';"';
		} else {
			$style_attr = NULL;
		}
	 return '<hr class="divider '. $style .' '. $class .'" '.$style_attr.' />';
	 }
	add_shortcode( 'et_divider', 'et_divider' );


/*
 * Divider
 */
	function et_spacing( $atts ) {
		extract( shortcode_atts( array(
			'size'	=> '20px',
			'class'	=> '',
		  ),
		  $atts ) );
	 return '<hr class="et-spacing '. $class .'" style="height: '. $size .'" />';
	}
	add_shortcode( 'et_spacing', 'et_spacing' );

/*
 * Divider
 */
	function et_big_title( $atts ) {
		extract( shortcode_atts( array(
			'fontsize' => '55',
			'align' => 'left',
			'textcolor' => '#000',
			'title' => 'Your title goes here',
			'make_underline' => 'yes',
		  ),
		  $atts ) );
	 return '<h1 class="big-title '.$make_underline.'" style="text-align:'.$align.'; font-size:'.$fontsize.'px; color:'.$textcolor.'; border-bottom-color:'.$textcolor.';"> ' . $title . '<span class="heading-end-dot">.</span></h1>';
	}
	add_shortcode( 'et_big_title', 'et_big_title' );