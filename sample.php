<?php
include('./vendor/autoload.php');

$advPng = new \PHPImageOptim\Tools\Png\AdvPng();
$advPng->setBinaryPath('/usr/local/bin/advpng');

$optiPng = new \PHPImageOptim\Tools\Png\OptiPng();
$optiPng->setBinaryPath('/usr/local/bin/optipng');

$pngOut = new \PHPImageOptim\Tools\Png\PngOut();
$pngOut->setBinaryPath('/usr/local/bin/pngout');

$pngCrush = new \PHPImageOptim\Tools\Png\PngCrush();
$pngCrush->setBinaryPath('/usr/local/bin/pngcrush');

$pngQuant = new \PHPImageOptim\Tools\Png\PngQuant();
$pngQuant->setBinaryPath('/usr/local/bin/pngquant');

$optim = new \PHPImageOptim\PHPImageOptim();
$optim->setImage('./tests/image/lenna-original.png');
$optim->chainCommand($pngQuant)
    ->chainCommand($advPng)
    ->chainCommand($optiPng)
    ->chainCommand($pngCrush)
    ->chainCommand($pngOut);
$optim->optimise();
