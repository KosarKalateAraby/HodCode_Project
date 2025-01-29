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
/* Template Name: Login Page */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_text_field($_POST['username']);
    $password = $_POST['password'];
    $email = sanitize_email($_POST['email']);

    // دریافت اطلاعات کاربر با نام کاربری
    $user = get_user_by('login', $username);

    if (!$user) {
        $error_message = 'نام کاربری یافت نشد.';
    } elseif (!wp_check_password($password, $user->user_pass, $user->ID)) {
        $error_message = 'رمز عبور اشتباه است.';
    } elseif ($user->user_email !== $email) {
        $error_message = 'ایمیل وارد شده با نام کاربری مطابقت ندارد.';
    } else {
        // ورود موفقیت‌آمیز
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        $success_message = 'ورود با موفقیت انجام شد.';
    }
}
?>


    <div class="div-form-login">
        <div class="login-container">
            <!-- Login form container -->
            <div class="login-form-container">
                <!-- Header section -->
                <div class="header-login">
                    <div class="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo.svg" alt="دیباج">
                    </div>
                    <div class="nav-links">
                        <a href="<?php echo home_url()?>">صفحه‌اصلی</a>
                        <a href="<?php echo site_url('/register'); ?>">ثبت‌نام</a>
                    </div>
                </div>


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
                        <div class="register-container">
                            <button type="submit" class="btn btn-primary" name="login">ورود</button>
                            <a href="/Register.php" class="register-link">آیا حساب ندارید؟ همین الان ثبت نام کنید</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Image of fabric -->
            <div class="img-parche-container">
                <img class="img-parche" src="<?php echo get_template_directory_uri(); ?>/assets/image/LogIn.jpg" alt="پارچه">
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

    </div>
</body>