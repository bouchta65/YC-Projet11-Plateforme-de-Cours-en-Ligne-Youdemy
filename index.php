<?php 
include "src/classes/course.php";
include "src/db/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>EduWeb - Online Learning Platform</title>
  <meta name="title" content="EduWeb - Online Learning Platform">
  <meta name="description" content="Join EduWeb to access the best online courses and enhance your skills.">

  <link rel="shortcut icon" href="./public/assets/images/favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="./public/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="preload" as="image" href="./public/assets/images/hero-bg.svg">
  <link rel="preload" as="image" href="./public/assets/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="./public/assets/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="./public/assets/images/hero-shape-1.svg">
  <link rel="preload" as="image" href="./public/assets/images/hero-shape-2.png">
</head>

<body id="top">

  <header class="header" data-header>
    <div class="container">
      <a href="#" class="logo">
        <img src="./public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
      </a>

      <nav class="navbar" data-navbar>
        <div class="wrapper">
          <a href="#" class="logo">
            <img src="./public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
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
          <li class="navbar-item">
            <a href="#contact" class="navbar-link" data-nav-link>Contact</a>
          </li>
        </ul>
      </nav>

      <div class="header-actions">
        <a href="src/views/login.php" class="btn has-before">
          <span class="span">Login</span>
          <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
        </a>
        <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
          <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
        </button>
      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>
    </div>
  </header>

  <main>
    <article>
      <!-- Hero Section -->
      <section class="section hero has-bg-image" id="home" aria-label="home"
        style="background-image: url('./public/assets/images/hero-bg.svg')">
        <div class="container">
          <div class="hero-content">
            <h1 class="h1 section-title">
              Unlock Your Potential with <span class="span">EduWeb</span>
            </h1>
            <p class="hero-text">
              Join thousands of learners worldwide and gain access to the best online courses in technology, business, and more.
            </p>
            <a href="#courses" class="btn has-before">
              <span class="span">Explore Courses</span>
              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>
          </div>

          <figure class="hero-banner">
            <div class="img-holder one" style="--width: 270; --height: 300;">
              <img src="./public/assets/images/hero-banner-1.jpg" width="270" height="300" alt="Students learning online" class="img-cover">
            </div>
            <div class="img-holder two" style="--width: 240; --height: 370;">
              <img src="./public/assets/images/hero-banner-2.jpg" width="240" height="370" alt="Online course platform" class="img-cover">
            </div>
            <img src="./public/assets/images/hero-shape-1.svg" width="380" height="190" alt="" class="shape hero-shape-1">
            <img src="./public/assets/images/hero-shape-2.png" width="622" height="551" alt="" class="shape hero-shape-2">
          </figure>
        </div>
      </section>

      <!-- Categories Section -->
      <section class="section category" aria-label="category">
        <div class="container">
          <p class="section-subtitle">Explore Categories</p>
          <h2 class="h2 section-title">
            Popular <span class="span">Course Categories</span>
          </h2>
          <p class="section-text">
            Discover courses in the most in-demand fields.
          </p>

          <ul class="grid-list">
            <li>
              <div class="category-card" style="--color: 170, 75%, 41%">
                <div class="card-icon">
                  <img src="./public/assets/images/category-1.svg" width="40" height="40" loading="lazy"
                    alt="Technology" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Technology</a>
                </h3>
                <p class="card-text">
                  Learn programming, AI, and data science.
                </p>
                <span class="card-badge">15 Courses</span>
              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 351, 83%, 61%">
                <div class="card-icon">
                  <img src="./public/assets/images/category-2.svg" width="40" height="40" loading="lazy"
                    alt="Business" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Business</a>
                </h3>
                <p class="card-text">
                  Master entrepreneurship and management.
                </p>
                <span class="card-badge">10 Courses</span>
              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 229, 75%, 58%">
                <div class="card-icon">
                  <img src="./public/assets/images/category-3.svg" width="40" height="40" loading="lazy"
                    alt="Design" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Design</a>
                </h3>
                <p class="card-text">
                  Explore UI/UX, graphic design, and more.
                </p>
                <span class="card-badge">8 Courses</span>
              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 42, 94%, 55%">
                <div class="card-icon">
                  <img src="./public/assets/images/category-4.svg" width="40" height="40" loading="lazy"
                    alt="Personal Development" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Personal Development</a>
                </h3>
                <p class="card-text">
                  Enhance your skills and career growth.
                </p>
                <span class="card-badge">12 Courses</span>
              </div>
            </li>
          </ul>
        </div>
      </section>

      <!-- About Section -->
      <section class="section about" id="about" aria-label="about">
        <div class="container">
          <figure class="about-banner">
            <div class="img-holder" style="--width: 520; --height: 370;">
              <img src="./public/assets/images/about-banner.jpg" width="520" height="370" loading="lazy" alt="About EduWeb"
                class="img-cover">
            </div>
            <img src="./public/assets/images/about-shape-1.svg" width="360" height="420" loading="lazy" alt=""
              class="shape about-shape-1">
            <img src="./public/assets/images/about-shape-2.svg" width="371" height="220" loading="lazy" alt=""
              class="shape about-shape-2">
            <img src="./public/assets/images/about-shape-3.png" width="722" height="528" loading="lazy" alt=""
              class="shape about-shape-3">
          </figure>

          <div class="about-content">
            <p class="section-subtitle">About EduWeb</p>
            <h2 class="h2 section-title">
              Empowering Learners <span class="span">Worldwide</span>
            </h2>
            <p class="section-text">
              EduWeb is a leading online learning platform offering high-quality courses in various fields. Our mission is to make education accessible to everyone, everywhere.
            </p>
            <ul class="about-list">
              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                <span class="span">Expert Instructors</span>
              </li>
              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                <span class="span">Flexible Learning</span>
              </li>
              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                <span class="span">Lifetime Access</span>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <!-- Courses Section -->
      <section class="section course" id="courses" aria-label="course">
        <div class="container">
          <p class="section-subtitle">Featured Courses</p>
          <h2 class="h2 section-title">
            Popular <span class="span">Courses</span>
          </h2>
          <p class="section-text">
            Explore our most popular courses and start learning today.
          </p>

          <ul class="grid-list">
            <?php 
            $courses = Course::topCourses($conn);
            foreach($courses as $course) {
              echo '
              <li>
                <div class="course-card">
                  <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
                    <img src="../../public/'.$course['image'].'" width="370" height="220" loading="lazy"
                      alt="'.$course['titre'].'" class="img-cover">
                  </figure>
                  <div class="abs-badge">
                    <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                    <span class="span">'.$course['date_creation'].'</span>
                  </div>
                  <div class="card-content">
                    <span class="badge">'.$course['type'].'</span>
                    <h3 class="h3">
                      <a href="#" class="card-title">'.$course['titre'].'</a>
                    </h3>
                    <ul class="card-meta-list">
                      <li class="card-meta-item">
                        <ion-icon name="library-outline" aria-hidden="true"></ion-icon>
                        <span class="span">by: '.$course['username'].'</span>
                      </li>
                      <li class="card-meta-item">
                        <ion-icon name="people-outline" aria-hidden="true"></ion-icon>
                        <span class="span">'.$course['student_count'].' Students</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>';
            }
            ?>
          </ul>

          <a href="src/views/CoursesVist.php" class="btn has-before">
            <span class="span">Browse All Courses</span>
            <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
          </a>
        </div>
      </section>

      <!-- Stats Section -->
      <section class="section stats" aria-label="stats">
        <div class="container">
          <ul class="grid-list">
            <li>
              <div class="stats-card" style="--color: 170, 75%, 41%">
                <h3 class="card-title">50k+</h3>
                <p class="card-text">Students Enrolled</p>
              </div>
            </li>
            <li>
              <div class="stats-card" style="--color: 351, 83%, 61%">
                <h3 class="card-title">100+</h3>
                <p class="card-text">Expert Instructors</p>
              </div>
            </li>
            <li>
              <div class="stats-card" style="--color: 260, 100%, 67%">
                <h3 class="card-title">500+</h3>
                <p class="card-text">Online Courses</p>
              </div>
            </li>
            <li>
              <div class="stats-card" style="--color: 42, 94%, 55%">
                <h3 class="card-title">95%</h3>
                <p class="card-text">Satisfaction Rate</p>
              </div>
            </li>
          </ul>
        </div>
      </section>
    </article>
  </main>

  <!-- 
    - #FOOTER
  -->

  <footer class="footer" style="background-image: url('./public/assets/images/footer-bg.png')">

    <div class="footer-top section">
      <div class="container grid-list">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./public/assets/images/logo-light.svg" width="162" height="50" alt="EduWeb logo">
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
  <script src="./public/assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>