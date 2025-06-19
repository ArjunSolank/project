document.addEventListener('DOMContentLoaded', function() {
    // Load footer HTML
    fetch('/project/components/footer/footer.html')
        .then(response => response.text())
        .then(html => {
            document.getElementById('footer-container').innerHTML = html;
            
            // Load footer CSS
            if (!document.querySelector('link[href*="footer.css"]')) {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = '/project/components/footer/footer.css';
                document.head.appendChild(link);
            }
        })
        .catch(error => console.error('Error loading footer:', error));
}); 