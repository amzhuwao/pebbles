<?php
require_once dirname(__DIR__) . '/config.php';

// Handle adding/updating article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'save_article') {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $author = $conn->real_escape_string($_POST['author'] ?? 'Admin');
        $is_published = isset($_POST['is_published']) ? 1 : 0;

        $article_id = isset($_POST['article_id']) ? (int)$_POST['article_id'] : 0;

        // Handle featured image upload
        $featured_image = null;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['size'] > 0) {
            $file_ext = strtolower(pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION));
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($file_ext, $allowed_ext)) {
                $filename = time() . '_' . uniqid() . '.' . $file_ext;
                $upload_dir = dirname(__DIR__) . '/uploads/news/';
                $upload_path = $upload_dir . $filename;

                if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $upload_path)) {
                    $featured_image = 'uploads/news/' . $filename;
                }
            }
        }

        if ($article_id > 0) {
            // Update existing article
            $sql = "UPDATE news_articles SET title = '$title', content = '$content', author = '$author', is_published = $is_published";
            if ($featured_image) {
                $sql .= ", featured_image = '$featured_image'";
            }
            $sql .= " WHERE id = $article_id";

            if ($conn->query($sql)) {
                $success = "Article updated successfully!";
            } else {
                $error = "Error updating article: " . $conn->error;
            }
        } else {
            // Insert new article
            $sql = "INSERT INTO news_articles (title, content, featured_image, author, is_published, publish_date) 
                    VALUES ('$title', '$content', '$featured_image', '$author', $is_published, NOW())";

            if ($conn->query($sql)) {
                $success = "Article created successfully!";
            } else {
                $error = "Error creating article: " . $conn->error;
            }
        }
    }
}

// Handle delete article
if (isset($_GET['delete'])) {
    $article_id = (int)$_GET['delete'];
    $result = $conn->query("SELECT featured_image FROM news_articles WHERE id = $article_id");
    if ($row = $result->fetch_assoc() && $row['featured_image']) {
        @unlink('../' . $row['featured_image']);
    }

    $sql = "DELETE FROM news_articles WHERE id = $article_id";
    if ($conn->query($sql)) {
        $success = "Article deleted successfully!";
    }
}

// Get all articles
$articles = $conn->query("SELECT * FROM news_articles ORDER BY created_at DESC");

// Get single article for editing
$edit_article = null;
if (isset($_GET['edit'])) {
    $article_id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM news_articles WHERE id = $article_id");
    if ($result && $result->num_rows > 0) {
        $edit_article = $result->fetch_assoc();
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
        min-height: 200px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
    }

    input[type="checkbox"] {
        width: auto;
        margin-right: 10px;
        cursor: pointer;
    }

    .article-list {
        display: grid;
        gap: 15px;
    }

    .article-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 20px;
    }

    .article-image {
        width: 150px;
        height: 150px;
        border-radius: 5px;
        object-fit: cover;
        background: #f0f0f0;
    }

    .article-info h3 {
        color: #667eea;
        margin-bottom: 5px;
    }

    .article-info .meta {
        font-size: 12px;
        color: #999;
        margin-bottom: 10px;
    }

    .article-info .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .status.published {
        background: #d4edda;
        color: #155724;
    }

    .status.draft {
        background: #fff3cd;
        color: #856404;
    }

    .article-actions {
        display: flex;
        gap: 10px;
    }

    .article-actions a,
    .article-actions button {
        padding: 5px 10px;
        font-size: 12px;
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

    .form-actions {
        display: flex;
        gap: 10px;
    }

    .form-actions button {
        flex: 1;
    }
</style>

<?php
if (isset($success)) {
    echo '<div style="background: #d4edda; padding: 15px; border-radius: 5px; margin-bottom: 20px; color: #155724; border: 1px solid #c3e6cb;">' . htmlspecialchars($success) . '</div>';
}
if (isset($error)) {
    echo '<div style="background: #f8d7da; padding: 15px; border-radius: 5px; margin-bottom: 20px; color: #721c24; border: 1px solid #f5c6cb;">' . htmlspecialchars($error) . '</div>';
}
?>

<div class="tabs">
    <button class="tab-btn <?php echo $edit_article ? '' : 'active'; ?>" onclick="switchTab(event, 'articles')">All Articles</button>
    <button class="tab-btn <?php echo $edit_article ? 'active' : ''; ?>" onclick="switchTab(event, 'new')">
        <?php echo $edit_article ? 'Edit Article' : 'New Article'; ?>
    </button>
</div>

<!-- Articles List Tab -->
<div id="articles" class="tab-content <?php echo $edit_article ? '' : 'active'; ?>">
    <div class="article-list">
        <?php
        if ($articles && $articles->num_rows > 0) {
            while ($article = $articles->fetch_assoc()) {
                $status = $article['is_published'] ? 'Published' : 'Draft';
                $status_class = $article['is_published'] ? 'published' : 'draft';

                echo '<div class="article-card">';
                if ($article['featured_image']) {
                    $img_url = htmlspecialchars($article['featured_image']); // already stored as uploads/news/...
                    echo '<img src="' . $img_url . '" class="article-image" alt="' . htmlspecialchars($article['title']) . '">';
                } else {
                    echo '<div class="article-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">No Image</div>';
                }

                echo '<div class="article-info">';
                echo '<h3>' . htmlspecialchars($article['title']) . '</h3>';
                echo '<div class="meta">';
                echo 'By ' . htmlspecialchars($article['author']) . ' • ' . date('F j, Y', strtotime($article['created_at']));
                echo '</div>';
                echo '<span class="status ' . $status_class . '">' . $status . '</span>';
                echo '<p>' . htmlspecialchars(substr(strip_tags($article['content']), 0, 100)) . '...</p>';
                echo '<div class="article-actions">';
                echo '<a href="?page=news&edit=' . $article['id'] . '" class="btn">Edit</a>';
                echo '<a href="?page=news&delete=' . $article['id'] . '" class="btn btn-secondary" onclick="return confirm(\'Delete this article?\');">Delete</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No articles yet. <a href="?page=news&tab=new">Create one now</a></p>';
        }
        ?>
    </div>
</div>

<!-- New/Edit Article Tab -->
<div id="new" class="tab-content <?php echo $edit_article ? 'active' : ''; ?>">
    <div class="form-container">
        <h3><?php echo $edit_article ? 'Edit Article' : 'Create New Article'; ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_article">
            <?php if ($edit_article): ?>
                <input type="hidden" name="article_id" value="<?php echo $edit_article['id']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" id="title" name="title" required value="<?php echo $edit_article ? htmlspecialchars($edit_article['title']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" value="<?php echo $edit_article ? htmlspecialchars($edit_article['author']) : 'Admin'; ?>">
            </div>

            <div class="form-group">
                <label for="featured_image">Featured Image (Optional)</label>
                <input type="file" id="featured_image" name="featured_image" accept="image/*">
                <?php if ($edit_article && $edit_article['featured_image']): ?>
                    <p style="margin-top: 10px; color: #666;">
                        Current image:
                        <img src="<?php echo htmlspecialchars($edit_article['featured_image']); ?>" style="max-width: 150px; max-height: 100px; border-radius: 5px;">
                        <small style="display:block; color:#888; margin-top:4px;">Path: <?php echo htmlspecialchars($edit_article['featured_image']); ?></small>
                    </p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" required><?php echo $edit_article ? htmlspecialchars($edit_article['content']) : ''; ?></textarea>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="is_published" name="is_published" <?php echo ($edit_article && $edit_article['is_published']) ? 'checked' : ''; ?>>
                <label for="is_published" style="margin: 0;">Publish this article</label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">
                    <?php echo $edit_article ? 'Update Article' : 'Create Article'; ?>
                </button>
                <?php if ($edit_article): ?>
                    <a href="?page=news" class="btn btn-secondary" style="text-align: center; text-decoration: none;">Cancel</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(evt, tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

        const targetTab = document.getElementById(tabName);
        if (targetTab) {
            targetTab.classList.add('active');
        }
        if (evt && evt.currentTarget) {
            evt.currentTarget.classList.add('active');
        }
    }
</script>

<!-- Rich text editor for article content (local TinyMCE) -->
<script src="../vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content',
        menubar: false,
        statusbar: false,
        height: 420,
        plugins: 'lists link image table code autosave',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | table | removeformat | code',
        branding: false,
        autosave_interval: '30s',
        default_link_target: '_blank',
        link_default_protocol: 'https'
    });
</script>