// Admin Panel Simple Tab Switching
function switchTab(tabId) {
    // Remove active class from all tabs and links
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active-tab');
    });
    document.querySelectorAll('.sidebar-nav a').forEach(link => {
        link.classList.remove('active');
    });

    // Add active class to target tab
    document.getElementById(tabId).classList.add('active-tab');
    
    // Add active state to clicked link
    event.currentTarget.classList.add('active');
}

// Modal Handlers (Add / Edit info)
function openModal(modalId) {
    document.getElementById(modalId).classList.add('show');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('show');
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.classList.remove('show');
    }
}