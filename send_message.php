<?php
require_once('partials/_header.php');
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
                            Send Message to
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <?php
                                // Check if ID is set and fetch the phone number
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $stmt = $mysqli->prepare("SELECT phone FROM appointments WHERE id = ?");
                                    $stmt->bind_param("i", $id);
                                    $stmt->execute();
                                    $stmt->bind_result($phone);
                                    $stmt->fetch();
                                    $stmt->close();
                                ?>
                                <div class="form-group">
                                    <label for="to_phone">Phone Number:</label>
                                    <input type="text" class="form-control" id="to_phone" name="to_phone" value="<?php echo "+250".$phone; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="send_message">Send Message</button>
                                <?php } ?>
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
    <script>
        // Show alert when message is sent or not sent
        $(document).ready(function(){
            $('form').submit(function(event){
                event.preventDefault();
                var phone = $('#to_phone').val();
                var message = $('#message').val();
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + encodeURIComponent(message);
                window.location.href = url;
            });
        });
    </script>
</body>
</html>
