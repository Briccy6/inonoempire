<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');

// Check if the appointment ID is set
if(isset($_GET['id'])){
    $appointment_id = $_GET['id'];

    // Update the appointment status to declined
    $stmt = $mysqli->prepare("UPDATE appointments SET status = 'Declined' WHERE id = ?");
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $stmt->close();
}
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
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            Decline Appointment
                        </div>
                        <div class="card-body">
                            <p>Appointment has been declined successfully.</p>
                            <a href="payments_reports.php" class="btn btn-primary">Back to Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php require_once('partials/_footer.php'); ?>
    </div>
    <!-- Argon Scripts -->
    <?php require_once('partials/_scripts.php'); ?>
</body>
</html>
