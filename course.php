<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tag
  -->
  <title>EduWeb - The Best Program to Enroll for Exchange</title>
  <meta name="title" content="EduWeb - The Best Program to Enroll for Exchange">
  <meta name="description" content="This is an education html template made by codewithsadee">

  <!-- 
    - favicon
  -->


  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-bg.svg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-shape-1.svg">
  <link rel="preload" as="image" href="./assets/images/hero-shape-2.png">

</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">


      <a class="logo" href=""><img style="height: auto; width: 25%" src="Abstract Red Rooster Farm Free Logo (4) (1).png" alt=""></a>

      <nav class="navbar" data-navbar>

        <div class="wrapper">
          <a href="#" class="logo">
            <img src="./assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
          </a>

          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-link>About</a>
          </li>

          <li class="navbar-item">
            <a href="#courses" class="navbar-link" data-nav-link>Courses</a>
          </li>

          <li class="navbar-item">
            <a href="#blog" class="navbar-link" data-nav-link>Blog</a>
          </li>

        </ul>

      </nav>

      <div class="header-actions">

        <button class="header-action-btn" aria-label="toggle search" title="Search">
          <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
        </button>

        <a href="#" class="btn has-before">
          <span class="span">Login</span>
        </a>

        <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
          <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
        </button>

      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>
  <main>


    <!-- 
        - #COURSE
      -->
    <section class='section course' id='courses' aria-label='course'>

      <div class='container'>
        <div class="search-container">
          <input type="text" id="course-search" placeholder="Search for courses..."><button type="submit" id="search-btn" aria-label="Search">
            <ion-icon id="iconsearch" name="search-outline"></ion-icon>
          </button>

        </div>
        <button type="button" id="location-btn" aria-label="Filter by Location">
      Filter by Location
    </button>
    <div id="location-list" style="display: none;">
      <!-- List of locations will be populated here -->
    </div>
        <button type="button" id="Category-btn" aria-label="Filter by Category">
      Filter by Category
    </button>
    <div id="Category-list" style="display: none;">
      
    </div>
        <p class='section-subtitle'>Popular Courses</p>
        <h2 class='h2 section-title'>Pick A Course To Get Started</h2>
        <ul class='grid-list' id="search">
          <?php
          require_once('get_courses.php');
          ?>
        </ul>
      </div>
    </section>
    <script>
      document.getElementById('search-btn').addEventListener('click', function() {
        // Lấy giá trị từ ô input
        var searchValue = document.getElementById('course-search').value;

        // Tạo một request HTTP mới
        var xhr = new XMLHttpRequest();

        // Xác định phương thức và URL của request
        var tmp = xhr.open('GET', 'search.php?Title=' + searchValue, true);

        // Đặt hàm xử lý cho sự kiện load
        xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 300) {
            // Nếu request thành công, hiển thị kết quả tìm kiếm
            document.getElementById('search').innerHTML = xhr.responseText;
          } else {
            // Nếu request không thành công, hiển thị thông báo lỗi
            console.error('Request failed with status', xhr.status);
          }
        };

        // Gửi request
        xhr.send();
      });
    </script>
    <script>
        document.getElementById('location-btn').addEventListener('click', function() {
    var locationList = document.getElementById('location-list');
    if (locationList.style.display === 'none' || locationList.innerHTML === '') {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_locations.php', true);
      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
          var locations = JSON.parse(xhr.responseText);
          locationList.innerHTML = '';
          locations.forEach(function(location) {
            var locationItem = document.createElement('button');
            locationItem.textContent = location;
            locationItem.classList.add('location-item');
            locationList.appendChild(locationItem);
            locationItem.addEventListener('click', function() {
              filterCoursesByLocation(location);
            });
          });
          locationList.style.display = 'block';
        } else {
          console.error('Request failed with status', xhr.status);
        }
      };
      xhr.send();
    } else {
      locationList.style.display = locationList.style.display === 'block' ? 'none' : 'block';
    }
  });

      function filterCoursesByLocation(location) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'filterLocation.php?Location=' + location, true);
        xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 300) {
            document.getElementById('search').innerHTML = xhr.responseText;
          } else {
            console.error('Request failed with status', xhr.status);
          }
        };
        xhr.send();
      }
        document.getElementById('Category-btn').addEventListener('click', function() {
    var CategoryList = document.getElementById('Category-list');
    if (CategoryList.style.display === 'none' || CategoryList.innerHTML === '') {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_Category.php', true);
      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
          var Categorys = JSON.parse(xhr.responseText);
          CategoryList.innerHTML = '';
          Categorys.forEach(function(Category) {
            var CategoryItem = document.createElement('button');
            CategoryItem.textContent = Category;
            CategoryItem.classList.add('Category-item');
            CategoryList.appendChild(CategoryItem);
            CategoryItem.addEventListener('click', function() {
              filterCoursesByCategory(Category);
            });
          });
          CategoryList.style.display = 'block';
        } else {
          console.error('Request failed with status', xhr.status);
        }
      };
      xhr.send();
    } else {
      CategoryList.style.display = CategoryList.style.display === 'block' ? 'none' : 'block';
    }
  });

      function filterCoursesByCategory(Category) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'filterCategory.php?Category=' + Category, true);
        xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 300) {
            document.getElementById('search').innerHTML = xhr.responseText;
          } else {
            console.error('Request failed with status', xhr.status);
          }
        };
        xhr.send();
      }
    </script>
    <!-- 
        - #STATE
      -->

    <!-- <section class="section stats" aria-label="stats">
      <div class="container">
        <ul class="grid-list">
          <li>
            <div class="stats-card" style="--color: 170, 75%, 41%">
              <h3 class="card-title">29.3k</h3>

              <p class="card-text">Student Enrolled</p>
            </div>
          </li>
          <li>
            <div class="stats-card" style="--color: 351, 83%, 61%">
              <h3 class="card-title">32.4K</h3>

              <p class="card-text">Class Completed</p>
            </div>
          </li>
          <li>
            <div class="stats-card" style="--color: 260, 100%, 67%">
              <h3 class="card-title">100%</h3>

              <p class="card-text">Satisfaction Rate</p>
            </div>
          </li>
          <li>
            <div class="stats-card" style="--color: 42, 94%, 55%">
              <h3 class="card-title">354+</h3>

              <p class="card-text">Top Instructors</p>
            </div>
          </li>
        </ul>
      </div>
    </section> -->

    </article>
  </main>

  <!-- 
    - #FOOTER
  -->
  <footer class="footer" style="background-image: url('./assets/images/footer-bg.png')">

    <div class="footer-top section">
      <div class="container grid-list">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./assets/images/logo-light.svg" width="162" height="50" alt="EduWeb logo">
          </a>

          <p class="footer-brand-text">
            Lorem ipsum dolor amet consecto adi pisicing elit sed eiusm tempor incidid unt labore dolore.
          </p>

          <div class="wrapper">
            <span class="span">Add:</span>

            <address class="address">70-80 Upper St Norwich NR2</address>
          </div>

          <div class="wrapper">
            <span class="span">Call:</span>

            <a href="tel:+011234567890" class="footer-link">+01 123 4567 890</a>
          </div>

          <div class="wrapper">
            <span class="span">Email:</span>

            <a href="mailto:info@eduweb.com" class="footer-link">info@eduweb.com</a>
          </div>

        </div>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Online Platform</p>
          </li>

          <li>
            <a href="#" class="footer-link">About</a>
          </li>

          <li>
            <a href="#" class="footer-link">Courses</a>
          </li>

          <li>
            <a href="#" class="footer-link">Instructor</a>
          </li>

          <li>
            <a href="#" class="footer-link">Events</a>
          </li>

          <li>
            <a href="#" class="footer-link">Instructor Profile</a>
          </li>

          <li>
            <a href="#" class="footer-link">Purchase Guide</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Links</p>
          </li>

          <li>
            <a href="#" class="footer-link">Contact Us</a>
          </li>

          <li>
            <a href="#" class="footer-link">Gallery</a>
          </li>

          <li>
            <a href="#" class="footer-link">News & Articles</a>
          </li>

          <li>
            <a href="#" class="footer-link">FAQ's</a>
          </li>

          <li>
            <a href="#" class="footer-link">Sign In/Registration</a>
          </li>

          <li>
            <a href="#" class="footer-link">Coming Soon</a>
          </li>

        </ul>

        <div class="footer-list">

          <p class="footer-list-title">Contacts</p>

          <p class="footer-list-text">
            Enter your email address to register to our newsletter subscription
          </p>

          <form action="" class="newsletter-form">
            <input type="email" name="email_address" placeholder="Your email" required class="input-field">

            <button type="submit" class="btn has-before">
              <span class="span">Subscribe</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </button>
          </form>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-youtube"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          Copyright 2022 All Rights Reserved by <a href="#" class="copyright-link">codewithsadee</a>
        </p>

      </div>
    </div>

  </footer>

  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>



  <div id="course-list"></div>





  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>