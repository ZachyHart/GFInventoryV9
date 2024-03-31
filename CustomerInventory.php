<?php
require_once 'helpers/conn_helpers.php';
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
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
                    <a href="CustomerFeedbacK.php" class="sidebar-link" title="Feedback">
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
                <!-- Add more sidebar items here -->
            </ul>
            <div class="sidebar-footer">
                <form action="controllers/Users.php" method="post" id="logout">
                    <input type="hidden" name="type" value="logout">
                    <a href="javascript:{}" onclick="document.getElementById('logout').submit();"
                        class="sidebar-link" title="Logout" id="logout" type="submit">
                        <i class="lni lni-exit"></i>
                    </a>
                </form>
            </div>
        </aside>

        <div class="main p-3">
            <div class="text-center">
                <h1 class="inventory-title">PRODUCT LISTS</h1>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form method="GET" class="d-flex">
                        <input type="text" class="form-control me-2" name="search" placeholder="Search products...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 mt-3"> <!-- Updated to show 4 columns on large screens -->
                <?php
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM product_table WHERE product_name LIKE '%$search%'";
                } else {
                    $sql = 'SELECT * FROM product_table';
                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col">
                    <div class="card product_card">
                        <div class="row justify-content-start">
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <img src="img/products/<?php echo $row['product_image']; ?>"
                                    class="card-img-top product_image" alt="<?php echo $row['product_name']; ?>">
                            </div>

                            <div class="col-12">
    <div class="card-body">
        <div class="product-details">
            <span class="product-category"><?php echo $row['product_category']; ?></span>
            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
        </div>
        <div class="price_stock">
            <h1 class="price_text">₱ <?php echo $row['price']; ?></h1>
            <h1 class="stock_text">In stock x <?php echo $row['stock']; ?></h1>
        </div>
        
    </div>
</div>

                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="WorkingSidebar.js"></script>
</body>

</html>
