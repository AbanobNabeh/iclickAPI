# iClick API

Live Demo: https://iclickapi-main-vfl3rp.free.laravel.cloud/

This is a Laravel-based API project built with PHP. It provides social media features like posts, reels, stories, comments, follow system, and authentication.

---

## 🚀 Requirements

- PHP >= 8.1
- Composer
- MySQL / SQL Server / Any supported DB
- Node.js & NPM (optional)

---

## 📦 Installation

```bash
git clone https://github.com/AbanobNabeh/iclickAPI.git
cd iclickAPI
composer install
cp .env.example .env
php artisan key:generate

APP_URL=https://iclickapi-main-vfl3rp.free.laravel.cloud/

DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password


php artisan migrate
php artisan db:seed

php artisan storage:link

```
🧹 Useful Artisan Commands
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan migrate:fresh
```
