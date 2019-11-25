# Organilab 🖥
 Software diseñado para el departamento de computación e informática con la finalidad de facilitar la gestión sus recursos.
 
 ## Inicio 🚀
 
 ### Pre-requisitos 📋
 Para ejecutar el prototipo es necesario contar con los siguientes programas instalados en el equipo:
 * XAMPP
 * Mozilla Firefox
 * Composer
 * Laravel
 * Editor de texto (ej. Visual Studio Code)
 
 ### Instalación 🔧
 1. Copiar la carpeta que contiene el software en el directorio *htdocs* que se encuentra ubicado donde se instaló XAMPP.
 2. Iniciar el módulo Apache y MySQL de XAMPP.
 3. Abrir la carpeta de ORGANILAB con un editor de texto y modificar el archivo .env en las siguientes variables:
    ```
    DB_DATABASE = Nombre de la base de datos (ej. bd_organilab)
    DB_USERNAME = Nombre del usuario (ej. root)
    DB_PASSWORD = Contraseña de la base de datos
    ```
  4. Crear una base de datos con el mismo nombre que se asignó en *DB_DATABASE* en el panel de phpMyAdmin que ofrece XAMPP.
  5. Acceder por medio del terminal a la carpeta donde está ubicado Organilab e ingresar el siguiente comando:
     ```
     php artisan migrate:refresh --seed
     ```
  6. Para iniciar el software se debe ingresar el comando:
     ```
     php artisan serve
     ```
   7. Ingresar a la siguiente dirección [http://127.0.0.1:8000](http://127.0.0.1:8000).
 ## Construido con 🛠️
* [Laravel 5.8](https://laravel.com/docs/5.8/releases) - El framework web usado
* [XAMPP](https://www.apachefriends.org/es/index.html) - Apache + MariaDB
 
 ## Wiki 📖
*En desarrollo.*
 ## Autores ✒️
 * I. Cardemil
 * O. Flores
 * P. Tudela
 * J. Vásquez
 
 ## Plantilla de README 👀
 [/README-español.md](https://gist.github.com/Villanuevand/6386899f70346d4580c723232524d35a)
