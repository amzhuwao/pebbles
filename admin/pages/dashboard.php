<?php
$stats = ['sections' => 0, 'news' => 0, 'photos' => 0, 'newsletters' => 0, 'events' => 0];
if (isset($conn) && !$conn->connect_error) {
    if ($res = $conn->query('SELECT COUNT(*) AS c FROM gallery_sections')) {
        $row = $res->fetch_assoc();
        $stats['sections'] = (int)$row['c'];
    }
    if ($res = $conn->query('SELECT COUNT(*) AS c FROM news_articles')) {
        $row = $res->fetch_assoc();
        $stats['news'] = (int)$row['c'];
    }
    if ($res = $conn->query('SELECT COUNT(*) AS c FROM gallery_photos')) {
        $row = $res->fetch_assoc();
        $stats['photos'] = (int)$row['c'];
    }
    if ($res = $conn->query('SELECT COUNT(*) AS c FROM newsletters')) {
        $row = $res->fetch_assoc();
        $stats['newsletters'] = (int)$row['c'];
    }
    if ($res = $conn->query('SELECT COUNT(*) AS c FROM events')) {
        $row = $res->fetch_assoc();
        $stats['events'] = (int)$row['c'];
    }
}
?>

<div class="dashboard-grid">
    <div class="card">
        <h3>Gallery Sections</h3>
        <div class="card-number"><?php echo $stats['sections']; ?></div>
        <p>Manage your photo gallery sections</p>
        <a href="?page=gallery">Go to Gallery →</a>
    </div>

    <div class="card">
        <h3>News Articles</h3>
        <div class="card-number"><?php echo $stats['news']; ?></div>
        <p>Create and manage news articles</p>
        <a href="?page=news">Go to News →</a>
    </div>

    <div class="card">
        <h3>Newsletters</h3>
        <div class="card-number"><?php echo $stats['newsletters']; ?></div>
        <p>Create and send newsletters</p>
        <a href="?page=newsletter">Go to Newsletters →</a>
    </div>

    <div class="card">
        <h3>Events</h3>
        <div class="card-number"><?php echo $stats['events']; ?></div>
        <p>Manage school calendar events</p>
        <a href="?page=events">Go to Events →</a>
    </div>

    <div class="card">
        <h3>Total Photos</h3>
        <div class="card-number"><?php echo $stats['photos']; ?></div>
        <p>Photos uploaded to gallery</p>
    </div>
</div>

<div class="card">
    <h2>Welcome to Pebbles Elementary Admin Dashboard</h2>
    <p>Use the sidebar menu to navigate between sections. You can:</p>
    <ul style="margin-left: 20px; margin-top: 15px;">
        <li>Create and organize gallery sections</li>
        <li>Upload photos to gallery sections</li>
        <li>Create and publish news articles</li>
        <li>Create and send newsletters to parents</li>
        <li>Manage school events and calendar</li>
        <li>Manage all content from this admin panel</li>
    </ul>
</div>