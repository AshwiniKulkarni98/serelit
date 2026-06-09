<?php
/**
 * Temp Admin Creator (one-time mu-plugin)
 *
 * Creates a temporary administrator user on first load and writes
 * the credentials to wp-content/temp-admin.txt. REMOVE this file
 * immediately after you successfully log in.
 */

if (!defined('WPINC')) {
    /**
     * When the file is parsed outside of WP boot, do nothing.
     */
    return;
}

add_action('init', function () {
    if (get_option('temp_admin_created')) {
        return;
    }

    if (!function_exists('wp_create_user') || !function_exists('wp_generate_password')) {
        return;
    }

    $username = 'local_temp_admin';
    if (username_exists($username)) {
        update_option('temp_admin_created', 1);
        return;
    }

    $password = wp_generate_password(16, true, true);
    $email = 'local+tempadmin@example.local';

    $user_id = wp_create_user($username, $password, $email);

    if (!is_wp_error($user_id)) {
        $user = new WP_User($user_id);
        $user->set_role('administrator');
        update_option('temp_admin_created', 1);

        $out = "Username: $username\nPassword: $password\n";
        $file = defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR . '/temp-admin.txt' : ABSPATH . 'wp-content/temp-admin.txt';
        @file_put_contents($file, $out);
        error_log('Temp admin created: ' . $username);
    } else {
        error_log('Temp admin creation failed: ' . $user_id->get_error_message());
    }
}, 1);
