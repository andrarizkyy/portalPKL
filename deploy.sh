#!/bin/bash

# Menjalankan rangkaian perintah Laravel
git pull
php artisan migrate --force
php artisan optimize:clear

# Mengatur permission
chmod -R 777 bootstrap
chmod -R 777 storage

echo "✅ Update berhasil dijalankan!"