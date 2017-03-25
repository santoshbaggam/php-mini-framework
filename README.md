## Intro

A mini PHP framework built from scratch following the latest PSR standards.

The framework includes concepts like:

### Container

The app container file is located at `app/Core/Container.php`.

You can bind items to the app within `bootstrap/app.php` using the following array syntax. The first item in the array is the instance of the class you want to bind and the second is the method to invoke.

```php
$app->bind('databaseConnection', [new App\Core\Database\Connection, 'make']);
```

And to simply resolve items out of the container:

```php
$db = $app->databaseConnection;
```

### Dependency Injection

Within `app/Core/App.php`

```php
public function __construct()
{
	$this->container = new Container([
        'router' => function () {
            return new Router;
        },
        'response' => function () {
            return new Response;
        }
    ]);
}
```

### Closures

Apart from the array syntax, you can also bind items to the app by passing a closure as the second argument, within `bootstrap/app.php`

```php
$app->bind('database', function ($app) {
	return new App\Core\Database\QueryBuilder($app->databaseConnection);
});
```

### Routing

`routes.php`

You can make GET, POST, PUT, DELETE, or any HTTP route.

```php
// GET
$app->get('users', ['UsersController', 'index']);

// POST
$app->post('users', ['UsersController', 'store']);
```

### Responses

You return html views, json, or any other content type either from Controllers or by using anonymoues functions

```php
# return html view
$app->get('/', ['PagesController', 'home']);

# return json
$app->get('users', ['UsersController', 'index']);

# return plain text
$app->get('status', function ($app) {
	return '<pre> I\'m OK </pre>';
});
```

### And more
The framework includes many other concepts like MVC, front-controller pattern, collections, models, custom config file, etc.

> Note that the framework is not to be used for real projects.
> Built to understand the inner workings of popular frameworks in a simplistic way!

