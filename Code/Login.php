<?php
    /* Template Name: Login Page */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true
        );

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            $error_message = 'نام کاربری یا رمز عبور اشتباه است.';
        } else {
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
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.svg" alt="دیباج">
                    </div>
                    <div class="nav-links">
                        <a href="#">صفحه‌اصلی</a>
                        <a href="#">ورود</a>
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
                        <div class="register-container">
                            <button type="submit" class="btn btn-primary" name="login">ورود</button>
                            <a href="/Register.php" class="register-link">آیا حساب ندارید؟ همین الان ثبت نام کنید</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Image of fabric -->
            <div class="img-parche-container">
                <img class="img-parche" src="<?php echo get_template_directory_uri(); ?>/assets/d.jpg" alt="پارچه">
            </div>
        </div>
    </div>
