<?php
/* Used by the buddypress and front-end editors to display event time-related information */
global $EM_Event;
$days_names = em_get_days_names();
$hours_format = em_get_hour_format();
$admin_recurring = is_admin() && $EM_Event->is_recurring();
?>
<?php if( is_admin() ): ?><input type="hidden" name="_emnonce" value="<?php echo wp_create_nonce('edit_event'); ?>" /><?php endif; ?>
<!-- START recurrence postbox -->
<div id="em-form-with-recurrence" class="event-form-with-recurrence event-form-when">
	<div class="form-row">
		<label>
			<input type="checkbox" id="em-recurrence-checkbox" name="recurring" value="1" <?php if($EM_Event->is_recurring()) echo 'checked' ?> />
			<?php _e('This is a recurring event.', 'events-manager'); ?>
		</label>
	</div>

	<div class="em-date-range row">
		<div class="halfMedium-6 column">
			<label>
				<span class="em-recurring-text"><?php _e ( 'Recurrences span from ', 'events-manager'); ?></span>
				<span class="em-event-text"><?php _e ( 'From ', 'events-manager'); ?></span>
			</label>
			<div class="form-row">
				<input class="em-date-start em-date-input-loc is-datepicker" type="text" />
				<input class="em-date-input" type="hidden" name="event_start_date" value="<?php echo $EM_Event->event_start_date ?>" />
			</div>
		</div>

		<div class="halfMedium-6 column">
			<label>
				<span class="em-recurring-text"><?php _e('to','events-manager'); ?></span>
				<span class="em-event-text"><?php _e('to','events-manager'); ?></span>
			</label>
			<div class="form-row">
				<input class="em-date-end em-date-input-loc is-datepicker" type="text" />
				<input class="em-date-input" type="hidden" name="event_end_date" value="<?php echo $EM_Event->event_end_date ?>" />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="halfMedium-6 column">
			<label>
				<span class="em-recurring-text"><?php _e('Events start from','events-manager'); ?></span>
				<span class="em-event-text"><?php _e('Event starts at','events-manager'); ?></span>
			</label>
			<div class="form-row">
				<input id="start-time" class="em-time-input em-time-start" type="text" size="8" maxlength="8" name="event_start_time" value="<?php echo date( $hours_format, $EM_Event->start ); ?>" />
			</div>
		</div>
		<div class="halfMedium-6 column">
			<label>
				<?php _e('to','events-manager'); ?>
			</label>
			<div class="form-row">
				<input id="end-time" class="em-time-input em-time-end" type="text" size="8" maxlength="8" name="event_end_time" value="<?php echo date( $hours_format, $EM_Event->end ); ?>" />
			</div>
		</div>
		<div class="small-12 column">
			<div class="form-row">
				<label>
					<input type="checkbox" class="em-time-allday" name="event_all_day" id="em-time-all-day" value="1" <?php if(!empty($EM_Event->event_all_day)) echo 'checked="checked"'; ?> />
					<?php _e('All day','events-manager'); ?>
				</label>
			</div>
		</div>
	</div>


	<div class="em-recurring-text row">
		<div class="halfMedium-6 column">
			<label for="recurrence-frequency"><?php _e ( 'This event repeats', 'events-manager'); ?></label>
			<div class="form-row">
				<select id="recurrence-frequency" name="recurrence_freq">
					<?php
						$freq_options = array ("daily" => __ ( 'Daily', 'events-manager'), "weekly" => __ ( 'Weekly', 'events-manager'), "monthly" => __ ( 'Monthly', 'events-manager'), 'yearly' => __('Yearly','events-manager') );
						em_option_items ( $freq_options, $EM_Event->recurrence_freq );
					?>
				</select>
			</div>
		</div>
		<div class="halfMedium-6 column">
			<label><?php _e ( 'every', 'events-manager')?></label>
			<div class="form-row">
				<input id="recurrence-interval" name='recurrence_interval' class="is-inline" type="text" size='2' value='<?php echo $EM_Event->recurrence_interval ; ?>' />
				<span class='interval-desc' id="interval-daily-singular"><?php _e ( 'day', 'events-manager')?></span>
				<span class='interval-desc' id="interval-daily-plural"><?php _e ( 'days', 'events-manager') ?></span>
				<span class='interval-desc' id="interval-weekly-singular"><?php _e ( 'week on', 'events-manager'); ?></span>
				<span class='interval-desc' id="interval-weekly-plural"><?php _e ( 'weeks on', 'events-manager'); ?></span>
				<span class='interval-desc' id="interval-monthly-singular"><?php _e ( 'month on the', 'events-manager')?></span>
				<span class='interval-desc' id="interval-monthly-plural"><?php _e ( 'months on the', 'events-manager')?></span>
				<span class='interval-desc' id="interval-yearly-singular"><?php _e ( 'year', 'events-manager')?></span>
				<span class='interval-desc' id="interval-yearly-plural"><?php _e ( 'years', 'events-manager') ?></span>
			</div>
		</div>
		<p class="alternate-selector small-12 column" id="weekly-selector">
			<?php
				$saved_bydays = ($EM_Event->is_recurring()) ? explode ( ",", $EM_Event->recurrence_byday ) : array(); 
				em_checkbox_items ( 'recurrence_bydays[]', $days_names, $saved_bydays ); 
			?>
		</p>
		<p class="alternate-selector small-12 column"  id="monthly-selector" style="display:inline;">
			<span class="row">
				<span class="halfMedium-6 column">
					<span class="form-row">
						<select id="monthly-modifier" name="recurrence_byweekno">
							<?php
								$weekno_options = array ("1" => __ ( 'first', 'events-manager'), '2' => __ ( 'second', 'events-manager'), '3' => __ ( 'third', 'events-manager'), '4' => __ ( 'fourth', 'events-manager'), '-1' => __ ( 'last', 'events-manager') );
								em_option_items ( $weekno_options, $EM_Event->recurrence_byweekno  );
							?>
						</select>
					</span>
				</span>
				<span class="halfMedium-6 column">
					<span class="form-row">
						<select id="recurrence-weekday" name="recurrence_byday">
							<?php em_option_items ( $days_names, $EM_Event->recurrence_byday  ); ?>
						</select>
					</span>
				</span>
			</span>
			<?php _e('of each month','events-manager'); ?>
		</p>
		<div class="em-duration-range small-12 column">
			<label for="end-days"><?php echo _e('Each event spans','events-manager'); ?></label>
			<div class="form-row">
				<input id="end-days" class="is-inline" type="text" size="8" maxlength="8" name="recurrence_days" value="<?php echo $EM_Event->recurrence_days; ?>" />
				<?php _e ( 'day(s)', 'events-manager') ?>
			</div>
		</div>
		<div class="em-range-description small-12 column">
			<div class="form-row">
				<em><?php _e( 'For a recurring event, a one day event will be created on each recurring date within this date range.', 'events-manager'); ?></em>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready( function($) {
		$('#em-recurrence-checkbox').change(function(){
			if( $('#em-recurrence-checkbox').is(':checked') ){
				$('.em-recurring-text').show();
				$('.em-event-text').hide();
			}else{
				$('.em-recurring-text').hide();
				$('.em-event-text').show();
			}
		});
		$('#em-recurrence-checkbox').trigger('change');
	});
	//]]>
	</script>
</div>
