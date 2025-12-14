# Laravel Docker CRUD

Proyecto Laravel listo para ejecutar en **cualquier sistema operativo** con un solo comando.

## 🚀 Requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## ⚡ Inicio rápido

```bash
docker compose up
```

**¡Eso es todo!** 🎉

La primera vez tardará unos minutos mientras:
- Descarga las imágenes de Docker
- Instala Laravel automáticamente
- Configura la base de datos
- Ejecuta las migraciones

## 🌐 URLs de acceso

| Servicio    | URL                      | Credenciales           |
|-------------|--------------------------|------------------------|
| Laravel     | http://localhost:8000    | -                      |
| phpMyAdmin  | http://localhost:8080    | laravel / secret       |

## 📦 Servicios incluidos

| Servicio    | Puerto | Descripción              |
|-------------|--------|--------------------------|
| Nginx       | 8000   | Servidor web             |
| PHP 8.2     | 9000   | PHP-FPM                  |
| MySQL 8.0   | 3306   | Base de datos            |
| phpMyAdmin  | 8080   | Administrador de BD      |
| Redis       | 6379   | Cache y sesiones         |

## 📌 Comandos útiles

```bash
# Levantar contenedores
docker compose up

# Levantar en segundo plano
docker compose up -d

# Ver logs
docker compose logs -f

# Ver logs de Laravel
docker compose logs -f app

# Detener contenedores
docker compose down

# Detener y eliminar volúmenes (borrar BD)
docker compose down -v

# Reconstruir contenedores
docker compose up -d --build

# Ejecutar comandos artisan
docker compose exec app php artisan <comando>

# Ejecutar composer
docker compose exec app composer <comando>

# Acceder al contenedor
docker compose exec app bash
```

## 📁 Estructura del proyecto

```
CRUD-Laravel/
├── docker/
│   ├── nginx/
│   │   └── conf.d/
│   │       └── app.conf        # Config Nginx
│   ├── php/
│   │   └── local.ini           # Config PHP
│   └── entrypoint.sh           # Script de inicio automático
├── src/                        # Código Laravel (se genera automáticamente)
├── docker-compose.yml
├── Dockerfile
└── README.md
```

## 🔧 Configuración de la base de datos

Las credenciales por defecto son:

| Variable     | Valor    |
|--------------|----------|
| DB_HOST      | db       |
| DB_DATABASE  | laravel  |
| DB_USERNAME  | laravel  |
| DB_PASSWORD  | secret   |

## 🔧 Solución de problemas

### El contenedor no inicia
```bash
# Ver los logs para identificar el error
docker compose logs app
```

### Permisos en Linux/Mac
```bash
sudo chown -R $USER:$USER src/
```

### Limpiar todo y empezar de nuevo
```bash
docker compose down -v
rm -rf src/*
docker compose up --build
```

### Puerto en uso
Si el puerto 8000 u 8080 está en uso, edita `docker-compose.yml` y cambia los puertos.

## 📄 Licencia

MIT
