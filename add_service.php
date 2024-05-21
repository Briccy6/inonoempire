<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Other form data
    $service_name = $_POST['service_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $min_cost = $_POST['min_cost'] ?? '';
    $max_cost = $_POST['max_cost'] ?? '';
    $service_profile = '';

    // Check if a file was uploaded
    if (isset($_FILES['service_profile']) && $_FILES['service_profile']['error'] === UPLOAD_ERR_OK) {
        // Define the directory where the file will be saved
        $uploadDir = 'images/service/';

        // Generate a unique name for the file
        $filename = uniqid() . '_' . basename($_FILES['service_profile']['name']);

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($_FILES['service_profile']['tmp_name'], $uploadDir . $filename)) {
            // Set the file path for storing in the database
            $service_profile = $uploadDir . $filename;
        } else {
            echo '<script>alert("Failed to upload file.");</script>';
        }
    }

    if (!empty($service_name)) {
        // Insert data into the database
        $sql = "INSERT INTO services (service_name, description, min_cost, max_cost, service_profile) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssdds", $service_name, $description, $min_cost, $max_cost, $service_profile);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo '<script>alert("Service added successfully.");</script>';
        } else {
            echo '<script>alert("Failed to add service.");</script>';
        }

        $stmt->close();
    } else {
        echo '<script>alert("Please enter a service name.");</script>';
    }
}

require_once('partials/_head.php');
?>

<body>

  <!-- Sidenav -->
  <?php
  require_once('partials/_sidebar.php');
  ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php
    require_once('partials/_topnav.php');
    ?>
    <!-- Header -->
    <div style="background-image: url(assets/img/theme/restro00.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
    <span class="mask bg-gradient-dark opacity-8"></span>
      <div class="container-fluid">
        <div class="header-body">
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3>Please Fill All Fields</h3>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Service Name</label>
                    <input type="text" name="service_name" class="form-control">
                    
                  </div>
                  <div class="col-md-6">
                    <label>Service Description</label><br>
                    <!-- <input id="phone" type="tel" name="phone" class="form-control"/> -->
                    <textarea name="description" class="form-control" value=""></textarea>
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Min Cost</label>
                    <input type="number" name="min_cost" class="form-control" value="">
                  </div>
                  <div class="col-md-6">
                    <label>Max Cost</label>
                    <input type="number" name="max_cost" class="form-control" value="">
                  </div>
                </div>
                <div class="col-md-6">
                    <label>Service Profile</label>
                    <input type="file" name="service_profile" class="form-control">
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="addService" value="Add Service" class="btn btn-success" value="">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php
      require_once('partials/_footer.php');
      ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>
<script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
 initialCountry: "auto",
 geoIpLookup: getIp,
 utilsScript:
   "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",

   });
   const info = document.querySelector(".alert-info");

function process(event) {
 event.preventDefault();

 const phoneNumber = phoneInput.getNumber();

 info.style.display = "";
 info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
}
function getIp(callback) {
 fetch('https://ipinfo.io/json?token=<your token>', { headers: { 'Accept': 'application/json' }})
   .then((resp) => resp.json())
   .catch(() => {
     return {
       country: 'rw',
     };
   })
   .then((resp) => callback(resp.country));
}
 </script>
</html>
