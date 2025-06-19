document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const marks10th = document.getElementById("marks_10th");
    const marks12th = document.getElementById("marks_12th");
    const percentage10th = document.getElementById("percentage_10th");
    const percentage12th = document.getElementById("percentage_12th");

    // Debug: Check if elements are found
    console.log({
        marks10th: marks10th,
        marks12th: marks12th,
        percentage10th: percentage10th,
        percentage12th: percentage12th
    });

    if (!marks10th || !marks12th || !percentage10th || !percentage12th) {
        console.error("One or more elements not found!");
        return;
    }

    // Calculate 10th percentage
    marks10th.addEventListener("input", function () {
        const marks = parseFloat(this.value) || 0;
        const percentage = (marks / 600) * 100;
        percentage10th.textContent = `Percentage: ${percentage.toFixed(2)}%`;
        console.log(`10th Marks: ${marks}, Percentage: ${percentage}%`);
    });

    // Calculate 12th percentage
    marks12th.addEventListener("input", function () {
        const marks = parseFloat(this.value) || 0;
        const percentage = (marks / 700) * 100;
        percentage12th.textContent = `Percentage: ${percentage.toFixed(2)}%`;
        console.log(`12th Marks: ${marks}, Percentage: ${percentage}%`);
    });

    // Form submission validation
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let isValid = true;

        // Reset error messages
        document.querySelectorAll(".error").forEach(error => {
            error.textContent = "";
            error.style.display = "none";
        });

        // Required fields check
        const requiredFields = [
            "first_name", "last_name", "email", "dob", "gender", "mobile_number",
            "nationality", "aadhar_card", "marks_10th", "marksheet_10th",
            "marks_12th", "marksheet_12th", "known_languages", "ielts_status"
        ];
        requiredFields.forEach(id => {
            const field = document.getElementById(id);
            if (!field.value.trim()) {
                showError(field, "This field is required.");
                isValid = false;
            }
        });

        // Email validation
        const email = document.getElementById("email");
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            showError(email, "Please enter a valid email.");
            isValid = false;
        }

        // Mobile number validation (basic check for 10 digits or with country code)
        const mobile = document.getElementById("mobile_number");
        if (!/^\+?\d{10,15}$/.test(mobile.value)) {
            showError(mobile, "Please enter a valid mobile number.");
            isValid = false;
        }

        // Nationality must be "Indian" (case-insensitive)
        const nationality = document.getElementById("nationality");
        if (nationality.value.trim().toLowerCase() !== "indian") {
            showError(nationality, "Only Indian nationals are eligible.");
            isValid = false;
        }

        // Age must be 18+ based on DOB
        const dob = document.getElementById("dob");
        const birthDate = new Date(dob.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (age < 18) {
            showError(dob, "You must be 18 or older.");
            isValid = false;
        }

        // 10th and 12th passing check (33% minimum)
        const marks10thVal = parseFloat(marks10th.value) || 0;
        const marks12thVal = parseFloat(marks12th.value) || 0;
        const percentage10thVal = (marks10thVal / 600) * 100;
        const percentage12thVal = (marks12thVal / 700) * 100;

        if (percentage10thVal < 33) {
            showError(marks10th, "You must pass 10th with at least 33%.");
            isValid = false;
        }
        if (percentage12thVal < 33) {
            showError(marks12th, "You must pass 12th with at least 33%.");
            isValid = false;
        }

        // File upload validation (Aadhar, 10th, 12th marksheets)
        const aadhar = document.getElementById("aadhar_card");
        const marksheet10th = document.getElementById("marksheet_10th");
        const marksheet12th = document.getElementById("marksheet_12th");
        if (!aadhar.files.length) {
            showError(aadhar, "Aadhar card upload is required.");
            isValid = false;
        }
        if (!marksheet10th.files.length) {
            showError(marksheet10th, "10th marksheet upload is required.");
            isValid = false;
        }
        if (!marksheet12th.files.length) {
            showError(marksheet12th, "12th marksheet upload is required.");
            isValid = false;
        }

        // If all validations pass, submit the form
        if (isValid) {
            form.submit();
        }
    });

    // Helper function to show error messages
    function showError(field, message) {
        let error = field.nextElementSibling;
        if (!error || !error.classList.contains("error")) {
            console.error(`Error span not found for field: ${field.id}`);
            error = document.createElement("span");
            error.className = "error";
            field.parentNode.appendChild(error);
        }
        error.textContent = message;
        error.style.display = "block";
        console.log(`Showing error for ${field.id}: ${message}`);
    }
});