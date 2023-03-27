const form = document.getElementById('loginForm');
var username = document.getElementById("content");
var password = document.getElementById("content2");
form.addEventListener('submit', (event) => {
    if (username.value.trim() === '' || password.value.trim() === '') {
        event.preventDefault();
        alert('Please enter your username and password');
        return;
    }
});
