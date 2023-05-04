
# Your Rooms

Este proyecto consiste en un sistema de salas de chat en línea que permite a los usuarios conectarse y comunicarse en tiempo real. Está dirigido a cualquier persona interesada en conocer y socializar con otros usuarios a través de una plataforma virtual.

## Pre-requisitos 📋
Para la correcta ejecución de este proyecto, necesitas tener las siguientes tecnologías instaladas en tu ordenador.
* Php ^7.2.5|^8.0
* Composer 1.8.0
* Laravel ^6.20.26
* Laravel Echo Server 1.6.3
* Redis ^4.0.14
* Npm 8.19.3
* MySQL ^5.5
## Instalación 🔧

1. Clona este proyecto.
```bash
git clone https://github.com/JoanArturo/your-rooms.git
```

2. Instala las dependencias de php con composer.
```bash
composer install
```

3. Instala las dependencias de javascript con npm.
```bash
npm install
```

4. Crea una nueva base de datos con tu gestor de base de datos preferido.

5. Crea el archivo .env y configura las variables de entorno correspondientes.
```json
APP_NAME="Your Rooms"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://you-rooms.com

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=your_new_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

BROADCAST_DRIVER=redis
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

FILESYSTEM_DRIVER=public
REDIS_CLIENT=predis

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
CALLBACK_URL_GOOGLE="http://you-rooms.com/auth/google/callback"
```

6. Configura una cuenta Gmail para obtener el GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET y CALLBACK_URL_GOOGLE para que el módulo de inicio de sesión por correo funcione correctamente.

7. Genera una APP_KEY.
```bash
php artisan key:generate
```

8. Ejecuta las migraciones con los seeders.
```bash
php artisan migrate:fresh --seed
```

9. Crea el enlace de la carpeta storage/app/public.
```bash
php artisan storage:link
```

10. Genera el archivo de configuración laravel-echo-server.json.
```bash
laravel-echo-server init
```

11. Configura el archivo laravel-echo-server.json.
```json
{
	"authHost": "http://you-rooms.com",
	"authEndpoint": "/broadcasting/auth",
	"clients": [],
	"database": "redis",
	"databaseConfig": {
		"redis": {},
		"sqlite": {
			"databasePath": "/database/laravel-echo-server.sqlite"
		}
	},
	"devMode": true,
	"host": "127.0.0.1",
	"port": "6001",
	"protocol": "http",
	"socketio": {},
	"secureOptions": 67108864,
	"sslCertPath": "",
	"sslKeyPath": "",
	"sslCertChainPath": "",
	"sslPassphrase": "",
	"subscribers": {
		"http": true,
		"redis": true
	},
	"apiOriginAllow": {
		"allowCors": false,
		"allowOrigin": "",
		"allowMethods": "",
		"allowHeaders": ""
	}
}
```

12. Ejecuta el demonio de Laravel Echo Server.
```bash
laravel-echo-server start
```

13. Ejecuta el proyecto laravel.
```bash
php artisan serve
```
## Construido con 🛠️
- [Laravel 6.20.26](https://laravel.com/docs/6.x)
- [Composer 1.8.0](https://getcomposer.org/)
- [Bootstrap 4.0.0](https://getbootstrap.com/docs/4.0/getting-started/introduction/)
- [Laravel Echo Server 1.6.3](https://github.com/tlaverdure/laravel-echo-server)
- [Laravel Echo 1.15.0](https://github.com/laravel/echo/tree/v1.15.0)
- [Socket IO Client 2.3.0](https://socket.io/docs/v2/client-installation/)
- [Axios 0.19](https://github.com/axios/axios/tree/v0.19.0)
- [Remix Icon 2.5.0](https://remixicon.com/releases)
- [Select2 4.1.0](https://select2.org/getting-started/installation)
- [MySQL 5.5](https://downloads.mysql.com/archives/community/)
- [Redis 4.0.14](https://redis.io/download/)
- [Npm 8.19.3](https://www.npmjs.com/package/npm/v/8.19.3)


## Preview 📸

- Inicio de sesión
![App Screenshot](https://i.imgur.com/LdwiPKd.png)

- Registro
![App Screenshot](https://i.imgur.com/iuVC8rz.png)

- Pagina principal
![App Screenshot](https://i.imgur.com/KkQFfkG.png)

- Sala de chat
![App Screenshot](https://i.imgur.com/A0OaKe2.png)

- Galería de fotos del usuario
![App Screenshot](https://i.imgur.com/eUlMeRJ.png)

- Datos de perfil del usuario
![App Screenshot](https://i.imgur.com/RaW8IKt.png)

- Otros ajustes
![App Screenshot](https://i.imgur.com/xrprZlC.png)

- Sidebar de salas disponibles
![App Screenshot](https://i.imgur.com/B9ChRX3.png)

- Sidebar de salas abiertas por el usuario
![App Screenshot](https://i.imgur.com/hCJ1Nu9.png)

- Listado de usuarios (Administrador)
![App Screenshot](https://i.imgur.com/pkBUosV.png)

- Listado de salas (Administrador)
![App Screenshot](https://i.imgur.com/RtY7mtf.png)

- Listado de reportes recibidos (Administrador)
![App Screenshot](https://i.imgur.com/7Y0krxJ.png)
## Autor 🖋️

- [@JoanArturo](https://github.com/JoanArturo)