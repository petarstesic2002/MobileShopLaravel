## Start
    Put the project in xampp htdocs and start the Apache and MySQL servers
## Install Dependencies
    run composer install
    run composer dump-autoload
## Database
    If the migrations and seeders don't work, use the electro_db.sql from the public folder to create it in phpmyadmin.
    Update database info in .env file
## Credentials
    Credentials are in public folder
    Update FrontController contact method to set up your smtp to recieve mail from the contact form, use .env file if you want
## Run
    run php artisan serve
