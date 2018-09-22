# Easily add seo meta data to your Eloquent model.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fhusquinet/laravel-model-seoable.svg?style=flat-square)](https://packagist.org/packages/fhusquinet/laravel-model-seoable)
[![Total Downloads](https://img.shields.io/packagist/dt/fhusquinet/laravel-model-seoable.svg?style=flat-square)](https://packagist.org/packages/fhusquinet/laravel-model-seoable)

If you are storing a lot of values, especially booleans, as columns in your database, and if this data is not always the same for each row you might want to consider using a JSON column.
To ease up the usage of it, this package provides an easy way API toscope results from your database and getting/setting options.
If you are used to Laravel's syntax you will be familiar with this one as well.

## Installation

You can install the package via composer:

```bash
composer require fhusquinet/laravel-model-seoable
```

```bash
php artisan migrate
```

## Usage

Add the Seoable trait to your wanted models.
``` php
// App\Models\Article.php

namespace App\Models;

use FHusquinet\Seoable\Traits\Seoable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Seoable;
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email florian.husquinet@deegital.be instead of using the issue tracker.

## Credits

- [Florian Husquinet](https://github.com/fhusquinet)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
