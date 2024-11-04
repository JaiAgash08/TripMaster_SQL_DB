// Smooth Scroll to Sections
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetSection = document.querySelector(this.getAttribute('href'));
        if (targetSection) {
            targetSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Explore Button Scroll to Services (if it exists on the page)
const exploreButton = document.querySelector('.hero button');
if (exploreButton) {
    exploreButton.addEventListener('click', function () {
        const servicesSection = document.querySelector('#services');
        if (servicesSection) {
            servicesSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
}

// Back to Home Button
document.querySelector('.back-button').addEventListener('click', function () {
    window.location.href = 'index.html';  // Redirects to Home page
});

// Simulate Booking or Reserving (Basic Interactivity)
document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', function () {
        if (!this.classList.contains('back-button')) { // Exclude the back button from showing alert
            alert('Thank you for your interest! This feature is coming soon.');
        }
    });
});
