#!/bin/bash
set -e

# Esperar a que MySQL esté listo
echo "⏳ Esperando a que MySQL esté disponible..."
while ! mysqladmin ping -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent 2>/dev/null; do
    sleep 2
done
echo "✅ MySQL está listo!"

# Verificar si Laravel ya está instalado
if [ ! -f "/var/www/artisan" ]; then
    echo "📦 Instalando Laravel..."
    composer create-project laravel/laravel /var/www/temp --prefer-dist --no-interaction
    mv /var/www/temp/* /var/www/temp/.[!.]* /var/www/ 2>/dev/null || true
    rm -rf /var/www/temp
    echo "✅ Laravel instalado!"
fi

# Configurar el archivo .env de Laravel
echo "🔧 Configurando .env de Laravel..."
if [ -f "/var/www/.env.example" ] && [ ! -f "/var/www/.env" ]; then
    cp /var/www/.env.example /var/www/.env
fi

# Actualizar valores del .env
sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/" /var/www/.env
sed -i "s/DB_HOST=.*/DB_HOST=$DB_HOST/" /var/www/.env
sed -i "s/DB_PORT=.*/DB_PORT=$DB_PORT/" /var/www/.env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" /var/www/.env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" /var/www/.env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" /var/www/.env

# Configurar Redis si está disponible
sed -i "s/CACHE_STORE=.*/CACHE_STORE=redis/" /var/www/.env 2>/dev/null || true
sed -i "s/SESSION_DRIVER=.*/SESSION_DRIVER=redis/" /var/www/.env 2>/dev/null || true
sed -i "s/REDIS_HOST=.*/REDIS_HOST=redis/" /var/www/.env

echo "✅ .env configurado!"

# Instalar dependencias si no existen
if [ ! -d "/var/www/vendor" ]; then
    echo "📦 Instalando dependencias de Composer..."
    cd /var/www && composer install --no-interaction --optimize-autoloader
    echo "✅ Dependencias instaladas!"
fi

# Generar key si no existe
cd /var/www
if grep -q "APP_KEY=$" /var/www/.env || grep -q "APP_KEY=base64" /var/www/.env; then
    echo "🔑 APP_KEY ya existe"
else
    echo "🔑 Generando APP_KEY..."
    php artisan key:generate --force
fi

# Configurar permisos
echo "🔐 Configurando permisos..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/storage /var/www/bootstrap/cache 2>/dev/null || true

# Ejecutar migraciones
echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force || true

# Limpiar y cachear
echo "🧹 Optimizando Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo ""
echo "🚀 ¡Laravel está listo!"
echo "📍 Accede a: http://localhost:8000"
echo "📍 phpMyAdmin: http://localhost:8080"
echo ""

# Iniciar PHP-FPM
exec php-fpm
