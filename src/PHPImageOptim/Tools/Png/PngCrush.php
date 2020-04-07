<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class PngCrush extends Common implements ToolsInterface
{
    /**
     * @throws Exception
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface
    {
        $absoluteImagePath = realpath($this->imagePath);
        if (false === $absoluteImagePath) {
            throw new Exception('Unable to escape PngCrush image path');
        }

        // Write file to temporary location
        $currentDirectory = getcwd();
        if (false === $currentDirectory) {
            throw new Exception('Unable to get current working folder');
        }

        chdir(sys_get_temp_dir());

        exec(
            $this->binaryPath . ' -rem gAMA -rem cHRM -rem iCCP -rem sRGB -brute -q -l 9 -reduce -ow ' . escapeshellarg($absoluteImagePath),
            $output,
            $optimResult
        );

        // Switch back to previous directory
        if (false === chdir($currentDirectory)) {
            throw new Exception('Unable to change folder');
        }

        if (true === $this->stopOnFailure && 0 !== $optimResult) {
            throw new Exception('PNGCRUSH was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    /**
     * @throws Exception
     * @return string
     */
    public function getVersion(): string
    {
        $output = [];
        exec($this->binaryPath . ' --version 2>&1', $output, $result);

        if (0 !== $result) {
            throw new Exception('Unable to determine version, error code: ' . $result);
        }

        $versionMatches = [];
        preg_match('/pngcrush ([0-9]+.[0-9]+.[0-9]+)/m', $output[0], $versionMatches);

        return $versionMatches[1];
    }
}
