<?php
/** A simple text block **/
class AQ_Column_Block extends AQ_Block {

	/* PHP5 constructor */
	function __construct() {

		$block_options = array(
			'name' => 'Block Holder',
			'size' => 'span12',
		);

		//create the widget
		parent::__construct('aq_column_block', $block_options);

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
		__('Drag block items into this column box', 'framework'),
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
			echo '<li id="template-block-'.$number.'" class="block block-container block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">',
						'<p class="empty-column">',
							__('Drag block items into this column box', 'framework'),
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
			'columnbg' => '#f5f5f5',
			'bgimg' => '',
			'paddingtop' => '65',
			'paddingbottom' => '65',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
$columnbg = isset($columnbg) ? $columnbg : '#f5f5f5';

		?>
		<div class="description ">
			<label for="<?php echo $this->get_field_id('columnbg') ?>">
				Column Background color (optional)
                <div class="aqpb-color-picker">
                <input type="text" id="<?php echo $this->get_field_id('columnbg') ?>" class="input-color-picker" value="<?php echo $columnbg ?>" name="<?php echo $this->get_field_name('columnbg') ?>" data-default-color="<?php echo $columnbg ?>"/>
                 </div>
			</label>
		</div> 
        
      <div class="description ">
	        <label for="<?php echo $this->get_field_id('bgimg') ?>">
	        Upload an Column background image (optional)<br/>
		   <input type="text" id="<?php echo $this->get_field_id('bgimg') ?>" class="input-full input-upload" value="<?php echo $bgimg ?>" name="<?php echo $this->get_field_name('bgimg') ?>">
           <a href="#" class="aq_upload_button button" rel="<?php echo $media_type ?>">Upload</a><p></p>
	        </label>
	        <?php if($bgimg) { ?>
	        <div class="screenshot">
	        <img src="<?php echo $bgimg ?>" style="width:80px; height:auto;"  />
	        </div> 
	        <?php } ?>
	    </div>   
        
	 <div class="description ">
	        <label for="<?php echo $this->get_field_id('paddingtop') ?>">
	        padding from top 
		   <input type="text" id="<?php echo $this->get_field_id('paddingtop') ?>" class="input-full " value="<?php echo $paddingtop ?>" name="<?php echo $this->get_field_name('paddingtop') ?>">
           </label>
	        
           <label for="<?php echo $this->get_field_id('paddingbottom') ?>">
	        padding from bottom
		   <input type="text" id="<?php echo $this->get_field_id('paddingbottom') ?>" class="input-full " value="<?php echo $paddingbottom ?>" name="<?php echo $this->get_field_name('paddingbottom') ?>">
           </label>
	    </div>   
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
        echo '<div style="background:'.$columnbg .' url('.$bgimg.'); padding:'.$paddingtop.'px 0 '.$paddingbottom.'px 0;"> <div class="container"><div class="row">';
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
echo '</div></div> </div>';
			$this->after_block($instance);

		} else {
			//show nothing
		}
	}

}