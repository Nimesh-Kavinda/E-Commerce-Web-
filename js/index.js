
let darkMode = JSON.parse(localStorage.getItem('darkMode')) || false;

// darkMode function
const activeDarkMode = () => {
  changeDarkModeIcon();

  darkMode = !darkMode;
  JSON.stringify(localStorage.setItem('darkMode', darkMode));

  darkModeToggle();
};

function darkModeToggle() {
  if (darkMode) {
    document.querySelector('html').setAttribute('data-bs-theme', 'dark');
    document.querySelector('.startpage-div1').classList.add('bg-dark');
    document.querySelector('.startpage-div2').classList.add('bg-dark');
    document.querySelector('.startpage-div3').classList.add('bg-dark');
    document.querySelectorAll('.t').forEach(function(element) {
      element.classList.remove('t-colour');
    });  
  } else if (!darkMode) {
    document.querySelector('html').setAttribute('data-bs-theme', 'light');
    document.querySelector('.startpage-div1').classList.remove('bg-dark');
    document.querySelector('.startpage-div2').classList.remove('bg-dark');
    document.querySelector('.startpage-div3').classList.remove('bg-dark');
    document.querySelectorAll('.t').forEach(function(element) {
      element.classList.add('t-colour');
  });  

 }
}

function changeDarkModeIcon() {
  const switchMode = document.getElementById('switch-mode');
  const iTag = switchMode.querySelectorAll('i');


  iTag.forEach((element) => {
    element.classList.toggle('d-none');
  });
}

if (darkMode != false) {
  darkModeToggle();
  changeDarkModeIcon();
}

const toggleButton = document.getElementById('div1');
toggleButton.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
});


