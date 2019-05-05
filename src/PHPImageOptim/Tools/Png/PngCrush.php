<?php

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class PngCrush extends Common implements ToolsInterface
{
    /**
     * @return ToolsInterface
     * @throws Exception
     */
    public function optimise(): ToolsInterface
    {
        $absoluteImagePath = realpath($this->imagePath);
        if ($absoluteImagePath === false) {
            throw new \Exception('Unable to escape PngCrush image path');
        }

        // Write file to temporary location
        $currentDirectory = getcwd();
        if ($currentDirectory === false) {
            throw new \Exception('Unable to get current working folder');
        }

        chdir(sys_get_temp_dir());

        exec(
            $this->binaryPath . ' -rem gAMA -rem cHRM -rem iCCP -rem sRGB -brute -q -l 9 -reduce -ow ' . escapeshellarg($absoluteImagePath),
            $aOutput,
            $optimResult
        );

        // Switch back to previous directory
        if (chdir($currentDirectory) === false) {
            throw new \Exception('Unable to change folder');
        }

        if ($this->stopIfFail && $optimResult != 0) {
            throw new Exception('PNGCRUSH was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
