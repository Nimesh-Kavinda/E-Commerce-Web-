const scrollBtn = document.getElementById('scrollBtn');
    const scrollIcon = document.getElementById('scrollIcon');

    // Load scroll position from localStorage
    if (localStorage.getItem('scrollPosition') === 'top') {
      scrollIcon.className = 'fas fa-arrow-up animate-icon'; // Show 'Go to Top' icon
    } else {
      scrollIcon.className = 'fas fa-arrow-down animate-icon'; // Show 'Go to Bottom' icon
    }

    // Event listener for the button click
    scrollBtn.addEventListener('click', function() {
      if (window.scrollY === 0) {
        // Scroll to the bottom
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        localStorage.setItem('scrollPosition', 'bottom'); // Save position in localStorage
      } else {
        // Scroll to the top
        window.scrollTo({ top: 0, behavior: 'smooth' });
        localStorage.setItem('scrollPosition', 'top'); // Save position in localStorage
      }
    });

    // Event listener for window scroll to toggle icon
    window.addEventListener('scroll', function() {
      if (window.scrollY + window.innerHeight <= document.body.scrollHeight) {
        scrollIcon.className = 'fas fa-arrow-up animate-icon'; // At bottom, show 'Go to Top'
        localStorage.setItem('scrollPosition', 'bottom'); // Save position in localStorage
      } else {
        scrollIcon.className = 'fas fa-arrow-down animate-icon'; // Not at bottom, show 'Go to Bottom'
        localStorage.setItem('scrollPosition', 'top'); // Save position in localStorage
      }
    });
  