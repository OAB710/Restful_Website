<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin details</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/admin_style.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v5.15.4/css/all.css">
    <!-- link icon -->
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-8d95b745961f6b33ab3aa1b98a45291a.css?vsn=d">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
    <div class="navigation">
            <ul>
                <li>
                <a href="admin.php">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Welcome admin</span>
                    </a>
                </li>

                <li>

                <li>
                    <a href="admin.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Manage User</span>
                    </a>
                </li>

                <li>
                    <a href="ManageCourse.php">
                        <span class="icon">
                            <i class="fa-light fa-database"></i>
                        </span>
                        <span class="title">Manage Course</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->


            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>List of course</h2>
                        <a href="form.php" class="btn">Add course</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Title</td>
                                <td>Content</td>
                                <td>Duration</td>
                                <td>Type</td>
                                <td>Location</td>
                                <td>Category</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <?php
                            require_once ('admin_get_courses.php');
                        ?>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->

            </div>
        </div>

        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>