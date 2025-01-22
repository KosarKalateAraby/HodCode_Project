<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


get_header( 'shop' ); ?>

<!-- رفع ارور نمایش دادن صفحه -->
<?php
global $product;

// اطمینان از مقداردهی درست به $product
if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() ); // دریافت محصول مرتبط با پست جاری
}

// اگر هنوز $product مقداردهی نشده است
if ( ! $product ) {
    echo '<p>Product not found.</p>';
    return;
}

// حالا می‌توانید با خیال راحت تابع get_gallery_image_ids() را فراخوانی کنید
$attachment_ids = $product->get_gallery_image_ids();
?>


<div class="container my-5">
    <div class="row">
        <!-- ---------------------قسمت نمایش تصاویر محصول --------------------->
        <div class="col-md-6">
            <div id="productGallery" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">
                    <?php
                    global $product;
                    if (!$product) {
                        $product = wc_get_product(get_the_ID());
                    }
                    $main_image = $product->get_image_id(); // عکس اصلی محصول
                    $main_image_url = wp_get_attachment_url($main_image);
                    ?>
                    <div class="carousel-item active">
                        <img src="<?php echo esc_url($main_image_url); ?>" class="d-block w-100 zoomable" alt="Main Product Image" style="aspect-ratio: 1 / 1 !important; object-fit: cover;">
                    </div>
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ($attachment_ids) {
                        foreach ($attachment_ids as $index => $attachment_id) {
                            $image_url = wp_get_attachment_url($attachment_id);
                            ?>
                            <div class="carousel-item">
                                <img src="<?php echo esc_url($image_url); ?>" class="d-block w-100 zoomable" alt="Product Image" style="aspect-ratio: 1 / 1; object-fit: cover;">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <!-- ----------------------کنترل اسلایدر --------------------------->
                <button class="carousel-control-prev position-absolute top-50 translate-middle-y" type="button" data-bs-target="#productGallery" data-bs-slide="prev" style="z-index: 10;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next position-absolute top-50 translate-middle-y" type="button" data-bs-target="#productGallery" data-bs-slide="next" style="z-index: 10;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- تصاویر کوچک پایین اسلایدر -->
                <div class="carousel-thumbnails mt-3 d-flex justify-content-center">
                    <img src="<?php echo esc_url($main_image_url); ?>" class="thumbnail-img mx-1 active" data-bs-target="#productGallery" data-bs-slide-to="0" style="cursor: pointer; width: 90px; height: 90px; object-fit: cover;">
                    <?php
                    if ($attachment_ids) {
                        foreach ($attachment_ids as $index => $attachment_id) {
                            $thumb_url = wp_get_attachment_url($attachment_id);
                            ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" class="thumbnail-img mx-1" data-bs-target="#productGallery" data-bs-slide-to="<?php echo $index + 1; ?>" style="cursor: pointer; width: 90px; height: 90px; object-fit: cover;">
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-------------------------- قسمت نمایش مشخصات محصول ----------------------------->

        <div class="col-md-6">
            <h1 class="product-title mb-3"><?php the_title(); ?></h1>
            <p class="product-price1 fw-bold">
                قیمت هر متر: <?php echo $product->get_price_html(); ?>
            </p>
            <hr>

            <!------------------------ قسمت نمایش رنگبندی محصولات ------------------->
            <?php
            global $post;
            $color_hex = get_post_meta($post->ID, '_product_color_hex', true); // دریافت رنگ‌ها

            if ($color_hex) {
                $colors = explode(',', $color_hex); // جدا کردن رنگ‌ها با کاما
                echo '<div class="product-colors mb-3 d-flex align-items-center">';
                echo '<span class="fw-bold me-1">رنگ‌بندی:</span>'; // کاهش فاصله با `me-1`
                echo '<div class="d-flex flex-wrap gap-1 align-items-center">'; // کاهش فاصله دایره‌ها
                foreach ($colors as $index => $color) {
                    $color = trim($color); // حذف فاصله‌ها
                    echo '<div class="color-circle" data-color="' . esc_attr($color) . '" title="' . esc_attr($color) . '" style="background-color: ' . esc_attr($color) . ';"></div>';
                }
                echo '</div>';
                echo '</div>';

                // دکمه "پیشنهاد رنگ‌های مکمل"
                echo '<button id="color-suggestions-btn" class="btn btn-info mt-3" style="background-color: #EF4056; color: white; margin-top: 10px; margin-bottom: 20px; border-radius: 5px; display:none;">پیشنهاد رنگ‌های مکمل</button>';
            }
            ?>

            <!-- پس‌زمینه تار -->
            <div id="overlay" style="display: none;"></div>

            <!-------------------------- باکس مدال نمایش رنگ‌های مکمل -------------------------->
            <div class="modal fade" id="complementaryModal" tabindex="-1" aria-labelledby="complementaryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="complementaryModalLabel">پالت رنگ مکمل</h5>
                        </div>
                        <div class="modal-body">
                            <div class="selected-color mb-3">
                                <strong>رنگ انتخاب‌شده:</strong>
                                <div class="color-circle" id="selectedColor" style="width: 40px; height: 40px; border-radius: 50%;"></div>
                            </div>
                            <div class="complementary-colors">
                                <strong>رنگ‌های مکمل:</strong>
                                <div id="complementaryColors" class="d-flex gap-2"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" style="background-color: var(--color-blue);" data-bs-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ورودی‌های محاسبه قیمت -->
            <div class="mb-3">
                <input type="number" class="form-control mb-2" id="inputMeters" placeholder="متر" min="0">
                <input type="number" class="form-control" id="inputCentimeters" placeholder="سانتی‌متر" min="0" max="99">
            </div>
            <div class="mb-3">
                <label for="totalPrice" class="form-label">قیمت کل (به تومان):</label>
                <input type="text" class="form-control" id="totalPrice" readonly>
            </div>

            <!-- مشخصات بیشتر -->
            <ul class="product-meta mt-4">
                <li><strong>کد محصول:</strong> <?php echo $product->get_sku(); ?></li>
                <li><strong>دسته بندی:</strong> <?php echo wc_get_product_category_list($product->get_id()); ?></li>
                <li><strong>Tags:</strong> <?php echo wc_get_product_tag_list($product->get_id()); ?></li>
            </ul>

            <!-- فرم افزودن به سبد خرید -->
            <div class="add-to-cart mt-4">
                <form method="post" enctype="multipart/form-data">
                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="btn btn-primary d-flex align-items-center justify-content-center gap-2">
                        افزودن به سبد خرید
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>



<?php
// حذف تب‌های پیش‌فرض ووکامرس
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
?>


<!-- ---------------------قسمت توضیحات محصول----------------------------- -->

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- بخش تب‌ها -->
            <ul class="nav nav-tabs" id="product-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                        توضیحات
                    </button>
                </li>
            </ul>

            <!-- محتوای تب‌ها -->
            <div class="tab-content mt-4" id="product-tabs-content">
                <!-- تب توضیحات -->
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="text-justify">
                        <?php
                        // دریافت محتوای توضیحات محصول بدون تگ‌های HTML
                        global $post;
                        $description = apply_filters('the_content', get_the_content());
                        // حذف تمامی تگ‌های HTML (از جمله <p>) و نمایش فقط متن
                        echo nl2br(esc_html(strip_tags($description)));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ----------------------- قسمت محصولات مرتبط -------------------- -->

<div class="related-products my-5">
    <div class="container">
        <h3 class="text-center mb-4">محصولات مرتبط</h3>
        <div class="row gx-4 gy-4 justify-content-center">
            <?php
            // نمایش محصولات مرتبط
            $related_products = wc_get_related_products($product->get_id(), 4); // 4 محصول مرتبط
            if (!empty($related_products)) {
                foreach ($related_products as $related_product_id) {
                    $related_product = wc_get_product($related_product_id);
                    ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm border-0 h-100">
                            <!-- استفاده از get_the_post_thumbnail_url برای فراخوانی تصویر محصول -->
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url($related_product->get_id(), 'full')); ?>" class="card-img-top" alt="<?php echo esc_attr($related_product->get_name()); ?>" style="aspect-ratio: 1 / 1; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="font-size: 18px; color: black;"><?php echo esc_html($related_product->get_name()); ?></h5>
                                <p class="card-text" style="font-size: 16px; color: black;"><?php echo wc_price($related_product->get_price()); ?></p>
                                
                                <!-- فرم افزودن به سبد خرید -->
                                <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                                    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $related_product->get_id() ); ?>" />
                                    <button type="submit" class="btn btn-danger w-100 rounded-3">
                                        <i class="bi bi-cart-plus"></i> افزودن به سبد خرید
                                    </button>
                                </form>

                                <a href="<?php echo esc_url(get_permalink($related_product->get_id())); ?>" class="btn btn-outline-primary w-100 mt-2 rounded-3">
                                    مشاهده جزئیات محصول
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>محصولات مرتبطی برای نمایش وجود ندارد.</p>';
            }
            ?>
        </div>
    </div>
</div>





<script>

    // --------------اضافه کردن قابلیت انتخاب فقط یک رنگ محصول----------

    document.addEventListener("DOMContentLoaded", function () {
    const colorCircles = document.querySelectorAll(".color-circle");

    colorCircles.forEach(circle => {
        circle.addEventListener("click", function () {
            // حذف کلاس "selected" از تمام دایره‌ها
            colorCircles.forEach(c => c.classList.remove("selected"));

            // اضافه کردن کلاس "selected" به دایره انتخاب‌شده
            this.classList.add("selected");

            // دریافت رنگ انتخاب‌شده (اختیاری)
            const selectedColor = this.getAttribute("data-color");
            console.log("Selected Color:", selectedColor);
        });
    });
});


// ------------- قابلیت پیشنهاد رنگ مکمل برای هر رنگبندی -----------------

document.addEventListener("DOMContentLoaded", function () {
    const colorCircles = document.querySelectorAll('.color-circle');
    const suggestionsBtn = document.getElementById('color-suggestions-btn');
    const overlay = document.getElementById('overlay');
    const modalCloseBtn = document.querySelector('[data-bs-dismiss="modal"]');
    
    // تنظیم استایل اولیه دکمه پیشنهاد رنگ مکمل برای انیمیشن
    suggestionsBtn.style.opacity = 0;
    suggestionsBtn.style.transition = 'opacity 0.5s ease'; // انیمیشن نرم برای تغییر اپاسیتی

    colorCircles.forEach(circle => {
        circle.addEventListener('click', function () {
            // نمایش دکمه پیشنهاد رنگ‌های مکمل با انیمیشن نرم
            suggestionsBtn.style.display = 'inline-block';

            // استفاده از setTimeout برای اعمال انیمیشن
            setTimeout(() => {
                suggestionsBtn.style.opacity = 1; // بعد از تاخیر دکمه به طور آرام ظاهر می‌شود
            }, 50);

            // دریافت رنگ انتخاب‌شده
            const selectedColor = this.getAttribute("data-color");

            // محاسبه رنگ مکمل و نمایش آن در مدال
            const complementaryColors = calculateComplementaryColors(selectedColor);
            document.getElementById('selectedColor').style.backgroundColor = selectedColor;

            // نمایش رنگ‌های مکمل
            const complementaryContainer = document.getElementById('complementaryColors');
            complementaryContainer.innerHTML = ''; // پاک کردن رنگ‌های قبلی
            complementaryColors.forEach(color => {
                const colorDiv = document.createElement('div');
                colorDiv.classList.add('color-circle');
                colorDiv.style.backgroundColor = color;
                colorDiv.style.width = '40px';
                colorDiv.style.height = '40px';
                colorDiv.style.borderRadius = '50%';
                complementaryContainer.appendChild(colorDiv);
            });
        });
    });

    // افزودن رویداد کلیک برای دکمه "نمایش رنگ‌های مکمل"
    suggestionsBtn.addEventListener('click', function() {
        // نمایش پس‌زمینه تار و مدال
        overlay.style.display = 'block';
        const modal = new bootstrap.Modal(document.getElementById('complementaryModal'));
        modal.show(); // نمایش مدال
    });

    // بستن مدال و پنهان کردن پس‌زمینه تار
    modalCloseBtn.addEventListener('click', function () {
        overlay.style.display = 'none'; // پنهان کردن پس‌زمینه تار
    });
});



// محاسبه رنگ‌های مکمل
function calculateComplementaryColors(hexColor) {
    // تبدیل رنگ از هکس به RGB
    const rgb = hexToRgb(hexColor);
    // رنگ مکمل به سادگی از طریق چرخش رنگ محاسبه می‌شود (برای مثال 180 درجه)
    const complementaryRgb = { r: 255 - rgb.r, g: 255 - rgb.g, b: 255 - rgb.b };
    const complementaryColor = rgbToHex(complementaryRgb.r, complementaryRgb.g, complementaryRgb.b);
    
    // می‌توانیم چند رنگ مکمل مختلف با کمی تغییر به‌دست آوریم
    return [complementaryColor, lightenOrDarken(complementaryColor, 20), lightenOrDarken(complementaryColor, -20)];
}

// تبدیل هکس به RGB
function hexToRgb(hex) {
    const match = hex.match(/^#([a-f0-9]{6}|[a-f0-9]{3})$/i);
    let color = match ? match[1] : '';
    if (color.length === 3) {
        color = color.split('').map(function (char) { return char + char; }).join('');
    }
    const rgb = parseInt(color, 16);
    return { r: (rgb >> 16) & 0xff, g: (rgb >>  8) & 0xff, b: rgb & 0xff };
}

// تبدیل RGB به هکس
function rgbToHex(r, g, b) {
    return '#' + (1 << 24 | r << 16 | g << 8 | b).toString(16).slice(1).toUpperCase();
}

// روشن یا تیره کردن رنگ
function lightenOrDarken(hex, percent) {
    const rgb = hexToRgb(hex);
    const factor = (percent / 100) * 255;
    const r = Math.min(255, Math.max(0, rgb.r + factor));
    const g = Math.min(255, Math.max(0, rgb.g + factor));
    const b = Math.min(255, Math.max(0, rgb.b + factor));
    return rgbToHex(r, g, b);
}



// ----------- نمایش قیمت کل به صورت لحظه‌ای -----------
    
    document.addEventListener("DOMContentLoaded", function () {
        const inputMeters = document.getElementById("inputMeters");
        const inputCentimeters = document.getElementById("inputCentimeters");
        const totalPrice = document.getElementById("totalPrice");

        // استخراج قیمت از متن مربوط به قیمت هر متر
        const pricePerMeter = parseFloat(
            document.querySelector(".product-price1").innerText
                .replace(/[^\d.]/g, "") // حذف تمام کاراکترهای غیرعددی
        );

        // تابع محاسبه قیمت کل
        function calculateTotal() {
            const meters = parseFloat(inputMeters.value) || 0;
            const centimeters = parseFloat(inputCentimeters.value) || 0;

            // محاسبه طول کل به متر
            const totalLength = meters + centimeters / 100;

            // محاسبه قیمت کل و حذف اعشار
            const total = Math.round(totalLength * pricePerMeter);

            // نمایش قیمت کل با فرمت هزارگان
            totalPrice.value = `${total.toLocaleString()} تومان`;
        }

        // افزودن رویداد به ورودی‌های متر و سانتی‌متر
        inputMeters.addEventListener("input", calculateTotal);
        inputCentimeters.addEventListener("input", calculateTotal);
    });
</script>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
?>