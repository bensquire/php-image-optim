<?php

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class AdvPng extends Common implements ToolsInterface
{
    /**
     * @return ToolsInterface
     * @throws Exception
     */
    public function optimise(): ToolsInterface
    {
        exec(
            $this->binaryPath . ' -z -4 -i20 -- ' . escapeshellarg($this->imagePath),
            $output,
            $result
        );

        if ($this->stopIfFail && $result !== 0) {
            throw new Exception('ADVPNG was unable to optimise image, result:' . $result . ' File: ' . $this->imagePath);
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
