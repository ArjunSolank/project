document.addEventListener('DOMContentLoaded', function() {
    // Close notification bar
    const closeNotification = document.querySelector('.close-notification');
    if (closeNotification) {
        closeNotification.addEventListener('click', function() {
            this.parentElement.style.display = 'none';
        });
    }

    // Dropdown functionality
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

    // Scroll animation
    const scrollItems = document.querySelectorAll('.scroll-item');

    function checkScroll() {
        scrollItems.forEach(item => {
            const rect = item.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                item.classList.add('visible');
            } else {
                item.classList.remove('visible');
            }
        });
    }

    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Initial check

    // Image slider functionality
    const imageSlider = document.querySelector('.image-slider');
    if (imageSlider) {
        const images = imageSlider.querySelectorAll('.scroll-image');
        let currentIndex = 0;

        function updateSlider() {
            const offset = -currentIndex * 100;
            images.forEach(img => {
                img.style.transform = `translateX(${offset}%)`;
            });
        }

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            updateSlider();
        }, 4000); // Automatic swipe every 4 seconds
    }
});
