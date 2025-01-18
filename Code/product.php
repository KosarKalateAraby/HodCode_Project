<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه محصولات</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container my-5">
        <!-- ردیف بالای دکمه‌های دسته‌بندی پارچه -->
        <div class="row text-center my-4">
            <div class="col-12">
                <button class="btn custom-button">پارچه تابستانی</button>
                <button class="btn custom-button">پارچه بهاری</button>
                <button class="btn custom-button">پارچه زمستانی</button>
                <button class="btn custom-button">پارچه پاییزی</button>
                <button class="btn custom-button">پارچه مجلسی</button>
            </div>
        </div>
        <div class="row">
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
                ["img" => get_template_directory_uri() . "/assets/image/p4.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 7", "rating" => 4],
                ["img" => get_template_directory_uri() . "/assets/image/p5.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 8", "rating" => 4],
            ];

            foreach ($fabrics as $key => $fabric) {
                echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex flex-column width-custom">';
                echo '<div class="card h-100 fabric-card">';
                echo '<img src="' . htmlspecialchars($fabric['img']) . '" class="card-img-top fabric-img" alt="Fabric">';
                echo '<div class="card-body d-flex flex-column">';
                echo '<div class="flex-row">';
                echo '<p class="card-text">';
                if (isset($fabric['price'])) {
                    echo htmlspecialchars($fabric['price']);
                } else {
                    echo 'قیمت موجود نیست';
                }
                echo '</p>';
                echo '<h5 class="card-title">';
                if (isset($fabric['name'])) {
                    echo htmlspecialchars($fabric['name']);
                } else {
                    echo 'نام موجود نیست';
                }
                echo '</h5>';
                echo '</div>';
                echo '<div class="rating mb-3">';
                echo '</div>';
                echo '<a href="#" class="btn btn-custom mt-auto">مشاهده محصول</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>

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
        </div>
    </div>
</body>

</html>