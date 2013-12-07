<?php

namespace PHPImageOptim\Tools\Jpeg;
use PHPImageOptim\Tools\ToolsInterface;
use PHPImageOptim\Tools\Common;
use Exception;

class JpegTran extends Common implements ToolsInterface
{

    public function optimise()
    {
        exec($this->binaryPath . ' -optimize ' . $this->imagePath, $aOutput, $iResult);
        if ($iResult != 0)
        {
            throw new Exception('JPEGTRAN was unable  to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' -v --', $aOutput, $iResult);
    }
}