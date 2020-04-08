#!/usr/bin/php
<?php declare(strict_types=1);

use PHPImageOptim\PHPImageOptim;
use PHPImageOptim\Tools\Png\AdvPng;
use PHPImageOptim\Tools\Png\OptiPng;
use PHPImageOptim\Tools\Png\PngCrush;
use PHPImageOptim\Tools\Png\PngOut;
use PHPImageOptim\Tools\Png\PngQuant;

include('./vendor/autoload.php');

$advPng = new AdvPng();
$advPng->setBinaryPath('/usr/local/bin/advpng');
$advPng->getVersion();        // Optional, for demonstration purposes

$optiPng = new OptiPng();
$optiPng->setBinaryPath('/usr/local/bin/optipng');

$pngCrush = new PngCrush();
$pngCrush->setBinaryPath('/usr/local/bin/pngcrush');

$pngOut = new PngOut();
$pngOut->setBinaryPath('/usr/local/bin/pngout');

$pngQuant = new PngQuant();
$pngQuant->setBinaryPath('/usr/local/bin/pngquant');

$guetzli = new \PHPImageOptim\Tools\Jpeg\Guetzli();
$guetzli->setBinaryPath('/usr/local/bin/guetzli');

$optim = new PHPImageOptim();
$optim->chainCommand($pngQuant);
$optim->chainCommand($advPng);
$optim->chainCommand($optiPng);
$optim->chainCommand($pngCrush);
$optim->chainCommand($pngOut);
$optim->chainCommand($guetzli); // This won't be used because the image is a PNG
$optim->setImage('./tests/image/lenna-original.png');
$optim->optimise();
