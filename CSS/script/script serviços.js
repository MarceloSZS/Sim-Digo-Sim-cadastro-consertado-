// JavaScript
const servicesButton = document.getElementById('services-button');
const submenu = document.getElementById('submenu');

servicesButton.addEventListener('click', () => {
  submenu.classList.toggle('show');
});