<?php

namespace PHPImageOptim\Tools\Gif;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class Gifsicle extends Common implements ToolsInterface
{
    /**
     * @return ToolsInterface
     * @throws Exception
     */
    public function optimise(): ToolsInterface
    {
        exec(
            $this->binaryPath . ' -b -O2 ' . escapeshellarg($this->imagePath),
            $output,
            $optimResult
        );
        if ($this->stopIfFail && $optimResult !== 0) {
            throw new Exception('GIFSICLE was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
