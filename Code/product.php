<?php
/*
Template Name: Product Page
*/
?>
<?php
// این خط کد از قالب وردپرس استفاده می‌کند
get_header(); // نمایش هدر سایت
?>

    <div class="container my-5"> <!-- ایجاد کانتینر اصلی -->
        <div class="row text-center my-4">
            <div class="col-12">
                <!-- دکمه‌های فیلتر محصولات -->
                <button class="btn custom-button">پارچه تابستانی</button>
                <button class="btn custom-button">پارچه بهاری</button>
                <button class="btn custom-button">پارچه زمستانی</button>
                <button class="btn custom-button">پارچه پاییزی</button>
                <button class="btn custom-button">پارچه مجلسی</button>
            </div>
        </div>

        <?php
        $fabrics = [
            ["img" => get_template_directory_uri() . "/assets/image/p1.jpg", "price" => "210,000 تومان", "name" => "پارچه ابریشمی", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p2.jpg", "price" => "210,000 تومان", "name" => "پارچه پنبه‌ای", "rating" => 5],
            ["img" => get_template_directory_uri() . "/assets/image/p3.jpg", "price" => "210,000 تومان", "name" => "پارچه کتان", "rating" => 3],
            ["img" => get_template_directory_uri() . "/assets/image/p4.jpg", "price" => "210,000 تومان", "name" => "پارچه پشمی", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p5.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 1", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p6.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 2", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p7.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 3", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p1.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 4", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p2.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 5", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p3.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 6", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p3.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 7", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/image/p3.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 8", "rating" => 4],
        ];

        echo '<div class="row">';
        foreach ($fabrics as $key => $fabric) {
            echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column">';
            echo '<div class="card h-100 fabric-card">';
            echo '<img src="' . $fabric['img'] . '" class="card-img-top fabric-img" alt="Fabric">';
            echo '<div class="card-body d-flex flex-column">';
            echo '<div class="price-title">';
            echo '<p class="card-text">' . $fabric['price'] . '</p>';
            echo '<h5 class="card-title">' . $fabric['name'] . '</h5>';
            echo '</div>';
            echo '<div class="rating mb-3">';
            for ($i = 1; $i <= 5; $i++) {
                echo '<span class="fas fa-star" onclick="rateProduct(this, ' . $i . ')"></span>';
            }
            echo '</div>';
            echo '<a href="#" class="btn btn-custom mt-auto">مشاهده محصول</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            if (($key + 1) % 4 == 0) {
                echo '</div><div class="row">';
            }
        }
        echo '</div>';
        ?>

        <script>
            /* تابع برای امتیازدهی به محصولات */
            function rateProduct(star, rating) {
                const allStars = star.parentNode.querySelectorAll('.fa-star');
                allStars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('checked');
                    } else {
                        s.classList.remove('checked');
                    }
                });
            }
        </script>
    </div>