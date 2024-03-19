<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>What's Happening - Post</title>
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

      
 -->
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
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">Post New Event </h1>
          </div>
        </div>

        <?php
         
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // fetched datbase information
          include 'serverlogin.php';
          // creating database connection
          $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          // posting data from Form
          $groupName = $conn->real_escape_string($_POST['communityGroup']);
          $title = $conn->real_escape_string($_POST['eventTitle']);
          $eventDate = $conn->real_escape_string($_POST['eventDate']);
          $eventTime = $conn->real_escape_string($_POST['eventTime']);
          $eventType = $conn->real_escape_string($_POST['eventType']);
          $imageName = $conn->real_escape_string($_POST['imageName']);
          $description = $conn->real_escape_string($_POST['eventDescription']);
      
          $formattedEventDate = date('Y-m-d H:i:s', strtotime("$eventDate $eventTime"));
          $currentDate = date('Y-m-d H:i:s');
      
          // Retrieve EventTypeID
          $stmt = $conn->prepare("SELECT EventTypeID FROM eventtypes WHERE EventType LIKE ?");
          $eventType = "%$eventType%";
          $stmt->bind_param("s", $eventType);
          $stmt->execute();
          $eventTypeResult = $stmt->get_result();
          if ($eventTypeResult->num_rows > 0) {
              $eventTypeRow = $eventTypeResult->fetch_assoc();
              $eventTypeID = $eventTypeRow['EventTypeID'];
          } else {
              // Handle the error appropriately if no matching event type is found
              echo "No matching EventType found.";
              $stmt->close();
              $conn->close();
              exit; // Stop script execution
          }

      
          // Retrieve GroupID
          $stmt = $conn->prepare("SELECT GroupID FROM groups WHERE GroupName LIKE ?");
          $groupName = "%$groupName%";
          $stmt->bind_param("s", $groupName);
          $stmt->execute();
          $groupResult = $stmt->get_result();
          if ($groupResult->num_rows > 0) {
              $groupRow = $groupResult->fetch_assoc();
              $groupID = $groupRow['GroupID'];
          } else {
              // Handle the error appropriately if no matching group is found
              echo "No matching Group found.";
              $stmt->close();
              $conn->close();
              exit; // Stop script execution
          }
        
      
          // Prepare the SQL statement to insert the new event.
          $stmt = $conn->prepare("INSERT INTO events (EventTypeID, GroupID, EventDate, SubmitDate, EventTitle, EventImage, EventDesc) VALUES (?, ?, ?, ?, ?, ?, ?)");
      
          // Bind the parameters to the SQL query.
          $stmt->bind_param("iisssss", $eventTypeID, $groupID, $formattedEventDate, $currentDate, $title, $imageName, $description);
      
          // Execute the statement and check for errors
          if ($stmt->execute()) {
              echo "New event added successfully!";
              // Optionally redirect to the events page or display a success message
          } else {
              echo "Error: " . $stmt->error;
          }
          
          // Close statement and connection
          $stmt->close();
          $conn->close();
        
         }
      
        
        ?>

        <div class="form mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form" class="php-email-form">
                <div class="form-group">
                <input type="text" name="communityGroup" class="form-control" id="community-group" placeholder="Your Community Group" required>
                </div>
                <div class="form-group">
                <input type="text" name="eventTitle" class="form-control" id="event-title" placeholder="Your Event Title" required>
                </div>
                <div class="form-group">
                <input type="text" name="eventDate" class="form-control" id="event-date" placeholder="Your Event Date (Format: day/month/year)" required>
                </div>
                <div class="form-group">
                  <input type="time" name="eventTime" class="form-control" id="event-time" placeholder="Your Event Time" required>
                </div>
                <div class="form-group">
                  <input type="text" name="eventType" class="form-control" id="event-type" placeholder="Your Event Type" required>
                </div>
                <div class="form-group">
                  <input type="text" name="imageName" class="form-control" id="image-name" placeholder="Image Name" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="eventDescription" rows="5" placeholder="The Event Description" required></textarea>
                </div>
                <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Submit</button></div>
            </form>
        </div><!-- End Contact Form -->


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