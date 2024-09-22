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