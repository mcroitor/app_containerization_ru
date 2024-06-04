# metadb
This CLI script creates description of database in PHP language. This case is 
usefull in development, when an IDE with autocomplete is used.

Script will generate a folder _meta_ that will contains php files (PHP 8.x) 
with the name of tables each. Each file will contain a class, with constants 
equal to column names and fields with the same name.

## Usage:
```shell
$ php generator.php --dsn=<DSN> [--user=<USER> --password=<PASSWORD>] [--output=<OUTPUT_FOLDER>]
```

Supported databases: MySQL, sqlite.

## Samples:
``` shell
$ php generator.php --dsn=sqlite:sample.db
$ php generator.php --dsn=mysql:host=localhost;dbname=sample --user=user --password=password
```

For table:
```SQL
CREATE TABLE sample (id INTEGER, param TEXT);
```
will be created file _sample.php_:
```php
<?php
namespace meta;

class sample {
  public const ID = "id";
  public const PARAM = "param";

  public $id;
  public $param;

  public function __construct(array|object $data) {
    foreach($data as $key => $value) {
      $this->$key = $value;
    }
  }
}
```
