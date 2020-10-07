#Socio User Management System 

Laravel project to apply CRUD functionalities on users.

## Getting Started

1. Clone or download the repository
2. move into the project directory
3. Install laravel dependencies using `` composer install  ``
4. Install npm dependencies using `` npm install && npm run dev ``
5. Fill all the database information in the ".env" file
6. Generate app encryption key using `` php artisan key:generate ``
7. Generate the database tables using `` php artisan migrate `` 

9. **Important**: \
Generate permission ``php artisan db:seed --class=PermissionTableSeeder`` \

Generate Admin using ``php artisan db:seed --class=CreateAdminUserSeeder `` \

email: "admin@gmail.com", password: "12345678"

10. Run `` php artisan serve `` to open the project


