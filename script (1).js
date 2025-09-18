// script.js
function switchForm(form) {
    const container = document.getElementById('container');
    const loginForm = document.getElementById('loginForm');
    const signUpForm = document.getElementById('signUpForm');
  
    if (form === 'login') {
      loginForm.classList.remove('hidden');
      signUpForm.classList.add('hidden');
      container.classList.remove('flip');
    } else if (form === 'signup') {
      signUpForm.classList.remove('hidden');
      loginForm.classList.add('hidden');
      container.classList.add('flip');
    }
  }
  