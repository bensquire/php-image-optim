<?php

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class PngCrush extends Common implements ToolsInterface
{
    public function optimise()
    {
        // Pngcrush attempts to write a temporary file to the current directory;
        // make sure we're somewhere we can write a file
        $prevDir = getcwd();
        chdir(sys_get_temp_dir());

        exec($this->binaryPath . ' -rem gAMA -rem cHRM -rem iCCP -rem sRGB -brute -q -l 9 -reduce -ow ' . escapeshellarg($this->imagePath), $aOutput, $iResult);

        // Switch back to previous directory
        chdir($prevDir);

        if ($iResult != 0)
        {
            throw new Exception('PNGCrush was unable  to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
