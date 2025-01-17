<?php
// بررسی می‌کند که فایل به‌صورت مستقیم اجرا نشود.
if (!defined('ABSPATH')) {
    exit; // امن‌سازی فایل
}
?>

<div id="main-slider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <!-- Indicators -->
    <div class="carousel-indicators">
        <?php
        // لیستی از اسلایدها (می‌توانید از دیتابیس نیز مقدار بگیرید)
        $slides = [
            ['url' => get_template_directory_uri() . '/assets/image/slide4.png', 'alt' => 'اسلاید ۱'],
            ['url' => get_template_directory_uri() . '/assets/image/slide2.jpg', 'alt' => 'اسلاید ۲'],
            ['url' => get_template_directory_uri() . '/assets/image/slide3.jpg', 'alt' => 'اسلاید ۳'],
        ];

        foreach ($slides as $index => $slide) {
            $active = ($index === 0) ? 'active' : ''; // فعال‌سازی اولین اسلاید
            echo '<button type="button" data-bs-target="#main-slider" data-bs-slide-to="' . $index . '" class="' . $active . '" aria-current="' . ($active ? "true" : "false") . '" aria-label="Slide ' . ($index + 1) . '"></button>';
        }
        ?>
    </div>

    <!-- Slides -->
    <div class="carousel-inner">
        <?php
        foreach ($slides as $index => $slide) {
            $active = ($index === 0) ? 'active' : '';
            echo '<div class="carousel-item ' . $active . '">
                    <img src="' . esc_url($slide['url']) . '" class="d-block w-100" alt="' . esc_attr($slide['alt']) . '">
                </div>';
        }
        ?>
    </div>

    <!-- Navigation Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#main-slider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#main-slider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

