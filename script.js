const navLinks = document.querySelector('.nav_links');
const hamburger = document.getElementById('hamburger_menu');

hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    hamburger.classList.toggle('active');
});

// ScrollSpy setup
const sections = document.querySelectorAll('section');
const navItems = document.querySelectorAll('.nav_links a');

window.addEventListener('scroll', () => {
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= (sectionTop - sectionHeight / 3)) {
            current = section.getAttribute('id');
        }
    });

    navItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('href') === `#${current}`) {
            item.classList.add('active');
        }
    });
});

// Lightbox setup
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox_img');
const lightboxClose = document.getElementById('lightbox_close');
const galleryImages = document.querySelectorAll('.gallery_card img, .news_image');

galleryImages.forEach(image => {
    image.style.cursor = 'pointer';
    image.addEventListener('click', () => {
        lightbox.classList.add('show');
        lightboxImg.src = image.src;
        lightboxImg.alt = image.alt;
    });
});

lightboxClose.addEventListener('click', () => {
    lightbox.classList.remove('show');
});

lightbox.addEventListener('click', (e) => {
    if (e.target !== lightboxImg) {
        lightbox.classList.remove('show');
    }
});


// Dynamic News Filtering setup
const filterButtons = document.querySelectorAll('.filter_btn');
const workCards = document.querySelectorAll('.work_card');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active_filter'));
        button.classList.add('active_filter');

        const filterValue = button.getAttribute('data-filter');

        workCards.forEach(card => {
            const cardLabel = card.querySelector('.label').textContent.trim();
            if (filterValue === 'All' || cardLabel === filterValue) {
                card.style.display = 'block';
                // Add a small animation effect
                card.style.opacity = '0';
                setTimeout(() => { card.style.opacity = '1'; }, 50);
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Feature 5: Dark Mode Toggle
const themeToggleBtn = document.getElementById('theme_toggle');
const currentTheme = localStorage.getItem('theme');

if (currentTheme === 'dark') {
    document.documentElement.classList.add('dark-mode');
    themeToggleBtn.textContent = '☀️';
}

themeToggleBtn.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark-mode');
    
    if (document.documentElement.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        themeToggleBtn.textContent = '☀️';
    } else {
        localStorage.setItem('theme', 'light');
        themeToggleBtn.textContent = '🌙';
    }
});

// Feature 6: Back to Top Button
const backToTopBtn = document.getElementById('back_to_top');

window.addEventListener('scroll', () => {
    if (window.scrollY > 400) {
        backToTopBtn.classList.add('show');
    } else {
        backToTopBtn.classList.remove('show');
    }
});

backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Feature 7: Typewriter Effect
const typewriterElement = document.getElementById('hero_typewriter');
if (typewriterElement) {
    const textToType = typewriterElement.textContent;
    typewriterElement.textContent = ''; // Clear text
    typewriterElement.classList.add('typewriter-text');
    
    let i = 0;
    const typingSpeed = 60; // ms per character
    
    function typeWriter() {
        if (i < textToType.length) {
            typewriterElement.textContent += textToType.charAt(i);
            i++;
            setTimeout(typeWriter, typingSpeed);
        } else {
            // Remove the blinking cursor after typing is done (optional)
            setTimeout(() => {
                typewriterElement.classList.remove('typewriter-text');
            }, 1000);
        }
    }
    
    // Start typing after a short delay
    setTimeout(typeWriter, 300);
}