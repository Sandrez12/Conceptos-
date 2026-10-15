#!/bin/sh
set -e

# Render (y otros proveedores) indican el puerto por la variable PORT.
PORT="${PORT:-80}"
sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Esta aplicación no cifra datos persistentes; si no hay clave, se genera una temporal.
if [ -z "${APP_KEY}" ]; then
  export APP_KEY="$(php artisan key:generate --show --no-interaction)"
fi

php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

exec apache2-foreground
