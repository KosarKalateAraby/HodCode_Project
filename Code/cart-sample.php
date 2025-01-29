<?php
/* Template Name: Cart Page */
?>
<?php
// فراخوانی هدر قالب
get_header();
?>
<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="container py-5">
    <div class="row">
        <!-- ستون سمت چپ: محصولات -->
        <div class="col-lg-8 mb-4">
            <div class="border p-4 rounded bg-white shadow-sm">
                <h2 class="mb-4 text-center">سبد خرید شما</h2>
                <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                    <?php do_action('woocommerce_before_cart_table'); ?>
                    <div class="table-responsive">
                        <table class="table table-hover shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th class="product-thumbnail">تصویر</th>
                                    <th class="product-name">نام محصول</th>
                                    <th class="product-price">قیمت</th>
                                    <th class="product-quantity">تعداد</th>
                                    <th class="product-subtotal">قیمت کل</th>
                                    <th class="product-remove">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                    $product_id = $cart_item['product_id'];
                                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                                ?>
                                <tr class="text-center align-middle">
                                    <td class="product-thumbnail">
                                        <?php
                                        $main_image_url = wp_get_attachment_url($_product->get_image_id());
                                        if ($main_image_url) {
                                            echo '<img src="' . esc_url($main_image_url) . '" class="img-fluid rounded d-block mx-auto" style="width: 100%; max-width: 80px; height: auto; object-fit: cover;">';
                                        }
                                        ?>
                                    </td>
                                    <td class="product-name"><?php echo $_product->get_name(); ?></td>
                                    <td class="product-price"><?php echo wc_price($_product->get_price()); ?></td>
                                    <td class="product-quantity"><?php echo $cart_item['quantity']; ?></td>
                                    <td class="product-subtotal"><?php echo wc_price($_product->get_price() * $cart_item['quantity']); ?></td>
                                    <td class="product-remove">
                                        <a href="<?php echo wc_get_cart_remove_url($cart_item_key); ?>" class="btn btn-danger btn-sm">&times;</a>
                                    </td>
                                </tr>
                                <?php endif;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
        </div>

        <!-- ستون سمت راست: اطلاعات پرداخت -->
        <div class="col-lg-4">
            <div class="border p-4 rounded bg-white shadow-sm">
                <h3 class="mb-4 text-center">خلاصه سفارش</h3>
                <?php
                // محاسبات 20 درصد مبلغ کل
                $cart_total = WC()->cart->get_subtotal();
                $discount_amount = $cart_total * 0.8; // 80 درصد تخفیف
                $payable_amount = $cart_total * 0.2; // 20 درصد مبلغ قابل پرداخت
                ?>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>قیمت کل:</span>
                        <strong><?php echo wc_price($cart_total); ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>تخفیف:</span>
                        <strong><?php echo wc_price($discount_amount); ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>مبلغ قابل پرداخت:</span>
                        <strong><?php echo wc_price($payable_amount); ?></strong>
                    </li>
                </ul>
                <div class="mt-4 text-center">
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="btn btn-primary btn-lg btn-block">تکمیل خرید</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_cart'); ?>

<?php
// فراخوانی فوتر قالب
get_footer();
?>