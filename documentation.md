#Documentation

The Laravel application is contained in `app/`. The Angular backend is contained entirely in `admin/`.

---------------

##To install:

####Laravel

1. Create a new file called `enviroment.php`. This will tell Laravel which configuration to use by returning the name of the environment:

  ```php
  <?php
  return 'local';
  ```
2. Then create a file named `.env[environment name].php` return the array of configuration options:

  ```php
  <?php
  return array(
      'DB_HOST' => 'localhost',
      'DB_USER' => 'db_user',
      'DB_PASS' => 'password',
      'DB_DATABASE' => 'database'
  );
  ```
3. Then run `composer install`. For more information about composer and instructions on how to install, go to [the Composer download page](https://getcomposer.org/download/).

####Angular

All these commands should be run from within `admin`, so make sure you `cd admin` before running them. This also depends on having `node` and `npm` both installed.

1. Run `npm i` to install all the node dependencies.

2. Run `bower install` to install all the front-end dependencies.

3. Add the `API_ROOT` to the application by renaming `admin/app/configuration/index.sample.js` to `index.js` and add the API root information: 

```js
module.exports = {
  'API_ROOT': '<url goes here>'
}
```

---------------------

##To run

Run `brunch watch` and `php -S localhost:8000 server.php` in the root of the project.