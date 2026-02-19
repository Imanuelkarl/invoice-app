# Sales Invoice Management System

A simple yet complete CRUD web application built with **Laravel 12** for
managing sales invoices.

---

## ✨ Features

- Full **CRUD** operations for invoices\
- Invoice listing with **pagination**\
- Filter invoices by **date range** and **payment status**\
- **File upload** support (PDF, JPG, JPEG, PNG)\
- Clean, modern, responsive UI using **plain CSS + vanilla
  JavaScript**\
- Auto-submit filter when changing payment status\
- Client-side form enhancements:
    - File preview\
    - Loading states\
    - Basic validation\
- Proper Laravel **resource routing & model binding**

---

## 🛠 Tech Stack

- **Backend:** Laravel 12.x (PHP 8.1+)\
- **Database:** MySQL / MariaDB\
- **Frontend:** Blade templates + HTML + CSS + Vanilla JavaScript\
- **Styling:** Custom CSS (No Tailwind / Bootstrap)\
- **File Storage:** Laravel public disk\
- **Asset Handling:** Vite (optional)

---

## 📋 Requirements

- PHP ≥ 8.1\
- Composer\
- MySQL or MariaDB\
- Node.js & npm (optional -- for asset compilation)\
- Git

---

## 🚀 Installation

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/Imanuelkarl/invoice-app.git
cd invoice-app
```

---

### 2️⃣ Install Dependencies

```bash
composer install
```

Optional (only if compiling assets):

```bash
npm install
```

---

### 3️⃣ Set Up Environment File

```bash
cp .env.example .env
```

Edit `.env` and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invoiceapp
DB_USERNAME=<your-username>
DB_PASSWORD=<your-password>
```

Generate application key:

```bash
php artisan key:generate
```

---

### 4️⃣ Create Database & Run Migrations

Create a database named:

    invoiceapp

Then run:

```bash
php artisan migrate
```

---

### 5️⃣ Create Storage Symlink (Required for File Uploads)

```bash
php artisan storage:link
```

---

### 6️⃣ (Optional) Compile Assets

Development:

```bash
npm run dev
```

Production:

```bash
npm run build
```

---

### 7️⃣ Start Development Server

```bash
php artisan serve
```

Open in browser:

    http://127.0.0.1:8000/invoices

---

## 📂 Project Structure Highlights

    app/
    ├── Http/
    │   └── Controllers/
    │       └── InvoiceController.php
    ├── Models/
    │   └── Invoice.php

    database/
    ├── migrations/
    │   └── *_create_invoices_table.php

    public/
    ├── css/
    │   └── invoices.css
    ├── js/
    │   ├── invoices-create.js
    │   └── invoices-edit.js

    resources/
    └── views/
        └── invoices/
            ├── index.blade.php
            ├── create.blade.php
            ├── edit.blade.php
            └── show.blade.php

    routes/
    └── web.php

---

## 📌 Usage

Action URL

---

List & Filter `/invoices`
Create `/invoices/create`
View `/invoices/{id}`
Edit `/invoices/{id}/edit`
Delete Via form on list or show page

---

## 🔎 Filter Behavior

- Changing **Payment Status dropdown** → auto-filters (JavaScript)\
- **Date range filter** → requires clicking "Filter" button

---

## 📎 File Uploads

- Supported formats: `PDF`, `JPG`, `JPEG`, `PNG`\
- Maximum size: **2MB** (configurable in validation rules)

---

## 🔐 Security Notes (Development)

- Keep `APP_DEBUG=true` only in local/development\

- In production:

    ```env
    APP_ENV=production
    APP_DEBUG=false
    ```

- Never commit real `.env` credentials\

- Add authentication (Laravel Breeze / Jetstream / Sanctum) for
  production use

---

## 🧩 Troubleshooting

---

Issue Possible Fix

---

Page not found `php artisan route:clear`

View not found Check path: `resources/views/invoices/...`

File not showing after Run `php artisan storage:link`
upload

Database connection Verify `.env` credentials & ensure MySQL is
error running

CSS/JS not loading Check asset paths or run `npm run dev`

---

---

## 📜 License

MIT License (or your preferred license)

---

## 👨‍💻 Author

Built with ❤️ in Abuja, Nigeria\
Last updated: February 2026
