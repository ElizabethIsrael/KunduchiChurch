<?php 

// Include database connection
include 'dbconnection.php';

// Fetch news and events from the database
$news_query = "SELECT * FROM newsandupdates ORDER BY date DESC";
$news_result = mysqli_query($conn, $news_query);

$events_query = "SELECT * FROM upcomingevents ORDER BY date DESC";
$events_result = mysqli_query($conn, $events_query);

// Handle delete action for news
if (isset($_GET['news_Id'])) {
    $news_id = $_GET['news_Id']; // No need for echo here
    $delete_query = "DELETE FROM newsandupdates WHERE news_id = $news_id";
    
    if (mysqli_query($conn, $delete_query)) {
        header("Location: admin.php?success=News deleted successfully");
        exit();
    } else {
        echo "Error deleting news: " . mysqli_error($conn);
    }
}

// Handle delete action for events
if (isset($_GET['events_Id'])) {
    $event_id = $_GET['events_Id'];
    $delete_query = "DELETE FROM upcomingevents WHERE events_id = $event_id";
    
    if (mysqli_query($conn, $delete_query)) {
        header("Location: admin.php?success=Event deleted successfully");
        exit();
    } else {
        echo "Error deleting event: " . mysqli_error($conn);
    }
}

// Handle update  news
if (isset($_POST['send']) && isset($_GET['updatnews_id'])) {
    $updnews_id = $_GET['updatnews_id'];
    $title = $_POST['newsTitle'];
    $date = $_POST['newsDate'];
    $description = $_POST['newsDescription'];

    $sql1 = "UPDATE newsandupdates SET title = '$title', date = '$date', description = '$description' WHERE news_id = $updnews_id";
    $news = mysqli_query($conn, $sql1);

       header("Location: admin.php");
    
}
// Handle update events
if (isset($_POST['send']) && isset($_GET['updatevents_id'])) 
{
    $updevents_id = $_GET['updatevents_id'];
    $title = $_POST['eventTitle'];
    $date = $_POST['eventDate'];
    $description = $_POST['eventDescription'];

    $sql2 = "UPDATE upcomingevents SET title = '$title', date = '$date', description = '$description' WHERE events_id = $updevents_id";
    $news = mysqli_query($conn, $sql2);

       header("Location: admin.php");
    
}
?>
