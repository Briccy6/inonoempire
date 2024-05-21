<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $adn = "UPDATE comments SET status=1 WHERE commnt_id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Comment Approved";
        header("refresh:1; url=orders_reports.php");
        exit(); // Add exit to prevent further execution
    } else {
        $err = "Try Again Later";
    }
}
?>
