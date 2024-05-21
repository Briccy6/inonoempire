<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
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
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--8">
            <!-- Appointment Details -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            Appointment Details
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['update'])) {
                                $id = $_GET['update'];
                                $ret = "SELECT * FROM appointments NATURAL JOIN services WHERE id=?";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->bind_param('i', $id);
                                $stmt->execute();
                                $res = $stmt->get_result();
                                while ($appointment = $res->fetch_object()) {
                            ?>
                                    <h4>Client Name: <?php echo $appointment->fullname; ?></h4>
                                    <p>Contact: <?php echo $appointment->phone; ?></p>
                                    <p>Email: <?php echo $appointment->email; ?></p>
                                    <p>Service Requested: <?php echo $appointment->service_name; ?></p>
                                    <p>Service Description: <?php echo $appointment->description; ?></p>
                                    <!-- Allow/Decline Buttons -->
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="allow_appointments.php?id=<?php echo $appointment->id; ?>" class="btn btn-success">Allow</a>
                                        <a href="decline_appointment.php?id=<?php echo $appointment->id; ?>" class="btn btn-danger">Decline</a>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<p>No appointment selected</p>";
                            }
                            ?>
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
