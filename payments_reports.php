<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
?>

<body>
    <!-- Sidenav --><!-- For more projects: Visit codeastro.com  -->
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
                        Who requested to work with us
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success" scope="col"> Code</th>
                                        <th scope="col">Client Names</th>
                                        <th class="text-success" scope="col">Service Requested</th>
                                        <th scope="col">Email</th>
                                        <th class="text-success" scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead><!-- For more projects: Visit codeastro.com  -->
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM appointments";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($payment = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th class="text-success" scope="row">
                                                <?php echo $payment->id; ?>
                                            </th>
                                            <th scope="row">
                                                <?php echo $payment->fullname; ?>
                                            </th>
                                            <td class="text-success">
                                                <!-- <?php echo $payment->service_name; ?> -->
                                            </td>
                                            <td>
                                                 <?php echo $payment->email; ?>
                                            </td>
                                            <td>
                                                 <?php echo $payment->status; ?>
                                            </td>
                                           
                                           <td><a href="view_request.php?update=<?php echo $payment->id; ?>">
                          <button class="btn btn-sm btn-primary">
                            <i class="fas fa-user-edit"></i>
                            Read More
                          </button>
                        </a>
                    <a href="send_message.php?id=<?php echo $payment->id;?>">  <button class="btn btn-sm btn-primary"><i class="fa fa-reply" aria-hidden="true"></i>Send Message</button></a>
                    </td>
                                        </tr>
                                    <?php } ?>
                                </tbody><!-- For more projects: Visit codeastro.com  -->
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
<!-- For more projects: Visit codeastro.com  -->
</html>