// Theme management
function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
}

function toggleTheme() {
    const currentTheme = localStorage.getItem('theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    setTheme(newTheme);
    updateThemeIcon(newTheme);
}

function updateThemeIcon(theme) {
    const themeIcon = document.querySelector('.theme-toggle i');
    if (themeIcon) {
        themeIcon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }
}

// Initialize theme
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);
    updateThemeIcon(savedTheme);
});

// Toggle sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main-content');
    const toggle = document.querySelector('.sidebar-toggle');
    
    sidebar.classList.toggle('collapsed');
    main.classList.toggle('full-width');
    toggle.classList.toggle('active');
}

// Toggle submenu
function toggleSubmenu(event) {
    event.preventDefault();
    const submenuLink = event.currentTarget;
    const submenu = submenuLink.nextElementSibling;
    
    submenuLink.classList.toggle('active');
    submenu.classList.toggle('active');
}

// Show section content
function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });

    // Show selected section
    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.classList.add('active');
        
        // Add loading state
        selectedSection.classList.add('loading');
        
        // Simulate data loading
        setTimeout(() => {
            selectedSection.classList.remove('loading');
        }, 1000);
    }
}

// Show overview section by default
document.addEventListener('DOMContentLoaded', () => {
    const overviewSection = document.querySelector('.overview');
    if (overviewSection) {
        overviewSection.classList.add('active');
    }
});

// Handle errors
window.onerror = function(msg, url, lineNo, columnNo, error) {
    console.error('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
    return false;
};

function editUser(userId) {
    // Fetch user data
    $.ajax({
        url: 'edit_user.php',
        type: 'POST',
        data: {
            action: 'fetch',
            user_id: userId
        },
        success: function(response) {
            try {
                const userData = JSON.parse(response);
                showEditModal(userData);
            } catch(e) {
                alert('Error fetching user data');
            }
        }
    });
}

function showEditModal(userData) {
    // Create modal HTML
    const modalHtml = `
    <div class="modal" id="editModal">
        <div class="modal-content">
            <h2>Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" name="user_id" value="${userData.User_id}">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="${userData.First_name}" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="${userData.Last_name}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="${userData.User_email}" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" value="${userData.User_DOB}" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="Male" ${userData.User_Gender === 'Male' ? 'selected' : ''}>Male</option>
                        <option value="Female" ${userData.User_Gender === 'Female' ? 'selected' : ''}>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone" value="${userData.User_phone}" required>
                </div>
                <div class="modal-buttons">
                    <button type="submit" class="btn-save">Save Changes</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>`;

    // Add modal to page
    document.body.insertAdjacentHTML('beforeend', modalHtml);

    // Add form submit handler
    document.getElementById('editUserForm').onsubmit = function(e) {
        e.preventDefault();
        updateUser(this);
    };
}

function updateUser(form) {
    const formData = new FormData(form);
    formData.append('action', 'update');

    $.ajax({
        url: 'edit_user.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response === 'success') {
                alert('User updated successfully');
                closeModal();
                location.reload(); // Refresh to show updated data
            } else {
                alert('Error updating user');
            }
        }
    });
}

function deleteUser(userId) {
    if(confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: 'delete_user.php',
            type: 'POST',
            data: {
                user_id: userId
            },
            success: function(response) {
                if(response === 'success') {
                    alert('User deleted successfully');
                    location.reload(); // Refresh to show updated list
                } else {
                    alert('Error deleting user');
                }
            }
        });
    }
}

function closeModal() {
    const modal = document.getElementById('editModal');
    if(modal) {
        modal.remove();
    }
}
