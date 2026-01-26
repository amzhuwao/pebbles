<?php
// Newsletter management page
if (!isset($conn)) {
    require_once dirname(__DIR__) . '/config.php';
}

$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_newsletter'])) {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);

        $sql = "INSERT INTO newsletters (title, content, is_sent, recipient_count) VALUES ('$title', '$content', 0, 0)";
        if ($conn->query($sql)) {
            $message = 'Newsletter created successfully!';
        } else {
            $error = 'Error creating newsletter: ' . $conn->error;
        }
    }

    if (isset($_POST['edit_newsletter'])) {
        $id = intval($_POST['id']);
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);

        $sql = "UPDATE newsletters SET title='$title', content='$content' WHERE id=$id AND is_sent=0";
        if ($conn->query($sql)) {
            $message = 'Newsletter updated successfully!';
            $action = 'list';
        } else {
            $error = 'Error updating newsletter: ' . $conn->error;
        }
    }

    if (isset($_POST['send_newsletter'])) {
        $id = intval($_POST['id']);
        $recipient_count = intval($_POST['recipient_count']);

        $sql = "UPDATE newsletters SET is_sent=1, sent_date=NOW(), recipient_count=$recipient_count WHERE id=$id";
        if ($conn->query($sql)) {
            $message = 'Newsletter sent successfully!';
            $action = 'list';
        } else {
            $error = 'Error sending newsletter: ' . $conn->error;
        }
    }

    if (isset($_POST['delete_newsletter'])) {
        $id = intval($_POST['id']);
        $sql = "DELETE FROM newsletters WHERE id=$id AND is_sent=0";
        if ($conn->query($sql)) {
            $message = 'Newsletter deleted successfully!';
            $action = 'list';
        } else {
            $error = 'Error deleting newsletter: ' . $conn->error;
        }
    }
}

// Get newsletters
$newsletters = [];
$result = $conn->query("SELECT * FROM newsletters ORDER BY created_at DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $newsletters[] = $row;
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
    .form-group textarea,
    .form-group input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
    }

    .form-group textarea {
        min-height: 300px;
        resize: vertical;
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

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-success:hover {
        background: #218838;
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

    .newsletter-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    .newsletter-card h3 {
        color: #667eea;
        margin-bottom: 10px;
    }

    .newsletter-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
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

    .status-sent {
        background: #d4edda;
        color: #155724;
    }

    .status-draft {
        background: #fff3cd;
        color: #856404;
    }

    .newsletter-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .newsletter-actions .btn {
        padding: 8px 15px;
        font-size: 13px;
    }
</style>

<div class="button-group" style="margin-bottom: 20px;">
    <a href="?page=newsletter&action=create" class="btn btn-primary">Create New Newsletter</a>
</div>

<?php if ($message): ?>
    <div class="message"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<?php if ($action === 'create'): ?>
    <div class="form-container">
        <h2>Create New Newsletter</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title">Newsletter Title</label>
                <input type="text" id="title" name="title" required placeholder="e.g., February Newsletter 2026">
            </div>

            <div class="form-group">
                <label for="content">Newsletter Content</label>
                <textarea id="content" name="content" required placeholder="Enter newsletter content (HTML supported)"></textarea>
            </div>

            <div class="button-group">
                <button type="submit" name="create_newsletter" class="btn btn-primary">Create Newsletter</button>
                <a href="?page=newsletter" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php elseif ($action === 'edit' && isset($_GET['id'])): ?>
    <?php
    $id = intval($_GET['id']);
    $newsletter = null;
    foreach ($newsletters as $n) {
        if ($n['id'] == $id) {
            $newsletter = $n;
            break;
        }
    }
    if (!$newsletter) {
        echo '<div class="error">Newsletter not found.</div>';
    } elseif ($newsletter['is_sent']) {
        echo '<div class="error">Cannot edit a sent newsletter.</div>';
    } else {
    ?>
        <div class="form-container">
            <h2>Edit Newsletter</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $newsletter['id']; ?>">

                <div class="form-group">
                    <label for="title">Newsletter Title</label>
                    <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($newsletter['title']); ?>">
                </div>

                <div class="form-group">
                    <label for="content">Newsletter Content</label>
                    <textarea id="content" name="content" required><?php echo htmlspecialchars($newsletter['content']); ?></textarea>
                </div>

                <div class="button-group">
                    <button type="submit" name="edit_newsletter" class="btn btn-primary">Update Newsletter</button>
                    <a href="?page=newsletter" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
<?php elseif ($action === 'send' && isset($_GET['id'])): ?>
    <?php
    $id = intval($_GET['id']);
    $newsletter = null;
    foreach ($newsletters as $n) {
        if ($n['id'] == $id) {
            $newsletter = $n;
            break;
        }
    }
    if (!$newsletter) {
        echo '<div class="error">Newsletter not found.</div>';
    } elseif ($newsletter['is_sent']) {
        echo '<div class="error">This newsletter has already been sent.</div>';
    } else {
    ?>
        <div class="form-container">
            <h2>Send Newsletter</h2>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($newsletter['title']); ?></p>
            <p><strong>Created:</strong> <?php echo date('F j, Y g:i A', strtotime($newsletter['created_at'])); ?></p>

            <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ddd;">
                <h3>Preview</h3>
                <div><?php echo $newsletter['content']; ?></div>
            </div>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $newsletter['id']; ?>">

                <div class="form-group">
                    <label for="recipient_count">Number of Recipients</label>
                    <input type="number" id="recipient_count" name="recipient_count" required min="1" value="150" placeholder="e.g., 150">
                </div>

                <div class="button-group">
                    <button type="submit" name="send_newsletter" class="btn btn-success">Send Newsletter</button>
                    <a href="?page=newsletter" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
<?php else: ?>
    <h2>Newsletters</h2>
    <?php if (empty($newsletters)): ?>
        <div class="message">No newsletters found. <a href="?page=newsletter&action=create">Create one now</a></div>
    <?php else: ?>
        <?php foreach ($newsletters as $newsletter): ?>
            <div class="newsletter-card">
                <h3><?php echo htmlspecialchars($newsletter['title']); ?></h3>
                <div class="newsletter-meta">
                    <span><strong>Created:</strong> <?php echo date('F j, Y g:i A', strtotime($newsletter['created_at'])); ?></span>
                    <span>
                        <strong>Status:</strong>
                        <span class="status-badge <?php echo $newsletter['is_sent'] ? 'status-sent' : 'status-draft'; ?>">
                            <?php echo $newsletter['is_sent'] ? 'Sent' : 'Draft'; ?>
                        </span>
                    </span>
                    <?php if ($newsletter['is_sent']): ?>
                        <span><strong>Sent to:</strong> <?php echo $newsletter['recipient_count']; ?> recipients</span>
                        <span><strong>Sent on:</strong> <?php echo date('F j, Y g:i A', strtotime($newsletter['sent_date'])); ?></span>
                    <?php endif; ?>
                </div>

                <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 15px; max-height: 200px; overflow: hidden; border: 1px solid #ddd;">
                    <div><?php echo substr(strip_tags($newsletter['content']), 0, 300) . '...'; ?></div>
                </div>

                <div class="newsletter-actions">
                    <?php if (!$newsletter['is_sent']): ?>
                        <a href="?page=newsletter&action=edit&id=<?php echo $newsletter['id']; ?>" class="btn btn-secondary">Edit</a>
                        <a href="?page=newsletter&action=send&id=<?php echo $newsletter['id']; ?>" class="btn btn-success">Send</a>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $newsletter['id']; ?>">
                            <button type="submit" name="delete_newsletter" class="btn btn-danger" onclick="return confirm('Delete this newsletter?')">Delete</button>
                        </form>
                    <?php else: ?>
                        <button class="btn" disabled style="opacity: 0.5;">Sent Newsletter (Read-only)</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>