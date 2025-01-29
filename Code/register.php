<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body class="pt-3 pb-3">
    
    <?php
        /* Template Name:  Register Page */


        $success_message = null;
        $error_message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // دریافت داده‌های فرم
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (email_exists($email)) {
                // اگر ایمیل قبلا ثبت شده باشد
                $error_message = 'این حساب از قبل موجود است!';
                $redirect_to_login = true; // نشان‌دهنده نمایش دکمه صفحه ورود
            }
            else {
                $userdata = array(
                    'user_login' => $username,
                    'user_email' => $email,
                    'user_pass'  => $password
                );

                $user_id = wp_insert_user($userdata);

                if (is_wp_error($user_id)) {
                    $error_message = 'خطایی رخ داده است: ' . $user_id->get_error_message();
                } else {
                    $success_message = 'ثبت نام با موفقیت انجام شد.';
                }
            }
        }
    ?>

    <div class="div-form-r">
        <div class="login-container">
            <!-- Login form container -->
            <div class="register-form-container">
                <!-- Header section -->
                <div class="header">
                    <div class="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo.svg" alt="لوگو">
                    </div>
                    <div class="nav-links">
                        <a href="<?php echo home_url('/')?>">صفحه‌اصلی</a>
                        <a href="<?php echo site_url('/log-in'); ?>">ورود</a>
                    </div>
                </div>

                <!-- Display error or success message below the header -->
                

                <div class="login-form">
                    <form method="POST" action="">
                        <div class="form-group1">
                            <label for="username">نام کاربری :</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="لطفا نام کاربری خود را وارد کنید" required>
                        </div>
                        <div class="form-group">
                            <label for="email">ایمیل:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="لطفا ایمیل خود را وارد کنید" required>
                        </div>
                        <div class="form-group">
                            <label for="password">رمز عبور:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="لطفا رمز عبور خود را وارد کنید" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">تایید رمز عبور :</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="لطفا دوباره رمز عبور خود را وارد کنید" required>
                        </div>
                        <div class="register-container-register">
                            <button type="submit" class="btn btn-primary" name="login">ثبت نام</button>
                            <a href="<?php echo site_url('/log-in'); ?>" class="register-link-register">آیا حساب دارید؟ وارد شوید</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Image of fabric -->
            <div class="img-parche-container">
            <img class="img-parcheh" src="<?php echo get_template_directory_uri(); ?>/assets/image/SignIn.jpg" alt="پارچه">
            </div>
        </div>
    </div>

        <!-- پیام موفقیت یا خطا -->
        <div class="overlay" id="message-overlay">
            <div class="message-box">
                <p id="message-text"></p>
                <button id="message-button"></button>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                <?php if (isset($success_message)): ?>
                    showMessage("<?php echo $success_message; ?>", "رفتن به صفحه اصلی", function () {
                        window.location.href = "<?php echo home_url(); ?>";
                    });
                <?php elseif (isset($error_message)): ?>
                    showMessage("<?php echo $error_message; ?>", "بستن", function () {
                        document.getElementById("message-overlay").style.display = "none";
                    });
                <?php endif; ?>
            });

            function showMessage(message, buttonText, buttonAction) {
                const overlay = document.getElementById("message-overlay");
                const messageText = document.getElementById("message-text");
                const messageButton = document.getElementById("message-button");

                messageText.textContent = message;
                messageButton.textContent = buttonText;
                messageButton.onclick = buttonAction;

                overlay.style.display = "flex";
            }
        </script>

</body>
</html>