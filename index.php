<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>What's Happening</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>What's Happening</h1>
      </a>
      <?php include 'navbar.php'; ?>

      
 
      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.php" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">

    
    <!-- ======= Post Grid Section ======= -->

    <!-- All the php code for fetchong information from serverlogin.php and php prepared statement to fetch data from event table from the database -->
    <?php

    // fetched data from serverlogin.php for databse information
    include 'serverlogin.php';
    // created the connection for databse
    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

    // Checking the connection, if not show error message
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Query to get the most recently submitted event
    // using php prepared statement
    $stmt = $conn->prepare("SELECT EventID, EventTitle, EventDesc FROM events ORDER BY SubmitDate DESC LIMIT 1");
    $stmt->execute();
    $latestEvent = $stmt->get_result()->fetch_assoc();

    // this query get eventhappning closest to todAYS DATE
    $stmt = $conn->prepare("SELECT EventID, EventTitle, EventDesc FROM events WHERE EventDate > NOW() ORDER BY EventDate ASC LIMIT 1");
    $stmt->execute();
    $upcomingEvent = $stmt->get_result()->fetch_assoc();

    // Close the statement 
    $stmt->close();
    ?>
          <!-- adjust the slider according to instruction and made sure previous css ids are being properly used  -->
            <!-- Hero Slider Section -->
            <section id="hero-slider" class="hero-slider">
              <div class="container-md" data-aos="fade-in">
                <div class="row">
                  <div class="col-12">
                    <div class="swiper sliderFeaturedPosts">
                      <div class="swiper-wrapper">

                        <!-- Static slide for "What's Happening in your community" -->
                        

                        <!-- Dynamic slide for "Latest Added Event" -->
                        <div class="swiper-slide">
                          <a href="single-post.php?eventNumber=<?= htmlspecialchars($latestEvent['EventID']) ?>" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-2.jpg');">
                            <div class="img-bg-inner">
                            <h2>Whats happening in your community</h2>
                              <p><b><?= htmlspecialchars($latestEvent['EventTitle']) ?></b>
                              <?= htmlspecialchars($latestEvent['EventDesc']) ?></p>
                            </div>
                          </a>
                        </div>

                        <!-- Dynamic slide for "Happening Soon" -->
                        <div class="swiper-slide">
                          <a href="single-post.php?eventNumber=<?= htmlspecialchars($upcomingEvent['EventID']) ?>" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-3.jpg');">
                            <div class="img-bg-inner">
                            <h2>Latest Added Events</h2>
                              <p><b><?= htmlspecialchars($upcomingEvent['EventTitle']) ?></b>
                              <?= htmlspecialchars($upcomingEvent['EventDesc']) ?></p>
                            </div>
                          </a>
                        </div>

                    

                      </div>
                      <div class="custom-swiper-button-next">
                        <span class="bi-chevron-right"></span>
                      </div>
                      <div class="custom-swiper-button-prev">
                        <span class="bi-chevron-left"></span>
                      </div>
                      <div class="swiper-pagination"></div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          <!-- End Hero Slider Section -->
    


    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About What's Happening</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="about.php" class="footer-link-more">Learn More</a></p>
          </div>
          <?php include 'footer.php'; ?>
          <div class="col-6 col-lg-2">
          <h3 class="footer-heading">Events</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="events.php?type=all"><i class="bi bi-chevron-right"></i> All Events</a></li>
              <li><a href="events.php?type=ArtCulture"><i class="bi bi-chevron-right"></i> Music</a></li>
              <li><a href="events.php?type=ArtCulture"><i class="bi bi-chevron-right"></i> Culture</a></li>
              <li><a href="events.php?type=Sports"><i class="bi bi-chevron-right"></i> Sport</a></li>
              <li><a href="events.php?type=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
              <li><a href="events.php?type=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
             
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>