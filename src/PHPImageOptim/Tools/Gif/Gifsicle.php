<?php

namespace PHPImageOptim\Tools\Gif;
use PHPImageOptim\Tools\ToolsInterface;
use PHPImageOptim\Tools\Common;
use Exception;

class Gifsicle extends Common implements ToolsInterface
{
    public function optimise()
    {
        exec($this->binaryPath . ' -b -O2 ' . $this->imagePath, $aOutput, $iResult);
        if ($iResult != 0)
        {
            throw new Exception('Gifsicle was unable to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
