<?php
/**
 * Plugin Name:       Login Log
 * Author:            Lee Tomko

 */

function login_log( $user_login, $user ) {
    
    $directory = plugin_dir_path( __FILE__ );

    $roles = implode(",", $user->roles);

    $date = date('m/d/Y h:i:s a', time());

    $text = "In, " . $user_login . ", " . $roles . ", " . $_SERVER['REMOTE_ADDR'] . ", " . $date;

    $log = file_put_contents($directory.'login_log.txt', $text.PHP_EOL , FILE_APPEND | LOCK_EX);

}

function login_log_out( ) {
    
    $directory = plugin_dir_path( __FILE__ );

    $user = wp_get_current_user();
    $user_login = $user->user_login;
    $roles = implode(",", $user->roles);

    $date = date('m/d/Y h:i:s a', time());

    $text = "Out, " . $user_login . ", " . $roles . ", " . $_SERVER['REMOTE_ADDR'] . ", " . $date;

    $log = file_put_contents($directory.'login_log.txt', $text.PHP_EOL , FILE_APPEND | LOCK_EX);

}

add_action('wp_login', 'login_log', 10, 2);
add_action('clear_auth_cookie', 'login_log_out');


 ?>
