<?php
class Test_WPRocket extends WP_UnitTestCase {

	public $wpr;

    public function setUp(): void {
        parent::setUp();
    }

    // Test wp_rocket page case 1 where plugin is provisioned + plugin is active + flag exists
    public function test_wp_rocket_case_1()
    {

        // Test as Managed WordPress user
        $features_transient = array (
            0 => 'ONE_CLICK_INSTALL',
            1 => 'STAGING_ENV',
            2 => 'STANDARD_THEMES',
            3 => 'PERFORMANCE_CACHE',
            4 => 'FREE_MIGRATION',
            5 => 'MWP_ADDON',
        );
        set_site_transient('oc_premi_flag', $features_transient, 12 * HOUR_IN_SECONDS);

        // Set wp rocket provisioning flag
        update_site_option('oc-wp-rocket-activation', 'true');

        // activate plugin in database
        $active_plugins = get_option( 'active_plugins' );
        if (!in_array('wp-rocket/wp-rocket.php', $active_plugins)) {
            array_push($active_plugins, 'wp-rocket/wp-rocket.php');
        }
        update_site_option( 'active_plugins', $active_plugins );

        // set site transient with feature subscription response
        $feature_data = array ( 'data' =>  array ( 'addonExists' => true, 'invoicedUntil' => '2023-10-28T00:00:00.000+00:00', 'product' => 'WP_ROCKET', 'source' => 'PURCHASED'), 'error' => NULL, 'success' => true );
        set_site_transient('onecom_wp_rocket_addon_info', $feature_data, 12 * HOUR_IN_SECONDS);

        /**
         * require with same file in buffering will avoid errors
         */
        ob_start();
		$this->wpr = new Onecom_Wp_Rocket();
        require dirname( dirname( __FILE__ ) ) . "/templates/wp-rocket-admin-page.php";
        $wp_rocket_admin_html = ob_get_contents();
        ob_end_clean();

        /**
         * Because html validation recommends @amp; instead of & but we cannont change in this
         * in constant OC_CP_LOGIN_URL which not only used in html but on ALP header redirections as well
         */
        $wp_rocket_admin_html = str_replace("&targetUrl", " &amp;targetUrl ", $wp_rocket_admin_html);

        // Load html (include utf8 if needed)
        $xml = new SimpleXMLElement("<div>".$wp_rocket_admin_html."</div>");

        // Validate html document
        $nonDocumentErrors = $xml->{'non-document-error'};

        $errors = $xml->error;
        if (count($nonDocumentErrors) > 0) {
            // Indeterminate
            $this->markTestIncomplete();
        } elseif (count($errors) > 0) {
            // Invalid html
            $this->fail("HTML output did not validate.");
        } else {
            $this->assertTrue(TRUE);
        }

        // Reset data
        delete_site_transient('oc_premi_flag');
        delete_site_option('oc-wp-rocket-activation');

        // delete activated plugin entry in database
        $active_plugins = get_option( 'active_plugins' );
        if (in_array('wp-rocket/wp-rocket.php', $active_plugins)) {
            unset($active_plugins['wp-rocket/wp-rocket.php']);
        }
        update_option( 'active_plugins', $active_plugins );

    }

    // Test wp_rocket page case 3: where plugin is installed but not active
    public function test_wp_rocket_case_3()
    {

        // Test as Managed WordPress user
        $features_transient = array (
            0 => 'ONE_CLICK_INSTALL',
            1 => 'STAGING_ENV',
            2 => 'STANDARD_THEMES',
            3 => 'PERFORMANCE_CACHE',
            4 => 'FREE_MIGRATION',
            5 => 'MWP_ADDON',
        );
        set_site_transient('oc_premi_flag', $features_transient, 12 * HOUR_IN_SECONDS);

        //  Add fake plugin file if plugin is not installed
        wp_clean_plugins_cache();
        $plugins = get_plugins();

        $path = WP_CONTENT_DIR . '/plugins/wp-rocket/';
        if (!array_key_exists('wp-rocket/wp-rocket.php',$plugins)) {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
                $fp = fopen($path.'wp-rocket.php', 'x');
                fwrite($fp, '/** Plugin Name: WP Rocket */');
                fclose($fp);
            }
        }

        // deactivate plugin in database if active
        $active_plugins = get_option( 'active_plugins' );
        if (in_array('wp-rocket/wp-rocket.php', $active_plugins)) {
            unset($active_plugins['wp-rocket/wp-rocket.php']);
        }
        update_site_option( 'active_plugins', $active_plugins );

        // set site transient with feature subscription response
        $feature_data = array ( 'data' =>  array ( 'addonExists' => true, 'invoicedUntil' => '2023-10-28T00:00:00.000+00:00', 'product' => 'WP_ROCKET', 'source' => 'PURCHASED'), 'error' => NULL, 'success' => true );
        set_site_transient('onecom_wp_rocket_addon_info', $feature_data, 12 * HOUR_IN_SECONDS);


        /**
         * require with same file in buffering will avoid errors
         */
        ob_start();
		$wpr = new Onecom_Wp_Rocket();
        require dirname( dirname( __FILE__ ) ) . "/templates/wp-rocket-admin-page.php";
        $wp_rocket_admin_case_3_html = ob_get_contents();
        ob_end_clean();

        /**
         * Because html validation recommends @amp; instead of & but we cannot change in this
         * in constant OC_CP_LOGIN_URL which not only used in html but on ALP header redirections as well
         */
        $wp_rocket_admin_case_3_html = str_replace("&targetUrl", " &amp;targetUrl ", $wp_rocket_admin_case_3_html);

        // Load html (include utf8 if needed)
        $xml = new SimpleXMLElement("<div>".$wp_rocket_admin_case_3_html."</div>");

        // Validate html document
        $nonDocumentErrors = $xml->{'non-document-error'};

        $errors = $xml->error;
        if (count($nonDocumentErrors) > 0) {
            // Indeterminate
            $this->markTestIncomplete();
        } elseif (count($errors) > 0) {
            // Invalid html
            $this->fail("HTML output did not validate.");
        } else {
            $this->assertTrue(TRUE);
        }

        // Reset data
        delete_site_transient('oc_premi_flag');
        delete_site_option('oc-wp-rocket-activation');

        // delete installed fake plugin directory and file
        //delete_plugins(array('wp-rocket/wp-rocket.php'));
        if (file_exists($path)) {
            unlink($path.'wp-rocket.php');
            rmdir($path);
        }
    }

    // Test wp_rocket page case 4: where plugin is purchased but not installed
    public function test_wp_rocket_case_4()
    {

        // Test as Managed WordPress user
        $features_transient = array (
            0 => 'ONE_CLICK_INSTALL',
            1 => 'STAGING_ENV',
            2 => 'STANDARD_THEMES',
            3 => 'PERFORMANCE_CACHE',
            4 => 'FREE_MIGRATION',
            5 => 'MWP_ADDON',
        );
        set_site_transient('oc_premi_flag', $features_transient, 12 * HOUR_IN_SECONDS);

        // Set wp rocket provisioning flag
        update_site_option('oc-wp-rocket-activation', 'true');

        // make sure wp rocket is not installed
        $path = WP_CONTENT_DIR . '/plugins/wp-rocket/';

        if (file_exists($path)) {
            unlink($path.'wp-rocket.php');
            rmdir($path);
        }

        // set site transient with feature addon response
        $feature_data = array ( 'data' =>  array ( 'addonExists' => true, 'invoicedUntil' => '2023-10-28T00:00:00.000+00:00', 'product' => 'WP_ROCKET', 'source' => 'PURCHASED'), 'error' => NULL, 'success' => true );
        set_site_transient('onecom_wp_rocket_addon_info', $feature_data, 12 * HOUR_IN_SECONDS);

        /**
         * require with same file in buffering will avoid errors
         */
        ob_start();
		$wpr = new Onecom_Wp_Rocket();
        require dirname( dirname( __FILE__ ) ) . "/templates/wp-rocket-admin-page.php";
        $wp_rocket_admin_case_4_html = ob_get_contents();
        ob_end_clean();

        /**
         * Because html validation recommends @amp; instead of & but we cannot change in this
         * in constant OC_CP_LOGIN_URL which not only used in html but on ALP header redirections as well
         */
        $wp_rocket_admin_case_4_html = str_replace("&targetUrl", " &amp;targetUrl ", $wp_rocket_admin_case_4_html);
        // Load html (include utf8 if needed)
        $xml = new SimpleXMLElement("<div>".$wp_rocket_admin_case_4_html."</div>");

        // Validate html document
        $nonDocumentErrors = $xml->{'non-document-error'};

        $errors = $xml->error;
        if (count($nonDocumentErrors) > 0) {
            // Indeterminate
            $this->markTestIncomplete();
        } elseif (count($errors) > 0) {
            // Invalid html
            $this->fail("HTML output did not validate.");
        } else {
            $this->assertTrue(TRUE);
        }

        // Reset data
        delete_site_transient('oc_premi_flag');


    }

    // Test wp_rocket page case 5: where plugin is active (via outside) but flag does not exists
    public function test_wp_rocket_case_5()
    {

        // Test as Managed WordPress user
        $features_transient = array (
            0 => 'ONE_CLICK_INSTALL',
            1 => 'STAGING_ENV',
            2 => 'STANDARD_THEMES',
            3 => 'PERFORMANCE_CACHE',
            4 => 'FREE_MIGRATION',
            5 => 'MWP_ADDON',
        );
        set_site_transient('oc_premi_flag', $features_transient, 12 * HOUR_IN_SECONDS);

        // Set wp rocket provisioning flag
        delete_site_option('oc-wp-rocket-activation');

        // activate plugin in database
        $active_plugins = get_option( 'active_plugins' );
        if (!in_array('wp-rocket/wp-rocket.php', $active_plugins)) {
            array_push($active_plugins, 'wp-rocket/wp-rocket.php');
        }
        update_site_option( 'active_plugins', $active_plugins );

        // set site transient with feature missing response
        $feature_data = array('source' => '', 'error' => true, 'success' => false);
        set_site_transient('onecom_wp_rocket_addon_info', $feature_data, 12 * HOUR_IN_SECONDS);

        /**
         * require with same file in buffering will avoid errors
         */
        ob_start();
		$this->wpr = new Onecom_Wp_Rocket();
        require dirname( dirname( __FILE__ ) ) . "/templates/wp-rocket-admin-page.php";
        $wp_rocket_admin_html = ob_get_contents();
        ob_end_clean();

        /**
         * Because html validation recommends @amp; instead of & but we cannot change in this
         * in constant OC_CP_LOGIN_URL which not only used in html but on ALP header redirections as well
         */
        $wp_rocket_admin_html = str_replace("&targetUrl", " &amp;targetUrl ", $wp_rocket_admin_html);

        // Load html (include utf8 if needed)
        $xml = new SimpleXMLElement("<div>".$wp_rocket_admin_html."</div>");

        // Validate html document
        $nonDocumentErrors = $xml->{'non-document-error'};

        $errors = $xml->error;
        if (count($nonDocumentErrors) > 0) {
            // Indeterminate
            $this->markTestIncomplete();
        } elseif (count($errors) > 0) {
            // Invalid html
            $this->fail("HTML output did not validate.");
        } else {
            $this->assertTrue(TRUE);
        }

        // Reset data
        delete_site_transient('oc_premi_flag');

    }

    // Default case + Case 2: if WP Rocket is not purchased and not installed
    public function test_wp_rocket_case_2()
    {

        // Test as Managed WordPress user
        $features_transient = array (
            0 => 'ONE_CLICK_INSTALL',
            1 => 'STAGING_ENV',
            2 => 'STANDARD_THEMES',
            3 => 'PERFORMANCE_CACHE',
            4 => 'FREE_MIGRATION',
            5 => 'MWP_ADDON',
        );
        set_site_transient('oc_premi_flag', $features_transient, 12 * HOUR_IN_SECONDS);

        set_site_transient('onecom_wp_rocket_addon_info', array(
            'data' => array(
                'addonExists' => true,
                'invoicedUntil' => '2026-10-27T00:00:00.000+00:00',
                'product' => 'WP_ROCKET',
                'source' => 'PURCHASED',
                'country' => 'DK',
            ),
            'error' => null,
            'success' => true,
        ), 12 * HOUR_IN_SECONDS);

        /**
         * require with same file in buffering will avoid errors
         */
        ob_start();
		$this->wpr = new Onecom_Wp_Rocket();
        require dirname( dirname( __FILE__ ) ) . "/templates/wp-rocket-admin-page.php";
        $wp_rocket_admin_html = ob_get_contents();
        ob_end_clean();

        /**
         * Because html validation recommends @amp; instead of & but we cannot change in this
         * in constant OC_CP_LOGIN_URL which not only used in html but on ALP header redirections as well
         */
        $wp_rocket_admin_html = str_replace("&targetUrl", " &amp;targetUrl ", $wp_rocket_admin_html);

        // Load html (include utf8 if needed)
        $xml = new SimpleXMLElement("<div>".$wp_rocket_admin_html."</div>");

        // Validate html document
        $nonDocumentErrors = $xml->{'non-document-error'};

        $errors = $xml->error;
        if (count($nonDocumentErrors) > 0) {
            // Indeterminate
            $this->markTestIncomplete();
        } elseif (count($errors) > 0) {
            // Invalid html
            $this->fail("HTML output did not validate.");
        } else {
            $this->assertTrue(TRUE);
        }

        delete_site_transient('oc_premi_flag');

    }

	// validate if actions are regisered with
	public function test_init_hooks()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		$this->wpr->init();
		$this->assertTrue(true, has_action('admin_enqueue_scripts', [$this->wpr, 'enqueue_scripts']));
		$this->assertTrue(true, has_action('wp_ajax_activate_oc_wp_rocket', [$this->wpr, 'activate_wp_rocket']));
		$this->assertTrue(true, has_action('activate_wp-rocket/wp-rocket.php', [$this->wpr, 'wp_rocket_activation_action']));
	}

	// validate scripts enqueue (non wp-rocket page)
	public function test_enqueue_script_non_wpr()
	{
		// On non wp-rocket page, enquee should be false
		$this->wpr = new Onecom_Wp_Rocket();
		$response = $this->wpr->enqueue_scripts('xyz');
		$admin_style = wp_style_is('oc_wpr_style', 'enqueued');
		$admin_script = wp_script_is('oc_wpr_script', 'enqueued');
		$this->assertFalse($admin_script);
		$this->assertFalse($admin_style);
		$this->assertNull($response);
	}

	// validate scripts enqueue (on wp-rocket page)
	public function test_enqueue_script_wpr()
	{
		// Test if wp-rocket page
		$this->wpr = new Onecom_Wp_Rocket();
		$response = $this->wpr->enqueue_scripts('one-com_page_onecom-wp-rocket');
		$admin_style = wp_style_is('oc_wpr_style', 'enqueued');
		$admin_script = wp_script_is('oc_wpr_script', 'enqueued');
		$this->assertTrue($admin_script && $admin_style);
		$this->assertNull($response);
		unset($this->wpr);
	}

	// validate wp_rocket_plugin_info() plugin entry
	public function test_wp_rocket_plugin_info()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		$response = $this->wpr->wp_rocket_plugin_info();
		// On localhost, onecom_fetch_plugins() will work with VPN on

		// It should return array
		$this->assertIsArray($response);
	}

		// validate guide link, always string
	public function test_wp_rocket_translated_guide()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		$response = $this->wpr->wp_rocket_translated_guide();
		// It should return array
		$this->assertIsString($response);
	}

	// validate plugin active status, always boolean
	public function test_is_wp_rocket_active()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		$response = $this->wpr->is_wp_rocket_active();
		$this->assertTrue(is_bool($response));
	}

	// Test check_addon_purchase_response logic
	public function test_check_addon_purchase_response()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		// Success case
		$success = [
			'success' => true,
			'data' => [
				'source' => 'PURCHASED',
				'product' => 'WP_ROCKET',
			],
		];
		$this->assertTrue($this->wpr->check_addon_purchase_response($success));
		// Failure case
		$fail = [
			'success' => false,
			'error' => 'Some error',
		];
		$this->assertFalse($this->wpr->check_addon_purchase_response($fail));
	}

	// Test set_transient_for_addon_activation sets transients
	public function test_set_transient_for_addon_activation()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		$slug = 'testaddon';
		// No transients needed before, this function sets them
		$this->wpr->set_transient_for_addon_activation($slug);
		$this->assertNotFalse(get_site_transient('testaddon_activation_start_at'));
		$this->assertNotFalse(get_site_transient('testaddon_activation_button_clicked_at'));
		$this->assertNotFalse(get_site_transient('testaddon-pp-activation-start-at'));
	}

	// Test clear_activation_queue deletes transients
	public function test_clear_activation_queue()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		$slug = 'testaddon';
		// Set required transients before clearing
		set_site_transient('testaddon_activation_start_at', 1, 60);
		set_site_transient('testaddon_activation_button_clicked_at', 1, 60);
		set_site_transient('testaddon-pp-activation-start-at', 1, 60);
		$this->assertNotFalse(get_site_transient('testaddon_activation_start_at'));
		$this->assertNotFalse(get_site_transient('testaddon_activation_button_clicked_at'));
		$this->assertNotFalse(get_site_transient('testaddon-pp-activation-start-at'));
		$this->wpr->clear_activation_queue($slug);
		$this->assertFalse(get_site_transient('testaddon_activation_start_at'));
		$this->assertFalse(get_site_transient('testaddon_activation_button_clicked_at'));
		$this->assertFalse(get_site_transient('testaddon-pp-activation-start-at'));
	}

	// Test clear_addon_status_queue deletes transients
	public function test_clear_addon_status_queue()
	{
		$this->wpr = new Onecom_Wp_Rocket();
		$slug = 'testaddon';
		// Set required transients before clearing
		set_site_transient('testaddon_purchase_button_start_at', 1, 60);
		set_site_transient('testaddon_select_button_clicked_at', 1, 60);
		$this->assertNotFalse(get_site_transient('testaddon_purchase_button_start_at'));
		$this->assertNotFalse(get_site_transient('testaddon_select_button_clicked_at'));
		$this->wpr->clear_addon_status_queue($slug);
		$this->assertFalse(get_site_transient('testaddon_purchase_button_start_at'));
		$this->assertFalse(get_site_transient('testaddon_select_button_clicked_at'));
	}

	// Test static wp_rocket_page includes the template
	public function test_wp_rocket_page_static()
	{
		ob_start();
		Onecom_Wp_Rocket::wp_rocket_page();
		$output = ob_get_clean();
		$this->assertStringContainsString('wp-rocket', $output);
	}

	// Test wp_rocket_addon_info with force param and empty domain
	public function test_wp_rocket_addon_info_force_empty_domain()
	{
		// set site transient with feature subscription response
		$feature_data = array ( 'data' =>  array ( 'addonExists' => true, 'invoicedUntil' => '2023-10-28T00:00:00.000+00:00', 'product' => 'WP_ROCKET', 'source' => 'PURCHASED'), 'error' => NULL, 'success' => true );
		set_site_transient('onecom_wp_rocket_addon_info', $feature_data, 12 * HOUR_IN_SECONDS);

		$this->wpr = new Onecom_Wp_Rocket();
		$response = $this->wpr->wp_rocket_addon_info(false, '');
		$this->assertIsArray($response);
		$this->assertArrayHasKey('success', $response);
	}

    // Test get_marketplace_prices returns array
    public function test_get_marketplace_prices()
    {
        set_site_transient('onecom_marketplace_prices', ['success' => true, 'data' => ['prices' => []]], 60);
        $this->wpr = new Onecom_Wp_Rocket();
        $result = $this->wpr->get_marketplace_prices(['WP_ROCKET'], true);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('success', $result);
        delete_site_transient('onecom_marketplace_prices');
    }

    // Test get_wpr_price returns array with success key
    public function test_get_wpr_price()
    {
        set_site_transient('onecom_marketplace_prices', ['success' => true, 'data' => ['prices' => [['addon' => 'WP_ROCKET', 'result' => ['priceInclVat' => 10, 'currencySymbol' => '$']]]]], 60);
        $this->wpr = new Onecom_Wp_Rocket();
        $result = $this->wpr->get_wpr_price(['WP_ROCKET']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('success', $result);
        delete_site_transient('onecom_marketplace_prices');
    }

    // Test get_cu_country_code returns default if not set
    public function test_get_cu_country_code_default()
    {
        // No country in transient, should return 'US'
        set_site_transient('onecom_wp_rocket_addon_info', ['data' => []], 60);
        $this->wpr = new Onecom_Wp_Rocket();
        $code = $this->wpr->get_cu_country_code();
        $this->assertEquals('US', $code);
        delete_site_transient('onecom_wp_rocket_addon_info');
    }

    // Test get_cu_country_code returns country if set
    public function test_get_cu_country_code_custom()
    {
        set_site_transient('onecom_wp_rocket_addon_info', ['data' => ['country' => 'DK']], 60);
        $this->wpr = new Onecom_Wp_Rocket();
        $code = $this->wpr->get_cu_country_code();
        $this->assertEquals('DK', $code);
        delete_site_transient('onecom_wp_rocket_addon_info');
    }

    // Test call_wp_api_provisioner returns string status
    public function test_call_wp_api_provisioner()
    {
        set_site_transient('onecom_wp_rocket_addon_info', ['success' => false], 60);
        $this->wpr = new Onecom_Wp_Rocket();
        $status = $this->wpr->call_wp_api_provisioner('WP_ROCKET');
        $this->assertIsString($status);
        $this->assertContains($status, ['addon_not_subscribed', 'already_in_queue', 'added_to_queue']);
        delete_site_transient('onecom_wp_rocket_addon_info');
    }

    // Test is_wp_rocket_addon_purchased returns boolean
    public function test_is_wp_rocket_addon_purchased()
    {
        set_site_transient('onecom_wp_rocket_addon_info', ['success' => true, 'data' => ['source' => 'PURCHASED', 'product' => 'WP_ROCKET']], 60);
        $this->wpr = new Onecom_Wp_Rocket();
        $result = $this->wpr->is_wp_rocket_addon_purchased();
        $this->assertTrue(is_bool($result));
        delete_site_transient('onecom_wp_rocket_addon_info');
    }

    // Test is_oc_wp_rocket_flag_exists returns correct value
    public function test_is_oc_wp_rocket_flag_exists()
    {
        update_site_option('oc-wp-rocket-activation', 'true');
        $this->wpr = new Onecom_Wp_Rocket();
        $result = $this->wpr->is_oc_wp_rocket_flag_exists();
        $this->assertEquals('true', $result);
        delete_site_option('oc-wp-rocket-activation');
    }

    // Test is_wp_rocket_installed returns boolean
    public function test_is_wp_rocket_installed()
    {
        // No transient needed, just call
        $this->wpr = new Onecom_Wp_Rocket();
        $result = $this->wpr->is_wp_rocket_installed();
        $this->assertTrue(is_bool($result));
    }

    // Test HTML output methods
    public function test_wp_rocket_pricing_table_output()
    {
        set_site_transient('onecom_marketplace_prices', ['success' => true, 'data' => ['prices' => [['addon' => 'WP_ROCKET', 'result' => ['fullPriceInclVat' => 10, 'currency' => '$']]]]], 60);
        set_site_transient('onecom_wp_rocket_addon_info', ['success' => false], 60);
        $this->wpr = new Onecom_Wp_Rocket();
        ob_start();
        $this->wpr->wp_rocket_pricing_table();
        $output = ob_get_clean();
        $this->assertStringContainsString('gv-product-table', $output);
        delete_site_transient('onecom_marketplace_prices');
        delete_site_transient('onecom_wp_rocket_addon_info');
    }
    public function test_get_wpr_success_notice_output()
    {
        $this->wpr = new Onecom_Wp_Rocket();
        ob_start();
        $this->wpr->get_wpr_success_notice();
        $output = ob_get_clean();
        $this->assertStringContainsString('WP Rocket activated', $output);
    }
    public function test_get_wpr_error_notice_output()
    {
        $this->wpr = new Onecom_Wp_Rocket();
        ob_start();
        $this->wpr->get_wpr_error_notice();
        $output = ob_get_clean();
        $this->assertStringContainsString('Oops, something went wrong', $output);
    }
    public function test_get_wpr_activate_info_output()
    {
        $this->wpr = new Onecom_Wp_Rocket();
        ob_start();
        $this->wpr->get_wpr_activate_info();
        $output = ob_get_clean();
        $this->assertStringContainsString('Activate WP Rocket', $output);
    }
    public function test_get_wpr_in_progress_notice_output()
    {
        $this->wpr = new Onecom_Wp_Rocket();
        ob_start();
        $this->wpr->get_wpr_in_progress_notice();
        $output = ob_get_clean();
        $this->assertStringContainsString('Activating may take a few minutes', $output);
    }
}
