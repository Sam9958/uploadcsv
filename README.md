A Laravel-based application that allows uploading a CSV file containing user data and inserts only valid records into a MySQL database.
The project is fully containerized using Docker.

🚀 Features

Upload CSV file containing users
Validate CSV records before inserting
Skip invalid or duplicate records

Store valid users in MySQL database

Fully Dockerized environment

REST API support

Clean architecture using Service Layer

🛠 Tech Stack

PHP 8.2

Laravel 10+

MySQL 8

Docker & Docker Compose

Apache

📁 CSV Format

The CSV file should contain the following columns:

user_id,email,user_name,password
Example:
1,test1@example.com,Test User 1,password123
2,test2@example.com,Test User 2,password456
📦 Project Setup (Using Docker)
1️⃣ Clone the repository
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
2️⃣ Start Docker Containers
docker-compose up -d --build
3️⃣ Install Dependencies
docker exec -it laravel_app composer install
4️⃣ Setup Environment

Copy .env.example to .env

cp .env.example .env

Update database credentials in .env:

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=secret
5️⃣ Generate Application Key
docker exec -it laravel_app php artisan key:generate
6️⃣ Run Migrations
docker exec -it laravel_app php artisan migrate
🗂 Database Structure
users table
Column	Type
id	bigint
user_id	string
email	string
user_name	string
password	string
created_at	timestamp
updated_at	timestamp
📤 API Endpoint
Upload CSV

POST /api/upload-csv

Request (Form Data)
Key	Type
csv_file	File


#second question anaswr
SELECT customers.customer_id, customers.name, customers.email, SUM(orders.amount) AS total_amount FROM customers INNER JOIN orders ON customers.customer_id = orders.customer_id WHERE YEAR(orders.order_date) = YEAR(CURRENT_DATE) - 1 GROUP BY customers.customer_id, customers.name, customers.email ORDER BY total_amount;
