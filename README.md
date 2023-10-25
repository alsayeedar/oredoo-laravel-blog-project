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

## Screenshots
<p align="center" width="100%">
    <img width="30%" src="https://raw.githubusercontent.com/alsayeedar/oredoo-laravel-blog-project/main/Screenshots/Screenshot_1.png"/>
    <img width="30%" src="https://raw.githubusercontent.com/alsayeedar/oredoo-laravel-blog-project/main/Screenshots/Screenshot_2.png"/>
    <img width="30%" src="https://raw.githubusercontent.com/alsayeedar/oredoo-laravel-blog-project/main/Screenshots/Screenshot_3.png"/>
</p>
<p align="center" width="100%">
    <img width="30%" src="https://raw.githubusercontent.com/alsayeedar/oredoo-laravel-blog-project/main/Screenshots/Screenshot_4.png"/>
    <img width="30%" src="https://raw.githubusercontent.com/alsayeedar/oredoo-laravel-blog-project/main/Screenshots/Screenshot_5.png"/>
    <img width="30%" src="https://raw.githubusercontent.com/alsayeedar/oredoo-laravel-blog-project/main/Screenshots/Screenshot_6.png"/>
</p>

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

## Contact:
[![Find me on Facebook](https://img.shields.io/badge/Facebook-1877F2?style=for-the-badge&logo=facebook&logoColor=white)](https://www.facebook.com/AlSayeedOfficial) [![Follow me on Instagram](https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white)](https://www.instagram.com/AlSayeedAR) [![Join on Telegram](https://img.shields.io/badge/Telegram-2CA5E0?style=for-the-badge&logo=telegram&logoColor=white)](https://t.me/AlSayeedAR) [![Message me on WhatsApp](https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white)](https://wa.me/8801868188006) [![Visit my Website](https://img.shields.io/badge/website-FF5722?style=for-the-badge&logo=blogger&logoColor=white)](https://www.priyotrick.com/)
