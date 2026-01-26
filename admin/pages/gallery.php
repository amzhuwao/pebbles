<?php
// This file is included from dashboard.php
// Config, session, and $conn are already available
// No need to re-include config.php

// Verify we have database connection (should be from dashboard.php)
if (!isset($conn)) {
    echo '<div style="background:#f8d7da;color:#721c24;padding:20px;border-radius:8px;margin:20px 0;border-left:4px solid #dc3545;">';
    echo '<h3>⚠️ Configuration Error</h3>';
    echo 'Database connection not available. This page must be accessed through dashboard.php';
    echo '</div>';
    return; // Stop execution of this file
}

// Check if there's a database connection error
if ($conn->connect_error) {
    $error = "Database connection failed: " . $conn->connect_error;
}

// Test error display (remove this after confirming errors show)
if (isset($_GET['test_error'])) {
    $error = "This is a test error message to verify error display is working!";
}
if (isset($_GET['test_success'])) {
    $success = "This is a test success message to verify success display is working!";
}

// Handle adding new section
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_section') {
    $section_name = $conn->real_escape_string($_POST['section_name']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO gallery_sections (section_name, description) VALUES ('$section_name', '$description')";
    if ($conn->query($sql)) {
        $success = "Section added successfully!";
    } else {
        $error = "Error adding section: " . $conn->error;
    }
}

// Handle updating section
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['action'])
    && $_POST['action'] === 'update_section'
) {
    $section_id = (int)($_POST['section_id'] ?? 0);
    $section_name = $conn->real_escape_string($_POST['section_name'] ?? '');
    $description = $conn->real_escape_string($_POST['description'] ?? '');
    $display_order = (int)($_POST['display_order'] ?? 0);

    if ($section_id > 0 && $section_name !== '') {
        $sql = "UPDATE gallery_sections 
                SET section_name = '$section_name', description = '$description', display_order = $display_order 
                WHERE id = $section_id";
        if ($conn->query($sql)) {
            $success = "Section updated successfully!";
            // Clear edit state
            unset($_GET['edit_section']);
        } else {
            $error = "Error updating section: " . $conn->error;
        }
    } else {
        $error = "Section name is required.";
    }
}

// Handle photo upload
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['action'])
    && $_POST['action'] === 'upload_photo'
    && isset($_FILES['photo'])
) {
    $section_id = (int)$_POST['section_id'];
    $photo_title = $conn->real_escape_string($_POST['photo_title']);
    $photo_description = $conn->real_escape_string($_POST['photo_description']);

    if ($_FILES['photo']['size'] > 0 && $_FILES['photo']['size'] <= 5 * 1024 * 1024) {
        $file_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($file_ext, $allowed_ext)) {
            $filename = time() . '_' . uniqid() . '.' . $file_ext;
            $upload_path = '../uploads/gallery/' . $filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                $photo_path = 'uploads/gallery/' . $filename;
                $sql = "INSERT INTO gallery_photos (section_id, photo_title, photo_description, photo_path) 
                        VALUES ($section_id, '$photo_title', '$photo_description', '$photo_path')";

                if ($conn->query($sql)) {
                    $success = "Photo uploaded successfully!";
                } else {
                    $error = "Error saving photo: " . $conn->error;
                }
            } else {
                $error = "Error uploading file";
            }
        } else {
            $error = "Invalid file type. Allowed: jpg, jpeg, png, gif, webp";
        }
    } else {
        $error = "File size exceeds 5MB limit";
    }
}

// Handle updating photo details (and optional image replace)
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['action'])
    && $_POST['action'] === 'update_photo'
) {
    $photo_id = (int)($_POST['photo_id'] ?? 0);
    $section_id = (int)($_POST['section_id'] ?? 0);
    $photo_title = $conn->real_escape_string($_POST['photo_title'] ?? '');
    $photo_description = $conn->real_escape_string($_POST['photo_description'] ?? '');
    $display_order = (int)($_POST['display_order'] ?? 0);

    if ($photo_id > 0 && $section_id > 0 && $photo_title !== '') {
        // Get current photo for path
        $current = $conn->query("SELECT photo_path FROM gallery_photos WHERE id = $photo_id");
        $current_path = null;
        if ($current && $row = $current->fetch_assoc()) {
            $current_path = $row['photo_path'];
        }

        $set_image_sql = '';
        // If a new image is uploaded, validate and replace
        if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
            if ($_FILES['photo']['size'] <= 5 * 1024 * 1024) {
                $file_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($file_ext, $allowed_ext)) {
                    $filename = time() . '_' . uniqid() . '.' . $file_ext;
                    $upload_path = '../uploads/gallery/' . $filename;
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                        $new_photo_path = 'uploads/gallery/' . $filename;
                        $set_image_sql = ", photo_path = '" . $conn->real_escape_string($new_photo_path) . "'";
                        // Remove old file
                        if ($current_path) {
                            @unlink('../' . $current_path);
                        }
                    } else {
                        $error = "Error uploading replacement image.";
                    }
                } else {
                    $error = "Invalid file type. Allowed: jpg, jpeg, png, gif, webp";
                }
            } else {
                $error = "File size exceeds 5MB limit";
            }
        }

        if (!isset($error)) {
            $sql = "UPDATE gallery_photos 
                    SET section_id = $section_id, photo_title = '$photo_title', photo_description = '$photo_description', display_order = $display_order $set_image_sql
                    WHERE id = $photo_id";
            if ($conn->query($sql)) {
                $success = "Photo updated successfully!";
                unset($_GET['edit_photo']);
            } else {
                $error = "Error updating photo: " . $conn->error;
            }
        }
    } else {
        $error = "Title and section are required.";
    }
}

// Handle reordering sections
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reorder_sections') {
    try {
        $sections_order = json_decode($_POST['sections_order'] ?? '[]', true);
        if (!is_array($sections_order)) {
            throw new Exception('Invalid sections order data');
        }
        $order = 10;
        foreach ($sections_order as $section_id) {
            $section_id = (int)$section_id;
            if (!$conn->query("UPDATE gallery_sections SET display_order = $order WHERE id = $section_id")) {
                throw new Exception('Database error: ' . $conn->error);
            }
            $order += 10;
        }
        echo json_encode(['success' => true, 'message' => 'Sections reordered']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

// Handle reordering photos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reorder_photos') {
    try {
        $photos_order = json_decode($_POST['photos_order'] ?? '[]', true);
        if (!is_array($photos_order)) {
            throw new Exception('Invalid photos order data');
        }
        $order = 10;
        foreach ($photos_order as $photo_id) {
            $photo_id = (int)$photo_id;
            if (!$conn->query("UPDATE gallery_photos SET display_order = $order WHERE id = $photo_id")) {
                throw new Exception('Database error: ' . $conn->error);
            }
            $order += 10;
        }
        echo json_encode(['success' => true, 'message' => 'Photos reordered']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

// Delete section
if (isset($_GET['delete_section'])) {
    $section_id = (int)$_GET['delete_section'];
    $sql = "DELETE FROM gallery_sections WHERE id = $section_id";
    if ($conn->query($sql)) {
        $success = "Section deleted successfully!";
    } else {
        $error = "Failed to delete section: " . $conn->error;
    }
}

// Delete photo
if (isset($_GET['delete_photo'])) {
    $photo_id = (int)$_GET['delete_photo'];
    $result = $conn->query("SELECT photo_path FROM gallery_photos WHERE id = $photo_id");
    if ($result && $row = $result->fetch_assoc()) {
        @unlink('../' . $row['photo_path']);
    }
    $sql = "DELETE FROM gallery_photos WHERE id = $photo_id";
    if ($conn->query($sql)) {
        $success = "Photo deleted successfully!";
    } else {
        $error = "Failed to delete photo: " . $conn->error;
    }
}

// Get all sections
$sections = null;
if (isset($conn) && !$conn->connect_error) {
    $sections = $conn->query("SELECT * FROM gallery_sections ORDER BY display_order");
    if (!$sections) {
        $error = "Failed to fetch sections: " . $conn->error;
    }
}

// Prefetch one section for editing
$edit_section = null;
if (isset($_GET['edit_section'])) {
    $edit_id = (int)$_GET['edit_section'];
    $res = $conn->query("SELECT * FROM gallery_sections WHERE id = $edit_id");
    if ($res && $res->num_rows > 0) {
        $edit_section = $res->fetch_assoc();
    }
}

// Prefetch one photo for editing
$edit_photo = null;
if (isset($_GET['edit_photo'])) {
    $edit_pid = (int)$_GET['edit_photo'];
    $res = $conn->query("SELECT * FROM gallery_photos WHERE id = $edit_pid");
    if ($res && $res->num_rows > 0) {
        $edit_photo = $res->fetch_assoc();
    }
}
?>

<style>
    .form-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: inherit;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    input[type="file"] {
        padding: 10px;
    }

    .section-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .section-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .section-card h3 {
        color: #667eea;
        margin-bottom: 10px;
    }

    .section-card p {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .photo-item {
        position: relative;
        border-radius: 5px;
        overflow: hidden;
        background: #f0f0f0;
    }

    .photo-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .photo-item .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 0, 0, 0.8);
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 12px;
    }

    .photo-item .delete-btn:hover {
        background: rgba(255, 0, 0, 1);
    }

    .draggable-item {
        cursor: move;
        opacity: 1;
        transition: opacity 0.2s;
    }

    .draggable-item.dragging {
        opacity: 0.5;
    }

    .drag-handle {
        display: inline-block;
        margin-right: 10px;
        color: #999;
        cursor: grab;
        font-size: 16px;
    }

    .drag-handle:active {
        cursor: grabbing;
    }

    .tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        border-bottom: 2px solid #ddd;
    }

    .tab-btn {
        padding: 10px 20px;
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        font-weight: 600;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }

    .tab-btn.active {
        color: #667eea;
        border-bottom-color: #667eea;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 500;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        animation: slideIn 0.3s ease;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-left: 4px solid #28a745;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-left: 4px solid #dc3545;
    }

    .alert-warning {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
        border-left: 4px solid #ffc107;
    }

    .alert-icon {
        margin-right: 10px;
        font-size: 18px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?php
// Display error and success messages
// Database connection error
if (isset($conn) && $conn->connect_error) {
    echo '<div class="alert alert-error">';
    echo '<span class="alert-icon">⚠️</span>';
    echo '<strong>Database Error:</strong> ' . htmlspecialchars($conn->connect_error);
    echo '</div>';
}

// Success messages
if (isset($success)) {
    echo '<div class="alert alert-success">';
    echo '<span class="alert-icon">✓</span>';
    echo htmlspecialchars($success);
    echo '</div>';
}

// Error messages
if (isset($error)) {
    echo '<div class="alert alert-error">';
    echo '<span class="alert-icon">✖</span>';
    echo '<strong>Error:</strong> ' . htmlspecialchars($error);
    echo '</div>';
}

// PHP errors (if any were captured)
$php_errors = error_get_last();
if ($php_errors && in_array($php_errors['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
    echo '<div class="alert alert-error">';
    echo '<span class="alert-icon">⚠️</span>';
    echo '<strong>PHP Error:</strong> ' . htmlspecialchars($php_errors['message']);
    echo '<br><small>File: ' . htmlspecialchars($php_errors['file']) . ' | Line: ' . $php_errors['line'] . '</small>';
    echo '</div>';
}

// Debug: Show if we're in error checking mode
if (isset($_GET['debug'])) {
    echo '<div class="alert alert-warning">';
    echo '<span class="alert-icon">ℹ️</span>';
    echo '<strong>Debug Info:</strong><br>';
    echo 'Conn exists: ' . (isset($conn) ? 'Yes' : 'No') . '<br>';
    echo 'Error var: ' . (isset($error) ? htmlspecialchars($error) : 'Not set') . '<br>';
    echo 'Success var: ' . (isset($success) ? htmlspecialchars($success) : 'Not set') . '<br>';
    echo 'PHP Version: ' . phpversion();
    echo '</div>';
}
?>

<div class="tabs">
    <button class="tab-btn active" onclick="switchTab('sections')">Manage Sections</button>
    <button class="tab-btn" onclick="switchTab('upload')">Upload Photos</button>
    <button class="tab-btn" onclick="switchTab('edit-photo')">Edit Photo</button>
</div>

<!-- Sections Tab -->
<div id="sections" class="tab-content active">
    <?php if ($edit_section): ?>
        <div class="form-container">
            <h3>Edit Section</h3>
            <form method="POST">
                <input type="hidden" name="action" value="update_section">
                <input type="hidden" name="section_id" value="<?php echo (int)$edit_section['id']; ?>">
                <div class="form-group">
                    <label for="edit_section_name">Section Name</label>
                    <input type="text" id="edit_section_name" name="section_name" value="<?php echo htmlspecialchars($edit_section['section_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="edit_description">Description</label>
                    <textarea id="edit_description" name="description"><?php echo htmlspecialchars($edit_section['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="edit_display_order">Display Order</label>
                    <input type="number" id="edit_display_order" name="display_order" value="<?php echo (int)$edit_section['display_order']; ?>">
                </div>
                <div class="button-group">
                    <button type="submit" class="btn">Update Section</button>
                    <a class="btn btn-secondary" href="?page=gallery" style="text-decoration:none; text-align:center;">Cancel</a>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <h3>Add New Section</h3>
        <form method="POST">
            <input type="hidden" name="action" value="add_section">
            <div class="form-group">
                <label for="section_name">Section Name</label>
                <input type="text" id="section_name" name="section_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn">Add Section</button>
        </form>
    </div>

    <div class="section-grid" id="sections-sortable">
        <?php
        if ($sections && $sections->num_rows > 0) {
            while ($section = $sections->fetch_assoc()) {
                $photos = $conn->query("SELECT * FROM gallery_photos WHERE section_id = " . $section['id'] . " ORDER BY display_order");
                $photo_count = $photos ? $photos->num_rows : 0;

                echo '<div class="section-card draggable-item" draggable="true" data-id="' . $section['id'] . '">';
                echo '<span class="drag-handle">⋮⋮</span>';
                echo '<h3>' . htmlspecialchars($section['section_name']) . '</h3>';
                echo '<p>' . htmlspecialchars($section['description']) . '</p>';
                echo '<p><strong>' . $photo_count . '</strong> photos</p>';
                echo '<div class="button-group" style="display:flex; gap:10px;">';
                echo '<a href="?page=gallery&edit_section=' . $section['id'] . '" class="btn" style="font-size: 12px;">Edit</a>';
                echo '<a href="?page=gallery&delete_section=' . $section['id'] . '" onclick="return confirm(\'Delete this section and all its photos?\');" class="btn btn-secondary" style="font-size: 12px;">Delete</a>';
                echo '</div>';

                if ($photo_count > 0) {
                    echo '<div class="photo-grid" data-section-id="' . $section['id'] . '">';
                    while ($photo = $photos->fetch_assoc()) {
                        echo '<div class="photo-item draggable-item" draggable="true" data-id="' . $photo['id'] . '" data-section="' . $section['id'] . '">';
                        echo '<img src="../' . htmlspecialchars($photo['photo_path']) . '" alt="' . htmlspecialchars($photo['photo_title']) . '">';
                        echo '<a href="?page=gallery&edit_photo=' . $photo['id'] . '" class="delete-btn" style="background: rgba(0,0,0,0.6);">Edit</a>';
                        echo '<a href="?page=gallery&delete_photo=' . $photo['id'] . '" class="delete-btn" style="top: 36px;" onclick="return confirm(\'Delete this photo?\');">Delete</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

<!-- Upload Photos Tab -->
<div id="upload" class="tab-content">
    <div class="form-container">
        <h3>Upload Photo</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="upload_photo">
            <div class="form-group">
                <label for="section_id">Select Section</label>
                <select id="section_id" name="section_id" required>
                    <option value="">-- Choose a section --</option>
                    <?php
                    $sections = $conn->query("SELECT * FROM gallery_sections ORDER BY section_name");
                    while ($section = $sections->fetch_assoc()) {
                        echo '<option value="' . $section['id'] . '">' . htmlspecialchars($section['section_name']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="photo_title">Photo Title</label>
                <input type="text" id="photo_title" name="photo_title" required>
            </div>
            <div class="form-group">
                <label for="photo_description">Photo Description</label>
                <textarea id="photo_description" name="photo_description"></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Select Photo (Max 5MB)</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>
            <button type="submit" class="btn">Upload Photo</button>
        </form>
    </div>
</div>

<!-- Edit Photo Tab -->
<div id="edit-photo" class="tab-content">
    <?php if ($edit_photo): ?>
        <div class="form-container">
            <h3>Edit Photo</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_photo">
                <input type="hidden" name="photo_id" value="<?php echo (int)$edit_photo['id']; ?>">
                <div class="form-group">
                    <label for="edit_section_id">Select Section</label>
                    <select id="edit_section_id" name="section_id" required>
                        <?php
                        $all_sections = $conn->query("SELECT * FROM gallery_sections ORDER BY section_name");
                        while ($sec = $all_sections->fetch_assoc()) {
                            $sel = ((int)$edit_photo['section_id'] === (int)$sec['id']) ? 'selected' : '';
                            echo '<option value="' . $sec['id'] . '" ' . $sel . '>' . htmlspecialchars($sec['section_name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_photo_title">Photo Title</label>
                    <input type="text" id="edit_photo_title" name="photo_title" value="<?php echo htmlspecialchars($edit_photo['photo_title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="edit_photo_description">Photo Description</label>
                    <textarea id="edit_photo_description" name="photo_description"><?php echo htmlspecialchars($edit_photo['photo_description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="edit_display_order_photo">Display Order</label>
                    <input type="number" id="edit_display_order_photo" name="display_order" value="<?php echo (int)$edit_photo['display_order']; ?>">
                </div>
                <div class="form-group">
                    <label for="edit_photo">Replace Image (optional)</label>
                    <input type="file" id="edit_photo" name="photo" accept="image/*">
                    <div style="margin-top:10px; color:#666; font-size: 13px;">
                        Current image: <img src="../<?php echo htmlspecialchars($edit_photo['photo_path']); ?>" style="max-width: 150px; max-height: 100px; border-radius: 5px; vertical-align: middle;">
                    </div>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn">Update Photo</button>
                    <a class="btn btn-secondary" href="?page=gallery" style="text-decoration:none; text-align:center;">Cancel</a>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="form-container">
            <p>Select a photo to edit from the Sections list (use the Edit button on a photo).</p>
        </div>
    <?php endif; ?>

</div>

<script>
    function switchTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

        // Show selected tab
        document.getElementById(tabName).classList.add('active');
        event.target.classList.add('active');
    }

    // If a specific edit is requested, switch to the relevant tab on load
    (function() {
        var hasEditPhoto = <?php echo $edit_photo ? 'true' : 'false'; ?>;
        if (hasEditPhoto) {
            // Activate Edit Photo tab by default
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
                document.getElementById('edit-photo').classList.add('active');
                var btns = document.querySelectorAll('.tab-btn');
                btns.forEach(el => el.classList.remove('active'));
                // third button is Edit Photo
                if (btns[2]) btns[2].classList.add('active');
            });
        }
    })();

    // Drag and drop for sections
    let draggedElement = null;

    document.addEventListener('dragstart', function(e) {
        if (e.target.classList.contains('draggable-item')) {
            draggedElement = e.target;
            e.target.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
        }
    });

    document.addEventListener('dragend', function(e) {
        if (draggedElement) {
            draggedElement.classList.remove('dragging');
            draggedElement = null;
        }
    });

    document.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
    });

    document.addEventListener('drop', function(e) {
        e.preventDefault();

        if (draggedElement && e.target.classList.contains('draggable-item') && draggedElement !== e.target) {
            const parent = draggedElement.parentNode;

            // Swap elements
            const allItems = Array.from(parent.querySelectorAll('.draggable-item'));
            const draggedIndex = allItems.indexOf(draggedElement);
            const targetIndex = allItems.indexOf(e.target.closest('.draggable-item'));

            if (draggedIndex < targetIndex) {
                allItems[targetIndex].after(draggedElement);
            } else {
                allItems[targetIndex].before(draggedElement);
            }

            // Save order via AJAX
            saveReorder();
        }
    });

    function saveReorder() {
        const sections = document.getElementById('sections-sortable');
        if (!sections) {
            console.error('Sections container not found');
            return;
        }

        const sectionsOrder = Array.from(sections.querySelectorAll('.section-card[data-id]'))
            .map(el => el.getAttribute('data-id'));

        console.log('Reordering sections:', sectionsOrder);

        fetch('?page=gallery', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'action=reorder_sections&sections_order=' + encodeURIComponent(JSON.stringify(sectionsOrder))
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Server response:', data);
                if (data.success) {
                    console.log('✓ Sections reordered successfully');
                    showNotification('Sections reordered successfully!', 'success');
                } else {
                    console.error('✖ Reorder failed:', data.error);
                    showNotification('Error: ' + (data.error || 'Unknown error'), 'error');
                }
            })
            .catch(err => {
                console.error('✖ Reorder request failed:', err);
                showNotification('Network error: ' + err.message, 'error');
            });
    }

    // Notification helper
    function showNotification(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-' + (type === 'success' ? 'success' : 'error');
        alertDiv.innerHTML = '<span class="alert-icon">' + (type === 'success' ? '✓' : '✖') + '</span>' + message;
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.zIndex = '9999';
        alertDiv.style.maxWidth = '400px';
        document.body.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.style.opacity = '0';
            alertDiv.style.transition = 'opacity 0.3s';
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    }

    // Global error handler
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.message, 'at', e.filename, 'line', e.lineno);
        showNotification('JavaScript Error: ' + e.message, 'error');
    });

    // Log when page loads
    console.log('Gallery admin page loaded successfully');
</script>