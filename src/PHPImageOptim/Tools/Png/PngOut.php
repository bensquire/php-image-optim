<?php

namespace PHPImageOptim\Tools\Png;
use PHPImageOptim\Tools\ToolsInterface;
use PHPImageOptim\Tools\Common;
use Exception;

class PngOut extends Common implements ToolsInterface
{
    public function optimise()
    {
        exec($this->binaryPath . ' -s0 -q -y ' . $this->imagePath . ' ' . $this->imagePath, $aOutput, $iResult);

        if ($iResult == 2)
        {
            return $this;
        }

        if ($iResult != 0)
        {
            throw new Exception('PNGOUT was Unable to optimise image, result:' . $iResult . ' File: ' . $this->binaryPath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath, $aOutput, $iResult);
    }
}