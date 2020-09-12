## Barebones Lumen Skeleton
A really contrived lumen skeleton, not to be used anywhere seriously. 

Before Silex's deprecation, I used [micro-silex-base](https://github.com/matical/micro-silex-base).

## Included
- Sessions
- Views
- Eloquent/Query builder

## Serving
- nginx/production - Anchor root to `public/`, be sure to set `APP_ENV` to production
- dev - `composer serve` or `php -S localhost:8000 -t public/ server.php`

## Developing
Copy `.env.example` to `.env`. Main logic lives in `routes.php`. Framework configuration (and maybe helpers) lives in `bootstrap.php`. 

### Databases
- To use sqlite, `touch database/database.sqlite`.
- Anything else, configure `.env` as usual.

## Quirks
Helpers from Illuminate/Foundation (from Laravel) are not available.
#### Getting an instance of schema
```php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

/** @var Illuminate\Database\Schema\Builder $schema */
$schema = DB::getSchemaBuilder();
$schema->create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
});
```

#### Flashing, Errors and Inputs
```php
if ($validator->fails()) {
    session()->flash('errors', $validator->errors()->all());
    session()->flashInput($request->except(['password', 'password_confirmation']));

    return redirect()->route('register');
}
```

#### Serving with Cloudflare/Reverse Proxies
If you're behind a reverse proxy, uncomment the following lines from `bootstrap.php`. This will avoid the "insecure form submission" popup when you're dealing with error flashing + redirects.
```php
if ($app->environment() === 'production') {
    URL::forceScheme('https');
}
```
