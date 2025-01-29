<?php
/**
 * Template Name: About-Us Page
 */
?>
<?php
// فراخوانی هدر قالب
get_header();
?>


<?php
// دریافت پست "درباره ما" از پست‌های معمولی
$args = array(
    'post_type'      => 'post',    // نوع پست: نوشته‌های معمولی
    'title'          => 'درباره ما',  // عنوان پست
    'posts_per_page' => 1,         // دریافت فقط یک پست
);

$about_query = new WP_Query($args);

// بررسی اینکه آیا پست "درباره ما" پیدا شده است
if ($about_query->have_posts()) {
    while ($about_query->have_posts()) {
        $about_query->the_post(); 
        $title = get_the_title();
        $description = apply_filters('the_content', get_the_content());
    }
} else {
    $title = "پست درباره ما پیدا نشد!";
    $description = "محتوای این پست هنوز تنظیم نشده است.";
}

// ریست کردن کوئری
wp_reset_postdata();
?>


<div class="container">
    <div class="row mt-5 d-flex">
        <div class="col-md-4 order-md-2">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/img-about.jpg" alt="Fabric" class="img-fluid mb-4">
        </div>
        <div class="col-md-8 order-md-1">
            <h2 class="title-about text-center"><?php echo $title; ?></h2>
            <p class="paragraph text-justify"><?php echo $description; ?></p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4 text-center">
            <div class="icon-circle">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/lightbulb-on.svg" alt="lightbulb"> <!-- آیکون اول -->
            </div>
            <h3>نوآوری</h3>
            <p><?php echo $innovations; ?></p>
        </div>
        <div class="col-md-4 text-center">
            <div class="icon-circle">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/shopping.svg" alt="shopping"> <!-- آیکون دوم -->
            </div>
            <h3>خرید سریع</h3>
            <p><?php echo $fast_purchase; ?></p>
        </div>
        <div class="col-md-4 text-center">
            <div class="icon-circle">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/chek.svg" alt="chek"> <!-- آیکون سوم -->
            </div>
            <h3>تضمین کیفیت</h3>
            <p><?php echo $quality_assurance; ?></p>
        </div>
    </div>

    <!-- سه دایره و سه مستطیل -->
    <div class="row mt-5 justify-content-center">
        <div class="col-md-4 text-center">
            <div class="circle">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/user.svg" alt="Icon 1">
            </div>
            <div class="rectangle"></div>
        </div>
        <div class="col-md-4 text-center">
            <div class="circle">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/user.svg" alt="Icon 2">
            </div>
            <div class="rectangle"></div>
        </div>
        <div class="col-md-4 text-center">
            <div class="circle">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/user.svg" alt="Icon 3">
            </div>
            <div class="rectangle"></div>
        </div>
    </div>
</div>

<?php
// فراخوانی فوتر قالب
get_footer();
?>