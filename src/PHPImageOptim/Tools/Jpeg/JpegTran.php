<?php

namespace PHPImageOptim\Tools\Jpeg;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class JpegTran extends Common implements ToolsInterface
{
    /**
     * @return ToolsInterface
     * @throws Exception
     */
    public function optimise(): ToolsInterface
    {
        exec($this->binaryPath . ' -optimize ' . escapeshellarg($this->imagePath), $aOutput, $iResult);
        if ($this->stopIfFail && $iResult !== 0) {
            throw new Exception('JPEGTRAN was unable to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' -v --', $aOutput, $iResult);
    }
}
