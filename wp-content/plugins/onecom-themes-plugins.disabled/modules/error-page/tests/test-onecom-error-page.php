<?php

class OnecomErrorPage extends WP_UnitTestCase {

    public $error_obj;

    public function setUp(): void {
        parent::setUp();

        add_filter( 'wp_doing_ajax', '__return_true' );
        require_once dirname( __FILE__, 2 ) . '/error-page.php';
        $this->error_obj = new Onecom_Error_Page();

    }

    public function test_menu_pages()
    {
        $this->assertNull($this->error_obj->menu_pages());
    }

    public function test_enqueue_scripts()
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
        $this->assertNull($this->error_obj->enqueue_scripts('test'));
        $this->assertNull($this->error_obj->enqueue_scripts('one-com_page_onecom-wp-error-page'));
        $this->assertEquals(true,wp_style_is('onecom-error-page-css','enqueued'));
        $this->assertEquals(true,wp_style_is('oc_cb_css','enqueued'));
        $this->assertEquals(true,wp_script_is('onecom-error-page','enqueued'));
        delete_site_transient('oc_premi_flag');
    }

    public function test_isPremium(){
        $features_transient = array (
            1 => 'STAGING_ENV',
            2 => 'STANDARD_THEMES',
            3 => 'PERFORMANCE_CACHE',
            4 => 'FREE_MIGRATION',
        );
        set_site_transient('oc_premi_flag', $features_transient, 12 * HOUR_IN_SECONDS);
        $this->assertEquals(false, $this->error_obj->isPremium());
    }


    public function test_error_page_callback()
    {
        ob_start();
        $this->assertNull($this->error_obj->error_page_callback(),ob_get_clean());
    }

    public function test_configure_feature()
    {
        add_filter( 'wp_die_ajax_handler', 'wp_ajax_print_handler_filter' );
        ob_start();
        $_POST['type'] = 'enable';
        $this->error_obj->configure_feature();
        $this->expectOutputstring('{"status":"success","message":"Automatic core updates are enabled"}',ob_get_clean());
    }

    public function test_disable_feature()
    {
        add_filter( 'wp_die_ajax_handler', 'wp_ajax_print_handler_filter' );
        $this->assertNull($this->error_obj->disable_feature());
    }

    public function test_is_onecom_plugin(){
        $this->assertEquals(True,$this->error_obj->is_onecom_plugin());
    }


    public function tearDown(): void
    {
        parent::tearDown();
        remove_filter( 'wp_doing_ajax', '__return_true' );
        remove_filter( 'wp_die_ajax_handler', 'wp_ajax_print_handler_filter' );
        remove_filter( 'wp_die_ajax_handler', 'wp_ajax_halt_handler_filter' );
    }
}
