
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>What's Happening </title>
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
    <section>
      <div class="container">
        <div class="row">

          <div class="col-md-9" data-aos="fade-up">
            <h3 class="category-title">EVENT CATEGORY: All   </h3>

            
            <?php
            // fetched data from serverlogin.php for databse information
            include 'serverlogin.php';
            // created the connection for databse
            $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
            
            // Checking the connection, if not show error message
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // SQL query to fetch events data along with group and event type information
            $sql = "SELECT e.EventID, e.EventDate, e.EventTitle, e.EventImage, e.EventDesc, 
                           g.GroupName, g.GroupImage, et.EventType 
                    FROM events e
                    JOIN groups g ON e.GroupID = g.GroupID
                    JOIN eventtypes et ON e.EventTypeID = et.EventTypeID
                    ORDER BY e.EventDate ASC";
            
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $eventNumber = htmlspecialchars($row['EventID']);
                  $title = htmlspecialchars($row['EventTitle']);
                  $description = htmlspecialchars($row['EventDesc']);
                  $image = htmlspecialchars($row['EventImage']); 
                  $eventType = htmlspecialchars($row['EventType']); 
                  $groupName = htmlspecialchars($row['GroupName']); 
                  $groupImage = htmlspecialchars($row['GroupImage']); 
                  
                  // Formating the date to show it exactly like the instruction provided
                  $dateObject = date_create($row['EventDate']);
                  $date = date_format($dateObject, 'd-M-y . h:i A');
                  // heredoc statement for printing the values
                  $htmlBlock = <<<HTML
                  <div class='d-md-flex post-entry-2 half'>
                      <a href='single-post.php?eventNumber={$eventNumber}' class='me-4 thumbnail'>
                          <img src='{$image}' alt='{$title}' class='img-fluid'>
                      </a>
                      <div>
                          <div class='post-meta'><span class='date'>{$eventType}</span> <span class='mx-1'>&bullet;</span> <span>{$date}</span></div>
                          <h3><a href='single-post.php?eventNumber={$eventNumber}'>{$title}</a></h3>
                          
                          <div class='d-flex align-items-center author'>
                              <div class='photo'><img src='{$groupImage}' alt='{$groupName}' class='img-fluid'></div>
                              <div class='name'>
                                  <h3 class='m-0 p-0'>{$groupName}</h3>
                              </div>
                          </div>
                      </div>
                  </div>
                  HTML;
          
                  echo $htmlBlock;
              }
          } else {
            // error checking in case databse does not fetch data
              echo "<p>No events found.</p>";
          }
          
          
          // closing connection
          $conn->close();
            ?>

            

            
            

            

    

            
          </div>

          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
            <div class="aside-block">

              <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">UPCOMING</button>
                </li>
                
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">LATEST ADDED</button>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">

                <!-- Popular -->
                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>
                </div> <!-- End Popular -->

                <!-- Trending -->
                <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>
                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>
                </div> <!-- End Trending -->

                <!-- Latest -->
                <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h2 class="mb-2"><a href="#">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                </div> <!-- End Latest -->

              </div>
            </div>

            

            <div class="aside-block">
              <h3 class="aside-title">EVENTS</h3>
              <ul class="aside-links list-unstyled">
                <li><a href="events.php?type=all"><i class="bi bi-chevron-right"></i> All Events</a></li>
                <li><a href="events.php?type=ArtCulture"><i class="bi bi-chevron-right"></i> Music</a></li>
                <li><a href="events.php?type=ArtCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li>
                <li><a href="events.php?type=Sports"><i class="bi bi-chevron-right"></i> Sport</a></li>
                <li><a href="events.php?type=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
                <li><a href="events.php?type=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
                
              </ul>
            </div><!-- End Categories -->

            <div class="aside-block">
              <h3 class="aside-title">Tags</h3>
              <ul class="aside-tags list-unstyled">
                <li><a href="events.php?type=all">All Events</a></li>
                <li><a href="events.php?type=ArtCulture">Music</a></li>
                <li><a href="events.php?type=ArtCulture">Art+Culture</a></li>
                <li><a href="events.php?type=Sports">Sport</a></li>
                <li><a href="events.php?type=Food">Food</a></li>
                <li><a href="events.php?type=Fund Raiser">Fund Raiser</a></li>
                
              </ul>
            </div><!-- End Tags -->

          </div>

        </div>
      </div>
    </section>
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
              <li><a href="events.php?type=ArtCulture"><i class="bi bi-chevron-right"></i> Arts+culture</a></li>
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