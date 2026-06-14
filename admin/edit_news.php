<?php
session_start();
require_once '../db.php';

// Check Authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php#manage-news");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();

if (!$news) {
    echo "News not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $details = $_POST['details'];
    $imagePath = $news['image'];

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $newFilename = uniqid() . '.' . $ext;
        
        $uploadDir = '../assets/news/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $newFilename);
        $imagePath = 'news/' . $newFilename;
    }

    $updateStmt = $pdo->prepare("UPDATE news SET title = ?, category = ?, details = ?, image = ? WHERE id = ?");
    $updateStmt->execute([$title, $category, $details, $imagePath, $id]);
    
    header("Location: index.php#manage-news");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News | Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .edit-container { max-width: 600px; margin: 2rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .edit-container h2 { margin-top: 0; color: #8b1f28; }
        .edit-container label { display: block; margin-top: 1rem; font-weight: bold; }
        .edit-container input[type="text"], .edit-container select, .edit-container textarea { width: 100%; padding: 0.5rem; margin-top: 0.5rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-update { margin-top: 1rem; padding: 0.75rem 1.5rem; background: #8b1f28; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .btn-update:hover { background: #6b141d; }
        .btn-cancel { display: inline-block; margin-top: 1rem; margin-left: 0.5rem; text-decoration: none; color: #333; }
    </style>
</head>
<body style="background: #f4f6f8; font-family: sans-serif;">
    <div class="edit-container">
        <h2>Edit News</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>News Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
            
            <label>Category</label>
            <select name="category">
                <option value="News" <?php if($news['category'] == 'News') echo 'selected'; ?>>News</option>
                <option value="Campus Report" <?php if($news['category'] == 'Campus Report') echo 'selected'; ?>>Campus Report</option>
                <option value="Notice" <?php if($news['category'] == 'Notice') echo 'selected'; ?>>Notice</option>
                <option value="Admin" <?php if($news['category'] == 'Admin') echo 'selected'; ?>>Admin</option>
            </select>

            <label>Details</label>
            <textarea name="details" rows="5" required><?php echo htmlspecialchars($news['details']); ?></textarea>

            <label>Current Image</label>
            <?php if($news['image']): ?>
                <img src="../assets/<?php echo $news['image']; ?>" alt="News Image" style="display:block; max-width: 100px; margin-top: 0.5rem; border-radius:4px;">
            <?php else: ?>
                <p>No image</p>
            <?php endif; ?>

            <label>Upload New Image (Leave empty to keep current)</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit" class="btn-update">Update News</button>
            <a href="index.php#manage-news" class="btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>