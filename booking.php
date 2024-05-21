<?php
include('config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $working_means = $_POST['working_means'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $start_time = $_POST['start_time'] ?? '';
    $end_time = $_POST['end_time'] ?? '';
    $service = $_POST['service'] ?? '';

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email address");</script>';
    } else {
       $sql = "INSERT INTO `appointments` (`fullname`, `phone`, `email`, `working_means`, `start_date`, `end_date`, `start_time`, `end_time`, `service_id`) 
        VALUES ('$fullname', '$phone', '$email', '$working_means', '$start_date', '$end_date', '$start_time', '$end_time', '$service')";

        if ($mysqli->query($sql) === TRUE) {
            echo '<script>alert("Thank for Hiring Inono Empire, we are checking your information you be notified as soon as possible, kindly be humble.");</script>';
        } else {
            echo '<script>alert("Error: ' . $mysqli->error . '");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--===== Meta Tag =====-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Inono Empire - We make it Happen">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Event Management in Rwanda, inono Empire, Event in Kigali, Event in Rwanda, inonoempire.com, kigali event, inono, brightline, Rental, Similtaneous interpretation, Visit Rwanda">
    <meta name="author" content="root">

    <!--    Css Links
    ==================================================-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css" id="color-change">

    <!-- Favicon
    ==================================================-->
    <link rel="icon" type="image/png" sizes="32x32" href="images/inono_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

    <!--    Title
    ==================================================-->
    <title>Work With Us | InonoEmpire - We make it Happen</title>
    <style>
        #service-list tbody tr {
            cursor: pointer;
        }
        


    </style>
</head>

<body id="top" class="page-load">
    <!--    Start Back to top
	=================================================-->
    <a href="#" id="scroll" style="display: none;"><span></span></a>
    <!--    End Back to top
    ==================================================-->

    <!--    Preloader
    ==================================================-->
    <!-- <div class="image-preloader">
    <img src="images/inono_icon.png" alt="Preloader Image">
</div> -->
    <!-- <div class="preloader">
        <div class="lds-css ng-scope">
            <div class="lds-spinner" style="100%;height:100%">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div> -->
    <!--    Preloader
    ==============================================-->
    <!--  Color Settings End
	==============================================-->
    <!-- Wrapper Start
==================================================-->
    <div id="page_wrapper">
        <div class="row">
            <!-- Start Nav Menu
	==============================================-->
            <header class="main_nav dark_nav">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light w-100">
                        <a class="navbar-brand" href="#top"><img class="nav-logo" src="images/logo/inono-empire-logo.png" alt="inono-empire-logo"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a class="nav-link active" href="index.php">Home<span class="sr-only">(current)</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                                <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="login.php">Admin</a></li>
                                <li class="nav-item"><a class="nav-link" href="booking.php">Book Now</a></li>


                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <div class="contact_massage bg_deepblack">
                <a href="https://api.whatsapp.com/send?phone=250788803494&text=Hi there! I have Question"><font color="green"><i class="fa fa-whatsapp" aria-hidden="true"></i></font></a>
            </div>
            <!-- End Nav Menu
	==================================================-->
            <section class="banner overlay_three full_row" style="background: url(images/bg-image/012.jpg) no-repeat center fixed;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="banner_text text-center">
                                <h1 class="page_banner_title color_white text-uppercase"><span class="line_double mx-auto color_default">Hire Us</span></h1>
                                <div class="breadcrumbs m-auto d-inline-block">
                                    <ul>
                                        <li class="hover_gray"><a href="index.html">Home</a></li>
                                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                        <li class="color-default">Work With us</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--    Start Portfolio
	===================================================-->
            <section id="contact-us" class="py_80 bg_black full_row">
                <div class="container">

                    <div class="contact pt_60 md_pl_80">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <!--    Start Title
		    				================================-->
                                <div class="main_title pb_60">
                                    <h2 class="title color_white">Hire Us</h2>
                                    <p class="mt_15 color_lightgray">Ready to take your ideas to the next level?
                                        Our team is here to make it happen.</p>
                                </div>
                                <!--    End Title
		    				================================-->
                            </div>
                        </div>

                        <div class="py-3">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h5 class="card-title">Filled the Form to Hire Us</h5>
                              
                               
                                    </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form action="" method="POST" id="appointment-form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fullname" class="control-label">Fullname</label>
                                                    <input type="text" name="fullname" id="fullname" class="form-control form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
        <label for="phone" class="control-label">Phone Number</label><br>

        <input type="tel" id="phone" name="phone" class="form-control" required>
    </div>
</div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
    <div class="form-group">
        <label for="working_means" class="control-label">Working Means</label>
        <select name="working_means" id="working_means" class="form-control">
            <option value="">~~SELECT WAYS OF WORKING~~</option>
            <option value="full_day">Full Day</option>
            <option value="hours">Hours</option>
        </select>
    </div>
</div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_date" class="control-label">Start Date</label>
                                                    <input type="date" name="start_date" id="start_date" class="form-control form-control" min="<?php echo date('Y-m-d');?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date" class="control-label">End Date</label>
                                                    <input type="date" name="end_date" id="end_date" class="form-control form-control" required>
                                                </div>
                                            </div>
                                        
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_time" class="control-label">Start Time</label>
                                                    <input type="time" name="start_time" id="start_time" class="form-control form-control" min="<?php echo date('Y-m-d');?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_time" class="control-label">End Tine</label>
                                                    <input type="time" name="end_time" id="end_time" class="form-control form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service" class="control-label">Service</label>
                                                    <select name="service" id="service" class="form-control">
                                                        <option value="">~~SELECT SERVICE</option>
                                                        <?php
                                                        include('config/config.php');
                                                        $service = $mysqli->query("SELECT * FROM `services` order by `service_name` asc");
                                                        while ($row = $service->fetch_assoc()) :
                                                        ?>
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['service_name'] ?></option>
                                                        <?php endwhile ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button class="btn btn-primary btn-lg rounded-0" type="submit">Book Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    <!-- End Portfolio
===================================================-->
    <!-- Wrapper End
==================================================-->
    <!--  Color Settings End
==============================================-->
    <!-- Footer
==================================================-->
    <!-- /#page_wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
   // Hide the preloader image when the page is fully loaded
   window.addEventListener('load', function() {
    var preloader = document.querySelector('.image-preloader');
    if (preloader) {
        preloader.style.display = 'none';
    }
});
const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "auto",
            geoIpLookup: getIp,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        const info = document.querySelector(".alert-info");

        function process(event) {
            event.preventDefault();

            const phoneNumber = phoneInput.getNumber();

            info.style.display = "";
            info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
        }

        function getIp(callback) {
            fetch('https://ipinfo.io/json?token=<your token>', {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then((resp) => resp.json())
                .catch(() => {
                    return {
                        country: 'rw',
                    };
                })
                .then((resp) => callback(resp.country));
        }

        document.getElementById('start_date').addEventListener('change', function () {
            var startDate = new Date(this.value);
            var endDateInput = document.getElementById('end_date');
            endDateInput.min = this.value;
            endDateInput.value = this.value; // Reset end date if it's before the new start date

            // Disable dates before start date in end date input
            var endDateOptions = endDateInput.getElementsByTagName('option');
            for (var i = 0; i < endDateOptions.length; i++) {
                var endDate = new Date(endDateOptions[i].value);
                if (endDate < startDate) {
                    endDateOptions[i].disabled = true;
                } else {
                    endDateOptions[i].disabled = false;
                }
            }
        });

        document.getElementById('end_date').addEventListener('change', function () {
            var endDate = new Date(this.value);
            var startDateInput = document.getElementById('start_date');
            startDateInput.max = this.value;
            startDateInput.value = this.value; // Reset start date if it's after the new end date
        });
        var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
        initialCountry: "auto",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    // Validate the phone number on form submission
    document.getElementById('appointment-form').addEventListener('submit', function(event) {
        if (!iti.isValidNumber()) {
            alert('Please enter a valid phone number.');
            event.preventDefault();
        }
    });
   document.getElementById('working_means').addEventListener('change', function() {
    var timeFields = document.getElementById('time-fields');
    if (this.value === 'full_day') {
        timeFields.style.display = 'none';
    } else {
        timeFields.style.display = 'block';
    }
});


</script></body>
</html>

