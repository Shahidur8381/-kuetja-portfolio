<?php
session_start();
require_once '../db.php';

// Check Authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Handle Add/Edit News Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_news') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $details = $_POST['details'];
    
    // Handle image upload here... (dummy image for now)
    $imagePath = 'default_news.png';

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

    $stmt = $pdo->prepare("INSERT INTO news (title, category, details, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $category, $details, $imagePath]);
    header("Location: index.php");
    exit;
}

// Handle Add Member Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_member') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $dept_batch = $_POST['dept_batch'];
    $media = $_POST['media'];
    $committee_type = $_POST['committee_type'];

    $stmt = $pdo->prepare("INSERT INTO members (name, position, dept_batch, media, committee_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $position, $dept_batch, $media, $committee_type]);
    header("Location: index.php");
    exit;
}

// Fetch Dashboard Stats safely
$totalNews = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
$totalMembers = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KUET JA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>KUET JA Admin</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="#dashboard" class="active" onclick="switchTab('dashboard')">📊 Dashboard</a>
                <a href="#manage-news" onclick="switchTab('manage-news')">📰 Manage News</a>
                <a href="#manage-members" onclick="switchTab('manage-members')">👤 Manage Members</a>
                <a href="../index.php" target="_blank">🌐 View Website</a>
            </nav>
            <div class="sidebar-footer">
                <a href="logout.php" class="btn-logout" style="text-align: center; text-decoration: none; display: block;">🚪 Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <h2>Welcome, Admin!</h2>
            </header>

            <!-- Dashboard Tab -->
            <section id="dashboard" class="tab-content active-tab">
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total News</h3>
                        <p class="stat-number"><?php echo $totalNews; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3>Active Members</h3>
                        <p class="stat-number"><?php echo $totalMembers; ?></p>
                    </div>
                </div>
            </section>

            <!-- Manage News Tab -->
            <section id="manage-news" class="tab-content">
                <div class="flex-between">
                    <h2>Manage News</h2>
                    <button class="btn-primary" onclick="openModal('news-modal')">+ Add News</button>
                </div>
                <div class="table-container card">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $newsList = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
                            while ($n = $newsList->fetch()):
                            ?>
                            <tr>
                                <td><?php echo date('Y-m-d', strtotime($n['created_at'])); ?></td>
                                <td><?php echo htmlspecialchars($n['title']); ?></td>
                                <td><?php echo htmlspecialchars($n['category']); ?></td>
                                <td>
                                    <a href="edit_news.php?id=<?php echo $n['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="delete_news.php?id=<?php echo $n['id']; ?>" class="btn-delete" style="text-decoration:none;" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Manage Members Tab -->
            <section id="manage-members" class="tab-content">
                <div class="flex-between">
                    <h2>Manage Members</h2>
                    <button class="btn-primary" onclick="openModal('member-modal')">+ Add Member</button>
                </div>
                <div class="table-container card">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Dept & Batch</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $memberList = $pdo->query("SELECT * FROM members ORDER BY id ASC");
                            while ($m = $memberList->fetch()):
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($m['name']); ?></td>
                                <td><?php echo htmlspecialchars($m['position']); ?><br><small>(<?php echo htmlspecialchars($m['committee_type']); ?>)</small></td>
                                <td><?php echo htmlspecialchars($m['dept_batch']); ?></td>
                                <td>
                                    <a href="edit_member.php?id=<?php echo $m['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="delete_member.php?id=<?php echo $m['id']; ?>" class="btn-delete" style="text-decoration:none;" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <!-- Modals for Add/Edit -->
    <div id="news-modal" class="modal-overlay">
        <div class="modal card">
            <div class="modal-header">
                <h3>Add / Edit News</h3>
                <span class="close-modal" onclick="closeModal('news-modal')">&times;</span>
            </div>
            <form action="index.php" method="POST" enctype="multipart/form-data" class="admin-form">
                <input type="hidden" name="action" value="add_news">
                <label>News Title</label>
                <input type="text" name="title" required>
                
                <label>Category</label>
                <select name="category">
                    <option value="News">News</option>
                    <option value="Campus Report">Campus Report</option>
                    <option value="Notice">Notice</option>
                    <option value="Admin">Admin</option>
                </select>

                <label>Details</label>
                <textarea name="details" rows="5" required></textarea>

                <label>Image Upload</label>
                <input type="file" name="image" accept="image/*">

                <button type="submit" class="btn-primary" style="margin-top:1rem; width:100%;">Save News</button>
            </form>
        </div>
    </div>

    <div id="member-modal" class="modal-overlay">
        <div class="modal card">
            <div class="modal-header">
                <h3>Add / Edit Member</h3>
                <span class="close-modal" onclick="closeModal('member-modal')">&times;</span>
            </div>
            <form action="index.php" method="POST" class="admin-form">
                <input type="hidden" name="action" value="add_member">
                <label>Name</label>
                <input type="text" name="name" required>
                
                <label>Committee Type</label>
                <select name="committee_type" required>
                    <option value="executive">Executive</option>
                    <option value="advisor">Advisor</option>
                </select>

                <label>Position</label>
                <input type="text" name="position" placeholder="e.g. সভাপতি" required>

                <label>Department & Batch</label>
                <input type="text" name="dept_batch" placeholder="e.g. সিএসই, ২০">

                <label>Media Representative</label>
                <input type="text" name="media" placeholder="e.g. কালের কণ্ঠ">

                <button type="submit" class="btn-primary" style="margin-top:1rem; width:100%;">Save Member</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>