<?php 

// Include database connection
include 'dbconnection.php';

// Fetch news and events from the database
$news_query = "SELECT * FROM newsandupdates ORDER BY date DESC";
$news_result = mysqli_query($conn, $news_query);

$events_query = "SELECT * FROM upcomingevents ORDER BY date DESC";
$events_result = mysqli_query($conn, $events_query);

// Handle delete action
if (isset($_GET['news_Id'])) {
    $new_id = $_GET['news_Id'];
    $delete_query = "DELETE FROM newsandupdates WHERE news_id = $new_id";
    mysqli_query($conn, $delete_query);
    header("Location: admin.php"); // Redirect to refresh the page
}

if (isset($_GET['events_Id'])) {
    $event_id = $_GET['events_Id'];
    $delete_query = "DELETE FROM upcomingevents WHERE events_id = $event_id";
    mysqli_query($conn, $delete_query);
    header("Location: admin.php"); // Redirect to refresh the page
}

// Initialize variable to avoid undefined variable error
$my_news = [];

// Edit news
if (isset($_GET['edit_id'])) {
    $ed_id = $_GET['edit_id'];
    $sel = "SELECT * FROM newsandupdates WHERE news_id = $ed_id";
    $result = mysqli_query($conn, $sel);
    
    if (mysqli_num_rows($result) > 0) {
        $my_news = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/admin-style.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Back to Church Site</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h1 class="text-center">Manage News & Updates</h1>

        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4>News & Updates</h4>
                <button class="btn btn-light float-right" data-toggle="modal" data-target="#addNewsModal">Add News</button>
            </div>
            <div class="card-body">
                <!-- Table displaying the list of News & Updates -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/n</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $i = 1;
                         foreach ($news_result as $news) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $news['title']; ?></td>
                            <td><?php echo $news['date']; ?></td>
                            <td><?php echo $news['description']; ?></td>
                            <td>
                                <a href="admin.php?edit_id=<?php echo $news['news_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editNewsModal">Edit</a>
                                <a href="admin.php?news_Id=<?php echo $news['news_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news item?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4>Upcoming Events</h4>
                <button class="btn btn-light float-right" data-toggle="modal" data-target="#addEventModal">Add Event</button>
            </div>
            <div class="card-body">
                <!-- Table displaying the list of Upcoming Events -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/n</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach ($events_result as $events) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $events['title']; ?></td>
                            <td><?php echo $events['date']; ?></td>
                            <td><?php echo $events['description']; ?></td>
                            <td>
                                <a href="admin.php?edtevent_id=<?php echo $events['events_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editEventModal">Edit</a>
                                <a href="admin.php?events_Id=<?php echo $events['events_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add News Modal -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">Add News</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="newconn.php" method="POST">
                        <div class="form-group">
                            <label for="newsTitle">Title</label>
                            <input type="text" class="form-control" id="newsTitle" name="newsTitle" placeholder="Enter news title">
                        </div>
                        <div class="form-group">
                            <label for="newsDate">Date</label>
                            <input type="date" class="form-control" name="newsDate" id="newsDate">
                        </div>
                        <div class="form-group">
                            <label for="newsDescription">Description</label>
                            <textarea class="form-control" id="newsDescription" name="newsDescription" rows="3" placeholder="Enter news description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit News Modal -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Edit News</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php if ($my_news) { 
                    foreach ($my_news as $news_item) { ?>
                    <form action="update.php" method="POST">
                        <div class="form-group">
                            <label for="editNewsTitle">Title</label>
                            <input type="text" class="form-control" id="editNewsTitle" name="newsTitle" value="<?php echo $news_item['title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editNewsDate">Date</label>
                            <input type="date" class="form-control" id="editNewsDate" name="newsDate" value="<?php echo $news_item['date']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editNewsDescription">Description</label>
                            <textarea class="form-control" id="editNewsDescription" name="newsDescription" rows="3"><?php echo $news_item['description']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <?php } 
                } else { ?>
                    <p>No news selected for editing.</p>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="eventconn.php" method="POST">
                        <div class="form-group">
                            <label for="eventTitle">Title</label>
                            <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Enter event title">
                        </div>
                        <div class="form-group">
                            <label for="eventDate">Date</label>
                            <input type="date" class="form-control" name="eventDate" id="eventDate">
                        </div>
                        <div class="form-group">
                            <label for="eventDescription">Description</label>
                            <textarea class="form-control" id="eventDescription" name="eventDescription" rows="3" placeholder="Enter event description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
