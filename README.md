## About Sample Laravel

Sample Laravel is basic application demonstrating features of the Laravel 
 framework:

- Multi-tenant development and example
- Basic authentication with login and logout
- Middleware example end user licensing agreement
- Sample table migrations
- Custom session driver to add additional database field
- Eloquent ORM sample observer
- Exception handling for non-existing tenants

This sample project is to illustrate the various functionality of a typical website using the Laravel 
framework with some light customizations.

## Install & Setup

This sample project requires Docker, NPM, and composer.

After pulling the project from this repository, run the following commands to try out this 
sample application:

- composer install to install all dependencies and packages
- npm run dev to build assets
- sail up -d
- sail artisan migrate & sail artisan tenants:migrate to migrate sample tables into the database
- Visit [localhost](http://localhost) for central application
- and [test.localhost](http://test.localhost) for tenant application

## Multi-tenant development and example

Multi-tenancy allows a single instance of the codebase to serve multiple customers 
who shares the same application but different database and data.  This sample
application utilizes the stancl/tenancy package as the foundation and is by no means complete as there are still some 
architectural issues that needs to be resolved.  Tenants are configured in this sample project to resolve by subdomains and the sample tenant can be accessed [test.localhost](http://test.localhost).

## Basic Authentication with login and logout

Both the central application and tenant application has basic authentication implemented as well as sample front-end content 
to distinguish between the central and tenant application.
To log into the central application, click on any one  of the buttons and use user a@a.com and password abc.  To log into the tenant application, use t@t.com and 
password abc.

Files:
- app/Http/Controllers

## Middleware example end user licensing agreement

A custom middleware group and middleware is added to the tenant side requiring the user to agree to 
EULA terms and conditions upon logging in.  After clicking agree, the user can
 then continue onward.
 
Files: 
-  app/Http/Kernel.php
-  app/Middleware/Eula.php
-  routes/tenants.php
 
## Sample table migrations

Illustrates database forward and backward database migrations in the Laravel ecosystem.

Files:
-  database/migrations

## Custom session driver to add additional database field

A custom session service provider and database session handler to add an 
additional field in the session database driver.

Files:
-  app/Providers/SessionServiceProvider.php
-  app/Handlers/DatabaseSessionhandler.php

## Eloquent ORM sample observer

Update the email_verified_at field on the user model when creating new users.
 For this sample application, it is fired when the database migration runs since 
 part of the migration seeds some sample users.
 
Files:
-  app/Providers/AppServiceProvider.php
-  app/Observers/User.php

## Exception handling for non-existing tenants

Redirect non-existing tenants (subdomains) to the central home page.

Files:
-  app/Exception/Handler.php