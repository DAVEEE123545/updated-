<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "facility_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert reservation into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $facility_name = $conn->real_escape_string($_POST['facility_name']);
    $reservation_date = $conn->real_escape_string($_POST['reservation_date']);
    $start_time = $conn->real_escape_string($_POST['start_time']);
    $end_time = $conn->real_escape_string($_POST['end_time']);
    $additional_request = $conn->real_escape_string($_POST['additional_request']);
    $purpose = $conn->real_escape_string($_POST['purpose']);

    $sql = "INSERT INTO reservations (user_name, email, facility_name, reservation_date, start_time, end_time, additional_request, purpose)
            VALUES ('$user_name', '$email', '$facility_name', '$reservation_date', '$start_time', '$end_time', '$additional_request', '$purpose')";

    if ($conn->query($sql) === TRUE) {
        // Return a success response in JSON format
        echo json_encode(['status' => 'success', 'message' => 'Reservation success']);
    } else {
        // Return an error response in JSON format
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
    }

    $conn->close();
}
?>
