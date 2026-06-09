<?php

/**
 * Class Onecom_ALP_Popup
 * Performs tests related to Onecom_ALP_Popup:
 */
use PHPUnit\Framework\TestCase;

class TestOnecomALPOnecomLoginTest extends TestCase
{
    // test enqueued style
    public function test_onecom_login_enqueue_style()
    {
        $object = new Onecom_ALP_Onecom_Login();

        ob_start();
        $object->onecom_login_enqueue_style();
        $output = ob_get_clean();

        // validate output as a string and some part of css selector
        $this->assertIsString($output);
        $this->assertStringContainsString("#onecom-login-button", $output);
    }

    // Validate action hooks occurrence


    // Validate action hooks condition if flag is 1
    public function test_init()
    {

        update_site_option('onecom_login_masking', 1);

        // Create a mock object for the Onecom_ALP_Onecom_Login class
        $loginObjMock = $this->getMockBuilder('Onecom_ALP_Onecom_Login')
            ->setMethods(['onecom_login_button', 'onecom_login_enqueue_style', 'onecom_login_enqueue_script'])
            ->getMock();

        // Call the init method
        $loginObjMock->init();

        $this->assertIsInt(has_action('login_footer', [$loginObjMock, 'onecom_login_button']));
    }

    public function test_onecom_login_enqueue_script()
    {
        $object = new Onecom_ALP_Onecom_Login(); // Replace YourClass with the actual class containing the onecom_login_enqueue_script method

        ob_start();
        $object->onecom_login_enqueue_script();
        $output = ob_get_clean();
        $this->assertStringContainsString("<script>", $output);

    }

    public function test_onecom_login_button()
    {
        $object = new Onecom_ALP_Onecom_Login(); // Replace YourClass with the actual class containing the onecom_login_button method

        ob_start();
        $object->onecom_login_button();
        $output = ob_get_clean();

        $expectedString = 'onecom-login-button';

        $this->assertStringContainsString($expectedString, $output);
    }
}
