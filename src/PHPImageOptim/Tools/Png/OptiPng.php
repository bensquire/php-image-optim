<?php

namespace PHPImageOptim\Tools\Png;
use PHPImageOptim\Tools\ToolsInterface;
use PHPImageOptim\Tools\Common;
use Exception;

class OptiPng extends Common implements ToolsInterface
{
    public function optimise()
    {
        exec($this->binaryPath . ' -i0 -o7 -zm1-9 ' . $this->imagePath, $aOutput, $iResult);
        if ($iResult != 0)
        {
            throw new Exception('OPTIPNG was unable  to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}