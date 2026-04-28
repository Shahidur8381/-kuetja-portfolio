<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="bn">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>সকল খবর | কুয়েট সাংবাদিক সমিতি</title>
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Noto+Serif+Bengali:wght@600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<script src="script.js" defer></script>
</head>
<body>
	<header class="header" id="home">
		<div class="container navbar">
			<div class="header_brand">
				<img class="header_logo" src="assets/kuet_logo.png" alt="KUET logo">
				<a href="index.php" class="logo">কুয়েট সাংবাদিক সমিতি</a>
				<div class="header_actions">
					<button class="theme_toggle" id="theme_toggle" aria-label="Toggle Theme" title="Toggle Dark/Light Mode">🌙</button>
					<div class="hamburger" id="hamburger_menu">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
			<nav class="nav_links" aria-label="Main Navigation">
				<a href="index.php">Home</a>
				<a href="all-news.php" class="active">All News</a>
				<a href="club-info.php">Club Info</a>
			</nav>
		</div>
	</header>

	<main>
		<section class="section" style="padding-top: 2rem;">
			<div class="container">
				<h1 style="margin-bottom: 2rem; text-align: center;">সকল খবর ও প্রতিবেদন</h1>
				
				<div class="filter_container" style="justify-content: center;">
					<button class="filter_btn active_filter" data-filter="All">All</button>
					<button class="filter_btn" data-filter="Campus Report">Campus Report</button>
					<button class="filter_btn" data-filter="News">News</button>
					<button class="filter_btn" data-filter="Notice">Notice</button>
					<button class="filter_btn" data-filter="Admin">Admin</button>
				</div>

				<div class="works_grid">
					<?php
					$limit = 10;
					$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
					$offset = ($page - 1) * $limit;

					$stmt = $pdo->prepare("SELECT * FROM news ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
					$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
					$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
					$stmt->execute();
					
					while ($news = $stmt->fetch()):
						$dateObj = new DateTime($news['created_at']);
					?>
					<article class="work_card card">
						<img src="assets/<?php echo htmlspecialchars($news['image']); ?>" alt="News" class="news_image">
						<span class="label"><?php echo htmlspecialchars($news['category']); ?></span>
						<h3><?php echo htmlspecialchars($news['title']); ?></h3>
						<p><?php echo substr(htmlspecialchars($news['details']), 0, 100); ?>...</p>
						<p class="news_date"><?php echo date_format($dateObj, 'd F, Y'); ?></p>
						<a href="#">বিস্তারিত পড়ুন &rarr;</a>
					</article>
					<?php endwhile; ?>
				</div>
                
                <!-- Pagination -->
                <div style="text-align: center; margin-top: 3rem;">
                    <?php if($page > 1): ?>
                    <a href="?page=<?php echo $page-1; ?>" class="btn_primary" style="background: transparent; color: var(--accent); border: 1px solid var(--accent); margin: 0 5px;">&laquo; Previous</a>
                    <?php endif; ?>
                    <a href="?page=<?php echo $page+1; ?>" class="btn_primary" style="background: transparent; color: var(--accent); border: 1px solid var(--accent); margin: 0 5px;">Next &raquo;</a>
                </div>
			</div>
		</section>
	</main>

	<footer class="footer">
		<div class="container footer_content">
			<div class="footer_main">
				<p>&copy; 2026 কুয়েট সাংবাদিক সমিতি | কার্যনির্বাহী কমিটি ২০২৫-২৬</p>
			</div>
		</div>
	</footer>

    <button id="back_to_top" class="back_to_top" aria-label="Back to Top" title="Go to top">↑</button>
	<div class="lightbox" id="lightbox">
		<span class="lightbox_close" id="lightbox_close">&times;</span>
		<img class="lightbox_content" id="lightbox_img">
	</div>
</body>
</html>