<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

if(isset($_GET['id'])){
    $service_id = $_GET['id'];

    if(isset($_POST['delete'])){
        $confirm = $_POST['confirm'];
        if($confirm == 'yes'){
            // Delete the service from the database
            $sql = "DELETE FROM services WHERE id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $service_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo '<script>alert("Service deleted successfully.");</script>';
            } else {
                echo '<script>alert("Failed to delete service.");</script>';
            }
            $stmt->close();

            // Redirect to services page
            echo '<script>alert("Service Deleted."); window.location="receipts.php"</script>';
            exit;
        } else {
            echo '<script>alert("Delete cancelled.");</script>';
        }
    }

    $sql = "SELECT * FROM services WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $service_name = $row['service_name'];
    } else {
        echo '<script>alert("Service not found.");</script>';
        header("Location: receipts.php");
        exit;
    }

    $stmt->close();
} else {
    echo '<script>alert("Invalid service ID.");</script>';
    header("Location: receipts.php");
    exit;
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
        <div style="background-image: url(assets/img/theme/restro00.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
            <span class="mask bg-gradient-dark opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--8">
            <!-- Delete confirmation -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3>Delete Service</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <p>Are you sure you want to delete the service "<?php echo $service_name; ?>"?</p>
                                <p><strong>Note:</strong> This action cannot be undone and you will lose some features on the webpage.</p>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Enter "yes" to confirm:</label>
                                        <input type="text" name="confirm" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="submit" name="delete" value="Delete Service" class="btn btn-danger">
                                    </div>
                                </div>
                            </form>
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
