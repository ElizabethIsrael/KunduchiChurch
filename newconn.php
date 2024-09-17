<?php
include 'dbconnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['newsTitle']) && isset($_POST['newsDate']) && isset($_POST['newsDescription'])) {
        // Adding new news
        $title = $conn->real_escape_string($_POST['newsTitle']);
        $date = $conn->real_escape_string($_POST['newsDate']);
        $description = $conn->real_escape_string($_POST['newsDescription']);

        $sql = "INSERT INTO newsandupdates (title, date, description) VALUES ('$title', '$date', '$description')";
        if ($conn->query($sql) === TRUE) {
            //echo "New news added successfully";
            header("location:admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } elseif (isset($_POST['eventTitle']) && isset($_POST['eventDate']) && isset($_POST['eventDescription'])) {
        // Adding new event
        $title = $conn->real_escape_string($_POST['eventTitle']);
        $date = $conn->real_escape_string($_POST['eventDate']);
        $description = $conn->real_escape_string($_POST['eventDescription']);

        $sql = "INSERT INTO upcomingevents (title, date, description) VALUES ('$title', '$date', '$description')";
        if ($conn->query($sql) === TRUE) {
            //echo "New event added successfully";
            header("location:admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    
    exit;
}
?>
?>