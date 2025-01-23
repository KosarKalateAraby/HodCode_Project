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


// document.addEventListener("DOMContentLoaded", function() {
//   const searchForm = document.getElementById("product-search-form");
//   const searchInput = document.getElementById("product-search-input");
//   const searchResults = document.getElementById("search-results");

//   searchForm.addEventListener("submit", function(event) {
//       event.preventDefault();  // جلوگیری از رفرش صفحه

//       const query = searchInput.value;

//       // بررسی کنید که آیا کاربر مقداری وارد کرده است یا خیر
//       if (!query) {
//           searchResults.innerHTML = '<p class="text-center">لطفاً عبارتی برای جستجو وارد کنید.</p>';
//           return;
//       }

//       // ارسال درخواست AJAX
//       fetch(ajax_object.ajax_url, {
//           method: "GET",
//           headers: {
//               "Content-Type": "application/x-www-form-urlencoded"
//           },
//           body: new URLSearchParams({
//               action: "search_products",
//               s: query
//           })
//       })
//       .then(response => response.text())
//       .then(data => {
//           searchResults.innerHTML = data;  // نمایش نتایج جستجو
//       })
//       .catch(error => {
//           console.error("خطا در ارسال درخواست:", error);
//           searchResults.innerHTML = '<p class="text-center">مشکلی در جستجو پیش آمده است. لطفاً دوباره تلاش کنید.</p>';
//       });
//   });
// });


jQuery.ajax({
    url: my_ajax_object.ajax_url, // از ajax_url استفاده کنید
    type: 'POST',
    data: {
        action: 'search_products', // نام اکشن PHP
        query: 'تست' // یک مقدار نمونه برای جستجو
    },
    success: function(response) {
        console.log('Success Response:', response); // نمایش پاسخ موفق
    },
    error: function(xhr, status, error) {
        console.error('Error Details:', {
            status: status,
            error: error,
            xhr: xhr
        });
    }
});
