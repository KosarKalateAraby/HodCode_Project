<?php
// فراخوانی هدر قالب
get_header();
?>

<?php
// فراخوانی فایل اسلایدر
get_template_part('slider');
?>

<!-- قسمت دسته بندی محصولات (کارت‌ها) -->
<div class="container py-5">
    <div class="row g-4"> <!-- فاصله یکنواخت بین کارت‌ها -->
    <?php
    // آرایه‌ای برای کارت‌ها
    $cards = [
        ['title' => 'محصولات پاییزی', 'color' => 'bg-primary', 'link' => '#'],
        ['title' => 'محصولات بهاری', 'color' => 'bg-warning', 'link' => '#'],
        ['title' => 'محصولات زمستانی', 'color' => 'bg-primary', 'link' => '#'],
        ['title' => 'محصولات تابستانی', 'color' => 'bg-warning', 'link' => '#']
    ];

    // نمایش کارت‌ها
    foreach ($cards as $card) {
        // بررسی رنگ پس‌زمینه و تعیین رنگ متن
        $textColor = ($card['color'] === 'bg-warning') ? 'text-dark' : 'text-white';

        echo '<div class="col-6 col-sm-4 col-md-3">'; // تنظیم ستون‌ها برای ریسپانسیو
        echo '<a href="' . $card['link'] . '" class="text-decoration-none">';
        echo '<div class="d-flex flex-column align-items-center justify-content-center ' . $card['color'] . ' ' . $textColor . ' shadow card-custom">';
        echo '<h5 class="m-0 text-center custom-text">' . $card['title'] . '</h5>'; // متن وسط کارت
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
    ?>
    </div>
</div>

<!-- نمایش محصولات ویژه -->


    <div class="container">
        <h2 class="text-center mb-4">محصولات ویژه!</h2>
        <div class="row g-4">
            <?php
            // داده‌های محصولات
            $products = [
                [
                    "name" => "پارچه ابریشمی",
                    "price" => 210000,
                    "image" => "assets/image/p1.jpg"
                ],
                [
                    "name" => "پارچه ساتن",
                    "price" => 180000,
                    "image" => "assets/image/p2.jpg"
                ],
                [
                    "name" => "پارچه مخمل",
                    "price" => 480000,
                    "image" => "assets/image/p3.jpg"
                ],
                [
                    "name" => "پارچه مازراتی",
                    "price" => 320000,
                    "image" => "assets/image/p4.jpg"
                ]
            ];

            // نمایش محصولات
            foreach ($products as $product): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <img src="<?php echo get_template_directory_uri() . '/' . $product['image']; ?>" 
                             alt="<?php echo $product['name']; ?>">
                        <div class="product-info d-flex justify-content-between">
                            <span class="product-name"><?php echo $product['name']; ?></span>
                            <span class="product-price"><?php echo number_format($product['price']); ?> تومان</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<!-- قسمت وبلاگ ها -->

<div class="container my-5">
    <h2 class="text-center mb-4">در وبلاگ می‌خوانید...</h2>
    <div class="row g-3">
        <?php
        // داده‌های مقالات
        $articles = [
            [
                "title" => "بررسی استایل نعیمه نظام‌دوست در جوکر",
                "description" => "از استایل‌های جذاب تا قشنگ",
                "image" => "assets/image/p4.jpg",
                "link" => "#"
            ],
            [
                "title" => "چگونه خوشتیپ‌ترین باشیم؟!",
                "description" => "با این استایل‌ها حسابی دلبری کن!",
                "image" => "assets/image/p4.jpg",
                "link" => "#"
            ],
            [
                "title" => "ایده استایل رسمی در شرکت",
                "description" => "دیگه برای لباس استرس نداشته باش!",
                "image" => "assets/image/p4.jpg",
                "link" => "#"
            ]
        ];

        // نمایش مقالات
        foreach ($articles as $article): ?>
            <div class="col-12">
                <div class="card blog-card flex-row align-items-center">
                    <div class="col-3 p-0">
                        <img src="<?php echo get_template_directory_uri() . '/' . $article['image']; ?>" 
                             alt="<?php echo $article['title']; ?>" class="img-fluid">
                    </div>
                    <div class="text-weblog col-9 d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h5 class="blog-title mb-2"><?php echo $article['title']; ?></h5>
                            <p class="text-muted mb-0"><?php echo $article['description']; ?></p>
                        </div>
                        <a href="<?php echo $article['link']; ?>" class="read-more-btn">اینجا بخوانید</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



    

<?php
// فراخوانی فوتر قالب
get_footer();
?>


