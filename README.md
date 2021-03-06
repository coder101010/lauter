## About

This is an experimental shoutbox project designed to test the potential of Laravel and VueJS with the maximum use of off-the-shelf libraries and packages.  

### Integrations
Homebrew
Composer
PHP
MySQL
Laravel
Node.js
VueJS
Pusher
AWS S3

### Installation
1. Clone this repo
2. Install Composer packages
   ```sh
   composer install
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Create blank database

5. Enter your API keys in `.env`

6. Initilise the database
    ```sh
    php artisan migrate
    ```
7. Compile the webpages and run it
    ```sh
    npm run dev
    php artisan serve
    ```


## Chat Homepage
```~/chat```

## Login Page
```~/login```

## Register Page
```~/register```


## Local URL
```http://127.0.0.1:8000/```


## Production Stack
PHP (8.0.15)
MySQL (8)
Composer (2.2.5)
Apache (2.4.52)
Nginx (1.20.2)

## To clean up the old message
```0 * * * * php /var/www/{APPNAME}/artisan schedule:run 1>> /dev/null 2>&1```
```php artisan schedule:run >> /dev/null 2>&1```

To update the number of messages and assets you wish to delete, update the following variable in .env

```MSG_HISTORY```

## Loal Testing
Please comment out line 27 at `app/Providers/AppServiceProvider.php` for local testing over HTTP.

# Required Services and Env Variables
AWS
Pusher
and
BROADCAST_DRIVER=pusher