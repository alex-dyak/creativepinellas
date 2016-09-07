<?php
/* WARNING! This file may change in the near future as we intend to add features to the event editor. If at all possible, try making customizations using CSS, jQuery, or using our hooks and filters. - 2012-02-14 */
/* 
 * To ensure compatability, it is recommended you maintain class, id and form name attributes, unless you now what you're doing. 
 * You also must keep the _wpnonce hidden field in this form too.
 */
global $EM_Event, $EM_Notices, $bp;

//check that user can access this page
if( is_object($EM_Event) && !$EM_Event->can_manage('edit_events','edit_others_events') ){
	?>
	<div class="wrap"><h2><?php esc_html_e('Unauthorized Access','events-manager'); ?></h2><p><?php echo sprintf(__('You do not have the rights to manage this %s.','events-manager'),__('Event','events-manager')); ?></p></div>
	<?php
	return false;
}elseif( !is_object($EM_Event) ){
	$EM_Event = new EM_Event();
}
$required = apply_filters('em_required_html','<i>*</i>');

echo $EM_Notices;
//Success notice
if( !empty($_REQUEST['success']) ){
	if(!get_option('dbem_events_form_reshow')) return false;
}

//Get the artists.
$query_args = array(
	'post_type'      => 'artist',
	'posts_per_page' => -1
);
$artist_query  = new WP_Query( $query_args );

?>
<form enctype='multipart/form-data' id="event-form" method="post" action="<?php echo esc_url(add_query_arg(array('success'=>null))); ?>"> <!--event-form-->
	<div class="wrap submitEventForm">
		<?php do_action('em_front_event_form_header'); ?>
		<?php if(get_option('dbem_events_anonymous_submissions') && !is_user_logged_in()): ?>
			<h3 class="event-form-submitter"><?php esc_html_e( 'Your Details', 'events-manager'); ?></h3>
			<div class="inside event-form-submitter submitEventForm-section">
				<div class="large-8">
					<label><?php esc_html_e('Name', 'events-manager'); ?></label>
					<div class="form-row">
						<input type="text" name="event_owner_name" id="event-owner-name" value="<?php echo esc_attr($EM_Event->event_owner_name); ?>" />
					</div>
				</div>
				<div class="large-8">
					<label><?php esc_html_e('Email', 'events-manager'); ?></label>
					<div class="form-row">
						<input type="text" name="event_owner_email" id="event-owner-email" value="<?php echo esc_attr($EM_Event->event_owner_email); ?>" />
					</div>
				</div>
				<?php do_action('em_front_event_form_guest'); ?>
				<?php do_action('em_font_event_form_guest'); //deprecated ?>
			</div>
		<?php endif; ?>
		<h3 class="event-form-name"><?php esc_html_e( 'Event Details', 'events-manager'); ?></h3>
		<div class="inside event-form-name submitEventForm-section">
			<div class="large-8">
				<label><?php esc_html_e('Event Name ', 'events-manager'); ?><?php echo $required; ?></label>
				<div class="form-row">
					<input type="text" name="event_name" id="event-name" value="<?php echo esc_attr($EM_Event->event_name,ENT_QUOTES); ?>" />
					<span><?php esc_html_e('The event name. Example: Birthday party', 'events-manager'); ?></span>
					<?php em_locate_template('forms/event/group.php',true); ?>
				</div>
			</div>
			<div class="large-8">
				<label><?php esc_html_e('Event Type', 'events-manager'); ?></label>
				<div class="form-row">
					<?php $select_events = wp_dropdown_categories(array(
						'echo' => 0,
						'show_option_all'    => __('none selected','events-manager'),
						'hide_empty' => 0,
						'orderby' =>'name',
						'name' => 'event-type',
						'hierarchical' => true,
						'taxonomy' => 'event-type',
						'selected' => '',
						'show_option_none' =>'',
						'option_none_value'=> 0,
						'class'=>'em-events-search-category'
					));
					$select_events = str_replace( "name='event-type' id=", "name='event-type[]' multiple='multiple' id=", $select_events );
					echo $select_events;
					?>
				</div>
			</div>
			<div class="large-8">
				<label><?php esc_html_e('Who Should Attend', 'events-manager'); ?></label>
				<div class="form-row">
					<?php $select_cats = wp_dropdown_categories(array(
						'echo' => 0,
						'show_option_all'    => __('none selected','events-manager'),
						'hide_empty' => 0,
						'orderby' =>'name',
						'name' => 'who-should-attend',
						'hierarchical' => true,
						'taxonomy' => 'who-should-attend',
						'selected' => '',
						'show_option_none' =>'',
						'option_none_value'=> 0,
						'class'=>'em-events-search-category'
					));
					$select_cats = str_replace( "name='who-should-attend' id=", "name='who-should-attend[]' multiple='multiple' id=", $select_cats );
					echo $select_cats;
					?>
				</div>
			</div>
			<div class="large-8">
				<label><?php esc_html_e('Artist', 'events-manager'); ?></label>
				<div class="form-row">
					<?php if ($artist_query->have_posts()) : ?>
					<select id="artist" name="artist[]" multiple="multiple" size="5" style="display: block;">
						<option value="0" selected="selected"><?php _e('none selected','events-manager'); ?></option>
						<?php while ( $artist_query->have_posts() ) : $artist_query->the_post(); ?>
						<option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
						<?php endwhile; ?>
					</select>
					<?php endif; ?>
				</div>
				<?php wp_reset_query(); ?>
			</div>
			<div class="large-8">
				<label><?php esc_html_e('Cost', 'events-manager'); ?></label>
				<div class="form-row">
					<input type="text" name="cost" id="cost" value="" />
				</div>
			</div>
			<div class="large-8">
				<label><?php esc_html_e('Website URL', 'events-manager'); ?></label>
				<div class="form-row">
					<input name="event-website" type="url" />
				</div>
			</div>
			<div class="small-12">
				<label><?php esc_html_e( 'Details', 'events-manager'); ?></label>
				<div class="event-editor form-row">
					<?php if( get_option('dbem_events_form_editor') && function_exists('wp_editor') ): ?>
						<?php wp_editor($EM_Event->post_content, 'em-editor-content', array('textarea_name'=>'content') ); ?>
					<?php else: ?>
						<textarea name="content" rows="10" style="width:100%"><?php echo $EM_Event->post_content ?></textarea>
						<?php esc_html_e( 'Details about the event.', 'events-manager')?> <?php esc_html_e( 'HTML allowed.', 'events-manager')?>
					<?php endif; ?>
				</div>
			</div>
			<div class="event-extra-details">
				<?php if(get_option('dbem_attributes_enabled')) { em_locate_template('forms/event/attributes-public.php',true); }  ?>
				<?php if(get_option('dbem_categories_enabled')) { em_locate_template('forms/event/categories-public.php',true); }  ?>
			</div>
		</div>

		<h3 class="event-form-when"><?php esc_html_e( 'When', 'events-manager'); ?></h3>
		<div class="inside event-form-when submitEventForm-section">
		<?php 
			if( empty($EM_Event->event_id) && $EM_Event->can_manage('edit_recurring_events','edit_others_recurring_events') && get_option('dbem_recurrence_enabled') ){
				em_locate_template('forms/event/when-with-recurring.php',true);
			}elseif( $EM_Event->is_recurring()  ){
				em_locate_template('forms/event/recurring-when.php',true);
			}else{
				em_locate_template('forms/event/when.php',true);
			}
		?>
		</div>

		<?php if( $EM_Event->can_manage('upload_event_images','upload_event_images') ): ?>
			<h3><?php esc_html_e( 'Event Image', 'events-manager'); ?></h3>
			<div class="inside event-form-image submitEventForm-section">
				<?php em_locate_template('forms/event/featured-image-public.php',true); ?>
			</div>
		<?php endif; ?>


		<?php if( get_option('dbem_locations_enabled') ): ?>
		<h3 class="event-form-where"><?php esc_html_e( 'Where', 'events-manager'); ?></h3>
		<div class="inside event-form-where submitEventForm-section">
		<?php em_locate_template('forms/event/location.php',true); ?>
		</div>
		<?php endif; ?>


		<?php /* TODO:  Booking not used and not styled	 */?>
		<?php if( get_option('dbem_rsvp_enabled') && $EM_Event->can_manage('manage_bookings','manage_others_bookings') ) : ?>
		<!-- START Bookings -->
		<h3><?php esc_html_e('Bookings/Registration','events-manager'); ?></h3>
		<div class="inside event-form-bookings submitEventForm-section">
			<?php em_locate_template('forms/event/bookings.php',true); ?>
		</div>
		<!-- END Bookings -->
		<?php endif; ?>
		
		<?php do_action('em_front_event_form_footer'); ?>
	</div>

	<div class="submit">
	    <?php if( empty($EM_Event->event_id) ): ?>
	    <input type='submit' class='btn btn-middleWidth btn--ocean' value='<?php echo esc_attr(sprintf( __('Submit %s','events-manager'), __('Event','events-manager') )); ?>' />
	    <?php else: ?>
	    <input type='submit' class='btn btn-middleWidth btn--ocean' value='<?php echo esc_attr(sprintf( __('Update %s','events-manager'), __('Event','events-manager') )); ?>' />
	    <?php endif; ?>
	</div>
	<input type="hidden" name="event_id" value="<?php echo $EM_Event->event_id; ?>" />
	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('wpnonce_event_save'); ?>" />
	<input type="hidden" name="action" value="event_save" />
	<?php if( !empty($_REQUEST['redirect_to']) ): ?>
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_REQUEST['redirect_to']); ?>" />
	<?php endif; ?>
</form>
