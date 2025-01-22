<?php
session_start(); 
include "../classes/course.php";
include "../db/config.php";

$isLoggedIn = isset($_SESSION['user']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>EduWeb - The Best Program to Enroll for Exchange</title>
  <meta name="title" content="EduWeb - The Best Program to Enroll for Exchange">
  <meta name="description" content="This is an education html template made by codewithsadee">

  <link rel="shortcut icon" href="../../favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="../../public/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="preload" as="image" href="../../public/assets/images/hero-bg.svg">
  <link rel="preload" as="image" href="../../public/assets/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="../../public/assets/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="../../public/assets/images/hero-shape-1.svg">
  <link rel="preload" as="image" href="../../public/assets/images/hero-shape-2.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body id="top">

<div id="loginModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div class="bg-white rounded-2xl shadow-2xl w-11/12 md:w-1/3 p-8 transform transition-all duration-300 ease-in-out scale-95 opacity-0">
    <!-- Modal Header -->
    <div class="text-center mb-6">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-[hsla(170,75%,41%,0.15)] rounded-full shadow-lg mb-4">
        <svg class="w-8 h-8 text-[hsl(170,75%,41%)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
      </div>
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Login Required</h2>
      <p class="text-gray-500">You need to log in to access this course. Please log in or sign up to continue.</p>
    </div>

    <!-- Modal Actions -->
    <div class="flex justify-end space-x-4">
      <button
        onclick="closeModal()"
        class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300"
      >
        Cancel
      </button>
      <a
        href="login.php"
        class="px-6 py-2 bg-[hsl(170,75%,41%)] text-white rounded-lg hover:bg-[hsl(170,75%,35%)] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[hsl(170,75%,41%)]"
      >
        Login
      </a>
    </div>
  </div>
</div>

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="../../public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
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
            <a href="../../index.php" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-link>About</a>
          </li>

          <li class="navbar-item">
            <a href="courses.php" class="navbar-link" data-nav-link>Courses</a>
          </li>

          <li class="navbar-item">
            <a href="#blog" class="navbar-link" data-nav-link>Blog</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link" data-nav-link>Contact</a>
          </li>

        </ul>

      </nav>

      <div class="header-actions">

        <a href="login.php" class="btn has-before">
          <span class="span">Login now</span>

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
      <br>
      <br>
      <br>

      <div class="course-top-bar z-40">
        <div class="course-search-sort">
          <div class="course-search">
            <input type="text" placeholder="Search for courses..." class="course-search-input">
            <button class="course-search-btn">
              <ion-icon name="search-outline"></ion-icon>
            </button>
          </div>

          <div class="course-sort">
            <select class="course-sort-select">
              <option value="category">Sort by Category</option>
            </select>
          </div>
          <div class="course-sort">
            <select class="course-sort-select">
              <option value="category">Sort by Tag</option>
            </select>
          </div>
          <div class="course-sort">
            <select class="course-sort-select">
              <option value="category">Sort by Date</option>
            </select>
          </div>
        </div>
      </div>

      <section class="section course" id="courses" aria-label="course">
  <div class="container">
    <!-- Course List -->
    <ul class="grid-list" id="course-list">
      <?php
      $courses = Course::getAllCourses($conn);
      foreach ($courses as $course) {
        echo '
        <li>
          <div class="course-card" onclick="handleCourseClick(' . $course['idCours'] . ')">
            <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
              <img src="../../public/' . $course['image'] . '" width="370" height="220" loading="lazy" alt="' . $course['titre'] . '" class="img-cover">
            </figure>
            <div class="abs-badge">
              <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
              <span class="span">' . $course['date_creation'] . '</span>
            </div>
            <div class="card-content">
              <span class="badge">' . $course['type'] . '</span>
              <h3 class="h3">
                <a href="#" class="card-title">' . $course['titre'] . '</a>
              </h3>
              <ul class="card-meta-list">
                <li class="card-meta-item">
                  <ion-icon name="library-outline" aria-hidden="true"></ion-icon>
                  <span class="span">by: ' . $course['username'] . '</span>
                </li>
                <li class="card-meta-item">
                  <ion-icon name="people-outline" aria-hidden="true"></ion-icon>
                  <span class="span">' . $course['student_count'] . ' Students</span>
                </li>
              </ul>
            </div>
          </div>
        </li>';
      }
      ?>
    </ul>

    <div class="pagination mt-8 flex justify-center space-x-2" id="pagination-controls">
    </div>
  </div>
</section>
    </article>
  </main>

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

  <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>

  <script src="./public/assets/js/script.js" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
    function handleCourseClick(courseId) {
      <?php if ($isLoggedIn) { ?>
        window.location.href = 'CourseDetails.php?id=' + courseId;
      <?php } else { ?>
        openModal();
      <?php } ?>
    }

    function openModal() {
      document.getElementById('loginModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('loginModal').classList.add('hidden');
    }
  </script>
  <script>
  function openModal() {
    const modal = document.getElementById('loginModal');
    const modalContent = modal.querySelector('div');
    modal.classList.remove('hidden');
    setTimeout(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
  }

  function closeModal() {
    const modal = document.getElementById('loginModal');
    const modalContent = modal.querySelector('div');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
      modal.classList.add('hidden');
    }, 200);
  }
</script>
<script>
  const itemsPerPage = 6;
  const courseList = document.getElementById('course-list');
  const paginationControls = document.getElementById('pagination-controls');
  const courses = Array.from(courseList.children); 

  function displayCourses(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    courses.forEach((course) => {
      course.style.display = 'none';
    });

    const currentCourses = courses.slice(startIndex, endIndex);
    currentCourses.forEach((course) => {
      course.style.display = 'block';
    });
  }

  function createPaginationButtons(totalPages) {
    paginationControls.innerHTML = ''; 

    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement('button');
      button.textContent = i;
      button.className = 'px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200';
      button.addEventListener('click', () => {
        displayCourses(i);
        setActiveButton(button);
      });

      if (i === 1) {
        button.classList.add('bg-blue-600', 'text-white');
      }

      paginationControls.appendChild(button);
    }
  }

  function setActiveButton(activeButton) {
    const buttons = paginationControls.querySelectorAll('button');
    buttons.forEach((button) => {
      button.classList.remove('bg-blue-600', 'text-white');
      button.classList.add('bg-gray-200', 'text-gray-700');
    });
    activeButton.classList.add('bg-blue-600', 'text-white');
    activeButton.classList.remove('bg-gray-200', 'text-gray-700');
  }

  const totalPages = Math.ceil(courses.length / itemsPerPage);
  createPaginationButtons(totalPages);
  displayCourses(1); // Display the first page by default
</script>
</body>
</html> 