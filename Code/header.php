<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo('name'); ?></title>
    <!-- لینک به فایل CSS بوت‌استرپ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= get_template_directory_uri() ?>/assets/image/logo.svg">
    <link rel="stylesheet" href="<?= get_stylesheet_uri(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <nav class="navbar navbar-expand-lg bg-light shadow-sm">
        <div class="container">
            <!-- لوگو -->
            <a class="navbar-brand" href="<?= home_url(); ?>">
                <img src="<?= get_template_directory_uri() ?>/assets/image/logo.svg" alt="<?php bloginfo('name'); ?>" class="logo">
            </a>
            <!-- دکمه برای نمایش در موبایل -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- منوی ناوبری -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main_menu', // مکان منوی تعریف شده در وردپرس
                    'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'container' => false, // حذف تگ اضافی <div>
                    'fallback_cb' => false, // حذف نمایش پیش‌فرض اگر منو تنظیم نشده باشد
                    'add_li_class' => 'nav-item', // افزودن کلاس به <li>
                    'link_class' => 'nav-link', // افزودن کلاس به <a>
                    'walker' => new Custom_Nav_Walker(), // اتصال Walker Class
                ));
                ?>
                <!-- آیکون‌های هدر -->
                <div class="header-icons d-none d-lg-flex">
                    <a href="#"><i class="bi bi-search" alt="سرچ"></i></a>
                    <a href="#"><i class="bi bi-heart" alt="مورد علاقه‌ها"></i></a>
                    <a href="#"><i class="bi bi-cart" alt="سبد خرید"></i></a>
                    <a href="#"><i class="bi bi-person" alt="حساب کاربری"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- نمایش باکس پایین صفحه -->
<?php
// Footer items dynamically
$footerItems = [
    ['icon' => 'fa-home', 'label' => 'خانه', 'url' => 'index.php'],
    ['icon' => 'fa-shopping-cart', 'label' => 'سبد خرید', 'url' => 'cart.php'],
    ['icon' => 'fa-box-open', 'label' => 'محصولات', 'url' => 'products.php'],
    ['icon' => 'fa-search', 'label' => 'جست‌وجو', 'url' => 'search.php'],
    ['icon' => 'fa-user', 'label' => 'حساب کاربری', 'url' => 'profile.php'],
];
?>

<footer class="fixed-bottom bg-light border-top" id="footer_header">
    <div class="d-flex justify-content-around align-items-center p-2">
        <?php
        $currentPath = $_SERVER['REQUEST_URI']; // گرفتن آدرس صفحه فعلی
        $currentPath = rtrim($currentPath, '/'); // حذف اسلش انتهایی (در صورت وجود)

        foreach ($footerItems as $item): 
            // بررسی دقیق مسیر صفحه خانه
            $isActive = ($currentPath === $item['url'] || ($item['url'] === '/index.php' && $currentPath === '/')) ? 'active' : '';
        ?>
            <a href="<?= $item['url'] ?>" class="footer-item text-center text-decoration-none <?= $isActive ?>">
                <i class="fas <?= $item['icon'] ?>"></i>
                <p><?= $item['label'] ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</footer>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
<?php wp_footer(); ?>
</body>
</html>
