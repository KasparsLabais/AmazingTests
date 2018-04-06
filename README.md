# AmazingTests

Amazing tests is simple No-framework application where you can take few (1) tests! JS/CSS do not count

## Installation
###Clone repo

```sh
$ git clone https://github.com/KasparsLabais/AmazingTests.git
```

### Enable rewrite module
Make sure rewrite module is uncommented (remove #)
```sh
LoadModule rewrite_module modules/mod_rewrite.so
```

### Edit .htaccess

So all requests would go via index.php

```sh
    AllowOverride All
    Require all granted
    RewriteEngine on
    
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
```

### Add Database

Import DB via sql file

```sh
/frame/db/tests_db.sql
```

### CDN

| CDN | WHY |
| ------ | ------ |
| VueJs | Because it is not a stone age. |
| Bootstrap V4 | We all love beautiful things |
| FontAwesome | Because it is "Awesome"? |


## New Features!

- Don't have any features.