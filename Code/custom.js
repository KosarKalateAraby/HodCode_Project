// ------- جاوااسکریپت بخش header -------

//کد جاوااسکریپت برای نمایش خط زیر هر متن فعال در منو
const navLinks = document.querySelectorAll('.navbar-nav a');

// اضافه کردن رویداد کلیک به هر لینک
navLinks.forEach(link => {
  link.addEventListener('click', function () {
    // حذف کلاس active از همه لینک‌ها
    navLinks.forEach(nav => nav.classList.remove('active'));
    
    // اضافه کردن کلاس active به لینک کلیک‌شده
    this.classList.add('active');
  });
});

// ریسپانسیو
// انتخاب عناصر
const menuButton = document.getElementById("menu-button");
const sidebar = document.getElementById("navbarNav");
const overlay = document.getElementById("overlay");
const closeMenuButton = document.getElementById("close-menu");

// باز کردن منو
menuButton.addEventListener("click", function () {
    sidebar.classList.add("open");
    overlay.classList.add("active"); // فعال کردن تاریک‌کننده
});

// بستن منو با دکمه خروج
closeMenuButton.addEventListener("click", function () {
    sidebar.classList.remove("open");
    overlay.classList.remove("active"); // غیرفعال کردن تاریک‌کننده
});

// بستن منو با کلیک روی لایه تاریک
overlay.addEventListener("click", function () {
    sidebar.classList.remove("open");
    overlay.classList.remove("active");
});


//استایل فعال ایکون های پایین صفحه در هنگام فعال بودن صفحه
document.addEventListener("DOMContentLoaded", function () {
  const footerItems = document.querySelectorAll(".footer-item");
  const currentPath = window.location.pathname.replace(/\/$/, ''); // حذف اسلش انتهایی
  // حذف کلاس active از همه لینک‌ها
  footerItems.forEach((item) => {
      item.classList.remove("active");

      // بررسی خاص برای صفحه "خانه"
      if ((currentPath === "/" || currentPath === "/index.php") && item.href.includes("/index.php")) {
          item.classList.add("active");
      } 
      // بررسی سایر لینک‌ها
      else if (item.href.includes(currentPath)) {
          item.classList.add("active");
      }
  });
});





