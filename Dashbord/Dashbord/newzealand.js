// Animate process steps on scroll
document.addEventListener('DOMContentLoaded', function() {
    const processSteps = document.querySelectorAll('.process-step');
    
    // function checkScroll() {
    //     processSteps.forEach(step => {
    //         const stepTop = step.getBoundingClientRect().top;
    //         const windowHeight = window.innerHeight;
            
    //         if (stepTop < windowHeight * 0.75) {
    //             step.classList.add('animate');
                
    //             // Add specific animations based on side
    //             if (step.classList.contains('right-side')) {
    //                 step.style.animation = 'slideInRight 0.8s ease forwards';
    //             } else {
    //                 step.style.animation = 'slideInLeft 0.8s ease forwards';
    //             }
    //         }
    //     });
    // }
    let currentIndex = 0;
    const slider = document.querySelector('.slider');
    const cards = document.querySelectorAll('.card');
    const cardWidth = cards[0].offsetWidth + 20; // Card width + margin-right
    
    function moveSlider() {
        currentIndex = (currentIndex + 1) % cards.length;
        const offset = -currentIndex * cardWidth;
        slider.style.transform = `translateX(${offset}px)`;
    }
    
    setInterval(moveSlider, 3000); // Adjust the interval as needed
setInterval(moveSlider, 3000); // Adjust the interval as needed
    // Initial check
    checkScroll();
    
    // Check on scroll
    window.addEventListener('scroll', checkScroll);
});

document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.fade-in');
    
    function checkScroll() {
        sections.forEach(section => {
            const sectionTop = section.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (sectionTop < windowHeight * 0.75) {
                section.classList.add('visible');
            }
        });
    }
    
    // Initial check
    checkScroll();
    
    // Check on scroll
    window.addEventListener('scroll', checkScroll);
});

// Flight Booking Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Set default date to today
    const dateInput = document.querySelector('.flight-booking input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    dateInput.value = today;

    // Swap button functionality
    const swapBtn = document.querySelector('.flight-booking .swap-btn');
    swapBtn.addEventListener('click', function() {
        const fromInput = document.querySelector('.flight-booking input[placeholder="From Airport"]');
        const toInput = document.querySelector('.flight-booking input[placeholder="To Airport"]');
        const tempValue = fromInput.value;
        fromInput.value = toInput.value;
        toInput.value = tempValue;
    });

    // Quick date buttons
    const dateBtns = document.querySelectorAll('.flight-booking .date-btn');
    dateBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            dateBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const date = new Date();
            if (this.textContent === 'Tomorrow') {
                date.setDate(date.getDate() + 1);
            }
            dateInput.value = date.toISOString().split('T')[0];
        });
    });

    // Search button functionality
    const searchBtn = document.querySelector('.flight-booking .search-btn');
    searchBtn.addEventListener('click', function() {
        const from = document.querySelector('.flight-booking input[placeholder="From Airport"]').value;
        const to = document.querySelector('.flight-booking input[placeholder="To Airport"]').value;
        const date = dateInput.value;

        if (!from || !to) {
            alert('Please enter both departure and arrival airports');
            return;
        }

        // Here you would typically make an API call to search for flights
        alert(`Searching for flights from ${from} to ${to} on ${date}`);
    });
});
