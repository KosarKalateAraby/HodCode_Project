<?php

// فراخوانی هدر قالب
get_header();
?>

<?php
// فراخوانی فایل اسلایدر
get_template_part('slider');
?>

<!-- قسمت دسته بندی محصولات (کارت‌ها) -->
<div class="container py-5">
    <div class="row g-4"> <!-- فاصله یکنواخت بین کارت‌ها -->
        <?php
        // آرایه‌ای برای کارت‌ها
        $cards = [
            ['title' => 'محصولات پاییزی', 'color' => 'bg-primary', 'link' => site_url('/shop')],
            ['title' => 'محصولات بهاری', 'color' => 'bg-warning', 'link' => site_url('/shop')],
            ['title' => 'محصولات زمستانی', 'color' => 'bg-primary', 'link' => site_url('/shop')],
            ['title' => 'محصولات تابستانی', 'color' => 'bg-warning', 'link' => site_url('/shop')]
        ];
        


        // نمایش کارت‌ها
        foreach ($cards as $card) {
            // بررسی رنگ پس‌زمینه و تعیین رنگ متن
            $textColor = ($card['color'] === 'bg-warning') ? 'text-dark' : 'text-white';

            echo '<div class="col-6 col-sm-4 col-md-3">'; // تنظیم ستون‌ها برای ریسپانسیو
            echo '<a href="' . $card['link'] . '" class="text-decoration-none">';
            echo '<div class="d-flex flex-column align-items-center justify-content-center ' . $card['color'] . ' ' . $textColor . ' shadow card-custom">';
            echo '<h5 class="m-0 text-center custom-text">' . $card['title'] . '</h5>'; // متن وسط کارت
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<!-- نمایش محصولات ویژه -->

<div class="container">
    <h2 class="text-center mb-4 fw-bold">محصولات ویژه!</h2>
    <div class="row g-4">
        <?php
        $args = [
            'post_type' => 'product',
            'tax_query' => [
                [
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                ],
            ],
        ];

        $featured_products = new WP_Query($args);

        if ($featured_products->have_posts()) :
            while ($featured_products->have_posts()) : $featured_products->the_post();
                global $product;
                ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card shadow-sm border p-2">
                        <!-- تصویر محصول -->
                        <a href="<?php the_permalink(); ?>" class="d-block">
                            <?php echo $product->get_image('woocommerce_thumbnail', ['class' => 'card-img-top square-image']); ?>
                        </a>
                        <div class="index-card-body d-flex justify-content-between align-items-center">
                            <!-- نام محصول -->
                            <span class="index-product-name text-dark">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </span>
                            <!-- قیمت محصول -->
                            <span class="index-product-price">
                                <?php echo $product->get_price_html(); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p class="text-center">هیچ محصول ویژه‌ای یافت نشد!</p>
        <?php endif; ?>
    </div>
</div>


<!-- قسمت وبلاگ ها -->

<div class="container my-5">
<h2 class="section-title1 text-center fw-bold mb-4">در وبلاگ می‌خوانید...</h2>
        <div class="row g-3">
            <?php
            // ایجاد کوئری برای دریافت آخرین مطالب
            $latest_posts = new WP_Query([
                'category_name' => 'blogs', // فقط پست‌هایی که در دسته‌ی blog هستند
                'post_type' => 'post', // نوع پست (مطالب)
                'posts_per_page' => 5, // تعداد پست‌ها
            ]);

            // اجرای حلقه وردپرس
            if ($latest_posts->have_posts()):
                while ($latest_posts->have_posts()): $latest_posts->the_post(); ?>
                    <div class="col-12">
                        <div class="card blog-card flex-row align-items-center">
                            <!-- تصویر شاخص -->
                            <div class="col-3 p-0">
                                <?php if (has_post_thumbnail()): ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" 
                                        alt="<?php the_title(); ?>" class="image-container">
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/p1.jpg" 
                                        alt="تصویر پیش‌فرض" class="image-container">
                                <?php endif; ?>
                            </div>

                            <!-- متن پست -->
                            <div class="text-weblog col-9 d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h5 class="blog-title mb-2"><?php the_title(); ?></h5>
                                    <p class="date-blog mb-1">
                                        <?php echo get_the_date('j F Y'); ?> | نوشته‌شده توسط <?php the_author(); ?>
                                    </p>
                                    <p class="des-blog mb-1 ">
                                        <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
                                    </p>

                                </div>
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">اینجا بخوانید</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); // بازنشانی کوئری
            else: ?>
                <p>هیچ مطلبی یافت نشد.</p>
            <?php endif; ?>
        </div>
</div>

<?php
// فراخوانی فوتر قالب
get_footer();
?>