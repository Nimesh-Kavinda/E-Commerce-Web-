
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
      
  } else if (!darkMode) {
    document.querySelector('html').setAttribute('data-bs-theme', 'light');
   
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


