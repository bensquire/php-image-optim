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
        exec(
            $this->binaryPath . ' -optimize ' . escapeshellarg($this->imagePath),
            $output,
            $optimResult
        );

        if ($this->stopIfFail && $optimResult !== 0) {
            throw new Exception('JPEGTRAN was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' -v --', $aOutput, $iResult);
    }
}
