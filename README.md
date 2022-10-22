# hash-core

## Commands - HashCore
 
site_name(); - get the site name

head(); - add all styles and scripts to the head of the page

js(); - add all scripts to the page

authenticate(OPTION); - check if the user is sign-in or not
- auth - check if the user is sign-in or not redirect to sign-in page if not
- auth-bool - check if the user is sign-in or not pass the result as a boolean

sign_in_form(); - generate a simple sign in form
sign_up_form(); - generate a simple sign up form

products(): - get/display all products

## Register Form - HashCore

```php
<?php include_once 'functions/functions.php'; ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Title</title>
        <?php head(); ?>
    </head>
        <body>

            <?php
            sign_up_form();
            js();
            ?>>

        </body>

    </html>
```


## Login Form - HashCore

```php
<?php include_once 'functions/functions.php'; ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Title</title>
        <?php head(); ?>
    </head>
        <body>

            <?php
            sign_in_form();
            js();
            ?>>

        </body>

    </html>
```
