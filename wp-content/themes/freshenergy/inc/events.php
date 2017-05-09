<?php
/**
 * Events page functions
 */

/**
 * Register the metabox
 */
function fe_events_date_add_meta_box() {
	add_meta_box (
		'fe_events_date_metabox',
		__( 'Event Date', 'fe' ),
		'fe_events_date_metabox_display',
		'post',
		'side',
		'default'
	);
}
add_action( 'admin_init', 'fe_events_date_add_meta_box' );

/**
 * render metabox contents
 * this requires the datepicker to be formatted using ISO 8601, for conveneience of sorting
 * display AP style dates, but save using the altformat: https://api.jqueryui.com/datepicker/#option-altFormat
 */
function fe_events_date_metabox_display() {
	global $post;
	$date = esc_attr(get_post_meta( $post->ID, 'events_date_iso', true ));

	?>
		<div id="fe_events_date_metabox">
			<label for="events_date" class="hidden">Event Date</label>
			<input type="text" id="events_date_datepicker" name="events_date" value="<?php echo $date; ?>"></input>
			<label for="events_date_iso" class="hidden">Event Date in YYYY-MM-DD format</label>
			<input type="text" id="events_date_iso" class="hidden" name="events_date_iso" value="<?php echo $date; ?>"></input>
			<script>
				$ = jQuery;
				jQuery(document).ready(function() {
					// assuming that there's only one instance of this metabox on the page
					$picker = $( '#events_date_datepicker' );
					$picker.datepicker({
						altField: '#events_date_iso',
						altFormat: 'yy-mm-dd', // aka 'ISO_8601'
						dateFormat: 'D, dd M yy',
						gotoCurrent: true,
						onSelect: function( dateText, inst ) {
						}
					});
					current_date = $('#events_date_iso').val();
					$picker.datepicker( 'setDate', Date.parse( current_date ) );
				});
			</script>
			<?php wp_nonce_field( 'events_date_iso', 'events_date_nonce' ); ?>
		</div>
	<?php
}
/**
 * validate and save the metabox
 */
function fe_events_date_save_fields( $post_id ) {
	if ( !isset( $_POST['events_date_nonce'] ) || ! wp_verify_nonce( $_POST['events_date_nonce'], 'events_date_iso' ) ) {
		return;
	}

	global $post;
	if ( isset( $_POST['events_date_iso'] ) ) {
		// needs validatiom
		$value = preg_replace( '/[^0-9-]+/', "", $_POST['events_date_iso'] );
		return;
	}
}
add_action( 'save_post', 'fe_events_date_save_fields' );

/**
 * enqueue jQuery UI datepicker
 */
function fe_datepicker_admin_enqueue() {
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
}
add_action( 'admin_enqueue_scripts', 'fe_datepicker_admin_enqueue' );
