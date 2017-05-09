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
						dateFormat: 'COOKIE',
						gotoCurrent: true,
						onSelect: function( dateText, inst ) {
						}
					});
					current_date = $('#events_date_iso').val();
					console.log( current_date );
					$picker.datepicker( 'setDate', current_date );
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
		error_log(var_export( 'foo', true));
		return;
	}

	global $post;
	if ( isset( $_POST['events_date_iso'] ) ) {
		// needs validatiom
		error_log(var_export( $_POST['events_date_iso'] , true));
		$value = preg_replace( '/[^0-9-]+/', "", $_POST['events_date_iso'] );
		error_log(var_export( $value , true));
		update_post_meta( $post->ID, 'events_date_iso', esc_attr( $value ) );
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

// test function
add_action( 'largo_after_hero', function() {
	printf(
		'<div class="entry-content red">date: %1$s</div>',
		get_post_meta( null, 'event-date', true )
	);
} );
