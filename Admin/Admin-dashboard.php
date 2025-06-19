<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit();
}

include '../connection/connection.php';

$sql_count = "SELECT COUNT(*) as total_users FROM user";
$result_count = mysqli_query($con, $sql_count);
$total_users = mysqli_fetch_assoc($result_count)['total_users'];

$sql_eligibility = "SELECT * FROM Eligibility_check";
$result_eligibility = $con->query($sql_eligibility);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/admin-dashboard.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <header>
        <nav>
            <div class="nav-left">
                <h1><i class="fas fa-crown"></i> Admin Dashboard</h1>
            </div>
            <div class="nav-right">
                <button class="theme-toggle" onclick="toggleTheme()">
                    <i class="fas fa-moon"></i>
                </button>
                <a href="admin_logout.php" class="btn btn-outline">Logout</a>
            </div>
        </nav>
    </header>

    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <aside class="sidebar" id="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li class="has-submenu">
                <a href="#user-management" onclick="toggleSubmenu(event)">
                    <i class="fas fa-users"></i> User Management
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="#user-list" onclick="showSection('user-list')">
                            <i class="fas fa-list"></i> User List
                        </a></li>
                    <li><a href="#login-analysis" onclick="showSection('login-analysis')">
                            <i class="fas fa-chart-line"></i> Login Analysis
                        </a></li>
                    <li><a href="#user-counselling" onclick="showSection('user-counselling')">
                            <i class="fas fa-user-shield"></i> Counselling
                        </a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#visa-management" onclick="toggleSubmenu(event)">
                    <i class="fas fa-passport"></i> Visa Management
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="#visa-applications" onclick="showSection('visa-applications')">
                            <i class="fas fa-file-alt"></i> Applications
                        </a></li>
                    <li><a href="#visa-status" onclick="showSection('visa-status')">
                            <i class="fas fa-clock"></i> Status Tracking
                        </a></li>
                    <li><a href="#visa-reports" onclick="showSection('visa-reports')">
                            <i class="fas fa-chart-bar"></i> Reports
                        </a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#blog-news" onclick="toggleSubmenu(event)">
                    <i class="fas fa-newspaper"></i> Blog & News
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="#blog-posts" onclick="showSection('blog-posts')">
                            <i class="fas fa-pen"></i> Upload Blogs
                        </a></li>
                   
                    <li><a href="#blog-comments" onclick="showSection('blog-comments')">
                            <i class="fas fa-comments"></i> Review Blogs
                        </a></li>
                </ul>
            </li>

            <li><a href="view_feedback.php" onclick="showSection('review-reports')">
                    <i class="fas fa-flag"></i> Review Reports
                </a></li>

            <li><a href="#eligibility-check" onclick="showSection('eligibility-check')">
                    <i class="fas fa-check-circle"></i> Eligibility Check
                </a></li>
        </ul>
    </aside>

    <main id="main-content">
        <section class="overview">
            <h2>Overview</h2>
            <div class="stats">
                <div class="stat">
                    <i class="fas fa-users stat-icon"></i>
                    <h3>Total Users</h3>
                    <p><?php echo $total_users; ?></p>
                </div>
                <div class="stat">
                    <i class="fas fa-passport stat-icon"></i>
                    <h3>Visa Applications</h3>
                    <p>50</p>
                </div>
                <div class="stat">
                    <i class="fas fa-plane-departure stat-icon"></i>
                    <h3>Flight Bookings</h3>
                    <p>30</p>
                </div>
            </div>
        </section>

        <section id="login-analysis" class="content-section">
            <h2 class="section-title">Login Analysis</h2>
            <div class="stats">
                <div class="stat">
                    <i class="fas fa-users stat-icon"></i>
                    <h3>Number of Visitors</h3>
                    <p>100</p>
                </div>
                <div class="stat">
                    <i class="fas fa-users stat-icon"></i>
                    <h3>Number of Logged-in Users</h3>
                    <p>100</p>
                </div>
            </div>
        </section>

        <section id="user-list" class="content-section">
            <h2 class="section-title">User List</h2>
            <div class="table-container">
                <?php
                $sql = "SELECT User_id, First_name, Last_name, User_email, User_DOB, User_Gender, User_phone FROM user";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                            <td>' . htmlspecialchars($row['User_id']) . '</td>
                            <td>' . htmlspecialchars($row['First_name']) . '</td>
                            <td>' . htmlspecialchars($row['Last_name']) . '</td>
                            <td>' . htmlspecialchars($row['User_email']) . '</td>
                            <td>' . htmlspecialchars($row['User_DOB']) . '</td>
                            <td>' . htmlspecialchars($row['User_Gender']) . '</td>
                            <td>' . htmlspecialchars($row['User_phone']) . '</td>
                            <td>
                                <a href="Delete_user.php?id=' . htmlspecialchars($row['User_id']) . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a>
                            </td>
                        </tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p class="no-data">No users found.</p>';
                }
                ?>
            </div>
        </section>




        <section id="user-counselling" class="content-section">
            <h2 class="section-title">Counselling Requests</h2>
            <p>This section will display review reports.</p>

            <?php
            $sql = "SELECT counselling_id, First_name, Last_name, Mo_No, Appointment_date, Counselling_hours, reason_for_counselling, created_at FROM counselling_data";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<table class="user-table">
        <thead>
            <tr>
                <th>Counselling ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile No.</th>
                <th>Appointment Date</th>
                <th>Timmings</th>
                <th>Reason for Counselling</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
            <td>' . htmlspecialchars($row['counselling_id']) . '</td>
            <td>' . htmlspecialchars($row['First_name']) . '</td>
            <td>' . htmlspecialchars($row['Last_name']) . '</td>
            <td>' . htmlspecialchars($row['Mo_No']) . '</td>
            <td>' . htmlspecialchars($row['Appointment_date']) . '</td>
            <td>' . htmlspecialchars($row['Counselling_hours']) . '</td>
            <td>' . htmlspecialchars($row['reason_for_counselling']) . '</td>
            <td>' . htmlspecialchars($row['created_at']) . '</td>
            <td>
                <a href="Delete_counselling.php?id=' . htmlspecialchars($row['counselling_id']) . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a>
            </td>
        </tr>';
                }

                echo '</tbody></table>';
            } else {
                echo '<p class="no-data">No users found.</p>';
            }
            ?>


        </section>

        <section id="visa-applications" class="content-section">
            <h2 class="section-title">Visa Applications</h2>
            <div class="stats">
                <div class="stat">
                    <i class="fas fa-file-alt stat-icon"></i>
                    <h3>Pending Applications</h3>
                    <p>25</p>
                </div>
                <div class="stat">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <h3>Approved Applications</h3>
                    <p>15</p>
                </div>
                <div class="stat">
                    <i class="fas fa-times-circle stat-icon"></i>
                    <h3>Rejected Applications</h3>
                    <p>10</p>
                </div>
            </div>
        </section>

        <section id="visa-status" class="content-section">
            <h2 class="section-title">Visa Status Tracking</h2>
            <p>Visa status tracking information will be displayed here.</p>
        </section>

        <section id="visa-reports" class="content-section">
            <h2 class="section-title">Visa Reports</h2>
            <p>Visa reports and analytics will be displayed here.</p>
        </section>

        <section id="blog-posts" class="content-section">
            <h2 class="section-title">Blog Posts</h2>
            <form action="blog-news.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="blogTitle">Blog Title:</label>
                    <textarea id="blogTitle" name="blogTitle" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="blogContent">Blog Content:</label>
                    <textarea id="blogContent" name="blogContent" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="blogImage">Blog Image:</label>
                    <input type="file" id="blogImage" name="blogImage" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="blogUrl">Blog Url:</label>
                    <input type="url" id="blogUrl" name="blogUrl" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </section>

        <section id="blog-categories" class="content-section">
            <h2 class="section-title">Blog Categories</h2>
            <p>Blog categories management will be displayed here.</p>
        </section>

        <section id="blog-comments" class="content-section">
            <h2 class="section-title">Uploaded Blogs</h2>

            <div class="table-container">
                <?php
                $sql = "SELECT * from blog_news";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>content</th>
                                <th>image</th>
                                <th>url</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delet</th>
                            </tr>
                        </thead>
                        <tbody>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                            <td>' . htmlspecialchars($row['id']) . '</td>
                            <td>' . htmlspecialchars($row['title']) . '</td>
                            <td>' . htmlspecialchars($row['content']) . '</td>';
                        echo "<td><img width='70' src='{$row['image']}'</td>";
                        echo ' <td>' . htmlspecialchars($row['url']) . '</td>
                            <td>' . htmlspecialchars($row['created_at']) . '</td>
                            <td>
                                <a href="edit_blog.php?id=' . htmlspecialchars($row['id']) . '" class="btn-edit">Edit</a>
                            </td>
                            <td>
                                <a href="delete_blog.php?id=' . htmlspecialchars($row['id']) . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a>
                            </td>
                        </tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo '<p class="no-data">No users found.</p>';
                }
                ?>
            </div>
        </section>

        <!-- Updated section for Eligibility Check table -->
        <section id="eligibility-check" class="content-section">
            <h2 class="section-title">Eligibility Check Records</h2>
            <div class="table-container">
                <?php
                if ($result_eligibility && $result_eligibility->num_rows > 0) {
                    echo '<table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Mobile Number</th>
                                <th>Nationality</th>
                                <th>Aadhar Card</th>
                                <th>10th %</th>
                                <th>12th %</th>
                                <th>10th Marksheet</th>
                                <th>12th Marksheet</th>
                                <th>Higher Education</th>
                                <th>Degree Certificate</th>
                                <th>Known Languages</th>
                                <th>IELTS Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>';

                    while ($row = $result_eligibility->fetch_assoc()) {
                        echo '<tr>
                            <td>' . htmlspecialchars($row['ECF_id']) . '</td>
                            <td>' . htmlspecialchars($row['First_name']) . '</td>
                            <td>' . htmlspecialchars($row['Last_name']) . '</td>
                            <td>' . htmlspecialchars($row['Email']) . '</td>
                            <td>' . htmlspecialchars($row['DOB']) . '</td>
                            <td>' . htmlspecialchars($row['Gender']) . '</td>
                            <td>' . htmlspecialchars($row['Mobile_number']) . '</td>
                            <td>' . htmlspecialchars($row['Nationality']) . '</td>
                            <td>';
                        if ($row['Aadhar_card']) echo '<a href="../' . htmlspecialchars($row['Aadhar_card']) . '" target="_blank" class="btn-edit">View</a>';
                        echo '</td>
                            <td>' . htmlspecialchars($row['Education_10th_percentage']) . '%</td>
                            <td>' . htmlspecialchars($row['Education_12th_percentage']) . '%</td>
                            <td>';
                        if ($row['Marksheet_10th']) echo '<a href="../' . htmlspecialchars($row['Marksheet_10th']) . '" target="_blank" class="btn-edit">View</a>';
                        echo '</td>
                            <td>';
                        if ($row['Marksheet_12th']) echo '<a href="../' . htmlspecialchars($row['Marksheet_12th']) . '" target="_blank" class="btn-edit">View</a>';
                        echo '</td>
                            <td>' . htmlspecialchars($row['Higher_education_name'] ?? 'N/A') . '</td>
                            <td>';
                        if ($row['Degree_certificate']) echo '<a href="../' . htmlspecialchars($row['Degree_certificate']) . '" target="_blank" class="btn-edit">View</a>';
                        echo '</td>
                            <td>' . htmlspecialchars($row['Known_languages']) . '</td>
                            <td>' . htmlspecialchars($row['Ielts_status']) . '</td>
                            <td>
                                <a href="Delete_eligibilityrow.php?delete_id=' . htmlspecialchars($row['ECF_id']) . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a>
                            </td>
                        </tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo '<p class="no-data">No eligibility records found.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <script src="js/admin-dashboard.js"></script>
</body>

</html>