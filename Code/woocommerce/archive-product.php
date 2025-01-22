<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

// حذف مسیر breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// حذف سایدبار
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.a
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );

?>
<div class="container my-5">

<form id="product-search-form">
    <input type="text" id="search-input" placeholder="جستجو در محصولات..." />
    <button type="submit" id="search-button">جستجو</button>
</form>

<div id="search-results"></div>




    <!-- دسته‌بندی‌ها -->
    <div class="row text-center my-4">
        <div class="col-12">
            <button class="btn custom-button">پارچه تابستانی</button>
            <button class="btn custom-button">پارچه بهاری</button>
            <button class="btn custom-button">پارچه زمستانی</button>
            <button class="btn custom-button">پارچه پاییزی</button>
            <button class="btn custom-button">پارچه مجلسی</button>
        </div>
    </div>

    <!-- نمایش محصولات -->
<div class="row">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php
            // دریافت اطلاعات محصول
            global $product;
            if ( empty( $product ) || ! $product->is_visible() ) {
                continue;
            }
            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 fabric-card">
                    <!-- تصویر محصول -->
                    <a href="<?php the_permalink(); ?>" class="card-img-top">
                        <?php echo $product->get_image(); ?>
                    </a>
                    
                    <div class="card-body d-flex flex-column">
                        <!-- نام محصول و قیمت -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="card-title fw-bold mb-0 fs-5"><?php the_title(); ?></h3>
                            <p class="card-text mb-0  fs-6">
                                <?php echo $product->get_price_html(); ?>
                            </p>
                        </div>
                        
                        <!-- امتیاز محصول -->
                        <div class="rating mb-3">
                            <?php
                            $rating = $product->get_average_rating();
                            for ( $i = 0; $i < 5; $i++ ) {
                                if ( $i < $rating ) {
                                    echo '<span class="fa fa-star text-warning"></span>';
                                } else {
                                    echo '<span class="fa fa-star text-secondary"></span>';
                                }
                            }
                            ?>
                        </div>
                        
                        <!-- دکمه مشاهده محصول -->
                        <a href="<?php the_permalink(); ?>" class="btn btn-custom mt-auto">مشاهده محصول</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p class="text-center">محصولی برای نمایش وجود ندارد.</p>
    <?php endif; ?>
</div>

<script>
                document.addEventListener("DOMContentLoaded", function() {
                    let fabrics = <?php echo (json_encode($fabrics)); ?>;
                    fabrics.forEach((fabric, index) => {
                        let randomFilledStars = localStorage.getItem('fabric_' + index + '_stars') || Math.floor(Math.random() * 6);
                        localStorage.setItem('fabric_' + index + '_stars', randomFilledStars);
                        fabric.randomStars = randomFilledStars;
                    });

                    let fabricCards = document.querySelectorAll('.rating');
                    fabricCards.forEach((card, index) => {
                        let randomStars = fabrics[index].randomStars;
                        for (let i = 0; i < 5; i++) {
                            if (i < randomStars) {
                                card.innerHTML += `<span class="fa fa-star filled"></span>`;
                            } else {
                                card.innerHTML += `<span class="fa fa-star"></span>`;
                            }
                        }
                    });
                });

                
</script>
<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
