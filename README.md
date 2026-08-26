# Requirements
- laravel 13.x + laravel kit starter livewire
- php 8.3+

# Setup
- php -v
- composer --version
- node -v
- npm v
- git --version
- laravel new kantin-multi-tenant
- npm isntall && npm run build
- composer require livewire/livewire
- php artisan install:broadcasting -> install laravel reverb
- setup .env

# run
- composer run dev
- php artisan reverb:start

# test
- php artisan test
- ./vendor/bin/pint --test
- npm run build

# troubleshooting
- jika instalasi reverb error karena locking package json, jalankan composer require laravel/reverb -W untuk sekalian di sesuaikan sesuai dependecy yg ada
- lalu isi .env dengan:
BROADCAST_CONNECTION=reverb (matikan yg isi log)

REVERB_APP_ID=
REVERB_APP_KEY=
REVERB_APP_SECRET=
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http

- Lalu jalankan php artisan reverb:install untuk id,key,dan secret
- dan terkahir tinggal ulangin php artisan reverb:start