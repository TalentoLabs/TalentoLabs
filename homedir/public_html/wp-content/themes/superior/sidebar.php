		<div class="sidebar" role="complementary">

					<?php if ( is_active_sidebar( 'bpsidebar' ) ) : ?>

						<?php dynamic_sidebar( 'bpsidebar' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="alert-message">
						
							<p><?php _e("Please activate some Widgets","e-connect"); ?>.</p>
						
						</div>

					<?php endif; ?>

				</div>