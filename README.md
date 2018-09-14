<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Web Development Assignment</h1>
    <br>
</p>

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project is PHP 5.4.0 installed.

CONFIG
------------

### Database

Update the file `config/db.php` with YOUR DATABASE CREDENTIALS, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=assignment',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- The application won't create the database for you, this has to be done manually before you can access it.

### Migration 

Once you have set up the database and edited the config in `config/db.php` you can then run the migration using the following command: 

`php yii migrate`

This command will create the database schema and also insert some data for the purposes of checking functionality. 


### Accessing the application 

Open CMD/Command Prompt and navigate to the root directory of the project. 

Run the following command: 
`php yii serve`

You can then access the application through the following URL:

~~~
http://localhost:8080
~~~


TESTING
-------

Tests are located in `tests/functional` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).

Before running the tests you must configure the environment. 

### Prerequisites 
Create an empty database and name it assignment_tests

Then navigate to `tests/bin` and run the following command: 

`php yii migrate`

This will prepare a test database by implementing the schema and inserting some test data. 

Tests can then be executed from the root directory by running

```
vendor/bin/codecept run functional
```

To run an individual test you must define the test file name and function like so: 
```
vendor/bin/codecept run functional ItemCest::test_name
```



