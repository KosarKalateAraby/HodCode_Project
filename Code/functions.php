
<?php

function enqueue_theme_scripts() {
    // بارگذاری فایل CSS
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css');

    // بارگذاری فایل JavaScript
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/script.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'enqueue_theme_scripts');
 

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