<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
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
                        <a href="add_service.php" class="btn btn-outline-success">
                <i class="fas fa-user-plus"></i>
                Add New Service
              </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success" scope="col">Code</th>
                                        <th scope="col">Service Name</th>
                                        <!-- <th class="text-success" scope="col">Description</th> -->
                                        <th scope="col">Min Cost</th>
                                        <th scope="col">Max Cost</th>
                                        <th class="text-success" scope="col">Service Profile</th>
                                       
                                        
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM services";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $service_id = $row['id'];
                                            $service_name = $row['service_name'];
                                            $description = $row['description'];
                                            $min_cost = $row['min_cost'];
                                            $max_cost = $row['max_cost'];
                                            $service_profile = $row['service_profile'];
                                                                                ?>
                                            <tr>
                                                <td><?php echo $service_id; ?></td>
                                                <td><?php echo $service_name; ?></td>
                                                <!-- <td><?php echo $description; ?></td> -->
                                                <td><?php echo $min_cost; ?></td>
                                                <td><?php echo $max_cost; ?></td>
                                                <td><img src="<?php echo $service_profile; ?>" style="width: 100px; height: 100px; border-radius:50%;" alt=""></td>
                
                                                <td>
                                                    <!-- Add your action buttons here -->
                                                    
    <!-- Update button -->
    <a href="update_service.php?id=<?php echo $service_id; ?>" class="btn btn-sm btn-info">
        <i class="fas fa-edit"></i> Update
    </a>
    <!-- Delete button -->
    <a href="delete_service.php?id=<?php echo $service_id; ?>" class="btn btn-sm btn-danger">
        <i class="fas fa-trash-alt"></i> Delete
    </a>
</td>
                                                
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No services found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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
</html>
