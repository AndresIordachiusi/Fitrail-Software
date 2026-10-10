#!/bin/sh
set -e
cd /var/www/html

php artisan package:discover --ansi
php artisan config:cache
php artisan view:cache || true

# Crea/actualiza las tablas en cada arranque (es seguro repetirlo)
php artisan migrate --force

# Datos de ejemplo (SqlDumpSeeder). Controlado por la variable RUN_SEED en Render:
#   RUN_SEED=true  -> carga los datos si la BD esta vacia (si ya estan, lo omite sin romper nada)
#   RUN_SEED=fresh -> BORRA todo y vuelve a crear tablas + datos (para recuperarte de un seed a medias)
if [ "$RUN_SEED" = "fresh" ]; then
  php artisan migrate:fresh --seed --force
elif [ "$RUN_SEED" = "true" ]; then
  php artisan db:seed --force || echo "Seed omitido (probablemente ya estaba cargado)"
fi

chown -R www-data:www-data storage bootstrap/cache
exec apache2-foreground
