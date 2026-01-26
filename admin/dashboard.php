<?php
// Enable error display for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$page = $_GET['page'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Pebbles Elementary</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 20px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar .logout {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
        }

        .user-info {
            text-align: right;
        }

        .user-info p {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .card-number {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
        }

        .card a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .card a:hover {
            text-decoration: underline;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .button-group {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #764ba2;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .admin-container {
                flex-direction: column;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="?page=dashboard" class="<?php echo $page === 'dashboard' ? 'active' : ''; ?>">Dashboard</a></li>
                <li><a href="?page=gallery" class="<?php echo $page === 'gallery' ? 'active' : ''; ?>">Gallery</a></li>
                <li><a href="?page=news" class="<?php echo $page === 'news' ? 'active' : ''; ?>">News</a></li>
                <li><a href="?page=newsletter" class="<?php echo $page === 'newsletter' ? 'active' : ''; ?>">Newsletters</a></li>
                <li><a href="?page=events" class="<?php echo $page === 'events' ? 'active' : ''; ?>">Events</a></li>
            </ul>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="main-content">
            <div class="header">
                <h1><?php echo ucfirst($page); ?></h1>
                <div class="user-info">
                    <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['admin_user']); ?></strong></p>
                    <p><?php echo date('F j, Y'); ?></p>
                </div>
            </div>

            <?php
            if ($page === 'dashboard') {
                include 'pages/dashboard.php';
            } elseif ($page === 'gallery') {
                include 'pages/gallery.php';
            } elseif ($page === 'news') {
                include 'pages/news.php';
            } elseif ($page === 'newsletter') {
                include 'pages/newsletter.php';
            } elseif ($page === 'events') {
                include 'pages/events.php';
            } else {
                include 'pages/dashboard.php';
            }
            ?>
        </div>
    </div>
</body>

</html>