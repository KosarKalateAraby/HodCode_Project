<?php
function enqueue_custom_styles() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap/dist/css/bootstrap.min.css', array(), '5.0.0', 'all');
    
    // Bootstrap Icons
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/css/bootstrap-icons/font/bootstrap-icons.css', array(), '1.0.0', 'all');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4', 'all');

    // AOS CSS
    
    // Custom Stylesheet
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

function enqueue_custom_scripts() {
    // Popper.js
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', array(), '1.16.0', true);

    // Bootstrap Bundle JS
    wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/css/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.0.0', true);

    // AOS JS

    // Custom JS
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/custom.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// اعلام سازگاری قالب با WooCommerce
function theme_support_woocommerce() {
    if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
    }
}
add_action('after_setup_theme', 'theme_support_woocommerce');

add_action('init', function() {
    if (class_exists('WooCommerce')) {
        error_log('WooCommerce is active and working!');
    } else {
        error_log('WooCommerce is not active.');
    }
});


function dibaj_theme_setup() {
    // ثبت مکان منو
    register_nav_menus(array(
        'main_menu' => 'منوی اصلی',
    ));
}
add_action('after_setup_theme', 'dibaj_theme_setup');


// <!-- استفاده از walker class برای استایل دادن به ایتم های منو -->

class Custom_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown-menu">'; // برای زیرمنوها
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

        $class_names = 'nav-item ' . esc_attr( $class_names ); // افزودن کلاس nav-item به <li>

        $output .= '<li class="' . $class_names . '">';

        $attributes = ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
        $attributes .= ' class="nav-link"'; // افزودن کلاس nav-link به <a>

        $output .= '<a' . $attributes . '>';
        $output .= apply_filters( 'the_title', $item->title, $item->ID );
        $output .= '</a>';
    }
}














?>