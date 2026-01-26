<?php
// Include config for database connection
require_once __DIR__ . '/admin/config.php';

// Fetch all gallery sections with their photos
$sections = $conn->query("SELECT * FROM gallery_sections ORDER BY display_order");
$gallery_data = [];
if ($sections && $sections->num_rows > 0) {
    while ($section = $sections->fetch_assoc()) {
        $photos = $conn->query("SELECT * FROM gallery_photos WHERE section_id = " . $section['id'] . " ORDER BY display_order");
        $section['photos'] = [];
        if ($photos && $photos->num_rows > 0) {
            while ($photo = $photos->fetch_assoc()) {
                $section['photos'][] = $photo;
            }
        }
        $gallery_data[] = $section;
    }
}

// Include header
include 'header.php';
?>

<div id="sj-outer-row-id-1" class="bs3-clearfix sj-outer-row sj-outer-row-1 sj-outer-row-odd">
    <div class="bs3-clearfix sj-content-row sj-content-row-1 sj-content-row-odd">
        <div class="column column-1col">
            <div id="element_gallery" class="element element-gallery">
                <div class="sj_element_gallery">
                    <?php
                    if (!empty($gallery_data)) {
                        foreach ($gallery_data as $section) {
                            echo '<h2 style="color: #667eea; margin-top: 30px; margin-bottom: 10px;">' . htmlspecialchars($section['section_name']) . '</h2>';
                            if ($section['description']) {
                                echo '<p style="color: #666; margin-bottom: 20px;">' . htmlspecialchars($section['description']) . '</p>';
                            }

                            if (!empty($section['photos'])) {
                                echo '<div class="photo-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; margin-bottom: 30px;">';
                                foreach ($section['photos'] as $photo) {
                                    echo '<div class="photo-item" style="border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s ease;">';
                                    echo '<div style="position: relative; overflow: hidden; background: #f0f0f0;">';
                                    $img_path = 'admin/' . htmlspecialchars($photo['photo_path']);
                                    echo '<img src="' . $img_path . '" alt="' . htmlspecialchars($photo['photo_title']) . '" style="width: 100%; height: 250px; object-fit: cover; display: block; transition: transform 0.3s ease;">';
                                    echo '</div>';
                                    if ($photo['photo_title']) {
                                        echo '<div style="padding: 12px; background: white;">';
                                        echo '<h4 style="margin: 0; color: #333; font-size: 16px;">' . htmlspecialchars($photo['photo_title']) . '</h4>';
                                        if ($photo['photo_description']) {
                                            echo '<p style="margin: 5px 0 0 0; color: #666; font-size: 13px;">' . htmlspecialchars($photo['photo_description']) . '</p>';
                                        }
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                        }
                    } else {
                        echo '<p>No gallery sections available.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include 'footer.php';
$conn->close();
