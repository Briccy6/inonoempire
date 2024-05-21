<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

if(isset($_GET['id'])){
    $service_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $service_name = $_POST['service_name'];
        $description = $_POST['description'];
        $min_cost = $_POST['min_cost'];
        $max_cost = $_POST['max_cost'];

        // Check if a new file was uploaded
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

        // Update the service in the database
        $sql = "UPDATE services SET service_name=?, description=?, min_cost=?, max_cost=?, service_profile=? WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssddsi", $service_name, $description, $min_cost, $max_cost, $service_profile, $service_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo '<script>alert("Service updated successfully.");</script>';
        } else {
            echo '<script>alert("Failed to update service.");</script>';
        }

        $stmt->close();
    }

    // Fetch service details
    $sql = "SELECT * FROM services WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $service_name = $row['service_name'];
        $description = $row['description'];
        $min_cost = $row['min_cost'];
        $max_cost = $row['max_cost'];
        $service_profile = $row['service_profile'];
    } else {
        echo '<script>alert("Service not found.");</script>';
        header("Location: services.php");
        exit;
    }

    $stmt->close();
} else {
    echo '<script>alert("Invalid service ID.");</script>';
    header("Location: services.php");
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
            <!-- Update form -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3>Update Service</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Service Name</label>
                                        <input type="text" name="service_name" class="form-control" value="<?php echo $service_name; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Service Description</label>
                                        <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Min Cost</label>
                                        <input type="number" name="min_cost" class="form-control" value="<?php echo $min_cost; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Max Cost</label>
                                        <input type="number" name="max_cost" class="form-control" value="<?php echo $max_cost; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Service Profile</label>
                                        <input type="file" name="service_profile" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <img src="<?php echo $service_profile; ?>" style="width: 100px; height: 100px; border-radius: 50%;" alt="Service Image">
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="submit" name="updateService" value="Update Service" class="btn btn-success">
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
