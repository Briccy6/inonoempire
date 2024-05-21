<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = "UPDATE comments SET status=2  WHERE  commnt_id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
      $success = "Comment Deleted" && header("refresh:1; url=orders_reports.php");
    } else {
      $err = "Try Again Later";
    }
  }
  if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $adn = "UPDATE comments SET status=1 WHERE  commnt_id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
      $success = "Comment Confirmed" && header("refresh:1; url=orders_reports.php");
    } else {
      $err = "Try Again Later";
    }
  }
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
                             Comments
                        </div><!-- For more projects: Visit codeastro.com  -->
                        <div class="table-responsive">
                            <table id="dataTable" class="table align-items-center table-flush">

                                <thead class="thead-light">                          
                                      <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="width:50%;justify-content:right;align-items:right;">

                                    <tr>
                                        <!-- <th class="text-success" scope="col">Code</th> -->
                                        <th scope="col">Fullnames</th>
                                        <th class="text-success" scope="col">Email</th>
                                        <th scope="col">Subject</th>
                                        <th class="text-success" scope="col">Message</th>
                                        <th scope="col">Status</th>
                                      <th scop="col">Action</th>
                                            <th scop="col">Receieved at</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  comments ORDER BY `created_at` DESC  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($order = $res->fetch_object()) {
                                        // $total = ($order->prod_price * $order->prod_qty);

                                    ?> <tr>
                                    <!-- <th class="text-success" scope="row"><?php echo $order->commnt_id; ?></th> -->
                                    <td><?php echo $order->full_name; ?></td>
                                    <td class="text-success"><?php echo $order->email; ?></td>
                                    <td><?php echo $order->subject; ?></td>
                                    <td class="text-success"><?php echo $order->message; ?></td>
                                    <td><?php if($order->status == 1){
                                        echo "Confirmed";
                                    } elseif($order->status== 2){
                                        echo"Deleted";
                                    }elseif($order->status == 3){
                                        echo"Unconfirmed";
                                    }?>
                                    <td class="text-success"><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                    <td>
                        <a href="orders_reports.php?delete=<?php echo $order->commnt_id; ?>">
                          <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                            Delete
                          </button>
                        </a>
                        <a href="orders_reports.php?update=<?php echo $order->commnt_id; ?>">
                          <button class="btn btn-sm btn-primary">
                          <i class="fas fa-check-circle"></i>

                            Confirm
                          </button>
                        </a>
                    </td>  
                                </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Change the index to match the column you want to search
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>

<!-- For more projects: Visit codeastro.com  -->
</html>