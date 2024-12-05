from flask import Flask, request, redirect, url_for, send_from_directory, render_template, render_template_string, jsonify, session, flash

app = Flask(__name__, static_url_path='', static_folder='static')
app.secret_key = 'supersecretkey'  # Schlüssel für die Sitzungsverwaltung

users = []
books = [
    {'id': 1, 'title': 'Book 1', 'author': 'Author 1', 'serial_number': 'SN001', 'available': True},
    {'id': 2, 'title': 'Book 2', 'author': 'Author 2', 'serial_number': 'SN002', 'available': True},
    {'id': 3, 'title': 'Book 3', 'author': 'Author 3', 'serial_number': 'SN003', 'available': True}
]

admin_user = {'username': 'admin', 'password': 'admin'}

@app.route('/')
def index():
    return redirect(url_for('static', filename='index.html'))

@app.route('/register', methods=['POST'])
def register():
    data = request.form
    username = data.get('username')
    email = data.get('email')
    password = data.get('password')
    tel = data.get('tel')
    
    if not username or not email or not password or not tel:
        return 'All fields are required', 400
    
    users.append({
        'username': username,
        'email': email,
        'password': password,
        'tel': tel
    })
    return 'Registration successful', 200

@app.route('/login', methods=['POST'])
def login():
    data = request.form
    username = data.get('username')
    password = data.get('password')
    
    if username == admin_user['username'] and password == admin_user['password']:
        session['username'] = username
        session['admin'] = True
        return redirect(url_for('admin'))
    
    user = next((u for u in users if u['username'] == username and u['password'] == password), None)
    if user:
        session['username'] = username
        session['admin'] = False
        return redirect(url_for('static', filename='books.html'))
    else:
        error = 'Invalid username or password'
        return render_template('login.html', error=error)

@app.route('/logout')
def logout():
    session.pop('username', None)
    session.pop('admin', None)
    return redirect(url_for('static', filename='index.html'))

@app.route('/admin')
def admin():
    if 'username' not in session or not session.get('admin'):
        return redirect(url_for('static', filename='login.html'))
    return render_template_string('''
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="register.html" class="register-btn">Register</a></li>
                <li><a href="login.html" class="login-btn">Login</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <h1>Admin Panel</h1>
            <h2>Books</h2>
            <div class="books-container">
                {% for book in books %}
                <div class="book-box">
                    <h3>{{ book.title }}</h3>
                    <p>by {{ book.author }}</p>
                    <p>Serial Number: {{ book.serial_number }}</p>
                    <p>Status: {{ 'Available' if book.available else 'Not Available' }}</p>
                    <a href="/edit_book/{{ book.id }}">Edit</a>
                    <a href="/delete_book/{{ book.id }}">Delete</a>
                </div>
                {% endfor %}
            </div>
            <h2>Add New Book</h2>
            <form action="/add_book" method="post">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br><br>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required><br><br>
                <label for="serial_number">Serial Number:</label>
                <input type="text" id="serial_number" name="serial_number" required><br><br>
                <input type="submit" value="Add Book">
            </form>
        </div>
    </body>
    </html>
    ''', books=books)

@app.route('/add_book', methods=['POST'])
def add_book():
    if 'username' not in session or not session.get('admin'):
        return redirect(url_for('static', filename='login.html'))
    title = request.form.get('title')
    author = request.form.get('author')
    serial_number = request.form.get('serial_number')
    book_id = len(books) + 1
    books.append({'id': book_id, 'title': title, 'author': author, 'serial_number': serial_number, 'available': True})
    return redirect(url_for('admin'))

@app.route('/edit_book/<int:book_id>', methods=['GET', 'POST'])
def edit_book(book_id):
    if 'username' not in session or not session.get('admin'):
        return redirect(url_for('static', filename='login.html'))
    book = next((b for b in books if b['id'] == book_id), None)
    if request.method == 'POST':
        book['title'] = request.form.get('title')
        book['author'] = request.form.get('author')
        book['serial_number'] = request.form.get('serial_number')
        return redirect(url_for('admin'))
    return render_template_string('''
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Book</title>
        <link rel="stylesheet" href="/static/styles.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="/static/index.html">Home</a></li>
                <li><a href="/static/about.html">About</a></li>
                <li><a href="/static/services.html">Services</a></li>
                <li><a href="/static/contact.html">Contact</a></li>
                <li><a href="/static/register.html" class="register-btn">Register</a></li>
                <li><a href="/static/login.html" class="login-btn">Login</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <h1>Edit Book</h1>
            <form action="/edit_book/{{ book.id }}" method="post">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ book.title }}" required><br><br>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="{{ book.author }}" required><br><br>
                <label for="serial_number">Serial Number:</label>
                <input type="text" id="serial_number" name="serial_number" value="{{ book.serial_number }}" required><br><br>
                <input type="submit" value="Save Changes">
            </form>
        </div>
    </body>
    </html>
    ''', book=book)

@app.route('/delete_book/<int:book_id>')
def delete_book(book_id):
    if 'username' not in session or not session.get('admin'):
        return redirect(url_for('static', filename='login.html'))
    global books
    books = [b for b in books if b['id'] != book_id]
    return redirect(url_for('admin'))

@app.route('/buy_book/<int:book_id>', methods=['POST'])
def buy_book(book_id):
    if 'username' not in session:
        return redirect(url_for('static', filename='login.html'))
    book = next((b for b in books if b['id'] == book_id), None)
    if book:
        book['available'] = False
        return jsonify({'status': 'success', 'message': f'You have bought {book["title"]}.'})
    return jsonify({'status': 'error', 'message': 'Book not found.'}), 404

@app.route('/borrow_book/<int:book_id>', methods=['POST'])
def borrow_book(book_id):
    if 'username' not in session:
        return redirect(url_for('static', filename='login.html'))
    book = next((b for b in books if b['id'] == book_id), None)
    if book:
        book['available'] = False
        return jsonify({'status': 'success', 'message': f'You have borrowed {book["title"]} for one month.'})
    return jsonify({'status': 'error', 'message': 'Book not found.'}), 404

@app.route('/return_book', methods=['POST'])
def return_book():
    serial_number = request.form.get('serial_number')
    book = next((b for b in books if b['serial_number'] == serial_number), None)
    if book:
        book['available'] = True
    return redirect(url_for('admin'))

@app.route('/books')
def get_books():
    return jsonify({'books': books})

@app.route('/<path:path>')
def static_files(path):
    return send_from_directory('static', path)

if __name__ == '__main__':
    app.run(debug=True)