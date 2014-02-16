<?php 

add_action( 'add_meta_boxes', 'et_meta_box_add' );

function et_meta_box_add()
 { 
   foreach (array('page') as $type)  

        add_meta_box('et_meta_box', 'Page  customization options', 'et_theme_meta_box', $type, 'normal', 'high');
   		add_meta_box('et_meta_box', 'Portfolio fields', 'et_theme_folio_meta_box', 'portfolio', 'normal', 'high');
    }

function et_theme_meta_box( $post )
{
	$values = get_post_custom( $post->ID );
	$text = isset( $values['heading_dec'] ) ? esc_attr( $values['heading_dec'][0] ) : '';
	$selected = isset( $values['page_title'] ) ? esc_attr( $values['page_title'][0] ) : ''; 
	wp_nonce_field( 'et_meta_box_nonce', 'meta_box_nonce' );
	?>

	<p><label for="page_title"><strong>Page Title</strong> </label></p>
	<p>	
		<select name="page_title" id="page_title"> 
			<option value="show" <?php selected( $selected, 'show' ); ?>>Show</option>
			<option value="hide" <?php selected( $selected, 'hide' ); ?>>Hide</option>
		</select>
	</p>

	<p><label for="heading_dec"><strong>Heading dec</strong> </label></p>
    <p><textarea name="heading_dec" id="heading_dec" placeholder="Your Text Here..." cols="50" rows="8" style="width:100%;"><?php echo $text; ?></textarea></p>
	 
	<?php	
}

function et_theme_folio_meta_box( $post )
{
	$values = get_post_custom( $post->ID );
	$challenge = isset( $values['challenge'] ) ? esc_attr( $values['challenge'][0] ) : ''; 
	$solution = isset( $values['solution'] ) ? esc_attr( $values['solution'][0] ) : '';
	$project_site_link = isset( $values['project_site_link'] ) ? esc_attr( $values['project_site_link'][0] ) : '';
	wp_nonce_field( 'et_meta_box_nonce', 'meta_box_nonce' );
	?>
 
	<p><label for="challenge"><strong>Challenge</strong> </label></p>
    <p><textarea name="challenge" id="challenge" placeholder="Your Text Here..." cols="50" rows="8" style="width:100%;"><?php echo $challenge; ?></textarea></p>
	
	<p><label for="solution"><strong>Solution</strong> </label></p>
    <p><textarea name="solution" id="solution" placeholder="Your Text Here..." cols="50" rows="8" style="width:100%;"><?php echo $solution; ?></textarea></p>
    
    <p><label for="solution"><strong>Project Site Link</strong> </label></p>
    <p><input type="text" value="<?php echo $project_site_link; ?>" name="project_site_link"></p>

	<?php	
}


add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'et_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['heading_dec'] ) )
		update_post_meta( $post_id, 'heading_dec', wp_kses( $_POST['heading_dec'], $allowed ) );
		
	if( isset( $_POST['page_title'] ) )
		update_post_meta( $post_id, 'page_title', esc_attr( $_POST['page_title'] ) );
	
	if( isset( $_POST['challenge'] ) )
		update_post_meta( $post_id, 'challenge', esc_attr( $_POST['challenge'] ) );

	if( isset( $_POST['solution'] ) )
		update_post_meta( $post_id, 'solution', esc_attr( $_POST['solution'] ) );

	if( isset( $_POST['project_site_link'] ) )
		update_post_meta( $post_id, 'project_site_link', esc_attr( $_POST['project_site_link'] ) );			 
}
?>