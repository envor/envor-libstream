# This is my package libstream

[![Latest Version on Packagist](https://img.shields.io/packagist/v/envor/libstream.svg?style=flat-square)](https://packagist.org/packages/envor/libstream)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/envor/libstream/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/envor/libstream/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/envor/libstream/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/envor/libstream/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/envor/libstream.svg?style=flat-square)](https://packagist.org/packages/envor/libstream)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require envor/libstream
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="libstream-migrations"
php artisan migrate
```

## Usage

```php

use Envor\Libstream\Command as LibCommand;
use App\Aggregates\Main;

#[HandledBy(Main::class)]
class Command extends LibCommand
{
    public static function createBusiness(
        string $uuid, 
        array $businessAttributes, 
        array $metaData = []
        ): self
    {
        return new self(new BusinessCreated(
            aggregateUuid: $uuid,
            businessAttributes: $businessAttributes,
            metaData: $metaData
        ));
    }
}

```
```php

use Envor\Libstream\Dispatcher as LibDispatcher

class Dispatcher extends LibDispatcher
{
    public function createBusiness(
        string $uuid, 
        array $businessAttributes, 
        array $metaData = []
        ): self
    {
        $this->add(new Command(new BusinessCreated(
            aggregateUuid: $uuid,
            businessAttributes: $businessAttributes,
            metaData: $metaData
        )));

        return $this;
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [inmanturbo](https://github.com/envor)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
