# php-image-optim
[![Build Status](https://travis-ci.org/bensquire/php-image-optim.png)](https://travis-ci.org/bensquire/php-image-optim)

The purpose of this library is to help automate the optimisation of images via the command line in PHP,

## Installation:
### Library
The library is PSR-4 compliant and the simplest way to install it is via composer, simply add:

```json
    {
        "require": {
            "bensquire/php-image-optim": "dev-master"
        }
    }
```

into your composer.json, then run 'composer install' or 'composer update' as required.

### Binaries
#### MacOS

```console
brew install Advancecomp # AdvPNG
brew install gifsicle
brew install guetzli
brew install jonof/kenutils/pngout
brew install jpeg # JPEGTran
brew install jpegoptim
brew install mozjpeg
brew install optipng
brew install pngcrush
brew install pngquant
brew install zopfli # Future
brew install svgo # Future

```

It's worth noting that mozJpeg is a fork of libjpeg-turbo and as such isn't a binary with it's own name, for example to use it in this library:

```php
use PHPImageOptim\Tools\Jpeg\MozJpeg;$tool = new MozJpeg();
$tool->setBinaryPath('/usr/local/opt/mozjpeg/bin/jpegtran');
```


## Example
This example demonstrates the optimisation of a PNG file, by chaining several commands together.

```php
use PHPImageOptim\Tools\Png\AdvPng;use PHPImageOptim\Tools\Png\OptiPng;use PHPImageOptim\Tools\Png\PngCrush;use PHPImageOptim\Tools\Png\PngOut;use PHPImageOptim\Tools\Png\PngQuant;<?php
    include('./vendor/autoload.php');

    $advPng = new AdvPng();
    $advPng->setBinaryPath('/usr/local/bin/advpng');

    $optiPng = new OptiPng();
    $optiPng->setBinaryPath('/usr/local/bin/optipng');

    $pngOut = new PngOut();
    $pngOut->setBinaryPath('/usr/bin/pngout');

    $pngCrush = new PngCrush();
    $pngCrush->setBinaryPath('/usr/local/bin/pngcrush');

    $pngQuant = new PngQuant();
    $pngQuant->setBinaryPath('/usr/local/bin/pngquant');

    $optim = new PHPImageOptim();
    $optim->setImage('./tests/image/lenna.png');
    $optim->chainCommand($pngQuant)
        ->chainCommand($advPng)
        ->chainCommand($optiPng)
        ->chainCommand($pngCrush)
        ->chainCommand($pngOut);
    $optim->optimise();
```

## Tooling
### Fix common coding inconsistencies
```console
    composer php-cs-fixer
```

### Find coding issues
```console
    composer php-stan
```

### Run unit tests
```console
    composer tests
```


## TODO:
Add zopfli support?

Add svgo support?