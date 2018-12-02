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
        // Write file to temporary location
        $prevDir = getcwd();
        chdir(sys_get_temp_dir());

        exec($this->binaryPath . ' -rem gAMA -rem cHRM -rem iCCP -rem sRGB -brute -q -l 9 -reduce -ow ' . escapeshellarg($absoluteImagePath), $aOutput, $iResult);

        // Switch back to previous directory
        chdir($prevDir);

        if ($this->stopIfFail && $iResult != 0) {
            throw new Exception('PNGCRUSH was unable to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
