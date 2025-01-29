<?php
/**
 * Template Name: Contact-Us Page
 */
?>
<?php
// فراخوانی هدر قالب
get_header();
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 order-lg-2 order-2">
                <div class="contact-form">
                    <form action="<?php home_url() ?>" method="post" class="form-contact">
                        <div class="form-group">
                            <h3>ارسال پیام</h3>
                            <label for="name">نام</label>
                            <input type="text" class="form-control mb-3" id="name" name="name" placeholder="نام" required>
                        </div>
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" class="form-control mb-3" id="email" name="email" placeholder="ایمیل" required>
                        </div>
                        <div class="form-group">
                            <label for="message">متن پیام...</label>
                            <textarea class="form-control mb-3" id="message" name="message" rows="4" placeholder="متن پیام..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">ارسال</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1 order-1">
                <h3>ما اینجا هستیم!</h3>
                <p>اگر سوالی دارید یا نیاز به کمک بیشتری دارید، می‌توانید به ما اعتماد کنید. تیم ما همیشه آماده پاسخگویی به شما و ارائه بهترین خدمات است. نظرات و بازخورد شما برای ما ارزشمند است و مشتاقانه منتظر شنیدن آن‌ها هستیم.</p>
                <div class="contact-info">
                    <div class="info-item">
                        <span class="icon-circle-contact"><i class="fas fa-map-marker-alt"></i></span>
                        <span>آدرس: مشهد، خانه پارچه دیباج</span>
                    </div>
                    <div class="info-item">
                        <span class="icon-circle-contact"><i class="fas fa-phone"></i></span>
                        <span>تلفن: +9370000000</span>
                    </div>
                    <div class="info-item">
                        <span class="icon-circle-contact"><i class="fas fa-envelope"></i></span>
                        <span>ایمیل: DibajShop@gmail.com</span>
                    </div>
                </div>
                <p>ما را دنبال کنید:<br>
                <div class="social-icons">
                    <a href="https://www.facebook.com" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.twitter.com" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.linkedin.com" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                </p>
            </div>
        </div>
        <!-- نقشه -->
        <div id="map"></div>
    </div>

    <script>
        var map = L.map('map').setView([36.297, 59.606], 13); // مختصات دقیق‌تر برای مرکز شهر مشهد

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([36.297, 59.606]).addTo(map)
            .bindPopup('مشهد، خانه پارچه دیباج')
            .openPopup();
    </script>

<?php
// فراخوانی فوتر قالب
get_footer();
?>