document.addEventListener('DOMContentLoaded', function() {
    // Updated path
    fetch('/project/components/taskbar/taskbar.html')
        .then(response => response.text())
        .then(html => {
            document.getElementById('taskbar-container').innerHTML = html;
            
            // Load taskbar CSS
            if (!document.querySelector('link[href*="taskbar.css"]')) {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = '/project/components/taskbar/taskbar.css';
                document.head.appendChild(link);
            }
            
            // Load taskbar JS
            if (!document.querySelector('script[src*="taskbar.js"]')) {
                const script = document.createElement('script');
                script.src = '/project/components/taskbar/taskbar.js';
                document.body.appendChild(script);
            }
        })
        .catch(error => console.error('Error loading taskbar:', error));
}); 