<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="bn">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>সদস্যগণ | কুয়েট সাংবাদিক সমিতি</title>
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Noto+Serif+Bengali:wght@600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<script src="script.js" defer></script>
</head>
<body>
	<header class="header">
		<div class="container navbar">
			<div class="header_brand">
				<img class="header_logo" src="assets/kuet_logo.png" alt="KUET logo">
				<a href="index.php" class="logo">কুয়েট সাংবাদিক সমিতি</a>
				<div class="header_actions">
					<button class="theme_toggle" id="theme_toggle">🌙</button>
					<div class="hamburger" id="hamburger_menu">
						<span></span><span></span><span></span>
					</div>
				</div>
			</div>
			<nav class="nav_links" aria-label="Main Navigation">
				<a href="index.php">Home</a>
				<a href="all-news.php">All News</a>
				<a href="club-info.php" class="active">Club Info</a>
			</nav>
		</div>
	</header>

	<main>
		<section class="team section">
			<div class="container">
				<h1 style="text-align: center; margin-bottom: 3rem;">আমাদের সদস্যবৃন্দ</h1>
				
				<h2>কার্যনির্বাহী পরিষদ</h2>
				<div class="table_wrap card" style="margin-bottom: 3rem;">
                    <!-- This table will be loaded dynamically from PHP later -->
					<table class="committee_table">
						<thead>
							<tr>
								<th>নাম</th>
                                <th>ছবি</th>
								<th>পদবি</th>
								<th>বিভাগ ও ব্যাচ</th>
								<th>প্রতিনিধি (মিডিয়া)</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$stmt = $pdo->query("SELECT * FROM members WHERE committee_type='executive'");
							while ($member = $stmt->fetch()):
							?>
							<tr>
								<td><?php echo htmlspecialchars($member['name']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($member['image']); ?>" alt="User" style="width:40px; border-radius:50%; object-fit: cover; aspect-ratio: 1/1;"></td>
								<td><?php echo htmlspecialchars($member['position']); ?></td>
								<td><?php echo htmlspecialchars($member['dept_batch']); ?></td>
								<td><?php echo htmlspecialchars($member['media'] ?? 'N/A'); ?></td>
							</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>

                <h2>উপদেষ্টা পরিষদ</h2>
				<div class="advisor_box card">
					<ul class="advisor_list">
						<?php
						$stmtAdv = $pdo->query("SELECT * FROM members WHERE committee_type='advisor'");
						while ($adv = $stmtAdv->fetch()):
						?>
						<li><strong><?php echo htmlspecialchars($adv['name']); ?></strong> - <?php echo htmlspecialchars($adv['position']); ?>, <?php echo htmlspecialchars($adv['dept_batch']); ?></li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</section>
	</main>

	<footer class="footer">
		<div class="container footer_content">
			<div class="footer_main">
				<p>&copy; 2026 কুয়েট সাংবাদিক সমিতি</p>
			</div>
		</div>
	</footer>
    <button id="back_to_top" class="back_to_top">↑</button>
</body>
</html>