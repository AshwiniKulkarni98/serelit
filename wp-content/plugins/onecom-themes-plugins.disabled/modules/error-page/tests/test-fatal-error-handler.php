<?php
class FatalErrorHandlerTest extends WP_UnitTestCase {

    public $fatal_obj;

    public function setUp(): void {
        parent::setUp();

        require_once ONECOM_WP_PATH . 'modules' . DIRECTORY_SEPARATOR . 'error-page' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'fatal-error-handler.php';

        $this->fatal_obj = new Onecom_Error_Handler();
		// Create an anonymous subclass to expose the protected method
		$this->instance = new class extends Onecom_Error_Handler {
			public function callDisplayDefaultErrorTemplate($error, $handled) {
				return $this->display_default_error_template($error, $handled);
			}
		};

		// Override wp_die() for testing
		add_filter( 'wp_die_handler', function() {
			return [ $this, 'capture_wp_die' ];
		});

    }


    public function test_display_default_error_template()
    {
        add_filter( 'wp_die_handler', 'wp_die_handler_filter' );
        try {
            wp_set_current_user( self::factory()->user->create( [
                'role' => 'administrator',
            ] ) );
        $this::getPrivateMethod($this->fatal_obj,'display_default_error_template',array('',''));
            $caught_json = '';
        } catch ( \Exception $e ) {
            $caught_json = json_decode( $e->getMessage(), true );
        }
        $this->assertEquals(500,$caught_json['args']['response']);

    }

    public function test_get_extension_for_error()
    {
        $this->assertEquals(array('type' =>"plugin",'slug'=>"onecom-themes-plugins"),$this::getPrivateMethod($this->fatal_obj,'get_extension_for_error',array(array('file'=>'/var/folders/l3/lxlkvnwn1xg05_c6kh2vcdnw0000gp/T/wordpress/wp-content/plugins/onecom-themes-plugins/onecom-themes-plugins.php'))));
        $this->assertEquals(array('type' =>"theme",'slug'=>"onecom-express"),$this::getPrivateMethod($this->fatal_obj,'get_extension_for_error',array(array('file'=>'/var/folders/l3/lxlkvnwn1xg05_c6kh2vcdnw0000gp/T/wordpress/wp-content/themes/onecom-express/style.css'))));
        $this->assertEquals(false,$this::getPrivateMethod($this->fatal_obj,'get_extension_for_error',array(array('file'=>'onecom-express/style.css'))));

    }


    public function test_get_plugin()
    {
        $this->assertContains('one.com',$this::getPrivateMethod($this->fatal_obj,'get_plugin',array(array('type' =>"plugin",'slug'=>"onecom-themes-plugins"))));
        $this->assertEquals(false,$this::getPrivateMethod($this->fatal_obj,'get_plugin',array(array('type' =>"plugin",'slug'=>"onecom-vcache"))));
    }

	public function test_get_cause()
	{
		$result = $this::getPrivateMethod(
			$this->fatal_obj,
			'get_cause',
			[ ['type' => 'plugin', 'slug' => 'onecom-themes-plugins'] ]
		);

		$this->assertStringContainsString('one.com', $result);
	}

	public function test_get_tips_for_theme()
	{
		$result = $this::getPrivateMethod(
			$this->fatal_obj,
			'get_tips',
			[ ['type' => 'theme', 'slug' => 'twentytwentythree'] ]
		);

		// Basic structure check
		$this->assertStringContainsString('<ul>', $result);
		$this->assertStringContainsString('</ul>', $result);

		// Theme-specific checks
		$this->assertStringContainsString('A recent theme update', $result);
		$this->assertStringContainsString('Activation of a child theme', $result);

		// Shared checks
		$this->assertStringContainsString('WordPress update', $result);
		$this->assertStringContainsString('PHP version update', $result);
		$this->assertStringContainsString('help center', $result);
	}

	public function test_get_tips_for_plugin()
	{
		$result = $this::getPrivateMethod(
			$this->fatal_obj,
			'get_tips',
			[ ['type' => 'plugin', 'slug' => 'hello-dolly'] ]
		);

		// Basic structure check
		$this->assertStringContainsString('<ul>', $result);
		$this->assertStringContainsString('</ul>', $result);

		// Plugin-specific checks
		$this->assertStringContainsString('A recent plugin update', $result);

		// Shared checks
		$this->assertStringContainsString('WordPress update', $result);
		$this->assertStringContainsString('PHP version update', $result);
		$this->assertStringContainsString('help center', $result);
	}


	/**
     * @param $obj
     * @param $name
     * for accessing private methods
     * @return mixed
     * @throws ReflectionException
     */
    public static function getPrivateMethod($obj, $name,$args) {
        $class = new ReflectionClass(get_class($obj));
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj,$args);
    }

	public function capture_wp_die( $message, $title = '', $args = [] ) {
		// Store what wp_die() received instead of killing execution
		$this->wp_die_args = [
			'message' => $message,
			'title'   => $title,
			'args'    => $args,
		];
	}

	public function test_default_message_when_not_logged_in() {
		$error = [ 'type' => 1, 'message' => 'Fatal error' ];

		$this->instance->callDisplayDefaultErrorTemplate( $error, false );

		$this->assertNotEmpty( $this->wp_die_args );
		$this->assertInstanceOf( WP_Error::class, $this->wp_die_args['message'] );

		$wp_error = $this->wp_die_args['message'];
		$this->assertStringContainsString( 'There has been a critical error on your website.', $wp_error->get_error_message() );
	}

	public function test_recovery_mode_message() {
		// Force wp_is_recovery_mode() to return true
		add_filter( 'wp_is_recovery_mode', '__return_true' );

		$error = [ 'type' => 1, 'message' => 'Fatal error' ];
		$this->instance->callDisplayDefaultErrorTemplate( $error, true );

		$wp_error = $this->wp_die_args['message'];
		$this->assertStringContainsString( 'putting it in recovery mode', $wp_error->get_error_message() );

		remove_filter( 'wp_is_recovery_mode', '__return_true' );
	}

	public function test_protected_endpoint_message() {
		// Fake is_protected_endpoint()
		add_filter( 'pre_option_is_protected_endpoint', '__return_true' );

		$error = [ 'type' => 1, 'message' => 'Fatal error' ];
		$this->instance->callDisplayDefaultErrorTemplate( $error, false );

		$wp_error = $this->wp_die_args['message'];
		$this->assertStringContainsString( 'check your site admin email inbox', $wp_error->get_error_message() );

		remove_filter( 'pre_option_is_protected_endpoint', '__return_true' );
	}


    public function tearDown(): void
    {
		remove_all_filters( 'wp_die_handler' );
		$this->wp_die_args = [];
        parent::tearDown();
    }



}