<?php
// Events calendar management page
if (!isset($conn)) {
    require_once dirname(__DIR__) . '/config.php';
}

$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_event'])) {
        $event_name = $conn->real_escape_string($_POST['event_name']);
        $event_description = $conn->real_escape_string($_POST['event_description']);
        $event_date = $conn->real_escape_string($_POST['event_date']);
        $event_location = $conn->real_escape_string($_POST['event_location']);
        $featured = isset($_POST['featured']) ? 1 : 0;
        $is_published = isset($_POST['is_published']) ? 1 : 0;

        // Handle image upload
        $event_image = '';
        if (!empty($_FILES['event_image']['name'])) {
            $target_dir = dirname(__DIR__) . '/uploads/events/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = time() . '_' . basename($_FILES['event_image']['name']);
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file)) {
                $event_image = 'uploads/events/' . $file_name;
            }
        }

        $image_sql = $event_image ? ", event_image='$event_image'" : '';
        $sql = "INSERT INTO events (event_name, event_description, event_date, event_location, featured, is_published $image_sql) 
                VALUES ('$event_name', '$event_description', '$event_date', '$event_location', $featured, $is_published)";

        if ($conn->query($sql)) {
            $message = 'Event created successfully!';
            $action = 'list';
        } else {
            $error = 'Error creating event: ' . $conn->error;
        }
    }

    if (isset($_POST['edit_event'])) {
        $id = intval($_POST['id']);
        $event_name = $conn->real_escape_string($_POST['event_name']);
        $event_description = $conn->real_escape_string($_POST['event_description']);
        $event_date = $conn->real_escape_string($_POST['event_date']);
        $event_location = $conn->real_escape_string($_POST['event_location']);
        $featured = isset($_POST['featured']) ? 1 : 0;
        $is_published = isset($_POST['is_published']) ? 1 : 0;

        $image_sql = '';
        if (!empty($_FILES['event_image']['name'])) {
            $target_dir = dirname(__DIR__) . '/uploads/events/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = time() . '_' . basename($_FILES['event_image']['name']);
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file)) {
                $image_sql = ", event_image='uploads/events/" . $file_name . "'";
            }
        }

        $sql = "UPDATE events SET event_name='$event_name', event_description='$event_description', 
                event_date='$event_date', event_location='$event_location', featured=$featured, 
                is_published=$is_published $image_sql WHERE id=$id";

        if ($conn->query($sql)) {
            $message = 'Event updated successfully!';
            $action = 'list';
        } else {
            $error = 'Error updating event: ' . $conn->error;
        }
    }

    if (isset($_POST['delete_event'])) {
        $id = intval($_POST['id']);
        $sql = "DELETE FROM events WHERE id=$id";
        if ($conn->query($sql)) {
            $message = 'Event deleted successfully!';
            $action = 'list';
        } else {
            $error = 'Error deleting event: ' . $conn->error;
        }
    }
}

// Get events
$events = [];
$result = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
?>

<style>
    .form-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="datetime-local"],
    .form-group textarea,
    .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
    }

    .form-group textarea {
        min-height: 150px;
        resize: vertical;
    }

    .checkbox-group {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }

    .checkbox-group label {
        display: flex;
        align-items: center;
        margin: 0;
    }

    .checkbox-group input[type="checkbox"] {
        margin-right: 8px;
        width: auto;
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.3s;
    }

    .btn-primary {
        background: #667eea;
        color: white;
    }

    .btn-primary:hover {
        background: #764ba2;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .message {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .event-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        display: flex;
        gap: 20px;
    }

    .event-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        flex-shrink: 0;
    }

    .event-content {
        flex: 1;
    }

    .event-content h3 {
        color: #667eea;
        margin-bottom: 10px;
    }

    .event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 10px;
        font-size: 14px;
        color: #666;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-published {
        background: #d4edda;
        color: #155724;
    }

    .status-draft {
        background: #fff3cd;
        color: #856404;
    }

    .status-featured {
        background: #cce5ff;
        color: #004085;
    }

    .event-description {
        color: #555;
        margin-bottom: 15px;
        font-size: 14px;
        line-height: 1.5;
    }

    .event-actions {
        display: flex;
        gap: 10px;
    }

    .event-actions .btn {
        padding: 8px 15px;
        font-size: 13px;
    }

    .no-image {
        width: 150px;
        height: 150px;
        background: #f0f0f0;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        text-align: center;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .event-card {
            flex-direction: column;
        }

        .event-image,
        .no-image {
            width: 100%;
            height: auto;
        }

        .event-actions {
            flex-wrap: wrap;
        }
    }
</style>

<div class="button-group" style="margin-bottom: 20px;">
    <a href="?page=events&action=create" class="btn btn-primary">Create New Event</a>
</div>

<?php if ($message): ?>
    <div class="message"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<?php if ($action === 'create'): ?>
    <div class="form-container">
        <h2>Create New Event</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="event_name">Event Name</label>
                <input type="text" id="event_name" name="event_name" required placeholder="e.g., Annual Sports Day">
            </div>

            <div class="form-group">
                <label for="event_description">Event Description</label>
                <textarea id="event_description" name="event_description" required placeholder="Enter event description"></textarea>
            </div>

            <div class="form-group">
                <label for="event_date">Event Date & Time</label>
                <input type="datetime-local" id="event_date" name="event_date" required>
            </div>

            <div class="form-group">
                <label for="event_location">Event Location</label>
                <input type="text" id="event_location" name="event_location" required placeholder="e.g., School Sports Field">
            </div>

            <div class="form-group">
                <label for="event_image">Event Image</label>
                <input type="file" id="event_image" name="event_image" accept="image/*">
                <small style="color: #666;">Optional. Upload an image for the event.</small>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="featured"> Feature on homepage
                    </label>
                    <label>
                        <input type="checkbox" name="is_published" checked> Publish event
                    </label>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" name="create_event" class="btn btn-primary">Create Event</button>
                <a href="?page=events" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php elseif ($action === 'edit' && isset($_GET['id'])): ?>
    <?php
    $id = intval($_GET['id']);
    $event = null;
    foreach ($events as $e) {
        if ($e['id'] == $id) {
            $event = $e;
            break;
        }
    }
    if (!$event) {
        echo '<div class="error">Event not found.</div>';
    } else {
    ?>
        <div class="form-container">
            <h2>Edit Event</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">

                <div class="form-group">
                    <label for="event_name">Event Name</label>
                    <input type="text" id="event_name" name="event_name" required value="<?php echo htmlspecialchars($event['event_name']); ?>">
                </div>

                <div class="form-group">
                    <label for="event_description">Event Description</label>
                    <textarea id="event_description" name="event_description" required><?php echo htmlspecialchars($event['event_description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="event_date">Event Date & Time</label>
                    <input type="datetime-local" id="event_date" name="event_date" required value="<?php echo str_replace(' ', 'T', $event['event_date']); ?>">
                </div>

                <div class="form-group">
                    <label for="event_location">Event Location</label>
                    <input type="text" id="event_location" name="event_location" required value="<?php echo htmlspecialchars($event['event_location']); ?>">
                </div>

                <div class="form-group">
                    <label for="event_image">Event Image</label>
                    <?php if ($event['event_image']): ?>
                        <div style="margin-bottom: 10px;">
                            <img src="<?php echo 'admin/' . htmlspecialchars($event['event_image']); ?>" style="max-width: 200px; max-height: 200px; border-radius: 5px;">
                            <p style="font-size: 12px; color: #666; margin-top: 5px;">Upload a new image to replace</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" id="event_image" name="event_image" accept="image/*">
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="featured" <?php echo $event['featured'] ? 'checked' : ''; ?>> Feature on homepage
                        </label>
                        <label>
                            <input type="checkbox" name="is_published" <?php echo $event['is_published'] ? 'checked' : ''; ?>> Publish event
                        </label>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" name="edit_event" class="btn btn-primary">Update Event</button>
                    <a href="?page=events" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
<?php else: ?>
    <h2>Events Calendar</h2>
    <?php if (empty($events)): ?>
        <div class="message">No events found. <a href="?page=events&action=create">Create one now</a></div>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <?php if ($event['event_image']): ?>
                    <img src="<?php echo 'admin/' . htmlspecialchars($event['event_image']); ?>" alt="Event image" class="event-image">
                <?php else: ?>
                    <div class="no-image">No Image</div>
                <?php endif; ?>

                <div class="event-content">
                    <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>

                    <div class="event-meta">
                        <span><strong>Date:</strong> <?php echo date('F j, Y g:i A', strtotime($event['event_date'])); ?></span>
                        <span><strong>Location:</strong> <?php echo htmlspecialchars($event['event_location']); ?></span>
                        <span>
                            <span class="status-badge <?php echo $event['is_published'] ? 'status-published' : 'status-draft'; ?>">
                                <?php echo $event['is_published'] ? 'Published' : 'Draft'; ?>
                            </span>
                        </span>
                        <?php if ($event['featured']): ?>
                            <span>
                                <span class="status-badge status-featured">⭐ Featured</span>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="event-description">
                        <?php echo htmlspecialchars(substr($event['event_description'], 0, 200)); ?>...
                    </div>

                    <div class="event-actions">
                        <a href="?page=events&action=edit&id=<?php echo $event['id']; ?>" class="btn btn-secondary">Edit</a>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                            <button type="submit" name="delete_event" class="btn btn-danger" onclick="return confirm('Delete this event?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>