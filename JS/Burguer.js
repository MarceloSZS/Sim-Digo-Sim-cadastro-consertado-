document.addEventListener('DOMContentLoaded', function() {
    var burguer = document.getElementById('burguer');
    var menu = document.querySelector('.menu ul');

    burguer.addEventListener('click', function() {
        menu.classList.toggle('show');
    });
});
