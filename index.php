<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="bn">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="কুয়েট সাংবাদিক সমিতি - KUET student journalism club portfolio website">
	<title>কুয়েট সাংবাদিক সমিতি | Portfolio</title>
	<link rel="icon" href="assets/club_logo.png" type="image/png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Noto+Serif+Bengali:wght@600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header class="header" id="home">
		<div class="container navbar">
			<div class="header_brand">
				<img class="header_logo" src="assets/kuet_logo.png" alt="KUET logo">
				<div class="logo">কুয়েট সাংবাদিক সমিতি</div>
				<img class="header_logo" src="assets/club_logo.png" alt="কুয়েট সাংবাদিক সমিতি logo">
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
				<a href="#home">Home</a>
				<a href="#about">About</a>
				<a href="#featured">Featured Works</a>
				<a href="#team">Team</a>
				<a href="#activities">Activities</a>
				<a href="#contact">Contact</a>
			</nav>
		</div>
	</header>

	<main>
		<section class="hero_section section">
			<div class="container hero_content">
				<p class="tagline">Student Journalism Club | KUET | প্রতিষ্ঠিত ২০২৫</p>
				<h1><span id="hero_typewriter">কণ্ঠস্বর, কনটেক্সট, এবং ক্যাম্পাসের গল্প</span></h1>
				<p class="hero_intro">
					কুয়েট সাংবাদিক সমিতি একটি শিক্ষার্থী-নেতৃত্বাধীন সাংবাদিকতা প্ল্যাটফর্ম।
					আমরা ক্যাম্পাসের গুরুত্বপূর্ণ গল্প, অর্জন, উদ্যোগ ও ভাবনাকে দায়িত্বশীলভাবে তুলে ধরি।
				</p>
				<a class="btn_primary" href="#team">দেখুন কার্যনির্বাহী কমিটি</a>
				<div class="hero_meta card">
					<p><strong>কার্যনির্বাহী কমিটি:</strong> ২০২৫-২৬</p>
					<p><strong>তারিখ:</strong> ০৪/০৯/২০২৫ ইং</p>
				</div>
			</div>
		</section>

		<section class="about section" id="about">
			<div class="container">
				<h2>সমিতি সম্পর্কে</h2>
				<div class="about_grid">
					<article class="card">
						<h3>Overview</h3>
						<p>
							কুয়েট সাংবাদিক সমিতি ক্যাম্পাসভিত্তিক তথ্যচর্চা, রিপোর্টিং এবং মিডিয়া স্কিল উন্নয়নের জন্য কাজ করে।
							এটি শিক্ষার্থীদের জন্য একটি দায়িত্বশীল ও সৃজনশীল প্ল্যাটফর্ম।
						</p>
					</article>
					<article class="card">
						<h3>Mission</h3>
						<p>
							বস্তুনিষ্ঠতা, যাচাই এবং নৈতিকতার ভিত্তিতে ক্যাম্পাসের সংবাদ ও ফিচার উপস্থাপন করা;
							নতুন সদস্যদের প্র্যাকটিক্যাল সাংবাদিকতায় দক্ষ করে তোলা।
						</p>
					</article>
					<article class="card">
						<h3>Vision</h3>
						<p>
							শিক্ষার্থীদের কণ্ঠস্বরকে প্রাতিষ্ঠানিকভাবে দৃশ্যমান করা এবং আগামী দিনের দায়িত্বশীল মিডিয়া লিডার তৈরি করা।
						</p>
					</article>
				</div>

				<div class="advisor_box card">
					<h3>উপদেষ্টা পরিষদ</h3>
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

		<section class="featured_works section" id="featured">
			<div class="container">
				<h2>Featured Works / News</h2>
				<div class="filter_container">
					<button class="filter_btn active_filter" data-filter="All">All</button>
					<button class="filter_btn" data-filter="Campus Report">Campus Report</button>
					<button class="filter_btn" data-filter="News">News</button>
					<button class="filter_btn" data-filter="Notice">Notice</button>
					<button class="filter_btn" data-filter="Admin">Admin</button>
				</div>
				<div class="works_grid">
					<?php
					$stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 4");
					while ($news = $stmt->fetch()):
						// formatting date
						$dateObj = new DateTime($news['created_at']);
						$formattedDate = date_format($dateObj, 'd F, Y');
					?>
					<article class="work_card card">
						<img src="assets/<?php echo htmlspecialchars($news['image']); ?>" alt="News Image" class="news_image">
						<span class="label"><?php echo htmlspecialchars($news['category']); ?></span>
						<h3><?php echo htmlspecialchars($news['title']); ?></h3>
						<p><?php echo substr(htmlspecialchars($news['details']), 0, 100); ?>...</p>
						<p class="news_date"><?php echo $formattedDate; ?></p>
					</article>
					<?php endwhile; ?>
				</div>
			</div>
		</section>

		<section class="team section" id="team">
			<div class="container">
				<h2>কার্যনির্বাহী পরিষদ (২০২৫-২৬)</h2>
				<div class="table_wrap card">
					<table class="committee_table">
						<thead>
							<tr>
								<th>নাম</th>
								<th>পদবি</th>
								<th>বিভাগ</th>
								<th>প্রতিনিধি</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$stmtExec = $pdo->query("SELECT * FROM members WHERE committee_type='executive'");
							while ($member = $stmtExec->fetch()):
							?>
							<tr>
								<td><?php echo htmlspecialchars($member['name']); ?></td>
								<td><?php echo htmlspecialchars($member['position']); ?></td>
								<td><?php echo htmlspecialchars($member['dept_batch']); ?></td>
								<td><?php echo htmlspecialchars($member['media'] ?? 'N/A'); ?></td>
							</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>

		<section class="activities section" id="activities">
			<div class="container">
				<h2>Activities & Gallery</h2>
				<div class="gallery_grid">
					<figure class="gallery_card">
						<img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80" alt="Editorial workshop session">
						<figcaption>Editorial Workshop</figcaption>
					</figure>
					<figure class="gallery_card">
						<img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=900&q=80" alt="Press conference simulation event">
						<figcaption>Press Brief Simulation</figcaption>
					</figure>
					<figure class="gallery_card">
						<img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=900&q=80" alt="Field reporting practice by students">
						<figcaption>Field Reporting Practice</figcaption>
					</figure>
					<figure class="gallery_card">
						<img src="https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=900&q=80" alt="Team coverage at university event">
						<figcaption>Campus Event Coverage</figcaption>
					</figure>
				</div>
			</div>
		</section>

		<section class="contact section" id="contact">
			<div class="container contact_wrap">
				<div class="contact_info">
					<h2>যোগাযোগ</h2>
					<p>Mobile: <a href="tel:+8801632533729">01632-533729</a>, <a href="tel:+8801521767436">01521767436</a></p>
					<p>Email: <a href="mailto:kuetja.2025@gmail.com">kuetja.2025@gmail.com</a></p>
					<p>Facebook: <a href="https://www.facebook.com/kuetja2025" target="_blank" rel="noopener noreferrer">facebook.com/kuetja2025</a></p>
					<p>Address: Student Welfare Center, KUET, Khulna, Bangladesh, 9203</p>
				</div>

				<form class="contact_form" id="contact_form">
					<label for="name">Name</label>
					<input type="text" id="name" name="name" placeholder="Your name" required>

					<label for="email">Email</label>
					<input type="email" id="email" name="email" placeholder="you@example.com" required>

					<label for="message">Message</label>
					<textarea id="message" name="message" rows="5" placeholder="Write your message" required></textarea>

					<button type="submit" class="btn_primary" id="submit_btn">Send Message</button>
                    <p id="form_status" style="margin-top: 10px; display: none; font-weight: bold;"></p>
				</form>
			</div>
		</section>
	</main>

	<footer class="footer">
		<div class="container footer_content">
			<div class="footer_main">
				<p>&copy; 2026 কুয়েট সাংবাদিক সমিতি | কার্যনির্বাহী কমিটি ২০২৫-২৬</p>
			</div>
			<div class="developer_info">
				<p>Developed by <strong>Shahidur Rahman Shawon</strong></p>
				<p>Dept. of CSE, KUET</p>
			</div>
		</div>
	</footer>

	<!-- Back to Top Button -->
	<button id="back_to_top" class="back_to_top" aria-label="Back to Top" title="Go to top">↑</button>

	<!-- Lightbox element -->
	<div class="lightbox" id="lightbox">
		<span class="lightbox_close" id="lightbox_close">&times;</span>
		<img class="lightbox_content" id="lightbox_img">
	</div>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
	<script type="text/javascript">
		(function() {
			emailjs.init("pgd3C4xHQyrhTINDn");
		})();
        
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById('contact_form');
            var statusMsg = document.getElementById('form_status');
            var btn = document.getElementById('submit_btn');

            if (form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    btn.textContent = 'Sending...';
                    btn.disabled = true;
                    
                    emailjs.sendForm('service_9889x4f', 'template_i3fj1fg', form)
                        .then(function(response) {
                            alert('Success! Your message has been sent.');
                            
                            statusMsg.style.display = 'block';
                            statusMsg.style.color = '#28a745';
                            statusMsg.textContent = 'Message sent successfully!';
                            
                            form.reset();
                            btn.textContent = 'Send Message';
                            btn.disabled = false;
                            
                            setTimeout(function() { statusMsg.style.display = 'none'; }, 5000);
                        }, function(error) {
                            alert('Failed to send the message. Error: ' + JSON.stringify(error));
                            
                            statusMsg.style.display = 'block';
                            statusMsg.style.color = '#dc3545';
                            statusMsg.textContent = 'Failed to send the message. Please try again.';
                            
                            btn.textContent = 'Send Message';
                            btn.disabled = false;
                        });
                });
            }
        });
	</script>
	<script src="script.js"></script>
</body>
</html>
