// Global variable to store polling interval
if (typeof window.wpRocketIntervalId === 'undefined') {
	window.wpRocketIntervalId = null;
}

if (typeof window.wpRocketAddonIntervalId === 'undefined') {
	window.wpRocketAddonIntervalId = null;
}

//added the below line to avoid multiple provision ajax request on reload
window.wpenqueued = true;
jQuery(document).ready(function () {

	//check plugin activation in progress on reload:
	//different ajax action onclick and onload
	//only enqueue on the wp-rocket page
	jQuery.post(ajaxurl, {
		action: 'on_reload_plugin_activate',
		addon_slug: 'wp-rocket'
	}, function(response){
		handle_plugin_activation_response(response, window.wpRocketIntervalId);

		// If queue in progress, start polling
		if (response.status === 'already_in_queue') {
			console.log("Polling on reload");
			oc_plugin_status_polling();
		}
	});

	//check addon purchase status in progress on reload:
	//different ajax action onclick and onload
	//only enqueue on the wp-rocket page
	jQuery.post(ajaxurl, {
		action: 'check_addon_purchase_status_onload',
		addon_slug: 'wp-rocket'
	}, function(response){
		handle_addon_purchase_response(response, window.wpRocketAddonIntervalId);

		// If queue in progress, start polling
		if (response.status === 'already_in_queue') {
			console.log("Polling on reload");
			oc_addon_status_polling();
		}
	});

	//hide notice on close
	jQuery('.wpr-container .gv-notice-close').click(function(){
		jQuery(this).parent().addClass('gv-hidden');
	});

	//on the button click check plugin activation
	jQuery('.oc-activate-wp-rocket-btn').click(function(){
		oc_activate_wp_plugin();
	});

	//on the button click check addon status
	jQuery('.gv-button.get-wpr-btn').click(function(){
		oc_addon_purchase_status();
	});


	// Capture WP-Rocket stats from WP-Rocket page & plugins entry
	jQuery("#onecom-wrap .oc-wp-rocket-cp-link").click(function (){
		let args = { 'event_action': 'click_cp_activate_button', 'item_category': 'plugin', 'item_name': 'wp_rocket' };
		oc_push_stats_by_js(args);
	})
	jQuery("#onecom-ui .oc-wp-rocket-cp-link").click(function (){
		let args = { 'event_action': 'click_cp_activate_button', 'item_category': 'plugin', 'item_name': 'wp_rocket' };
		oc_push_stats_by_js(args);
	})
	jQuery("#onecom-ui .wp-rocket-guide-link").click(function (){
		let args = { 'event_action': 'click_learn_more_button', 'item_category': 'plugin', 'item_name': 'wp_rocket' };
		oc_push_stats_by_js(args);
	})
	jQuery("#onecom-wrap .wp-rocket-offer-link").click(function (){
		let args = { 'event_action': 'click_wp_rocket_offer_link', 'item_category': 'plugin', 'item_name': 'wp_rocket' };
		oc_push_stats_by_js(args);
	})
});

// Common function to poll plugin activation status
function oc_plugin_status_polling(addon_slug = 'wp-rocket') {
	// If already polling, do nothing
	if (window.wpRocketIntervalId) return;

	// Define the polling function
	function pollStatus() {
		jQuery.post(ajaxurl, {
			action: 'activate_onclick_wp_plugin',
			addon_slug: addon_slug
		}, function(response){
			handle_plugin_activation_response(response, window.wpRocketIntervalId);
		});
	}

	// Call immediately at once
	pollStatus();

	//Then schedule it to repeat every 20 seconds
	window.wpRocketIntervalId = setInterval(pollStatus, 5000);
}

// Common function to poll addon activation status
//call on a twenty-seconds interval
function oc_addon_status_polling(addon_slug = 'wp-rocket') {
	// If already polling, do nothing
	if (window.wpRocketAddonIntervalId) return;

	// Define the polling function
	function pollAddonStatus() {
		jQuery.post(ajaxurl, {
			action: 'check_addon_purchase_status',
			addon_slug: addon_slug
		}, function(response){
			handle_addon_purchase_response(response, window.wpRocketAddonIntervalId);
		});
	}

	// Call immediately at once
	pollAddonStatus();

	//Then schedule it to repeat every 20 seconds
	window.wpRocketAddonIntervalId = setInterval(pollAddonStatus, 25000);
}

function stop_polling(intervalId, type) {
	if (intervalId) clearInterval(intervalId);

	if (type === 'plugin') {
		window.wpRocketIntervalId = null;
	} else if (type === 'addon') {
		window.wpRocketAddonIntervalId = null;
	}
}

// Common function to handle AJAX response
function handle_plugin_activation_response(response, intervalId = null) {

	 if (response.status === 'normal_reload') {
		//do nothing on normal reload
		 return false;
	 }

	if (response.status === 'added_to_queue') {
		// Push stats
		let args = { 'event_action': 'click_wp_activate_button', 'item_category': 'plugin', 'item_name': 'wp_rocket' };

		oc_push_stats_by_js(args);
		jQuery('.gv-notice.gv-notice-warning.wpr-notice').removeClass('gv-hidden');

	} else if (response.status === 'already_in_queue') {
		// Queue in progress → keep polling
		jQuery('.gv-notice.wpr-notice').addClass('gv-hidden');
		jQuery('.gv-notice.gv-notice-warning.wpr-notice').removeClass('gv-hidden');

	} else if (response.status === 'activated') {
		stop_polling(intervalId, 'plugin');
		let btn = '<a class="gv-button gv-button-secondary goto-wpr wpr-btn" href="'+response.url+'">'+response.btn_text+'</a>';
		let insertAfter = '<div class="gv-bottom wpr-pricing">'+btn+'</div>';
		//append or add HTML for the go-to button
		(jQuery('.gv-bottom.wpr-pricing').length) ? jQuery('.gv-bottom.wpr-pricing').html(btn) : jQuery(insertAfter).insertAfter('.gv-content.wpr-pricing-content');

		console.log("WP Rocket activated successfully.");
		jQuery('.gv-notice.gv-notice-warning.wpr-notice').addClass('gv-hidden');
		jQuery('.gv-notice.gv-notice-success.wpr-notice').removeClass('gv-hidden');
	} else if (response.status === 'expired_queue' || response.status === 'activation_failed') {
		stop_polling(intervalId, 'plugin');
		console.log("Activation queue status: "+response.status);
		jQuery('.gv-notice.gv-notice-warning.wpr-notice').addClass('gv-hidden');
		jQuery('.gv-notice.gv-notice-alert.wpr-notice').removeClass('gv-hidden');

	} else if(response.status === 'addon_not_subscribed'){
		//special case very rare to exist
		stop_polling(intervalId, 'plugin');
	} else {
		stop_polling(intervalId, 'plugin');
		jQuery('.gv-notice.gv-notice-warning.wpr-notice').addClass('gv-hidden');
		jQuery('.gv-notice.gv-notice-alert.wpr-notice').removeClass('gv-hidden');
		console.log("Error: Could not activate plugin");
	}
}

// Common function to handle AJAX response for addon purchase status
function handle_addon_purchase_response(response, intervalId = null) {

	 if (response.status === 'normal_reload') {
		//do nothing on normal reload
		 return false;
	 }

	 if (response.status === 'already_in_queue' || response.status === 'added_in_queue') {
		 // Queue in progress → keep polling
	 } else if (response.status === 'addon_purchased') {
		 stop_polling(intervalId, 'addon');
		// Push stats
		 let args = { 'event_action': 'wpr_addon_purchased', 'item_category': 'plugin', 'item_name': 'wp_rocket' };
		 oc_push_stats_by_js(args);
		// reload the page
		location.reload();
		console.log("WP Rocket addon purchased successfully.");
	} else if (response.status === 'already_plugin_active' ) {
		 stop_polling(intervalId, 'addon');
		console.log("Already plugin activated.");
	}else if (response.status === 'expired_queue' || response.status === 'addon_not_purchased') {
		 stop_polling(intervalId, 'addon');
		console.log("Activation queue expired or not purchased."+response.status);
	} else {
		 stop_polling(intervalId, 'addon');
		console.log("Error: Could not activate plugin");
	}
}

// On the button click → start polling
function oc_activate_wp_plugin() {
	jQuery('.gv-notice.gv-notice-alert.wpr-notice').addClass('gv-hidden');
	jQuery('.gv-notice.gv-notice-info.wpr-notice').addClass('gv-hidden');
	jQuery('.gv-notice.gv-notice-warning.wpr-notice').removeClass('gv-hidden');
	oc_plugin_status_polling('wp-rocket');
}

function oc_addon_purchase_status() {
	oc_addon_status_polling('wp-rocket');
}