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
    include('./vendor/autoload.php');
    
    $advPng = new \PHPImageOptim\Tools\Png\AdvPng();
    $advPng->setBinaryPath('/usr/local/bin/advpng');
    
    $optiPng = new \PHPImageOptim\Tools\Png\OptiPng();
    $optiPng->setBinaryPath('/usr/local/bin/optipng');
    
    $pngOut = new \PHPImageOptim\Tools\Png\PngOut();
    $pngOut->setBinaryPath('/usr/bin/pngout');
    
    $pngCrush = new \PHPImageOptim\Tools\Png\PngCrush();
    $pngCrush->setBinaryPath('/usr/local/bin/pngcrush');
    
    $pngQuant = new \PHPImageOptim\Tools\Png\PngQuant();
    $pngQuant->setBinaryPath('/usr/local/bin/pngquant');
    
    $optim = new \PHPImageOptim();
    $optim->setImage('/tests/image/lenna.png');
    $optim->chainCommand($pngQuant)
        ->chainCommand($advPng)
        ->chainCommand($optiPng)
        ->chainCommand($pngCrush)
        ->chainCommand($pngOut);
    $optim->optimise();
