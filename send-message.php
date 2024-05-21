<?php
// Include database connection
include('config/config.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $timestamp = date('Y-m-d H:i:s'); // Current timestamp

    // Prepare and bind SQL statement
    $stmt = $mysqli->prepare("INSERT INTO comments (full_name, email, subject, message,created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $subject, $message, $timestamp);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Message submitted successfully.'); window.location='contact-us.php'</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$mysqli->close();
?>