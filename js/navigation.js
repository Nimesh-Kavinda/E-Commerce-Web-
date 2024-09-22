// Scroll navigation icon

const scrollBtn = document.getElementById('scrollBtn');
const scrollIcon = document.getElementById('scrollIcon');

function updateIcon() {
  const scrollTop = window.scrollY;
  const scrollHeight = document.body.scrollHeight;
  const windowHeight = window.innerHeight;

  if (scrollTop + windowHeight >= scrollHeight - 1) {
  
    scrollIcon.className = 'fas fa-arrow-up animate-icon';
    localStorage.setItem('scrollPosition', 'bottom'); 
  } else if (scrollTop === 0) {
   
    scrollIcon.className = 'fas fa-arrow-down animate-icon';
    localStorage.setItem('scrollPosition', 'top'); 
  } else {
    
    const midScroll = (scrollTop / (scrollHeight - windowHeight)) > 0.5;
    if (midScroll) {
      scrollIcon.className = 'fas fa-arrow-up animate-icon'; 
    } else {
      scrollIcon.className = 'fas fa-arrow-down animate-icon'; 
    }
  }
}

if (localStorage.getItem('scrollPosition') === 'top') {
  scrollIcon.className = 'fas fa-arrow-down animate-icon';
} else {
  scrollIcon.className = 'fas fa-arrow-up animate-icon'; 
}


scrollBtn.addEventListener('click', function() {
  if (window.scrollY === 0) {
   
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    localStorage.setItem('scrollPosition', 'bottom');
    scrollIcon.className = 'fas fa-arrow-up animate-icon';
  } else {
   
    window.scrollTo({ top: 0, behavior: 'smooth' });
    localStorage.setItem('scrollPosition', 'top');
    scrollIcon.className = 'fas fa-arrow-down animate-icon'; 
  }
});


window.addEventListener('scroll', updateIcon);
