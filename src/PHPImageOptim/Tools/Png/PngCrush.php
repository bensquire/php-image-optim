<?php

namespace PHPImageOptim\Tools\Png;
use PHPImageOptim\Tools\ToolsInterface;
use PHPImageOptim\Tools\Common;
use Exception;

class PngCrush extends Common implements ToolsInterface
{
    public function optimise()
    {
        exec($this->binaryPath . ' -rem gAMA -rem cHRM -rem iCCP -rem sRGB -brute -l 9 -max -reduce -m 0 -q ' . $this->imagePath, $aOutput, $iResult);
        if ($iResult != 0)
        {
            throw new Exception('PNGCrush was unable  to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}