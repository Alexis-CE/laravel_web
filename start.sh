#!/bin/bash

# Tailscale en modo userspace (sin TUN, compatible con Render)
tailscaled --tun=userspace-networking --socks5-server=localhost:1055 --state=/tmp/tailscale.state &
sleep 2

tailscale up --authkey=${TAILSCALE_AUTHKEY} --hostname=render-laravel

for i in {1..15}; do
  tailscale status > /dev/null 2>&1 && break
  sleep 1
done

# Proxy TCP local 3306 -> NAS vía SOCKS5 de tailscale
socat TCP-LISTEN:3306,fork,reuseaddr SOCKS5:127.0.0.1:${TAILSCALE_NAS_IP}:3306,socksport=1055 &

sleep 2

cat > /var/www/.env << EOF
APP_NAME=laravel_web
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=https://laravel-web-2f0e.onrender.com
ASSET_URL=https://laravel-web-2f0e.onrender.com
FORCE_HTTPS=true
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}
SESSION_DRIVER=file
CACHE_STORE=file
LOG_CHANNEL=stderr
EOF

php artisan config:clear
php artisan serve --host=0.0.0.0 --port=8080
