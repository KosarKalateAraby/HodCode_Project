<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <!-- ستون سمت راست: مقاله اصلی -->
        <div class="col-md-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="card shadow-sm">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('full'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h1 class="card-blog-title fw-bold text-center"><?php the_title(); ?></h1>
                        <div class="d-flex justify-content-between text-muted mb-3">
                            <span>تاریخ: <?php echo get_the_date('j F Y');; ?></span>
                            <span>نویسنده: <?php the_author(); ?></span>
                        </div>
                        <div class="post-content" style="text-align: justify; line-height: 1.8;">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <div class="alert alert-warning" role="alert">
                    پستی پیدا نشد.
                </div>
            <?php endif; ?>
        </div>

        <!-- ستون سمت چپ: مقالات پربازدید -->
        <div class="col-md-4 mb-4">
            <h4 class="text-primary border-bottom pb-2">پربازدیدترین‌ها</h4>
            <div class="list-group">
                <?php
                // کوئری برای دریافت مقالات پربازدید
                $popular_posts = new WP_Query(array(
                    'posts_per_page' => 5,
                    'orderby' => 'comment_count', // بر اساس تعداد کامنت‌ها
                    'order' => 'DESC'
                ));
                if ($popular_posts->have_posts()) :
                    while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php the_title(); ?>" class="img-fluid me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                            <?php endif; ?>
                            <div>
                                <h6 class="mb-1"><?php the_title(); ?></h6>
                                <small class="text-muted"><?php echo get_the_date('j F Y');; ?></small>
                            </div>
                        </a>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p class="text-muted">هیچ مقاله‌ای موجود نیست.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>