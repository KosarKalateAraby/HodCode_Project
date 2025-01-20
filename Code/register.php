<?php
/**
 * Template Name: Register Page
 */
?>
<?php
// فراخوانی هدر قالب
get_header();
?>

 <!-- <?php
// اگر کاربر وارد شده است، او را به صفحه اصلی هدایت کنید
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

// پردازش فرم ثبت‌نام
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<p style='color: red;'>رمز عبور و تأیید رمز عبور مطابقت ندارند.</p>";
    } else {
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            echo "<p style='color: red;'>" . $user_id->get_error_message() . "</p>";
        } else {
            echo "<p style='color: green;'>ثبت‌نام با موفقیت انجام شد. لطفاً وارد شوید.</p>";
        }
    }
}
?> -->


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">ثبت نام</h3>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">نام کاربری:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="لطفاً نام خود را وارد کنید" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">ایمیل:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="لطفاً ایمیل خود را وارد کنید" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">رمز عبور:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="لطفاً رمز عبور خود را وارد کنید" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">تأیید رمز عبور:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="لطفاً رمز عبور را دوباره وارد کنید" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-primary w-100">ثبت نام</button>
                    </form>
                    <p class="text-center mt-3">
                        آیا حساب کاربری دارید؟ <a href="<?php echo wp_login_url(); ?>">وارد شوید</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>