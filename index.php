<?php
include 'process.php';

// Fetch news data from the database
$news_query = "SELECT * FROM newsandupdates ORDER BY date DESC";
$news_result = $conn->query($news_query);

// Fetch events data from the database
$events_query = "SELECT * FROM upcomingevents ORDER BY date DESC";
$events_result = $conn->query($events_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Website</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <a class="navbar-brand" href="#">
                <p>Kunduchi Catholic Church</p>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item "><a class="nav-link " href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="page.html">Prayer</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Admin</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Language
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="index2.html">Swahili</a>
                            <a class="dropdown-item" href="index.html">English</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="animate__animated animate__zoomIn text-center">
        <p style="font-size:xx-large; font-weight:800;">Welcome to St.Nicholaus Church! </p>
        <p style="font-size: large;">“Pain and suffering have come into your life, but remember pain, sorrow, suffering are but the kiss of Jesus — a sign that you<br> have come so close to Him that He can kiss you.” St. Mother Teresa of Calcutta.</p>
    </div>

    <div id="carouselExampleIndicators" class="container carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/c9.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/c2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/c3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="img/c4.jpg" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="mt-5">
        <div id="about" class="container ">
            <div class="row">
                <div class="col-md-6 mb-3 pr-5" style="overflow-y: auto; max-height: 500px; word-wrap: break-word;">
                    <h2>Welcome to St.Nicholaus Church-Kunduchi</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor. Maecenas nisl vitae massa...</p>
                </div>
                <div class="col-md-6">
                    <img src="img/k1.jpg" class="img-fluid" alt="Church Image">
                </div>
            </div>
        </div>
    </section>

    <div id="services" class="container-fluid mb-3" style="background-image:linear-gradient(to right, #063970, #abdbe3); min-height:550px;">
        <div class="row">
            <div class="col-md-6 col-sm-12 text-center pt-3" style="color:aliceblue;">
                <p style="font-size:xx-large; font-weight:800;">NEWS & UPDATES</p>
                <hr style="width:50%; text-align:center;">

                <?php
                if ($news_result->num_rows > 0) {
                    while($news_row = $news_result->fetch_assoc()) {
                        echo "<p><strong>" . $news_row['title'] . "</strong></p>";
                        echo "<p>" . $news_row['description'] . "</p>";
                        echo "<hr style='width:50%; text-align:center;'>";
                    }
                } else {
                    echo "<p>No news available at the moment.</p>";
                }
                ?>
            </div>

            <div class="col-md-6 col-sm-12 text-center pt-3" style="color:aliceblue;">
                <p style="font-size:xx-large; font-weight:800;">UPCOMING EVENTS</p>
                <hr style="width:50%; text-align:center;">

                <?php
                if ($events_result->num_rows > 0) {
                    while($events_row = $events_result->fetch_assoc()) {
                        echo "<p><strong>" . $events_row['title'] . "</strong></p>";
                        echo "<p>" . $events_row['description'] . "</p>";
                        echo "<hr style='width:50%; text-align:center;'>";
                    }
                } else {
                    echo "<p>No upcoming events at the moment.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer id="footer" class="bg-dark py-4" style="position:relative; z-index:100;">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
                    <h5>Contact Us</h5>
                    <p>Address: 123 Kunduchi Catholic Church Street, Dar es Salaam, Tanzania</p>
                    <p>Phone: (255) 686576597</p>
                    <p>Email: kunduchicatholic@gmail.com</p>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <h5>Services</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Sunday Service</a></li>
                        <li><a href="#">Bible Study</a></li>
                        <li><a href="#">Youth Group</a></li>
                        <li><a href="#">Community Outreach</a></li>
                        <li><a href="#">Prayer Meetings</a></li>
                    </ul>
                </div>
                <!--<div class="col-md-3 col-sm-6 mb-3">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">YouTube</a></li>
                        <li><a href="#">LinkedIn</a></li>
                    </ul>
                </div>-->
                <div class="col-md-3 col-sm-6">
                    <h5>Location</h5>
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.7909260334286!2d39.20464777378695!3d-6.6728079652317795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c5171ea825e77%3A0x96184bf17d6315b0!2sSt.%20Nicholaus%20Catholic%20Church!5e0!3m2!1sen!2stz!4v1723376299351!5m2!1sen!2stz"
                            width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center mt-3">
            <p>&copy; 2024 Kunduchi Catholic Church. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
