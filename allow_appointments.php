<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the appointment status to 'Allowed'
    $update_query = "UPDATE appointments SET status='Allowed' WHERE id=?";
    $stmt = $mysqli->prepare($update_query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Appointment allowed successfully
        $_SESSION['msg'] = "Appointment allowed successfully";
        echo "<script>alert('Appointment allowed successfully'); window.location='payments_reports.php';</script>";
        exit;
    } else {
        // Failed to allow appointment
        $_SESSION['error'] = "Failed to allow appointment";
        echo "<script>alert('Failed to allow appointment'); window.location='view_request.php?update=$id';</script>";
        exit;
    }
} else {
    // Redirect back to the view request page if appointment ID is not provided
    header('location: view_request.php');
    exit;
}
?>
