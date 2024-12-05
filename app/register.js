document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const tel = document.getElementById('tel').value;

    const user = { username, email, password, tel };
    localStorage.setItem('user', JSON.stringify(user));
    alert('Registration successful');
    window.location.href = 'login.html';
});