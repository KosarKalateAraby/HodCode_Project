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
    $title = "درباره ما";
    $description = "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است...";
    $innovations = "ما همیشه در جستجوی نوآوری‌های جدید هستیم تا تجربه خرید شما را جذاب‌تر و راحت‌تر کنیم.";
    $fast_purchase = "با فرآیند ساده و کاربرپسند خرید، تمام نیازهای شما تنها با چند کلیک برآورده می‌شوند.";
    $quality_assurance = "هر محصول ما تحت استانداردهای سختگیرانه‌ای آزمایش می‌شود تا فقط بهترین‌ها را به دست شما برسانیم.";
    ?>

<div class="container">
    <div class="row mt-5 d-flex">
        <div class="col-md-4 order-md-2">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/img-about.jpg" alt="Fabric" class="img-fluid">
        </div>
        <div class="col-md-8 order-md-1">
            <h1 class="title-about"><?php echo $title; ?></h1>
            <p class="paragraph"><?php echo $description; ?></p>
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