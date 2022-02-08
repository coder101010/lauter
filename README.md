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

## Local URL
```http://127.0.0.1:8000/```


## To clean up the old message
Set up a cron job or run the following to execute the command manually
```php artisan schedule:run >> /dev/null 2>&1```

To update the number of messages and assets you wish to delete, update the following variable in .env

```MSG_HISTORY```