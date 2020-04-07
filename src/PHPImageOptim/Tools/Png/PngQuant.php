<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class PngQuant extends Common implements ToolsInterface
{
    /**
     * @throws Exception
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface
    {
        exec(
            $this->binaryPath . ' --speed 1 --ext=.png --force ' . escapeshellarg($this->imagePath),
            $output,
            $optimResult
        );

        if (true === $this->stopOnFailure && 0 !== $optimResult) {
            throw new Exception('PNGQUANT was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
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
        exec($this->binaryPath . ' --version', $output, $result);

        if (0 !== $result) {
            throw new Exception('Unable to determine version, error code: ' . $result);
        }

        $versionMatches = [];
        preg_match('/^([0-9]{1,2}.[0-9]{1,2}.[0-9]{1,2})/m', $output[0], $versionMatches);

        return $versionMatches[1];
    }
}
