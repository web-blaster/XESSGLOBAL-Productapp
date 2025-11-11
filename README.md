# XESSGLOBAL-Productapp

A **Laravel-based product management application** with **REST API support**, **JWT authentication**, and a **web interface**.

---

## Table of Contents

- [Installation](#installation)
- [Assets](#assets)
- [Default Login Credentials](#default-login-credentials)
- [Project Structure](#project-structure)
- [API Usage](#api-usage) *(Optional for developers)*

---

## Installation

Follow these steps to set up the project locally:

### 1. Clone the repository
```bash
git clone https://github.com/web-blaster/XESSGLOBAL-Productapp.git
cd XESSGLOBAL-Productapp

#Install PHP dependencies
composer install

#Install Node.js dependencies
npm install

#cp .env.example .env
cp .env.example .env

#Generate application key
php artisan key:generate

#Configure .env database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xess_global_product_app
DB_USERNAME=root
DB_PASSWORD=

#Run migrations
php artisan migrate

#Optionally, seed the database
php artisan db:seed

#Compile assets using Vite
npm run dev

#Start Laravel development server
php artisan serve

##Assets

All project assets, including the database and API collection, are available inside the assets folder.

Make sure to run npm run dev to compile CSS/JS using Vite.

##Default Login Credentials

Use the following to access the system:

Email: admin@example.com

Password: password123

##Project Structure
XESSGLOBAL-Productapp/
├── app/                # Application logic
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/             # Public assets
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
├── storage/
├── tests/
├── composer.json
├── package.json
└── vite.config.js

##API Usage (Optional)

Authentication

Endpoint: /api/login

Method: POST

Body:{
  "email": "admin@example.com",
  "password": "password123"
}

