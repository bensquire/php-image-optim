php-image-optim
===============
[![Build Status](https://travis-ci.org/bensquire/php-image-optim.png)](https://travis-ci.org/bensquire/php-image-optim)

The purpose of this library is to help automate the optimisation of images via the command line in PHP,

Installation:
-------------
The library is PSR-0 compliant and the simplest way to install it is via composer, simply add:

    {
        "require": {
            "bensquire/php-image-optim": "dev-master"
        }
    }

into your composer.json, then run 'composer install' or 'composer update' as required.


Example:
--------
This example demonstrates the optimisation of a PNG file, by chaining several commands together.

    <?php
        use PHPImageOptim\Tools\Png\AdvPng;
        use PHPImageOptim\Tools\Png\OptiPng;
        use PHPImageOptim\Tools\Png\PngCrush;
        use PHPImageOptim\Tools\Png\PngOut;
        use PHPImageOptim\Tools\Png\PngQuant;

        include('../../vendor/autoload.php');

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
        $optim->setImage('/tmp/lenna.png');
        $optim  ->chainCommand($pngQuant)
                ->chainCommand($advPng)
                ->chainCommand($optiPng)
                ->chainCommand($pngCrush)
                ->chainCommand($pngOut);
        $optim->optimise();