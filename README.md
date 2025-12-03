# Laravel Book Library CRUD Application

This is a simple CRUD application built with Laravel for managing a list of books and tracking their borrowing/return process.

## Features

### Part 01 – Books & Categories

- `book_cate` table for book categories
- `books` table for storing book details
- Seeded 5 default book categories
- List all books on the home page with
  - Title
  - Author
  - Category
  - Price
  - Stock
- Filter books by category
- Create a new book with
  - Title (required)
  - Author (required)
  - Price (required, numeric)
  - Stock (required, numeric)
  - Category selection (required)
- Edit existing books (including stock and category)
- Delete books
- Out-of-stock indication
  - Shows a badge and red row when stock is 0


### Part 02 – Users, Borrowing & Returning

- Uses default Laravel `users` table to represent members/users
- `borrows` table to track issuing and returning of books
- Issue a book to a user
  - Creates a record in `borrows` with `issued_at`
  - Decreases book stock by 1
  - If stock becomes 0, shows an out-of-stock message
- Return a book
  - Sets `returned_at` timestamp
  - Increases book stock by 1
- Simple screens to
  - List all borrow records
  - Issue a new book
  - Mark a borrow as returned

---

## Validation Rules

Implemented using Laravel validation inside controllers

### Books
- `title`: required, string, max:255  
- `author`: required, string, max:255  
- `price`: required, numeric, min:0  
- `stock`: required, integer, min:0  
- `book_category_id`: required, exists in `book_cate`

### Borrow
- `user_id`: required, exists in `users`  
- `book_id`: required, exists in `books`

Error messages appear next to form fields and as success/error alerts.


## Technologies Used

- PHP (Laravel Framework)
- MySQL (via XAMPP)
- Laravel Eloquent ORM
- Blade templating engine
- Bootstrap 5 (CDN) for styling


## Database Schema

### book_cate
- `id` (PK)
- `name`  
- timestamps

### books
- `id` (PK)
- `title`
- `author`
- `price` (decimal 8,2)
- `stock` (integer)
- `book_category_id` (FK → `book_cate.id`)
- timestamps

### users
- Default Laravel user table  
(used to represent members)

### borrows
- `id` (PK)
- `user_id` (FK → `users.id`)
- `book_id` (FK → `books.id`)
- `issued_at`
- `returned_at` (nullable)
- timestamps

## Setup Instructions

### 1. Clone the repository

git clone https://github.com/<your-username>/<your-repo>.git
cd <your-repo>

### 2. Install dependencies

composer install


### 3. Create .env file

cp .env.example .env


Update database section in `.env`

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_crud
DB_USERNAME=root
DB_PASSWORD=


Generate app key

php artisan key:generate


### 4. Migrate & seed database

php artisan migrate
php artisan db:seed


This creates all tables and seeds 5 book categories.


### 5. Run the development server

php artisan serve


Open

* http://127.0.0.1:8000 → Book list
* http://127.0.0.1:8000/borrows → Borrow / Return page



## Main

### Books CRUD

* `GET /`
* `GET /books`
* `GET /books/create`
* `POST /books`
* `GET /books/{book}/edit`
* `PUT /books/{book}`
* `DELETE /books/{book}`

### Borrow / Return

* `GET /borrows`
* `GET /borrows/create`
* `POST /borrows`
* `POST /borrows/{borrow}/return`


## Additional Info

* Authentication is not implemented for simplicity.
* The project focuses on clean, readable, and beginner-friendly Laravel code.
* This project focuses mainly in demonstrating CRUD, database relations, Eloquent, Blade, routing, and form validation.
