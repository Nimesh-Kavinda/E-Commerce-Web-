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

// login form popup-function

const loginbtns = document.querySelectorAll(".b_login");
const loginform = document.querySelector(".login_from");
const loginfirst_btns =document.querySelectorAll(".b_loginfirts");
const registerform = document.querySelector(".register_form");

loginbtns.forEach(function(loginbtn) {
  loginbtn.addEventListener('click', function() {
     loginform.classList.remove("d-none");
     registerform.classList.add("d-none");
  })});

loginfirst_btns.forEach(function(loginfirst_btn) {
  loginfirst_btn.addEventListener('click', function() {
    loginform.classList.remove("d-none");
  })});

  // registrion form popup-function

  const registerbtns = document.querySelectorAll(".b_register");

  registerbtns.forEach(function(registerbtn) {
    registerbtn.addEventListener('click', function() {
       registerform.classList.remove("d-none");
       loginform.classList.add("d-none");

    })});