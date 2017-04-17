<?php

namespace App\Classes;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class MozJpeg extends Common implements ToolsInterface
{
    public function optimise()
    {
        exec($this->binaryPath . ' -quality 90 ' . escapeshellarg($this->imagePath), $aOutput, $iResult);

        if ($iResult !== 0) {
            throw new Exception('MozJpeg was unable to optimise image.');
        }
        return $this;
    }
    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}