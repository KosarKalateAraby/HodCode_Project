<?php
/*
Template Name: Blog Page
*/
?>
<?php
// این خط کد از قالب وردپرس استفاده می‌کند
get_header(); // نمایش هدر سایت
?>

<div class="container my-5">
    <!-- بخش محبوب‌ترین‌ها -->
    <h2 class="section-title">پر بازدیدترین‌ها</h2>
    <div class="row g-4 mb-5">
        <?php
        // کوئری برای دریافت پست‌های پربازدید
        $popularPosts = new WP_Query(array(
            'posts_per_page' => 3, // تعداد پست‌ها
            'orderby' => 'comment_count', // مرتب‌سازی بر اساس تعداد کامنت
            'order' => 'DESC', // ترتیب نزولی
        ));

        if ($popularPosts->have_posts()) :
            while ($popularPosts->have_posts()) : $popularPosts->the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <a href="<?php the_permalink(); ?>" class="blogs-card-link">
                        <div class="blogs-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="image-container" style="background-image: url('<?php the_post_thumbnail_url('medium'); ?>');"></div>
                            <?php else : ?>
                                <div class="image-container" style="background-image: url('path/to/default-image.jpg');"></div>
                            <?php endif; ?>
                            <div class="blogs-content">
                                <p class="blogs-meta"><?php echo get_the_date('j F Y'); ?></p>
                                <h5 class="blogs-title"><?php the_title(); ?></h5>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>هیچ مقاله‌ای موجود نیست.</p>
        <?php endif; ?>
    </div>


    <!-- بخش آخرین مطالب -->
    <h2 class="section-title">آخرین مطالب</h2>
    <div class="row g-3">
        <?php
        // ایجاد کوئری برای دریافت آخرین مطالب
        $latest_posts = new WP_Query([
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
                                    alt="<?php the_title(); ?>" class="img-fluid">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/p1.jpg"
                                    alt="تصویر پیش‌فرض" class="img-fluid">
                            <?php endif; ?>
                        </div>

                        <!-- متن پست -->
                        <div class="text-weblog col-9 d-flex justify-content-between align-items-center p-3">
                            <div>
                                <h5 class="blog-title mb-2"><?php the_title(); ?></h5>
                                <p class="text-muted mb-1">
                                    <?php echo get_the_date('j F Y'); ?> | نوشته‌شده توسط <?php the_author(); ?>
                                </p>
                                <p class="text-muted mb-0"><?php the_excerpt(); ?></p>
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