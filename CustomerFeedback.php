<?php
// Start the session and check if the user is authenticated, and if role is user
session_start();
if (!isset($_SESSION["usersName"]) || $_SESSION['role'] != 'user') {
    // header("Location: CustomerLogin.php");
    echo '<script>
    alert("You are not authorized to access this page", ' . $_SESSION["role"] . ');
    </script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Got Funko Collections</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">

            <div class="sidebar-logo">
                <img src="img/CircularLogo.jpg" alt="Logo"
                    style="width: 100%; max-width: 120px; display: block; margin: 0 auto;">
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="CustomerInventory.php" class="sidebar-link" title="Our Products">
                        <i class="lni lni-cart"></i>
                        <span><br>Our Products</span>
                    </a>
                </li>
                <!-- Second sidebar item for Feedback -->
                <li class="sidebar-item">
                    <a href="CustomerFeedback.php" class="sidebar-link" title="Feedback">
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
                <!-- Add more sidebar items here -->
            </ul>
            <div class="sidebar-footer">
                <a href="Customerlogin.php" class="sidebar-link" title="Logout">
                    <i class="lni lni-exit"></i>
                </a>
            </div>
        </aside>

        <div class="main p-3">
            <div class="text-center">
                <h1 class="inventory-title">Customer Feedback</h1>
                <div class="feedback-section mt-4">
                    <h2 class="text-center">We value your thoughts.</h2>
                    <p class="text-justify">
                        At GotFunko Collections, we are committed to providing you with the best experience
                        when it comes to purchasing our products. Your feedback matters to us, as it helps us
                        understand your needs better and ensures we continue to offer high-quality products
                        and exceptional service.
                    </p>
                    <p class="text-justify">
                        We value your opinions, suggestions, and experiences with our products and services.
                        Whether you’ve recently made a purchase, interacted with our customer service team,
                        or simply explored our website, we encourage you to share your thoughts with us.
                        Your feedback not only helps us improve but also assists fellow Funko Pop!
                        enthusiasts in making informed decisions.
                    </p>
                    <a href="CustomerFeedback2.php" class="btn btn-primary btn-feedback">ADD FEEDBACK</a>
                </div>
            </div>
            <!-- Admin reply -->
            <div class="container">
                <?php
                // Connect to database
                $conn = mysqli_connect('localhost', 'root', '', 'login_system');

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Retrieve feedbacks from the database
                $sql = "SELECT * FROM customerfeedbacks WHERE Email = '" . $_SESSION['usersEmail'] . "'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                <!-- Add a chat like conversation here the reply from admin-->
                <div class="card mb-3">
                    <div class="card-header">
                        Feedback from
                        <?php echo $row['FeedbackTitle']; ?>
                    </div>
                    <div class="chat_box">
                        <div class="customer_chat">
                            <div class="chat_bubble customer_bubble">
                                <?php echo $row['FeedbackContent']; ?> <br />
                                <small class="text-muted">
                                    You
                                </small>
                            </div>
                        </div>
                        <div class="admin_chat">
                            <div class="chat_bubble">
                                <div class="chat_bubble admin_bubble">
                                    <?php echo $row['reply']; ?> <br />
                                    <small class="text-muted
                                            ">
                                        Admin
                                    </small>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "No feedbacks found.";
                }
                ?>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="AdminInventory.js"></script>

</body>

</html>