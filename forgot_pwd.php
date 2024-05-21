<?php
session_start();
include('config/config.php');
require_once('config/code-generator.php');

if (isset($_POST['reset_pwd'])) {
  if (!filter_var($_POST['reset_email'], FILTER_VALIDATE_EMAIL)) {
    $err = 'Invalid Email';
  } else {
    $reset_email = $_POST['reset_email'];
    $checkEmail = mysqli_query($mysqli, "SELECT `admin_email` FROM `rpos_admin` WHERE `admin_email` = '" . $reset_email . "'") or exit(mysqli_error($mysqli));
    if (mysqli_num_rows($checkEmail) > 0) {
      // Generate reset token
      $reset_token = generateRandomString(10); // Use your code generator function here

      // Store reset token in the database
      $query = "INSERT INTO rpos_pass_resets (reset_email, reset_token, reset_status) VALUES (?,?,?)";
      $reset = $mysqli->prepare($query);
      $reset_status = 'Pending';
      $rc = $reset->bind_param('sss', $reset_email, $reset_token, $reset_status);
      $reset->execute();
      if ($reset) {
        // Send email with reset link
        $reset_link = "http://inonoempire.com/reset_password.php?token=$reset_token"; // Change yourwebsite.com to your actual website
        $subject = 'Password Reset Link';
        $message = "Please click the following link to reset your password: $reset_link";
        mail($reset_email, $subject, $message);

        $success = "Password Reset Instructions Sent To Your Email";
      } else {
        $err = "Please Try Again Or Try Later";
      }
    } else {
      $err = "No account with that email";
    }
  }
}
require_once('partials/_head.php');
?>

<!-- Your HTML code here -->

