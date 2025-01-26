<?php
function enqueue_custom_styles()
{
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

function enqueue_custom_scripts()
{
    // Popper.js
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', array(), '1.16.0', true);

    // Bootstrap Bundle JS
    wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/css/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.0.0', true);

    // AOS JS

    // Custom JS
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/custom.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// افزودن ajaxurl به فایل جاوااسکریپت
function my_enqueue_scripts()
{
    wp_enqueue_script('my-ajax-script', get_template_directory_uri() . '/custom.js', array('jquery'), null, true);

    // ارسال متغیر ajaxurl به اسکریپت
    wp_localize_script('my-ajax-script', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');


// اعلام سازگاری قالب با WooCommerce
function theme_support_woocommerce()
{
    if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
    }
}
add_action('after_setup_theme', 'theme_support_woocommerce');

add_action('init', function () {
    if (class_exists('WooCommerce')) {
        error_log('WooCommerce is active and working!');
    } else {
        error_log('WooCommerce is not active.');
    }
});


function dibaj_theme_setup()
{
    // ثبت مکان منو
    register_nav_menus(array(
        'main_menu' => 'منوی اصلی',
    ));
}
add_action('after_setup_theme', 'dibaj_theme_setup');


// <!-- استفاده از walker class برای استایل دادن به ایتم های منو -->

class Custom_Nav_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="dropdown-menu">'; // برای زیرمنوها
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));

        $class_names = 'nav-item ' . esc_attr($class_names); // افزودن کلاس nav-item به <li>

        $output .= '<li class="' . $class_names . '">';

        $attributes = ! empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
        $attributes .= ' class="nav-link"'; // افزودن کلاس nav-link به <a>

        $output .= '<a' . $attributes . '>';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }
}

// برای حذف بخش های خاصی از فایل single-product.php
// حذف تصاویر گالری
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

// حذف عنوان محصول
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

// حذف قیمت
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

// حذف دکمه افزودن به سبد خرید
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

// حذف مسیر ناوبری در صفحات ووکامرس
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// حذف شناسه محصول، دسته‌بندی و برچسب‌ها از صفحه محصول
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// غیرفعال کردن کامل نوار کناری در ووکامرس
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// حذف ویجت‌های خاص از نوار کناری
function remove_unwanted_widgets()
{
    unregister_widget('WP_Widget_Search'); // حذف ویجت جستجو
    unregister_widget('WP_Widget_Pages'); // حذف ویجت برگه‌ها
    unregister_widget('WP_Widget_Archives'); // حذف ویجت بایگانی‌ها
    unregister_widget('WP_Widget_Categories'); // حذف ویجت دسته‌بندی‌ها
}
add_action('widgets_init', 'remove_unwanted_widgets');


// ---------------------افزودن متافیلد رنگ‌بندی به صفحه ویرایش محصول------------------------------

function add_color_hex_metabox()
{
    add_meta_box(
        'product_color_hex', // شناسه متاباکس
        'Colors (Hex Code)', // عنوان متاباکس
        'display_color_hex_metabox', // تابع نمایش محتوا
        'product', // نوع پست (محصولات)
        'side', // مکان
        'default' // اولویت
    );
}
add_action('add_meta_boxes', 'add_color_hex_metabox');

// نمایش متاباکس
function display_color_hex_metabox($post)
{
    $color_hex = get_post_meta($post->ID, '_product_color_hex', true); // دریافت رنگ‌های ذخیره‌شده
?>
    <label for="product_color_hex">Enter colors as hex codes, separated by commas:</label>
    <input type="text" id="product_color_hex" name="product_color_hex" value="<?php echo esc_attr($color_hex); ?>" style="width: 100%;">
    <p><em>Example: #FF5733, #33FF57, #3357FF</em></p>
<?php
}

// ذخیره رنگ‌بندی
function save_product_color_hex($post_id)
{
    if (isset($_POST['product_color_hex'])) {
        $color_hex = sanitize_text_field($_POST['product_color_hex']);
        update_post_meta($post_id, '_product_color_hex', $color_hex);
    }
}
add_action('save_post', 'save_product_color_hex');

add_action('woocommerce_single_product_summary', 'display_color_circles', 25);

function display_color_circles()
{
    global $post;
    $color_hex = get_post_meta($post->ID, '_product_color_hex', true); // دریافت رنگ‌ها

    if ($color_hex) {
        $colors = explode(',', $color_hex); // جدا کردن رنگ‌ها با کاما
        echo '<div class="product-colors mb-3">';
        echo '<h5>رنگ‌بندی:</h5>';
        echo '<div class="d-flex flex-wrap gap-2">';
        foreach ($colors as $color) {
            $color = trim($color); // حذف فاصله‌ها
            echo '<div style="width: 30px; height: 30px; background-color: ' . esc_attr($color) . '; border-radius: 50%; border: 1px solid #ccc;" title="' . esc_attr($color) . '"></div>';
        }
        echo '</div>';
        echo '</div>';
    }
}

// غیرفعال کردن متن Available Colors
remove_action('woocommerce_single_product_summary', 'display_color_circles', 25);

// حذف محصولات مرتبط از صفحه محصول
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


add_action('init', function () {
    if (isset($_GET['run_cron'])) {
        do_action('update_product_prices_event');
        echo 'کرون اجرا شد!';
        exit;
    }
});



// // کد دریافت نرخ دلار
// function get_exchange_rate() {
//     $api_key = '5c2f87372f980c7c537e0b2d'; // کلید API شما
//     $api_url = "http://api.currencylayer.com/live?access_key=$api_key&currencies=IRR&source=USD"; // آدرس API

//     $response = wp_remote_get($api_url); // ارسال درخواست

//     if (is_wp_error($response)) {
//         return false; // بررسی خطا
//     }

//     $data = wp_remote_retrieve_body($response);
//     $data = json_decode($data, true); // تبدیل پاسخ به آرایه

//     if (isset($data['quotes']['USDIRR'])) {
//         return $data['quotes']['USDIRR']; // نرخ دلار به ریال
//     }

//     return false; // اگر خطایی بود
// }


// // کد بروزرسانی قیمت محصولات
// function update_product_prices_in_toman() {
//     $exchange_rate = get_exchange_rate(); // دریافت نرخ دلار
//     if (!$exchange_rate) {
//         return; // اگر خطا بود، برگرد
//     }

//     // دریافت همه محصولات ووکامرس
//     $args = array(
//         'post_type' => 'product',
//         'posts_per_page' => -1,
//     );

//     $products = get_posts($args);

//     foreach ($products as $product) {
//         $product_id = $product->ID;
//         $price_in_usd = get_post_meta($product_id, '_price', true); // قیمت به دلار

//         if ($price_in_usd) {
//             // محاسبه قیمت به تومان
//             $price_in_toman = $price_in_usd * $exchange_rate / 10; // تبدیل ریال به تومان

//             // بروزرسانی قیمت
//             update_post_meta($product_id, '_price', $price_in_toman);
//             update_post_meta($product_id, '_regular_price', $price_in_toman);
//         }
//     }
// }

// // افزودن کرون برای به‌روزرسانی قیمت‌ها هر ساعت
// if (!wp_next_scheduled('update_product_prices_event')) {
//     wp_schedule_event(time(), 'hourly', 'update_product_prices_event');
// }
// add_action('update_product_prices_event', 'update_product_prices_in_toman');


add_action('wp_ajax_search_products', 'search_products_callback');
add_action('wp_ajax_nopriv_search_products', 'search_products_callback');

function search_products_callback()
{
    // بررسی ورودی و جلوگیری از حملات
    $search_term = sanitize_text_field($_POST['query']);

    // جستجو در محصولات
    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => $search_term,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div>' . get_the_title() . '</div>'; // یا HTML دلخواه برای نمایش
        }
    } else {
        echo 'محصولی یافت نشد.';
    }
    wp_die();
}



// function my_enqueue_custom_scripts() {
//     // اضافه کردن jQuery از لینک خودتان
//     wp_enqueue_script('jquery-cdn', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), null, true);

//     // اضافه کردن جاوا اسکریپت بوت‌استرپ از لینک خودتان
//     wp_enqueue_script('bootstrap-js-cdn', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery-cdn'), null, true);
// }
// add_action('wp_enqueue_scripts', 'my_enqueue_custom_scripts');

// function enqueue_bootstrap_styles() {
//     // اضافه کردن CSS بوت‌استرپ از لینک خودتان
//     wp_enqueue_style('bootstrap-css-cdn', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
// }
// add_action('wp_enqueue_scripts', 'enqueue_bootstrap_styles');

function enqueue_custom_assets()
{
    //     // اضافه کردن CSS بوت‌استرپ
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');

    //     // اضافه کردن CSS Font Awesome
    wp_enqueue_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

    //     // اضافه کردن CSS Leaflet
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');

    //     // اضافه کردن جاوا اسکریپت Leaflet
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_assets');







?>

<?php
// <--برای اتصال صفحه لاگین به دیتابیس-->
function custom_login_function()
{
    if (isset($_POST['login'])) {
        $username = sanitize_text_field($_POST['username']);
        $password = $_POST['password'];

        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) {
            echo 'نام کاربری یا رمز عبور اشتباه است.';
        } else {
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('init', 'custom_login_function');
?>