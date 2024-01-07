# Metamata.id

## Requirement
**Backend**
<!-- - visual c++ redistributable packages (khusus untuk OS Windows) -->
- XAMPP (Min. PHP 8.1)
- Composer

## 1. How To Clone
**All branch**
```bash
git clone <url_git>
```
**Only one branch**
```bash
git clone -b <branch_name> <url_git>
```

## 2. Installation
**Backend**
- Install melalui composer
```bash
composer install
```
- Copy .env.example menjadi .env
```bash
cp .env.example .env
```

- Generate key
```bash
php artisan key:generate
```

- Setting Database
    - Buat Database MySQL baru, kemudian biarkan kosong
    - buka file .env
    - edit DB_DATABASE sesuai nama Database yang dibuat tadi
    - edit DB_USERNAME sesuai pengaturan, jika belum diatur isi dengan root
    - edit DB_PASSWORD sesuai pengaturan, jika belum diatur kosongi saja

- Migrate Database
```bash
php artisan migrate
```

- Seed Database User atau admin. untuk kebutuhan login bisa cek di folder /database/seeders/UserSeeder (untuk akun user)
```bash
php artisan db:seed
```

- Install module untuk JS
```bash
npm install
```

- Bundling module JS
```bash
npm run dev
```

- Buat Link Storage
```bash
php artisan storage:link
```

## 3. Run
- Running Server
```bash
php artisan serve
```
