##Installing

1. First clone this repository:

```
git clone https://github.com/daviesgeek/cms
```

2. [Install Composer](https://getcomposer.org/download/) for the PHP dependencies

3. `cd` into the root of the project and install all the PHP dependencies

```shell
composer install
```

4. Either make a symlink from the `public` directory to `public_html` or rename it to `public_html` (or whatever your public folder is named). I would recommend just symlinking it.

5. Add a new file in the root of the project called `environment.php` and return the environment name:
```php
<?php 
return 'local';
```

6. Configure the environment by creating a new file called `.env.<environment name>.php`, and return the configuration array:
```php
<?php 
return array(

'DB_HOST' => 'localhost',
'DB_USER' => 'user',
'DB_PASS' => 'password',
'DB_DATABASE' => 'database'

);
```

7. Run the migrations and seed the database by running:
```
php artisan migrate
php db:seed
```

8. Install and compile the JS
9. Add the API root and admin path to admin/configuration/index


8 & 9 will eventually have more info
