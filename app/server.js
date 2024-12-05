const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;

let users = [];

app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));

app.post('/register', (req, res) => {
    const { username, email, password, tel } = req.body;
    console.log('Received registration data:', req.body);
    if (!username || !email || !password || !tel) {
        return res.status(400).send('All fields are required');
    }
    users.push({ username, email, password, tel });
    res.send('Registration successful');
});

app.post('/login', (req, res) => {
    const { username, password } = req.body;
    console.log('Received login data:', req.body);
    const user = users.find(u => u.username === username && u.password === password);
    if (user) {
        res.redirect('/books.html');
    } else {
        res.status(401).send('Invalid username or password');
    }
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});