<?php
/* Template Name:  Register Page */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت داده‌های فرم
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (email_exists($email)) {
        // اگر ایمیل قبلا ثبت شده باشد
        $error_message = 'این ایمیل قبلاً ثبت شده است. لطفا از ایمیل دیگری استفاده کنید یا رمز عبور خود را بازیابی کنید.';
    } else {
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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.svg" alt="دیباج">
                </div>
                <div class="nav-links">
                    <a href="#">صفحه‌اصلی</a>
                    <a href="#">ثبت‌نام</a>
                </div>
            </div>

            <!-- Display error or success message below the header -->
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <?php if (isset($success_message)) : ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

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
                        <a href="/Login.php" class="register-link-register">آیا حساب دارید؟ وارد شوید</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Image of fabric -->
        <div class="img-parche-container">
            <img class="img-parcheh" src="<?php echo get_template_directory_uri(); ?>/assets/parcheh.jpg" alt="پارچه">
        </div>
    </div>
</div>