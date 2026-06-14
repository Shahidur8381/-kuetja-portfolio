<?php
session_start();
require_once '../db.php';

// Check Authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php#manage-members");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();

if (!$member) {
    echo "Member not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $committee_type = $_POST['committee_type'];
    $position = $_POST['position'];
    $dept_batch = $_POST['dept_batch'];
    $media = $_POST['media'];

    $updateStmt = $pdo->prepare("UPDATE members SET name = ?, committee_type = ?, position = ?, dept_batch = ?, media = ? WHERE id = ?");
    $updateStmt->execute([$name, $committee_type, $position, $dept_batch, $media, $id]);
    
    header("Location: index.php#manage-members");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member | Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .edit-container { max-width: 600px; margin: 2rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .edit-container h2 { margin-top: 0; color: #8b1f28; }
        .edit-container label { display: block; margin-top: 1rem; font-weight: bold; }
        .edit-container input[type="text"], .edit-container select { width: 100%; padding: 0.5rem; margin-top: 0.5rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-update { margin-top: 1rem; padding: 0.75rem 1.5rem; background: #8b1f28; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .btn-update:hover { background: #6b141d; }
        .btn-cancel { display: inline-block; margin-top: 1rem; margin-left: 0.5rem; text-decoration: none; color: #333; }
    </style>
</head>
<body style="background: #f4f6f8; font-family: sans-serif;">
    <div class="edit-container">
        <h2>Edit Member</h2>
        <form action="" method="POST">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required>
            
            <label>Committee Type</label>
            <select name="committee_type" required>
                <option value="executive" <?php if($member['committee_type'] == 'executive') echo 'selected'; ?>>Executive</option>
                <option value="advisor" <?php if($member['committee_type'] == 'advisor') echo 'selected'; ?>>Advisor</option>
            </select>

            <label>Position</label>
            <input type="text" name="position" value="<?php echo htmlspecialchars($member['position']); ?>" placeholder="e.g. সভাপতি" required>

            <label>Department & Batch</label>
            <input type="text" name="dept_batch" value="<?php echo htmlspecialchars($member['dept_batch']); ?>" placeholder="e.g. সিএসই, ২০">

            <label>Media Representative</label>
            <input type="text" name="media" value="<?php echo htmlspecialchars($member['media']); ?>" placeholder="e.g. কালের কণ্ঠ">

            <button type="submit" class="btn-update">Update Member</button>
            <a href="index.php#manage-members" class="btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>