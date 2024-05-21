<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

// Get the selected month and year from the user, or default to the current month and year
$selected_month = isset($_GET['month']) ? $_GET['month'] : date('n');
$selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Get the number of days in the selected month
$num_days = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);

if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $adn = "DELETE FROM  rpos_products  WHERE  prod_id = ?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $stmt->close();
  if ($stmt) {
    $success = "Deleted" && header("refresh:1; url=products.php");
  } else {
    $err = "Try Again Later";
  }
}
require_once('partials/_head.php');
?>

<body>
  <!-- Sidenav -->
  <?php require_once('partials/_sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php require_once('partials/_topnav.php'); ?>
    <!-- Header -->
    <div style="background-image: url(assets/img/theme/restro00.jpg); background-size: cover;" class="header pb-8 pt-5 pt-md-8">
      <span class="mask bg-gradient-dark opacity-8"></span>
      <div class="container-fluid">
        <div class="header-body"></div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Calendar -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Calendar</h3>
            </div>
            <iframe src="https://calendar.google.com/calendar/
              embed?height=600&wkst=1&ctz=UTC&bgcolor=%23ffffff&src=aGlyd2Ficm
              lhbjlAZ21haWwuY29t&src=bmNkc2VkajFtNG5scjBtZWxzcjNjZnA3N29AZ3JvdXAuY
              2FsZW5kYXIuZ29vZ2xlLmNvbQ&src=Y2xhc3Nyb29tMTE0Nzc4OTc1MzE3NDMwMDg5NzM
              0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ
              3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4ucncjaG9saWRheUBncm91cC52LmN
              hbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAxNDgyMjU3NTg1Nzg3OTEyNTE0QGd
              yb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=a2lnYWxpaHViQHRoZXJvb20uY29t&color=%2
              3039BE5&color=%23E67C73&color=%239E69AF&color=%237CB342&color=%230B8043&
              color=%23202124&color=%238E24AA" 
              style="border:solid 1px #777" width="100%" 
              height="600" frameborder="0" scrolling="no"></iframe>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php require_once('partials/_footer.php'); ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php require_once('partials/_scripts.php'); ?>
</body>
</html>
