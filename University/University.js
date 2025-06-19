// Functionality for the taskbar
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');

if (mobileMenuBtn && navLinks) {
    mobileMenuBtn.addEventListener('click', function() {
        navLinks.classList.toggle('active');
    });
}

// Functionality for dropdown on click
const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('.nav-link');
    const content = dropdown.querySelector('.dropdown-content');

    link.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default link behavior
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target)) {
            content.style.display = 'none';
        }
    });
});

// Slider functionality
document.addEventListener('DOMContentLoaded', function() {
  const slider = document.querySelector('.card-slider');
  const prevBtn = document.querySelector('.prev-btn');
  const nextBtn = document.querySelector('.next-btn');
  
  if (slider && prevBtn && nextBtn) {
    const cardWidth = slider.querySelector('.card').offsetWidth + 20; // 20px is margin-right
    
    prevBtn.addEventListener('click', () => {
      slider.scrollLeft -= cardWidth;
    });
    
    nextBtn.addEventListener('click', () => {
      slider.scrollLeft += cardWidth;
    });
  }
});