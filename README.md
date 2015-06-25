# in construction
![alt text](http://shimi.890m.com/img/construction.png":-)")

Yii2-Forms-Builder
============================

Yii2-Forms-Builder is a skeleton [Yii 2](http://www.yiiframework.com/) application
that allow to build dynamic forms :)


The module contains the basic features for create forms.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      modules/
            dform/        contains module and dependencies
                assets/             contains assets definition
                components/         contains the module components
                controllers/        contains module controller classes
                css/                contains the css
                img/                contains images
                js/                 contains the java script
                models/             contains model classes
                views/              contains view files for the module
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded to your application a directory named modules
that is directly under the module directory.

#### you need to copy only dform module


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=YOUR_HOST;dbname=YOUR_DB_NAME',
    'username' => 'USER_NAME',
    'password' => 'PASSWORD',
    'charset' => 'utf8',
];
```

**NOTE:** you don`t need to create a database you need to run "migration/init.php".
          if you have a database you can add the tables from migration to your database

Also check and edit the other files in the `config/` directory to customize your application.
