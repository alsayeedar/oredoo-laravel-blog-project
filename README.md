# Oredoo - Laravel Multi User Blog Project

A multi user blog project using Laravel 10 and Oredoo blog template

## Features

- Multi User (Admin, Author, Visitor)
- Comment and reply system (including guest comment)
- Featured post, Popular post
- Category, Tag, Search module
- Media Library
- Pages
- Dynamic header, footer menu
- Post, comment, category trash and restore
- etc.

## Installation

- Clone this repository
```
git clone https://github.com/alsayeedar/oredoo-laravel-blog-project.git
```
- Change directory
```
cd oredoo-laravel-blog-project
```
- Copy .env.example file
```
cp .env.example .env
```
- Install composer
```
composer i
```
- Generate key
```
php artisan key:generate
```
- Update database information in .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
- Run migration
```
php artisan migrate
```
- Seed databse
```
php artisan db:seed
```
- Start server
```
php artisan serve
```
- See the result
```
http://127.0.0.1:8000/
```

## Admin Details
- Admin credential
```
Username:admin
Password:admin
```

## Credit

- **[Al Sayeed](https://github.com/alsayeedar/)**
