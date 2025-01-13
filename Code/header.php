<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <nav class="navbar navbar-expand-lg bg-light shadow-sm">
            <div class="container">
                <!-- لوگو -->
                <a class="navbar-brand ms-3" href="<?= home_url(); ?>">
                    <img src="<?= get_template_directory_uri() ?>/assets/image/logo.svg" alt="<?php bloginfo('name'); ?>" class="logo">
                </a>
                <!-- دکمه برای نمایش در موبایل -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- منوی ناوبری -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- دکمه ضربدر -->
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 d-lg-none" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Close"></button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main_menu', // مکان منوی تعریف شده در وردپرس
                        'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0 pt-5',
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

                        <!-- حساب کاربری -->
                        <div class="account-icon position-relative">
                            <div class="account-dropdown">
                                <a href="#">
                                    <i class="bi bi-box-arrow-in-right"></i> ورود
                                </a>
                                <a href="#">
                                    <i class="bi bi-person-plus"></i> ثبت‌نام
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- نمایش باکس پایین صفحه -->
    <?php
    // Footer items dynamically
    $footerItems = [
        ['icon' => 'fa-home', 'label' => 'خانه', 'url' => home_url('/')],
        ['icon' => 'fa-shopping-cart', 'label' => 'سبد خرید', 'url' => site_url('/cart')],
        ['icon' => 'fa-box-open', 'label' => 'محصولات', 'url' => site_url('/?page_id=86')],
        ['icon' => 'fa-search', 'label' => 'جست‌وجو', 'url' => site_url('/search')],
        ['icon' => 'fa-user', 'label' => 'حساب کاربری', 'url' => site_url('/profile')],
    ];
    ?>

    <footer class="fixed-bottom bg-light border-top" id="footer_header">
        <div class="d-flex justify-content-around align-items-center p-2">
            <?php
            $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);// گرفتن آدرس صفحه فعلی
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
    <script src="/assets/css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= get_template_directory_uri() ?>/custom.js"></script>
    <?php wp_footer(); ?>
</body>
</html>
