<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه محصولات</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .custom-button {
            border-radius: 25px;
            padding: 5px 10px;
            margin: 5px;
            border: 2px solid #00264D;
            color: black;
            background-color: white;
        }
        .custom-button:focus,
        .custom-button:active {
            outline: none;
            box-shadow: none;
        }
        .fabric-img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }
        .fabric-card:hover .fabric-img {
            transform: scale(1.1);
        }
        .fabric-card {
            margin-bottom: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 15px;
            margin: 5px;
            border: none;
            display: flex;
            flex-direction: column;
        }
        .btn-custom {
            background-color: white;
            border: 2px solid #00264D;
            border-radius: 15px;
            color: black;
            padding: 2px 10px;
            font-size: 12px;
            width: auto;
            margin-right: 0;
            align-self: flex-end;
        }
        .btn-custom:hover {
            background-color: #f0f0f0;
            outline: none;
            box-shadow: none;
        }
        .price-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }
        .price-title h5 {
            font-size: 12px;
            margin-bottom: 0;
        }
        .price-title p {
            margin-bottom: 0;
        }
        .rating .fa-star {
            position: relative;
            font-size: 1rem;
            color: white;
            cursor: pointer;
        }
        .rating .fa-star:before {
            content: '\f005';
            color: transparent;
            -webkit-text-stroke: 1.5px orange; /* استروک نارنجی دور ستاره */
        }
        .rating .fa-star.checked:before {
            content: '\f005';
            color: orange;
            -webkit-text-stroke: 0; /* حذف استروک پس از کلیک */
        }
        @media (max-width: 768px) {
            .fabric-card {
                margin-bottom: 40px;
                margin-left: 10px;
                margin-right: 10px;
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row text-center my-4">
            <div class="col-12">
                <button class="btn custom-button">پارچه تابستانی</button>
                <button class="btn custom-button">پارچه بهاری</button>
                <button class="btn custom-button">پارچه زمستانی</button>
                <button class="btn custom-button">پارچه پاییزی</button>
                <button class="btn custom-button">پارچه مجلسی</button>
            </div>
        </div>

        <?php
        $fabrics = [
            ["img" => get_template_directory_uri() . "/assets/img/p1.jpg", "price" => "210,000 تومان", "name" => "پارچه ابریشمی", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/p2.jpg", "price" => "210,000 تومان", "name" => "پارچه پنبه‌ای", "rating" => 5],
            ["img" => get_template_directory_uri() . "/assets/img/p3.jpg", "price" => "210,000 تومان", "name" => "پارچه کتان", "rating" => 3],
            ["img" => get_template_directory_uri() . "/assets/img/p4.jpg", "price" => "210,000 تومان", "name" => "پارچه پشمی", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/p5.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 1", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/p6.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 2", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/p7.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 3", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/fabric8.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 4", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/fabric9.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 5", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/fabric10.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 6", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/fabric11.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 7", "rating" => 4],
            ["img" => get_template_directory_uri() . "/assets/img/fabric12.jpg", "price" => "210,000 تومان", "name" => "پارچه جدید 8", "rating" => 4],
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
