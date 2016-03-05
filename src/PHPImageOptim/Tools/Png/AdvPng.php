<?php

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class AdvPng extends Common implements ToolsInterface
{
    public function optimise()
    {
        exec($this->binaryPath . ' -z -4 -i20 -- ' . escapeshellarg($this->imagePath), $aOutput, $iResult);
        if ($iResult !== 0) {
            throw new Exception('ADVPNG was unable to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function optimiseStandard()
    {

    }

    public function optimiseExtreme()
    {

    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
