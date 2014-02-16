<?php
/*
The comments page for E-simple
*/

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="alert alert-info"><?php _e('This post is password protected. Enter the password to view comments.', 'theme_setup'); ?></div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<div class="mainc-title"> 
		<h3><?php comments_number('<span>' . __('No', 'theme_setup') . '</span> ' . __('Comments', 'theme_setup') . '', '<span>' . __('1', 'theme_setup') . '</span> ' . __('Comment', 'theme_setup') . '', '<span>%</span> ' . __('Comments', 'theme_setup') );?> <span class="pull-right"><i class="icon-comment"></i>  </span></h3>
	</div>

	<div id="comments">
		<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=bones_comments'); ?>
		</ol>
	</div>
	
	<?php endif; ?>
	
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<h3 id="pings">Trackbacks/Pingbacks</h3>
		
		<ol class="pinglist">
			<?php wp_list_comments('type=pings&callback=list_pings'); ?>
		</ol>
	<?php endif; ?>
  
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
    	<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed 
	?>
	
	<?php
		$suppress_comments_message = of_get_option('suppress_comments_message');

		if (is_page() && $suppress_comments_message) :
	?>
			
		<?php else : ?>
		
			<!-- If comments are closed. -->
			<p class="alert alert-info"><?php _e('Comments are closed', 'theme_setup'); ?>.</p>
			
		<?php endif; ?>

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond" class="respond-form">
   <div class="mainc-form">
	<h3 id="comment-form-title"></h3>
	<div class="mainc-title "><h3><?php comment_form_title( __('Leave a Respons', 'theme_setup'), __('Leave a Respons to', 'theme_setup') . ' %s' ); ?> <span class="pull-right"><i class="icon-comment"></i> </span></h3></div>
	<div id="cancel-comment-reply">
		<p class="small"><?php cancel_comment_reply_link( __('Cancel', 'theme_setup') ); ?></p>
   	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  	<div class="help">
  		<p><?php _e('You must be', 'theme_setup'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in', 'theme_setup'); ?></a> <?php _e('to post a comment', 'theme_setup'); ?>.</p>
  	</div>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="contact-form" id="commentform">

	<?php if ( is_user_logged_in() ) : ?>

	<p class="comments-logged-in-as"><?php _e('Logged in as', 'theme_setup'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'theme_setup'); ?>"><?php _e('Log out', 'theme_setup'); ?> &raquo;</a></p>

	<?php else : ?>
	<div class="mainc-form-top">
	      
	    <input class="field name" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e('Your Name', 'theme_setup'); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />  
		<input class="field email" type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e('Your Email', 'theme_setup'); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
 		<input class="field web last" type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e('Your Website', 'theme_setup'); ?>" tabindex="3" />

	</div> 
	<?php endif; ?>

	<div class="mainc-form-bottom"> 
		<textarea name="comment" id="comment" cols="50" rows="10" placeholder="<?php _e('Your Comment Here…', 'theme_setup'); ?>" tabindex="4"></textarea>
	</div> 
	
	<input class="btn btn-danger name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'theme_setup'); ?>" />
	<?php comment_id_fields(); ?>
 
	<?php 
		//comment_form();
		do_action('comment_form()', $post->ID); 

	?> 
	</form>
	
	<?php endif; // If registration required and not logged in ?>

	</div>	
</section>

<?php endif; // if you delete this the sky will fall on your head ?>