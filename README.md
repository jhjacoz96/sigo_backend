developer jhjacoz96@gmail.com

Pasos para instalar 

1- Clonar https://github.com/jhjacoz96/order_api.git
2- Cambiarse a la rama dev con el comando git checkout dev
3- Opcional Instalar Laragon (PHP + MySQL + Apache) https://sourceforge.net/projects/laragon/files/releases/4.0/laragon-full.exe
4- Crear una base de datos llamada order
5- Crear en la raiz del proyecto el archivo .env con el archivo suministrado
6- Copiar el .env.example en .env
7- Editar el archivo colocando el usuario mysql (root o el que hayan creado para conectarse a mysql) y la clave del mismo, colocar el nombre de la base de datos que crearon.
8- Ejecutar el comando en la raiz del proyecto "php artisan passport:install --force" (sin comillas)
9- Ejecutar el comando en la raiz del proyecto "php artisan db:seed" (sin comillas)
10- Ejecutar la aplicacion con el comando "php artisan serve"
11- Abrir el navegador wen en la direccion url http://localhost:8000
