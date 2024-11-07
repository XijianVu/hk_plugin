<?php
/**
 * @wordpress-plugin
 * Plugin Name:       HK 123
 * Plugin URI:        http://hk_wordpress.com
 * Description:       HK Plugin for WordPress
 * Version:           @VERSION
 * Author:            Hoang Khang Incotech
 * Author URI:        http://hk_wordpress.com
 */

 # getResponse function
function hk_getResponse($path=null) // 'login', 'edu/courses', '/hello'
{
    if (!class_exists('\App\Models\User')) {
        require __DIR__.'/vendor/autoload.php';
        $app = require_once __DIR__.'/bootstrap/app.php';
        $hk_kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

        if (!$path) {
            $path = isset($_REQUEST['path']) ? $_REQUEST['path'] : '/dashboard';
        }
        $response = $hk_kernel->handle(
            App\Wordpress\LaravelRequest::capture($path)
        );
            
        return $response;
    }
}

function my_custom_shortcode($atts) {
    // auto load laravel framework
    
        
        hk_getResponse('/');
              
        $atts = shortcode_atts(

        array(
            'page' => 'main',  
        ),
        $atts,
        'my_custom'
    );

    $custom_css = '<style>#site-preloader { display: none !important; }</style>';

    switch ($atts['page']) {
        case 'hosting':
            $html = view('hk.hosting.index')->render(); 
            $html .= $custom_css; 
            break;
        case 'domain':
            $html = view('hk.domain.index')->render();  
            $html .= $custom_css;
            break;
        case 'main':
        default:
            $html = view('hk.main.index')->render();  
            $html .= $custom_css; 
            break;
    }

    return $html;
}
add_shortcode('my_custom', 'my_custom_shortcode');


function handle_hosting_request() 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_REQUEST['page'] == 'hk') {
        
        $path = $_REQUEST['path']; 

        error_log('Form Data: ' . print_r($_POST, true)); 

        $response = hk_getResponse($path);

        $response->send(); 
        

        wp_die();
    }
}

add_action('init', 'handle_hosting_request');





function my_custom_menu() {
    // Add main menu
    add_menu_page(
        'Custom Menu Title',   // Page title
        'Custom Menu',         // Menu title
        'manage_options',      // Capability
        'custom_menu_slug',    // Menu slug
        'custom_menu_page',    // Function that displays the page content
        'dashicons-admin-generic', // Icon URL or Dashicon class
        6                      // Position in the menu
    );

    // Add submenu
    add_submenu_page(
        'custom_menu_slug',    // Parent menu slug
        'Submenu Title',       // Page title
        'Submenu',             // Submenu title
        'manage_options',      // Capability
        'custom_submenu_slug', // Menu slug
        'custom_submenu_page'  // Function that displays the page content
    );
}

add_action('admin_menu', 'my_custom_menu');

// Function for main menu page content
function custom_menu_page() {
    $response = hk_getResponse('/hk/main');
    $response = hk_getResponse('/hk/hosting');

    // send response
    $response->send(); // => echo html******
}

// Function for submenu page content
function custom_submenu_page() {
    echo '<h1>Welcome to the Submenu Page</h1>';
}

function handle_website_request() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_REQUEST['page'] == 'hk') {
        
        $path = $_REQUEST['path']; 
        
        error_log('Form Data: ' . print_r($_POST, true)); 
        
        $response = hk_getResponse($path);
        
        $response->send(); 
        
        wp_die();
    }
}

add_action('init', 'handle_website_request');