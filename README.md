# Check an email address exists

[![Latest Version on Packagist](https://img.shields.io/packagist/v/groundsix/laravel-neverbounce.svg?style=flat-square)](https://packagist.org/packages/groundsix/laravel-neverbounce)

This package allows email to be easily checked against https://neverbounce.com/.

Once installed you can do stuff like this:

```php
$this->validate($request, [
  'email' => 'neverbounce',
]);
```

or

```php
NeverBounce::valid($email);
```

## Install

You can install the package via composer:
``` bash
$ composer require ground/laravel-neverbounce
```

This service provider must be installed.
```php
// config/app.php
'providers' => [
    ...
    Groundsix\Neverbounce\NeverBounceServiceProvider::class,
];

'aliases' => [
    ...
    'NeverBounce' => Groundsix\Neverbounce\Facades\NeverBounce::class,
];
```

You can publish the config-file with:
```bash
php artisan vendor:publish --provider="Groundsix\Neverbounce\NeverBounceServiceProvider" --tag="config"
```

And your Neverbounce api details should be added to `.env`:
```
NEVERBOUNCE_USERNAME=<username>
NEVERBOUNCE_SECRET_KEY=<secret key>
```

## Usage

This package registers the `Neverbounce\API\NB_Single` into the application. But for conveniance provides a facade and a validator to simplify checking an email address.

#### Validator

```php
class AuthController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users|neverbounce',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
```

#### Facade

```php
...
use NeverBounce;

class AuthController extends Controller
{
    protected function storeEmail(Request $request)
    {
        if(NeverBounce::valid($request->get('email'))){
          //do something
        }
    }
}
```

#### NB_Single

Or you can access `NB_Single` directly. See https://github.com/NeverBounce/NeverBounceAPI-PHP#single for more details.

```php
...
use NeverBounce\API\NB_Single;

class AuthController extends Controller
{
    protected function storeEmail(Request $request)
    {
        if(app(NB_Single::class)->valid($request->get('email'))->is(NB_Single::GOOD)){
          //do something
        }
    }
}
```
