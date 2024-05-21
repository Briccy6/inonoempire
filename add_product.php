<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['addProduct'])) {
  //Prevent Posting Blank Values
  if (empty($_POST["event_code"]) || empty($_POST["event_name"]) || empty($_POST['event_desc']) 
   || empty($_POST['event_owner'])) {
    $err = "Blank Values Not Accepted";
  } else {
    $id = 1;
    $prod_id = $id++;
    $prod_code  = $_POST['event_code'];
    $prod_name = $_POST['event_name'];
    $prod_desc = $_POST['event_desc'];
    $prod_price = $_POST['event_price'];
    $event_owner = $_POST['event_owner'];
    $assigned_to = $_POST['assigned_to'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $location = $_POST['location'];
    $current_date = date("Y-m-d");
    $current_timestamp = time();
if($current_date >= $start_date){
  $decision=1;
}elseif($current_date < $start_date){
  $decision =2;
}else{
  $decision = 3;
}
    
    // Insert data into the event table
    $postQuery = "INSERT INTO `event`(`event_id`, `event_name`, `event_location`,
     `event_description`, `assigned_to`, `created_at`, `start_on`, `end_on`, `decision`,
      `owner`) VALUES ('$prod_id','$prod_name','$location','$prod_desc','$assigned_to',
      '$start_date','$decision'
      '$end_date','$event_owner')";
    $postStmt = mysqli_query($mysqli,$postQuery);
    
    // Bind parameters
    // $rc = $postStmt->bind_param('ssssssssss', $prod_id, $prod_name, $location, $prod_desc, $assigned_to, $current_date, $start_date, $end_date, NULL, $event_owner);
    
    // Execute the statement
    // $postStmt->execute();
    
    // Check if the query was successful
    if ($postStmt) {
        $success = "Event Scheduled" && header("refresh:1; url=add_product.php");
    } else {
        $err = "Please Try Again Or Try Later";
        echo mysqli_error($mysqli);
    }
    
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
    <!-- Header --><!-- For more projects: Visit codeastro.com  -->
    <div style="background-image: url(assets/img/theme/6.png); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
    <span class="mask bg-gradient-dark opacity-8"></span>
      <div class="container-fluid">
        <div class="header-body">
        </div>
      </div>
    </div><!-- For more projects: Visit codeastro.com  -->
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3>Please Fill All Fields</h3>
            </div><!-- For more projects: Visit codeastro.com  -->
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Event  Name</label>
                    <input type="text" name="event_name" class="form-control" placeholder="Enter The Name Of the Event">
                
                  </div>
                  <div class="col-md-6">
                    <label>Event  Owner</label>
                    <input type="text" name="event_owner" class="form-control" placeholder="Enter The Name Of the Event Owner">
                
                  </div>
                  <div class="col-md-6">
                    <label>Event  Assigned To</label>
                    <select name="assigned_to" id="" class="form-control">
                      <option value="">~~SELECT TEAM MEMBER ASSIGNED THE EVENT TO~~</option>
                      <?php
// Fetch names and IDs of users from the rpos_staff table
$staffQuery = "SELECT * FROM `rpos_staff`";
$staffResult = $mysqli->query($staffQuery);

if ($staffResult && $staffResult->num_rows > 0) {
    while ($row = $staffResult->fetch_assoc()) {
        $staff_id = $row['id'];
        $staff_name = $row['staff_name'];
        echo "<option value='$staff_id'>$staff_name</option>";
    }
}
?>
                    </select>
                    <!-- <input type="text" name="event_assigned_to" class="form-control" placeholder="ENter The Name Of the Event"> -->
                   
                    <div>
                <label>Location</label>
                    <input type="text" name="location"  class="form-control" placeholder="Event Location">
                  </div>
                  </div>
                 
                  <div class="col-md-6">
                    <label>Event Code</label>
                    <input type="text" name="event_code"  class="form-control" value="<?php $min = 100000; // Smallest 6-digit number
$max = 999999; // Largest 6-digit number
$random_number = mt_rand($min, $max);
echo $random_number;?> " readonly>
 <div class="col-md-6">
</div>
<div>
                    <label>Event Amount To Be Paid</label>
                    <input type="number" name="event_price"  class="form-control" placeholder="Amount to be paid">
                  </div>
               
                  </div>
                </div>
                <hr><!-- For more projects: Visit codeastro.com  -->
                
                  <div class="col-md-6" style="display:flex;justify-content:space-between;">
                    <div>
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="">
                  </div>
                <div>
                    <label>End Date</label>
                    <input type="date" name="end_date" class="form-control" value="">
                  </div>
                </div>                <hr><!-- For more projects: Visit codeastro.com  -->
                <div class="form-row">
                  <div class="col-md-12">
                    <label>Event Description</label>
                    <textarea rows="5" name="event_desc" class="form-control" value="" placeholder="Summarize the Event for more information on it"></textarea>
                  </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="addProduct" value="Schedule Event" class="btn btn-success" value="">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- For more projects: Visit codeastro.com  -->
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
<!-- For more projects: Visit codeastro.com  -->
</html>