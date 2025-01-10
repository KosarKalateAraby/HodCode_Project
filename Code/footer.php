<!-- footer.php -->
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Name 1.0
 */
?>

    </div><!-- #content -->

    <footer class="bg-custom-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start mt-5">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/enamad.jpg" alt="eNAMAD Logo" class="img-fluid mb-3 mt-5">
                        <p>www.eNAMAD.ir</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h3 class="font-weight-bold mb-2 text-right">اطلاعات تماس</h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <a href="https://telegram.org" target="_blank" rel="noopener noreferrer" class="mx-1">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/telegram-app.png" alt="Telegram" class="img-fluid" style="width: 30px; height: 30px;">
                            </a>
                            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="mx-1">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" alt="Instagram" class="img-fluid" style="width: 30px; height: 30px;">
                            </a>
                            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="mx-1">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/linkedin.png" alt="LinkedIn" class="img-fluid" style="width: 30px; height: 30px;">
                            </a>
                        </div>
                        <p class="text-right mb-0 ml-2">+9370000000</p>
                    </div>
                    <p class="text-right mt-2">DibajShop@gmail.com</p>
                    <p class="text-right">ایران - مشهد</p>
                </div>
                <div class="col-md-4">
                    <h3 class="font-weight-bold mb-2 text-right">لینک‌های مفید</h3>
                    <p class="text-right"><a href="#" class="text-white">صفحه اصلی</a></p>
                    <p class="text-right"><a href="#" class="text-white">محصولات</a></p>
                    <p class="text-right"><a href="#" class="text-white">وبلاگ</a></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-right">
                    <p>تمامی حقوق متعلق به فروشگاه دیباج می‌باشد</p>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<!-- افزودن لینک به فایل‌های CSS و JS مربوط به بوت‌استرپ -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- افزودن رنگ سفارشی به فایل CSS -->
<style>
    .bg-custom-dark {
        background-color: #00264D; /* رنگ آبی تیره مشابه تصویر */
    }
</style>

</body>
</html>