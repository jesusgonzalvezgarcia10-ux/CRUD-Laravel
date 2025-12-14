# Laravel Docker CRUD

Proyecto Laravel listo para ejecutar en cualquier sistema operativo con Docker.

## 🚀 Requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## 📦 Servicios incluidos

| Servicio    | Puerto | Descripción              |
|-------------|--------|--------------------------|
| Nginx       | 8000   | Servidor web             |
| PHP 8.2     | 9000   | PHP-FPM                  |
| MySQL 8.0   | 3306   | Base de datos            |
| phpMyAdmin  | 8080   | Administrador de BD      |
| Redis       | 6379   | Cache y sesiones         |

## 🛠️ Instalación

### 1. Crear proyecto Laravel (primera vez)

```bash
# Clonar o descargar este repositorio
cd CRUD-Laravel

# Crear proyecto Laravel en la carpeta src
docker run --rm -v ${PWD}/src:/app composer create-project laravel/laravel .
```

### 2. Configurar Laravel

Edita el archivo `src/.env` con estos valores:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_HOST=redis
```

### 3. Levantar los contenedores

```bash
docker-compose up -d
```

### 4. Instalar dependencias y configurar

```bash
# Entrar al contenedor
docker-compose exec app bash

# Dentro del contenedor:
composer install
php artisan key:generate
php artisan migrate
```

## 📌 Comandos útiles

```bash
# Levantar contenedores
docker-compose up -d

# Ver logs
docker-compose logs -f

# Detener contenedores
docker-compose down

# Reconstruir contenedores
docker-compose up -d --build

# Ejecutar comandos artisan
docker-compose exec app php artisan <comando>

# Ejecutar composer
docker-compose exec app composer <comando>

# Acceder al contenedor
docker-compose exec app bash

# Ver estado de contenedores
docker-compose ps
```

## 🌐 URLs de acceso

- **Aplicación Laravel:** http://localhost:8000
- **phpMyAdmin:** http://localhost:8080
  - Usuario: `laravel`
  - Contraseña: `secret`

## 📁 Estructura del proyecto

```
CRUD-Laravel/
├── docker/
│   ├── nginx/
│   │   └── conf.d/
│   │       └── app.conf
│   └── php/
│       └── local.ini
├── src/                    # Código Laravel (se genera)
├── .env                    # Variables de entorno Docker
├── docker-compose.yml
├── Dockerfile
└── README.md
```

## 🔧 Solución de problemas

### Permisos en Linux/Mac
```bash
sudo chown -R $USER:$USER src/
chmod -R 755 src/storage src/bootstrap/cache
```

### Limpiar todo y empezar de nuevo
```bash
docker-compose down -v
rm -rf src/*
```

## 📄 Licencia

MIT
