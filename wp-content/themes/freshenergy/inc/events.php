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
	$date = esc_attr(get_post_meta( $post->ID, 'events_date_epoch', true ));

	?>
		<div id="fe_events_date_metabox">
			<label for="events_date" class="hidden">Event Date</label>
			<input type="text" id="events_date_datepicker" name="events_date" value="<?php echo $date; ?>"></input>
			<label for="events_date_epoch" class="hidden">Event Date in YYYY-MM-DD format</label>
			<input type="text" id="events_date_epoch" class="hidden" name="events_date_epoch" value="<?php echo $date; ?>"></input>
			<script>
				$ = jQuery;
				jQuery(document).ready(function() {
					// assuming that there's only one instance of this metabox on the page
					$picker = $( '#events_date_datepicker' );
					$picker.datepicker({
						altField: '#events_date_epoch',
						altFormat: '@', // aka 'TIMESTAMP', the Unix epoch in milliseconds
						dateFormat: 'D, dd M yy',
						gotoCurrent: true,
						firstDay: 0,
						buttonText: '<span class="hidden">Select Event Date</span>📅',
						showOn: "both",
					});

					// populate the datepicker from the actual setting field upon load
					proposed_date = $('#events_date_epoch').val();
					if ( proposed_date ) {
						actual_date = new Date( Number( proposed_date ) ); // we're feeding this a Unix Epoch date with milliseconds: js-created, js-parsed
						console.log( proposed_date );
						console.log( actual_date );
						$picker.datepicker( 'setDate', actual_date );
					}
				});
			</script>
			<?php wp_nonce_field( 'events_date_epoch', 'events_date_nonce' ); ?>
		</div>
	<?php
}
/**
 * validate and save the metabox
 */
function fe_events_date_save_fields( $post_id ) {
	if ( !isset( $_POST['events_date_nonce'] ) || ! wp_verify_nonce( $_POST['events_date_nonce'], 'events_date_epoch' ) ) {
		return;
	}

	global $post;
	if ( isset( $_POST['events_date_epoch'] ) ) {
		// needs validatiom
		$value = preg_replace( '/[^0-9-]+/', "", $_POST['events_date_epoch'] );
		update_post_meta( $post->ID, 'events_date_epoch', esc_attr( $value ) );
		return;
	}
}
add_action( 'save_post', 'fe_events_date_save_fields' );

/**
 * enqueue jQuery UI datepicker
 */
function fe_datepicker_admin_enqueue() {
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'jquery-ui' );
	$suffix = (LARGO_DEBUG)? '' : '.min';
	wp_enqueue_style( 'jquery-ui-datepicker', get_stylesheet_directory_uri() . '/css/datepicker' . $suffix . '.css');
}
add_action( 'admin_enqueue_scripts', 'fe_datepicker_admin_enqueue' );
