<?php

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class OptiPng extends Common implements ToolsInterface
{
    /**
     * @return ToolsInterface
     * @throws Exception
     */
    public function optimise(): ToolsInterface
    {
        exec($this->binaryPath . ' -i0 -o7 -zm1-9 ' . escapeshellarg($this->imagePath), $aOutput, $iResult);
        if ($this->stopIfFail && $iResult !== 0) {
            throw new Exception('OPTIPNG was unable to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
